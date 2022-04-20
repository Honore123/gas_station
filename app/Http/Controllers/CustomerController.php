<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Material;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::query();
        if (request()->ajax())
        {
            return datatables($customer)
                ->editColumn('action','customer.partials.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('customer.index');
    }

    public function add()
    {
        $customerId = [
            'table' => 'customers',
            'field' => 'customer_id',
            'length' => 6,
            'prefix' => 'NCC',
            'reset_on_prefix_change' => true,
        ];

        return view('customer.add', [
            'customerId' => IdGenerator::generate($customerId)
        ]);
    }

    public function store()
    {
        $customer = request()->validate([
            'names'=>['string',' max:255 ',' required'],
            'phone_number'=> ['string',' max:13', 'required', 'unique:customers'],
            'email'=>['required','  email', 'unique:customers'],
            'location' => ['string','required'],
            'customer_id' => ['required',' unique:customers'],
            'description' => ['required']
        ]);
        Customer::create($customer);

        return redirect()->back()->with('success', 'Customer added');
    }
    public function edit(Customer $customer)
    {
        return view('customer.edit', [
            'customer' => $customer
        ]);
    }

    public function update(Customer $customer)
    {
        $data = request()->validate([
            'names'=>['string',' max:255 ',' required'],
            'phone_number'=> ['string',' max:13', 'required', Rule::unique('customers')->ignore($customer->id)],
            'email'=>['required','  email', Rule::unique('customers')->ignore($customer->id)],
            'location' => ['string','required'],
            'customer_id' => ['required',Rule::unique('customers')->ignore($customer->id)],
            'description' => ['required']
        ]);
        $customer->update($data);

        return redirect(route('customer.index'))->with('success', 'Customer updated');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted');
    }
}
