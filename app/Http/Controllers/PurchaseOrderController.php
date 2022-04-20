<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use App\Models\VendorOrder;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $vendorOrder = VendorOrder::query()->with(['vendor']);
        if (request()->ajax()) {
            return datatables($vendorOrder)
                ->editColumn('order_status', function ($order) {
                    if ($order->order_status == 0) {
                        return '<span class="badge bg-primary w-100">Pending</span>';
                    } elseif ($order->order_status == 1) {
                        return '<span class="badge bg-info w-100">Approved</span>';
                    } else {
                        return '<span class="badge bg-danger w-100">Cancelled</span>';
                    }
                })
                ->editColumn('total_amount', function ($order) {
                    return number_format($order->total_amount,0,'.',',');
                })
                ->editColumn('action','purchase-order.partials.action')
                ->rawColumns(['order_status','action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('purchase-order.index');
    }
    public function add()
    {
        $orderId = [
            'table' => 'vendor_orders',
            'field' => 'order_id',
            'length' => 6,
            'prefix' => 'NCP',
            'reset_on_prefix_change' => true,
        ];

        return view('purchase-order.add', [
            'vendors' => Vendor::all(),
            'categories' => ProductCategory::all(),
            'order_id' => IdGenerator::generate($orderId)
        ]);
    }

    public function ajaxVendor(Vendor $vendor, $order)
    {
        $vendorOrder = VendorOrder::where('order_id',$order)->first();
        if (!is_null($vendorOrder)) {
            $vendorOrder->update([
                "order_id" => $order,
                "vendor_id" => $vendor->id,
                "total_amount" => 0,
                "amount_paid" => 0,
                "remaining_amount" => 0,
            ]);
        } else {
            $vendorOrder = VendorOrder::create([
                "order_id" => $order,
                "vendor_id" => $vendor->id,
                "total_amount" => 0,
                "amount_paid" => 0,
                "remaining_amount" => 0,
            ]);
        }
        return response()->json([
            "phone_number" => $vendor->phone_number,
            "email" => $vendor->email,
            "vendor_order_id" => $vendorOrder->id
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
        $vendorOrderId = $request->vendorOrderId;
        $vendorOrder = VendorOrder::where('id',$vendorOrderId)->first();

        foreach ($selects as $key => $selected)
        {
            foreach ($products as $index => $product)
            {
                if ($selected === $product)
                {
                    $amount = $quantities[$index] * $amounts[$index];
                    PurchaseOrder::create([
                        'vendor_orders_id' => $vendorOrderId,
                        'product_id' => $product,
                        'quantity' => $quantities[$index],
                        'amount' => $amount
                    ]);
                    $vendorOrder->update([
                        "total_amount" => $vendorOrder->total_amount + $amount,
                    ]);
                }
            }
        }

        return redirect(route('purchase-order.index'))->with('success','Now you can download PDF file');
    }

    public function edit(VendorOrder $order)
    {
        $purchases = PurchaseOrder::with(['product'])->where('vendor_orders_id',$order->id)->get();

        return view('purchase-order.edit',[
            'vendorOrder' => $order->with(['vendor'])->where('id',$order->id)->first(),
            'purchases' => $purchases,
            'categories' => ProductCategory::all(),
        ]);
    }

    public function submitOrder(VendorOrder $order)
    {
        $order->update([
            'order_status' => 1
        ]);

        return redirect(route('purchase-order.index'))->with('success','Order approved successfully');
    }
}
