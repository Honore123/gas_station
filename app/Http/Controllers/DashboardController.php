<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\Expense;
use App\Models\Product;
use App\Models\SaleOrder;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data[] = '';
        $revenue = CustomerOrder::where('order_status',1)
            ->whereDate('created_at', '>',Carbon::now()->subDays(30))
            ->get();
        $product = SaleOrder::whereHas('customerOrder', function ($query) {
            $query->where('order_status',1)
                ->whereDate('created_at', '>',Carbon::now()->subDays(30));
        })->with(['customerOrder', 'product'])->get();
        $costPrice = [];
        $expense = Expense::whereDate('created_at', '>',Carbon::now()->subDays(30)) ->get();
        $bestSelling = DB::table('sale_orders')
            ->join('products', 'sale_orders.product_id','=','products.id')
            ->select('products.*','sale_orders.product_id',DB::raw('SUM(sale_orders.quantity) as sold'))
            ->whereDate('sale_orders.created_at', '>',Carbon::now()->subDays(30))
            ->groupByRaw('sale_orders.product_id')
            ->orderByRaw('SUM(sale_orders.quantity) ASC')
            ->get();
        foreach ($product as $cost) {
            $costPrice[] .= $cost->product->purchase_price * $cost->quantity;
        }
        $grossProfit = $revenue->sum('total_amount')-array_sum($costPrice);
        $expenses = $expense->sum('amount');
        $data['expenses'] =number_format($expenses,0,'.',',');;
        $data['grossProfit'] = number_format($grossProfit,0,'.',',');
        $data['netProfit'] = number_format($grossProfit - $expenses,0,'.',',');
        $data['revenue'] = number_format($revenue->sum('total_amount'),0,'.',',');
        $data['stores'] = number_format(Store::all()->count(),0,'.',',') ;
        $data['users'] = number_format(User::whereNotIn('name',['administrator'])->count(),0,'.',',');
        $data['products'] = number_format(Product::all()->count(),0,'.',',');
        $data['sales'] = number_format(CustomerOrder::all()->count(),0,'.',',');
        $data['bestSellings'] = $bestSelling;

        return view('dashboard', $data);
    }

    public function saleOrderChart(){
        $response = CustomerOrder::query()->where('order_status',1)->orderBy('id', 'DESC')->take(10)->get();
    
        return response()->json($response->reverse()->values());
    }

    public function expensesChart(){
        $response = Expense::query()->orderBy('id', 'DESC')->take(10)->get();
    
        return response()->json($response->reverse()->values());
    }
}
