<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Lista;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::all()->sortBy('category_id');
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
        $item = new Item;
        $item->name = $request->input('name');
        $item->category_id = $request->input('category_id');
        $item->note = $request->input('note');
        $item->image = $request->input('image');
        $item->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Item::findOrFail($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function find_by_name(Request $request)
    {
        return Item::where('name','=',$request->input('name'))->first();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $item = Category::findOrFail($request->input('id'));
        $item->name = $request->input('name');
        $item->category_id = $request->input('category_id');
        $item->note = $request->input('note');
        $item->image = $request->input('image');

        $item->save();

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items_in_list = DB::table('item_list')
        ->where('item_id', '=', $id)->delete();

        $item = Item::findOrFail($id);
        $item->delete();
    }

}
