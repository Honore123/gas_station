<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('product-category.index', [
            'categories' => ProductCategory::all(),
        ]);
    }

    public function store()
    {

        $category = request()->validate([
            'category_name' => ['required'],
        ]);

        ProductCategory::create($category);

        return redirect()->back()->with('success','Category created successfully');
    }

    public function edit(ProductCategory $category)
    {
        return response()->json($category);
    }

    public function update()
    {
        $data = request()->validate([
            'category_name' => ['required'],
        ]);
        $category = ProductCategory::where('id',request()->input('category'));


        $category->update($data);

        return redirect()->back()->with('success','Category updated');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted');
    }
}
