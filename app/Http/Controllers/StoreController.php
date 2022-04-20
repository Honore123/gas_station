<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function index()
    {
        return view('store.index', [
            'stores' => Store::with('seller')->get(),
            'sellers' => User::all()
        ]);
    }

    public function store()
    {

        $store = request()->validate([
            'store_phone' => ['required', 'string', 'max:15'],
            'description' => ['required'],
            'location' => ['required'],
            'store_seller' => ['required']
        ]);

        Store::create($store);

        return redirect()->back()->with('success','Store created successfully');
    }

    public function assignSeller(Store $store)
    {
        $data = request()->validate([
            'store_seller' => ['required']
        ]);
        $store->update($data);

        return redirect()->back()->with('success','Seller assigned successfully');
    }

    public function edit(Store $store)
    {
        return response()->json($store);
    }

    public function update()
    {
        $data = request()->validate([
            'store_phone' => ['required', 'string', 'max:15'],
            'description' => ['required'],
            'location' => ['required'],
        ]);
        $store = Store::where('id',request()->input('store'));


        $store->update($data);

        return redirect()->back()->with('success','Store updated');
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->back()->with('success', 'Store deleted');
    }
}
