@extends('layouts.main')

@section('title', $store->store_name . ' | Dashboard')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/dashboard/home-seller.css') }}">
@endsection

@section('content')
    <section>
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Welcome Seller, {{ $user->name }}</h1>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h3>Total Produk</h3>
                    <div class="card-value">{{ $totalProduct ?? 0 }}</div>
                </div>

                <div class="dashboard-card">
                    <h3>Total Pesanan</h3>
                    <div class="card-value">{{ $totalOrders ?? 0 }}</div>
                </div>

                <div class="dashboard-card">
                    <h3>Pesanan Selesai</h3>
                    <div class="card-value">{{ $completedOrders ?? 0 }}</div>
                </div>

                <div class="dashboard-card">
                    <h3>Produk Habis Stok</h3>
                    <div class="card-value text-red-500">{{ $outOfStock ?? 0 }}</div>
                </div>
            </div>

            <div class="dashboard-section">
                <h2 class="section-title">Aktivitas Terbaru</h2>
                <p style="color:#64748b;">(belum ada data aktivitas, tapi bagian ini nanti bisa diisi grafik atau log
                    aktivitas
                    seller)</p>
            </div>
        </div>
    </section>

@endsection
