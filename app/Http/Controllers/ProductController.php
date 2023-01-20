<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::query()->with(['category','vendor','material']);
        if (request()->ajax()) {
            return datatables($product)
                ->editColumn('image', function ($product) {
                    $image = json_decode($product->images, true);
                    return '<img src="'.asset('storage/'.$image[0]).'" width="100" alt="image">';
                })
                ->editColumn('action', 'product.partials.action')
                ->rawColumns(['action','image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('product.index');
    }
    public function add()
    {
        return view('product.add', [
                'categories' => ProductCategory::all(),
         'materials' => Material::all(),
                'vendors' => Vendor::all(),
                'barcode' => rand(11, 99),
        ]);
    }
    public function store()
    {
        $product = request()->validate([
            'barcode' => ['required', 'unique:products'],
            'product_name' => ['required','string'],
            'quantity' => ['required', 'max:11'],
            'category_id' => ['required'],
            'material_id' => ['required'],
            'unit' => ['required','string'],
            'retail_price' => ['required','max:11'],
            'purchase_price' => ['required','max:11'],
            'vendor_id' => ['required'],
            'description' => ['required'],
        ]);
        if (\request()->input('image')) {
            $product['images'] = json_encode(\request()->input('image'));
        }
        Product::create($product);

        return redirect()->back()->with('success', 'Product added successfully');
    }
    public function imageUpload(Request $request)
    {
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->storeAs('products/images', $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName()
        ]);
    }
    public function deleteImage(Request $request)
    {
        $name = $request->image;
        Storage::delete('products/images/'.$name);

        return response()->json([
            'status' => true
        ]);
    }
    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product,
            'categories' => ProductCategory::all(),
            'materials' => Material::all(),
            'vendors' => Vendor::all(),
        ]);
    }
    public function update(Product $product)
    {
        $data = request()->validate([
            'barcode' => ['required', Rule::unique('products')->ignore($product->id)],
            'product_name' => ['required','string'],
            'quantity' => ['required', 'max:11'],
            'category_id' => ['required'],
            'material_id' => ['required'],
            'unit' => ['required','string'],
            'retail_price' => ['required','max:11'],
            'purchase_price' => ['required','max:11'],
            'vendor_id' => ['required'],
            'description' => ['required'],
        ]);
        if (request()->input('image')) {
            $images = json_decode($product->images, true);
            foreach ($images as $image) {
                Storage::delete('public/products/images/'.$image);
            }
            $data['images'] = json_encode(request()->input('image'));
        }
        $product->update($data);

        return redirect(route('product.index'))->with('success', 'Product '.$product->product_name . ' updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('product.index'))->with('success', 'Product deleted!');
    }
}
