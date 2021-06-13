<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Variation;

class ProductController extends Controller
{
	public function index()
	{
		$products = Product::all();
		return view('admin.products-index')->with(compact('products'));
	}
	public function all()
	{
		$products = Product::with('variations')->get();
		return response()->json($products);
	}
	public function create()
	{
		$variations = Variation::all();
		return view('admin.products-create')->with(compact('variations'));
	}
	public function Add(Request $request)
	{
		$product = new Product;

		$product->name=$request->name;
		$product->detail=$request->detail;
		$product->Save();

		$product->variations()->attach($request->variations);

		$request->session()->flash('alert-success', 'Product Add Successfully');
		return redirect(route('products.index'));
	}
	public function edit(Product $product,$id)
	{
         $product = Product::with('variations')->find($id);
		 $variations = Variation::all();
         return view('admin.products-edit')->with(compact('product', 'variations'));
	}
	public function update(Request $request)
	{
		$product = Product::find($request->id);

		$product->name=$request->name;
		$product->detail=$request->detail;
		$product->Update();

		$product->variations()->sync([]);
		$product->variations()->attach($request->variations);
		return redirect(route('products.index'));
	}
	public function deleteProduct(Request $request, $id )
    {
        $product = Product::with('variations')->find($id);
		$product->variations()->sync([]);
        $product->delete();

        $request->session()->flash('alert-danger', 'Product Delete Successfully');
          return back();
    }

}
