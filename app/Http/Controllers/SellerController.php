<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Carbon;
use App\Models\PreOrderCampaign;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function view_HomeSeller($account_code)
    {
        $user = Auth::user();
        $store = Store::where('account_code', $account_code)->first();

        if (!$store || $store->id !== $user->store_id) {
            abort(403, '404 No Access');
        }

        $totalProduct = Product::where('store_id', $store->id)->count();

        return view('dashboard.home-seller', compact('user', 'store', 'totalProduct'));
    }

    public function view_Product($account_code)
    {
        $store = Store::where('account_code', $account_code)->firstOrFail();
        $products = Product::where('store_id', $store->id)->get();

        return view('seller.product', compact('products', 'store'));
    }

    public function view_PreOrderList($account_code)
    {
        $store = Store::where('account_code', $account_code)->firstOrFail();

        $poform = PreOrderCampaign::where('account_code', $account_code)->get()->map(function ($item) {
            $item->start_date = Carbon::parse($item->start_date)->format('j-M-Y');
            $item->end_date = Carbon::parse($item->end_date)->format('j-M-Y');
            $item->status = ($item->status == 1) ? 'Active' : 'Non Active';
            return $item;
        });

        return view('seller.preorder.preorderlist', compact('store', 'poform'));
    }

    public function view_PreOrderCreate($account_code)
    {
        $store = Store::where('account_code', $account_code)->firstOrFail();
        return view('seller.preorder.createpreorder', compact('store'));
    }
}
