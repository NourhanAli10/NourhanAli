<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Brand;
use App\Models\Product;
use App\services\Media;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductRequest;


class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('layouts.products.index', compact('products'));
    }

    public function create()
    {
        $brands =  Brand::select('id', 'name_en')->orderBy('name_en', 'ASC')->get();
        $subcategories = Subcategory::select('id', 'name_en')->orderBy('name_en', 'ASC')->get();
        return view('layouts.products.create', compact('brands', 'subcategories'));
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $brands =  Brand::select('id', 'name_en')->orderBy('name_en', 'ASC')->get();
        $subcategories = Subcategory::select('id', 'name_en')->orderBy('name_en', 'ASC')->get();
        return view('layouts.products.edit', compact('brands', 'subcategories', 'products'));
    }


    public function store(StoreProductRequest $request)
    {

        $newImageName = Media::upload($request->file('image'), 'product');
        $data = $request->except('_token', 'image');
        $data['image'] =  $newImageName;
        //    product::create($data);
        DB::table('products')->insert($data);
        return redirect()->route('dashboard.products.index')->with('success', 'Product Created Successfully');
    }


    public function update(StoreProductRequest $request, $id)
    {

        $data = $request->except('_token', '_method', 'image');
        $product = product::findOrFail($id);
        if ($request->hasFile('image')) {
            $newImageName = Media::upload($request->file('image'), 'product');
            $data['image'] = $newImageName;
            Media::delete(public_path('images\product\\' . $product->image));
        }

        $product->update($data);
        return redirect()->route('dashboard.products.index')->with('success', 'product updated successfully');
    }



    public function delete($id)
    {
        $product = product::findOrFail($id);
        Media::delete(public_path('images\product\\' . $product->image));
        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'product deleted successfully');
    }
}
