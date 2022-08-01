<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

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
