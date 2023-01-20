<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\Expense;
use App\Models\SaleOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function summarized()
    {
        $data[] = '';
        if (request()->filled(['start', 'end'])) {
            $revenue = CustomerOrder::where('order_status',1)
                ->where('created_at', '>=',request('start'))
                ->where('created_at', '<=',request('end'))
                ->get();
            $product = SaleOrder::whereHas('customerOrder', function ($query) {
                $query->where('order_status',1)
                    ->where('created_at', '>=',request('start'))
                    ->where('created_at', '<=',request('end'));
            })->with(['customerOrder', 'product'])->get();
            $costPrice = [];
            $expense = Expense::where('created_at', '>=',request('start'))
                ->where('created_at', '<=',request('end'))
                ->get();
            foreach ($product as $cost) {
                $costPrice[] .= $cost->product->purchase_price * $cost->quantity;
            }
            $grossProfit = $revenue->sum('total_amount')-array_sum($costPrice);
            $expenses = $expense->sum('amount');
            $data['expenses'] =number_format($expenses,0,'.',',');;
            $data['grossProfit'] = number_format($grossProfit,0,'.',',');
            $data['netProfit'] = number_format($grossProfit - $expenses,0,'.',',');
            $data['purchase'] = number_format(array_sum($costPrice),0,'.',',');
            $data['revenue'] = number_format($revenue->sum('total_amount'),0,'.',',');
        }
        return view('report.summarized', $data);
    }

    public function purchaseOrder()
    {
        return view('report.purchase-orders');
    }

    public function saleOrder()
    {
        $data[] = '';
        if (request()->filled(['start', 'end'])) {
            $revenue = CustomerOrder::where('order_status',1)
                ->where('created_at', '>=',request('start'))
                ->where('created_at', '<=',request('end'))
                ->get();
            $data['revenue'] = number_format($revenue->sum('total_amount'),0,'.',',');
        }

        return view('report.sale-orders', $data);
    }
    public function saleOrderAjax()
    {
        $salesReport = CustomerOrder::query()->where('order_status',1)
            ->where('created_at', '>=',request('start'))
            ->where('created_at', '<=',request('end'))
            ->with(['customer'])->get();

        return datatables($salesReport)
            ->editColumn('date', function ($report) {
                return $report->created_at ? $report->created_at->format('d/m/Y') : '';
            })
            ->addIndexColumn()
            ->make(true);

    }
    public function saleOrderChart(){
        $response = CustomerOrder::query()->where('order_status',1)->where('created_at', '>=',request('start'))
        ->where('created_at', '<=',request('end'))->orderBy('id', 'DESC')->take(10)->get();
    
        return response()->json($response->reverse()->values());
    }

    public function expenses()
    {
        $data[] = '';
        if(request()->filled(['start', 'end'])) {
            $expenses = Expense::where('created_at', '>=',request('start'))
                ->where('created_at', '<=',request('end'))->get();
            $data['expenses'] = $expenses;
        }


        return view('report.expenses', $data);
    }

    public function expensesChartAjax(){
        $response = Expense::where('created_at', '>=',request('start'))->where('created_at', '<=',request('end'))->orderBy('id', 'DESC')->take(10)->get();
        return response()->json($response->reverse()->values());
    }

    public function bestSelling()
    {
        $data[] = '';
        if (\request()->filled(['start','end'])){
            $bestSelling = DB::table('sale_orders')
                ->join('products', 'sale_orders.product_id','=','products.id')
                ->select('products.*','sale_orders.product_id',DB::raw('SUM(sale_orders.quantity) as sold, SUM(sale_orders.amount) as money'))
                ->where('sale_orders.created_at', '>=',request('start'))
                ->where('sale_orders.created_at', '<=',request('end'))
                ->groupByRaw('sale_orders.product_id')
                ->orderByRaw('SUM(sale_orders.quantity) ASC')
                ->get();
            $data['bestSelling'] = $bestSelling;
            $data['total_amount'] = $bestSelling->sum('money');
        }

        return view('report.best-selling',$data);
    }
}
