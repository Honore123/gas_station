<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    public function index()
    {
        $vendor = Vendor::query();
        if (request()->ajax())
        {
            return datatables($vendor)
                ->editColumn('action','vendor.partials.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('vendor.index');
    }
    public function add()
    {
        $vendorId = [
            'table' => 'vendors',
            'field' => 'vendor_id',
            'length' => 6,
            'prefix' => 'NCV',
            'reset_on_prefix_change' => true,
        ];
        return view('vendor.add', [
            'vendorId' => IdGenerator::generate($vendorId),
        ]);
    }
    public function store()
    {
        $vendor = request()->validate([
            'names'=>['string',' max:255 ',' required'],
            'phone_number'=> ['string',' max:13', 'required', 'unique:vendors'],
            'email'=>['required','  email', 'unique:vendors'],
            'location' => ['string','required'],
            'vendor_id' => ['required',' unique:vendors'],
            'description' => ['required']
        ]);
        Vendor::create($vendor);

        return redirect()->back()->with('success','Vendor added successfully');
    }

    public function edit(Vendor $vendor)
    {
        return view('vendor.edit', [
            'vendor' => $vendor
        ]);
    }

    public function update(Vendor $vendor)
    {
        $data = request()->validate([
            'names'=>['string',' max:255 ',' required'],
            'phone_number'=> ['string',' max:13', 'required', Rule::unique('vendors')->ignore($vendor->id)],
            'email'=>['required','  email', Rule::unique('vendors')->ignore($vendor->id)],
            'location' => ['string','required'],
            'vendor_id' => ['required',Rule::unique('vendors')->ignore($vendor->id)],
            'description' => ['required']
        ]);
        $vendor->update($data);

        return redirect(route('vendor.index'))->with('success','Vendor '. $vendor->names. ' updated');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect(route('vendor.index'))->with('success', 'Vendor deleted!');
    }

}
