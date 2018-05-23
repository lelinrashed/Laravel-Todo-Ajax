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


	public function create(Request $request)
	{
		$item = new Item;
		$item->item = $request->text;
		$item->save();
		Session::flash('status', 'Item Added Successfully');
		return 'Item Create Successfully.';
	}

	public function delete(Request $request)
	{
		Item::where('id', $request->id)->delete();
		return 'Item Delete Successfully.';
	}

	public function update(Request $request)
	{
		$item = Item::find($request->id);
		$item->item = $request->value;
		$item->save();		
		Session::flash('status', 'Update item Successfully');
		return 'Item Update Successfully.';
	}

	public function search(Request $request)
	{
		$term = $request->term;
		$items = Item::where('item', 'LIKE', '%'.$term.'%')->get();
		if (count($items)==0) {
			$searchResult[] = 'No item found';
		}else{
			foreach ($items as $key => $value) {
				$searchResult[] = $value->item;
			}
		}
		return $searchResult;
	}


}
