<?php

namespace App\Http\Controllers;
use Session;
use App\Item;
use Illuminate\Http\Request;

class ListsController extends Controller
{
    
	public function index()
	{
		return view('list')->with('items', Item::all());
	}


	public function create(request $request)
	{
		$item = new Item;
		$item->item = $request->text;
		$item->save();
		Session::flash('status', 'Item Added Successfully');
		return 'Item Create Successfully.';
	}

	public function delete(request $request)
	{
		Item::where('id', $request->id)->delete();
		return 'Item Delete Successfully.';
	}

	public function update(request $request)
	{
		$item = Item::find($request->id);
		$item->item = $request->value;
		$item->save();		
		Session::flash('status', 'Update item Successfully');
		return 'Item Update Successfully.';
	}

}
