<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        return view('welcome', compact('categories'));
    }

    public function CategoryProduct(Request $request)
    {
        $category = Category::find($request->category_id);
        $products = $category->products;
        // return Products With Success Response
        return response()->json($products,200);
    }

    public function productStore(Request $request)
    {
        $data = $request->categoryProduct;
        foreach ($data as $key => $row) {
            CategoryProduct::create([
                'category_id' => $row['categoryName'],
                'product_id' => $row['productName'],
                'price' => $row['priceName'],
            ]);
        }
        return redirect()->route('home')->with('success', 'Product Added Successfully');
    }

}
