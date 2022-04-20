<?php

namespace App\Http\Controllers\api;

use App\Models\CustomerOrder;
use App\Models\Product;
use App\Models\SaleOrder;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;

class SaleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CustomerOrder::whereDate('created_at', Carbon::today())->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orderId = [
            'table' => 'customer_orders',
            'field' => 'order_id',
            'length' => 11,
            'prefix' => 'NCS',
            'reset_on_prefix_change' => true,
        ];
        $customerOrder = CustomerOrder::create([
            'order_id' => IdGenerator::generate($orderId),
            'customer_id' => 1,
            'total_amount' => $request->total_amount,
            'amount_paid' => $request->amount_paid,
            'payment_method' => $request->payment_method,
            'discount' => $request->discount,
            'remaining_amount' => 0,
            'order_status' => 1,
        ]);
        foreach ($request->products as $product) {
            SaleOrder::create([
                'customer_orders_id' => $customerOrder->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'amount' => $product['total_price']
            ]);
           $proQuantity =  Product::where('id', $product['product_id'])->first();

           $proQuantity->update(['quantity' => ($proQuantity->quantity - $product['quantity'])]);
        }

        return $customerOrder;
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
