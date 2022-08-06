<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;

class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Lista::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $list = new Lista;
        $list->name = $request->input('name');
        $list->active = $request->input('active');
        $list->user_id = $request->input('user_id');
        $list->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Lista::findOrFail($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function find_by_name(Request $request)
    {
        return Lista::where('name','=',$request->input('name'))->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function find_by_user_id(Request $request)
    {
        $list = Lista::where('user_id','=',$request->input('user_id'))->where('active','=',1)->first();
        $json_list = new Lista;
        $json_list->id = $list->id;
        $json_list->name = $list->name;

        $all_categories=[];
        foreach($list->items as $item){
            $category=(new CategoryController)->show($item->category_id);
            if (!in_array($category, $all_categories)){
                $all_categories[] = $category;
            }
        }

        $filtered_categories = [];
        $data = [];
        foreach($all_categories as $category){
            $filtered_items = $list->items->where("category_id","=",$category->id);

            $items = [];
            foreach($filtered_items as $filtered_item){
                $item = new Item;
                $item->id = $filtered_item->id;
                $item-> name = $filtered_item->name;
                $item-> note = $filtered_item->note;
                $item-> image = $filtered_item->image;
                $item-> category_id = $filtered_item->category_id;
                $item-> created_at = $filtered_item->created_at;
                $item-> updated_at = $filtered_item->updated_at;
                $item-> pivot = $filtered_item->pivot;
                $items[] = $item;
            }
            $category->items = $items;
            $filtered_categories[] =$category;
        }

        $json_list['categories']=$filtered_categories;
        return $json_list;
    }

    /**
     * Display items from a list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function find_items($id)
    {
        $lista = Lista::findOrFail($id);        
        return $lista->items;
    }

    /**
     * Display inactive lists grouped by month and year.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function find_lists_by_month_year(Request $request)
    {
        $months = DB::table("list")
        ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') AS new_date")
        ->where("active","=","0")
        ->where("user_id","=",$request->input('user_id'))
        ->orderBy('created_at',"DESC")
        ->groupBy('new_date')
        ->get();

        $lists_by_month = [];
        foreach ($months as $month){
            $month_year = $month->new_date;
            $list = DB::table("list")
            ->selectRaw("id,name,canceled,DATE_FORMAT(created_at, '%Y-%m') AS new_date,DATE_FORMAT(created_at, '%d.%m.%y') AS created_at")
            ->where("active","=","0")
            ->where("user_id","=",$request->input('user_id'))
            ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"),"=",$month_year)
            ->get();
            $lists_by_month[] = $list;
        }
        
        return $lists_by_month;
    }

    /**
     * Add an item to a list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_item_to_list($item_id,$list_id)
    {
        $item = Item::findOrFail($item_id);
        $list = Lista::findOrFail($list_id);
        if (!$item->lists->contains($list_id)){
            $item->lists()->attach($list);
            return $item;
        }
        
        return 400;
    }

    /**
     * Set the active list and deactivate the others.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function set_active_list($list_id)
    {
        $lists = Lista::all();
        foreach($lists as $list){
            if ($list->id != $list_id and $list->active){
                $list->active = false;
            }
            else if ($list->id == $list_id and !$list->active){
                $list->active = true;
            }
            $list->save();
        }
        
        return 200;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $list = Lista::findOrFail($request->input('id'));
        $list->name = $request->input('name');
        $list->active = $request->input('active');
        $list->user_id = $request->input('user_id');
        
        $list->save();

        return $list;
    }

    /**
     * Add the new items and update the quantity for each item
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_list_items(Request $request)
    {
        $list = Lista::findOrFail($request->input('list_id'));
        $items = json_decode($request->input('items'),true);

        foreach ($items as $item) {
            $this->add_item_to_list($item['id'],$list->id);

            $item_in_list = DB::table('item_list')
            ->where('item_id', '=', $item['id'])
            ->where('lista_id', '=', $request->input('list_id'))
            ->update(['quantity'=>$item['pivot']['quantity']]);
        }

        return $list->items;
    }

    /**
     * Update the quantity of an item in the list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_item_quantity(Request $request)
    {
        $item_in_list = DB::table('item_list')
        ->where('item_id', '=', $request->input('item_id'))
        ->where('lista_id', '=', $request->input('list_id'))
        ->update(['quantity'=>$request->input('quantity')]);

        return $item_in_list;
    }

    
    /**
     * Delete an item from the list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove_item_from_list(Request $request)
    {
        $item_in_list = DB::table('item_list')
        ->where('item_id', '=', $request->input('item_id'))
        ->where('lista_id', '=', $request->input('list_id'))
        ->delete();

        return 200;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = Lista::findOrFail($id);
        $list->delete();
    }


}
