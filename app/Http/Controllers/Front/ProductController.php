<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('front.product.index',['models'=>Product::paginate(10)]);
    }
    public function create()
    {
        return view('front.product.form');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('product.index')->with("Success");
    }
    public function edit(Product $product)
    {
        return view('front.product.form',['model'=>$product]);
    }
    public function update(ProductRequest $productRequest, Product $product)
    {
        $product->update($productRequest->validated());
        return redirect()->back();
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with("Success");
    }
}
