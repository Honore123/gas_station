<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SaleOrder;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class SaleOrderController extends Controller
{
    public function index()
    {
        $order = CustomerOrder::query()->with(['customer']);
        if (request()->ajax()) {
            return datatables($order)
                ->editColumn('order_date', function ($order) {
                    return date('d/m/Y', strtotime($order->created_at));
                })
                ->editColumn('order_status', function ($order) {
                    if ($order->order_status == 0) {
                        return '<span class="badge bg-primary w-100" >Pending</span>';
                    } elseif ($order->order_status == 1) {
                        return '<span class="badge bg-success w-100">Paid</span>';
                    } else {
                        return '<span class="badge bg-danger w-100">Cancelled</span>';
                    }
                })
                ->editColumn('total_amount', function ($order) {
                    return number_format($order->total_amount,0,'.',',');
                })
                ->editColumn('action','sale-order.partials.action')
                ->rawColumns(['order_status','action'])
                ->addIndexColumn()
                ->make(true);

        }
        return view('sale-order.index');
    }

    public function add()
    {
        $orderId = [
            'table' => 'customer_orders',
            'field' => 'order_id',
            'length' => 6,
            'prefix' => 'NCS',
            'reset_on_prefix_change' => true,
        ];

        return view('sale-order.add', [
            'customers' => Customer::all(),
            'categories' => ProductCategory::all(),
            'order_id' => IdGenerator::generate($orderId)
        ]);
    }
    public function ajaxCustomer(Customer $customer, $order)
    {
        $customerOrder = CustomerOrder::where('order_id',$order)->first();
        if (!is_null($customerOrder)) {
            $customerOrder->update([
                "order_id" => $order,
                "customer_id" => $customer->id,
                "total_amount" => 0,
                "amount_paid" => 0,
                "remaining_amount" => 0,
            ]);
        } else {
            $customerOrder = CustomerOrder::create([
                "order_id" => $order,
                "customer_id" => $customer->id,
                "total_amount" => 0,
                "amount_paid" => 0,
                "remaining_amount" => 0,
            ]);
        }
        return response()->json([
            "phone_number" => $customer->phone_number,
            "email" => $customer->email,
            "customer_order_id" => $customerOrder->id
        ]);
    }

    public function store(Request $request)
    {
       $request->validate([
            'selected' => ['required']
        ]);
        $products = $request->product;
        $selects = $request->selected;
        $quantities = $request->quantity;
        $amounts = $request->amount;
        $customerOrderId = $request->customerOrderId;
        $customerOrder = CustomerOrder::where('id',$customerOrderId)->first();

        foreach ($selects as $key => $selected)
        {
            foreach ($products as $index => $product)
            {
                if ($selected === $product)
                {
                    $amount = $quantities[$index] * $amounts[$index];
                    SaleOrder::create([
                        'customer_orders_id' => $customerOrderId,
                        'product_id' => $product,
                        'quantity' => $quantities[$index],
                        'amount' => $amount
                    ]);
                    $customerOrder->update([
                        "total_amount" => $customerOrder->total_amount + $amount,
                    ]);
                }
            }
        }

        return redirect(route('sale-order.index'))->with('success','Products added successfully');
    }

    public function edit(CustomerOrder $order)
    {
        $purchases = SaleOrder::with(['product'])->where('customer_orders_id',$order->id)->get();

        return view('sale-order.edit',[
            'customerOrder' => $order->with(['customer'])->where('id',$order->id)->first(),
            'sales' => $purchases,
            'categories' => ProductCategory::all(),
        ]);
    }

    public function orderPayment(CustomerOrder $order)
    {
        $order->update([
            'order_status' => 1
        ]);

        return redirect(route('sale-order.index'))->with('success','Order payment successfully');
    }
}
