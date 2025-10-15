@extends('layouts.main')

@section('title', $store->store_name . ' | Pre Order List')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/seller/preorder/preorderlist.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/section.css') }}">
@endsection



@section('content')
    <section class="general-section">
        <div class="section-header">
            <h1>🧾 Pre Order List</h1>
        </div>
        <div class="section-header-2">
            <a href="{{ route('seller.preorder.create', $store->account_code) }}" class="btn btn-add">
                + Add New PO
            </a>
        </div>

    </section>



@endsection
