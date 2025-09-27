<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function edit_Product($account_code, $slug)
    {
        $store = Store::where('account_code', $account_code)->firstOrFail();

        $product = Product::where('store_id', $store->id)
                        ->where('slug', $slug)
                        ->firstOrFail();

        return view('seller.product_edit', compact('store', 'product'));
    }

    public function update_Product(Request $request, $account_code, $slug)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'id'
        ]);

        $store = Store::where('account_code', $account_code)->firstOrFail();

        $product = Product::where('store_id', $store->id)
                        ->where('id', $request->id)
                        ->firstOrFail();

        $product->update([
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'price'         => $request->input('price'),
            'quantity'      => $request->input('quantity'),
            'modified_by'   => auth()->user()->name ?? 'system',
            'modified_date' => now(),
        ]);

    return redirect()
        ->back()
        ->with('success', 'Product updated successfully!');

    }



}