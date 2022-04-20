<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image1 =  null;
        $image2 = null;
        $image3 =  null;
        $image4 =  null;
        if ($request->file('image1') != null){
            $image1 =  $request->file('image1')->store('products/images');
        }
        if ($request->file('image2') != null){
            $image2 =  $request->file('image2')->store('products/images');
        }
        if($request->file('image3') != null){
            $image3 =  $request->file('image3')->store('products/images');
        }
        if($request->file('image4') != null){
            $image4 =  $request->file('image4')->store('products/images');
        }

        $productData = json_decode($request->product, true);
        $productData['quantity'] = (int)$productData['quantity'];
        $productData['retail_price'] = (int)$productData['retail_price'];
        $productData['purchase_price'] = (int)$productData['purchase_price'];
        $productData['images'] = json_encode(array($image1, $image2, $image3, $image4));
        $productData['barcode'] = rand(11,99);

        return Product::create($productData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
