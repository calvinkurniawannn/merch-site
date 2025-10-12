<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function add_Product_Page($account_code)
    {
        $store = Store::where('account_code', $account_code)->firstOrFail();

        return view('seller.add_product_page', compact('store'));
    }

    public function post_product($account_code, Request $request)
    {
        $store = Store::where('account_code', $account_code)->first();
        $auth  = Auth::user();

        if (!$store || empty($store->account_code)) {
            return back()->with('error', 'Store or account code not found.');
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (!$request->hasFile('image')) {
            return back()->with('error', 'No image file uploaded.');
        }

        // ✅ Nama file unik
        $filename = $store->account_code . '/' . $store->account_code . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();

        // ✅ Simpan langsung ke storage/app/public
        $destinationPath = storage_path('app/public/' . $store->account_code);

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }
        $request->file('image')->move($destinationPath, $filename);

        // ✅ Path relatif dari public/storage
        $imagePath = $filename;

        // ✅ Simpan ke database
        $product = Product::create([
            'store_id'      => $store->id,
            'image'         => $imagePath, // contoh: calvinstore_1734100044.jpg
            'name'          => $validated['name'],
            'description'   => $validated['description'],
            'price'         => $validated['price'],
            'quantity'      => $validated['quantity'],
            'created_by'    => $auth->username ?? 'superadmin',
            'created_date'  => now(),
            'modified_by'   => $auth->username ?? 'superadmin',
            'modified_date' => now(),
            'slug'          => Product::generateUniqueSlug(),
        ]);

        return redirect()->back()
            ->with('success', 'Product added successfully!');
    }

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
        ]);

        $store = Store::where('account_code', $account_code)->firstOrFail();
        $auth = Auth::user();
        $product = Product::where('store_id', $store->id)
            ->where('slug', $slug)
            ->firstOrFail();

        $imagePath = $product->image; // default = image lama

        if ($request->hasFile('image')) {
            // ✅ Hapus gambar lama kalau ada
            $currImage = storage_path('app/public/' . $product->image);
            if (File::exists($currImage)) {
                File::delete($currImage);
            }

            // ✅ Pastikan folder store sudah ada
            $destinationPath = storage_path('app/public/' . $store->account_code);
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // ✅ Simpan gambar baru
            $newFileName = $store->account_code . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $newFileName);

            // ✅ Simpan path relatif (contoh: CALVIN123/filename.jpg)
            $imagePath = $store->account_code . '/' . $newFileName;
        }

        // ✅ Update data produk
        $product->update([
            'name'          => $request->input('name'),
            'image'         => $imagePath,
            'description'   => $request->input('description'),
            'price'         => $request->input('price'),
            'quantity'      => $request->input('quantity'),
            'modified_by'   => $auth->username ?? 'superadmin',
            'modified_date' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Product updated successfully!');
    }

    public function delete_Product($account_code, $slug)
    {
        $store = Store::where('account_code', $account_code)->firstOrFail();
        $product = Product::where('slug', $slug)->firstOrFail();

        $currImage = storage_path('app/public/' . $product->image);
        if (File::exists($currImage)) {
            File::delete($currImage);
        }
        $product->delete();

        return redirect()->back()
            ->with('success', 'Product deleted successfully!');
    }
}
