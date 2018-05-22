<?php

namespace App\Http\Controllers;
use Session;
use App\Item;
use Illuminate\Http\Request;

class ListsController extends Controller
{
    
	public function index()
	{
		 return view('list');
	}


	public function create(request $request)
	{
		$item = new Item;
		$item->item = $request->text;
		$item->save();
		Session::flash('status', 'Item Added Successfully');
		return redirect()->back();
	}

}
