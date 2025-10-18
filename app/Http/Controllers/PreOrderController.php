<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PreOrderCampaign;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PreOrderController extends Controller
{
    public function post_PO($account_code, Request $request)
    {
        $store = Store::where('account_code', $account_code)->first();
        $auth  = Auth::user();

        if (!$store || empty($store->account_code)) {
            return back()->with('error', 'Store or account code not found.');
        }

        // ✅ Validasi input
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'banner'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'start_date.required'    => 'Tanggal mulai wajib diisi.',
            'end_date.required'      => 'Tanggal berakhir wajib diisi.',
            'end_date.after_or_equal'=> 'Tanggal berakhir tidak boleh lebih awal dari tanggal mulai.',
        ]);

        // ✅ Simpan banner jika ada
        $imagePath = null;
        if ($request->hasFile('banner')) {
            $filename = 'banner-' . time() . '.' . $request->file('banner')->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/' . $store->account_code . '/banner');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $request->file('banner')->move($destinationPath, $filename);
            $imagePath = $filename;
        }

        $now = now();

        PreOrderCampaign::create([
            'account_code'   => $store->account_code,
            'banner'         => $imagePath,
            'title'          => $validated['title'],
            'description'    => $validated['description'],
            'start_date'     => $validated['start_date'],
            'end_date'       => $validated['end_date'],
            'created_by'     => $auth->username ?? 'superadmin',
            'created_date'   => $now,
            'modified_by'    => $auth->username ?? 'superadmin',
            'modified_date'  => $now,
            'slug'           => PreOrderCampaign::generateUniqueSlug(),
            'status'         => ($now->between($validated['start_date'], $validated['end_date'])) ? 1 : 0,
        ]);

        return redirect()
            ->route('seller.preorder.preorderlist', ['account_code' => $store->account_code])
            ->with('success', 'Pre Order Form berhasil dibuat!');
    }

    public function delete_PO($account_code,$slug)
    {
        $store = Store::where('account_code',$account_code)->firstOrFail();
        $poform = PreOrderCampaign::where('slug', $slug)->firstOrFail();

        $currImage = storage_path('app/public/' .$store->account_code.'/banner/' . $poform->banner);
        if (File::exists($currImage)) {
            File::delete($currImage);
        }
        $poform->delete();

        return redirect()->route('seller.preorder.preorderlist',['account_code' =>$store->account_code])
            ->with('success', 'Pre Order Form deleted successfully!');
    }
}