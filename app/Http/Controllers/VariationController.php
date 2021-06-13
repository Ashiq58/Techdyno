<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Variation;
use App\Product;

class VariationController extends Controller
{
	public function index()
	{
		$variations = Variation::all();
		return view('admin.variations-index')->with(compact('variations'));
	}
	public function all()
	{
		$variations = Variation::all();
		return response()->json($variations);
	}
	public function getVariants(Request $request)
	{
		$variations = Variation::where('product_id', '=', $request->product_id)->get();
        return response()->json(["success"=>true, 'variations'=>$variations]);   
	}
	public function create()
	{
		$products = Product::all();
		return view('admin.variations-create')->with(compact('products'));
	}
	public function store(Request $request)
	{
       $variation = new Variation;

       $variation->name=$request->name;
       $variation->value=$request->value;
       $variation->Save();
       $request->session()->flash('alert-success', ' Add Successfully');
       return redirect(route('variations'));

	}
	public function edit(Request $request,$id)
	{
        $variation =Variation::find($id);
         $products =Product::all();
        return view('admin.variations-edit')->with(compact('variation','products'));
	}
	public function update(Request $request)
	{
       $variation = Variation::find($request->id);
       $variation->name= $request->name;
       $variation->value= $request->value;
       $variation->Update();
       
       return redirect(route('variations'));

	}
	public function deleteProduct(Request $request, $id )
    {
        $variation = Variation::find($id);
        $variation->delete();

        $request->session()->flash('alert-danger', 'Variation Delete Successfully');
		return redirect()->route('variations')->with('alert-danger', 'Variation Delete Successfully');
    }

}
