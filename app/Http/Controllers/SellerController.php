<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SellerAccount;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function view_HomeSeller()
    {
        $user  = Auth::user();
        $seller = \App\Models\SellerAccount::find($user->seller_account_id);

        return view('dashboard.home-seller', compact('user', 'seller'));
    }

    public function view_Product(){
        $products = \App\Models\Product::all();
        return view('seller.product',compact('products'));
    }

    public function get_ProductJson($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return response()->json($product);
    }

    
public function update_Product(Request $request, $id)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'price'       => 'required|numeric|min:0',
        'quantity'    => 'required|integer|min:0',
    ]);

    $product = \App\Models\Product::findOrFail($id);

    $product->update([
        'name'         => $request->input('name'),
        'description'  => $request->input('description'),
        'price'        => $request->input('price'),
        'quantity'     => $request->input('quantity'),
        'modified_by'  => auth()->user()->name,
        'modified_date'=> now(),
    ]);


    // kembalikan JSON supaya bisa di-handle di JS
    return response()->json([
        'status'  => 'success',
        'message' => 'Product updated successfully',
        'product' => $product
    ]);
}




    public function delete_Product($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('seller.products')->with('success', 'Product deleted successfully.');
    }


}