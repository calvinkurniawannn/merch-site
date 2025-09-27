<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Client\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function view_HomeSeller($account_code)
    {
        $user   = Auth::user();
        $store = Store::where('account_code', $account_code)->first();

        if (!$store || $store->id !== $user->store_id) {
            abort(403, '404 No Access');
        }

        return view('dashboard.home-seller', compact('user', 'store'));
    }

    public function view_Product($account_code)
    {
        $store = Store::where('account_code', $account_code)->firstOrFail();

        $products = Product::where('store_id', $store->id)->get();

        return view('seller.product', compact('products', 'store'));
    }

    // ======================== DONE






    public function delete_Product($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('seller.products')->with('success', 'Product deleted successfully.');
    }


}