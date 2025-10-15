@extends('layouts.main')

@section('title', $store->store_name . ' | List Products')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/seller/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/section.css') }}">
@endsection

@section('content')
    <section class="general-section">
        <div class="section-header">
            <h1>📦 Master Products</h1>
        </div>
        <div class="section-header-2">
            <a href="{{ route('add.product.page', [$store->account_code]) }}" class="btn btn-add">
                + Add Product
            </a>
        </div>

        {{-- ✅ Alert Success --}}
        @if (session('success'))
            <div id="successAlert" class="alert-success">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    let alertBox = document.getElementById("successAlert");
                    alertBox.style.opacity = "0";
                    setTimeout(() => {
                        window.location.href =
                            "{{ route('seller.products', ['account_code' => $store->account_code]) }}";
                    }, 600);
                }, 1000);
            </script>
        @endif

        <div class="table-container">
            <table class="product-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div class="img-box">
                                    <img src="{{ asset('storage/' . $p->image) }}" alt="Product Image">
                                </div>
                            </td>
                            <td class="text-left">{{ $p->name }}</td>
                            <td class="text-left">{{ Str::limit($p->description, 50) }}</td>
                            <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                            <td>{{ $p->quantity }}</td>
                            <td>
                                <a href="{{ route('products.editPage', [$store->account_code, $p->slug]) }}"
                                    class="btn btn-edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', [$store->account_code, $p->slug]) }}"
                                    method="POST" class="inline-form"
                                    onsubmit="return confirm('Apakah kamu yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="no-data">Belum ada produk ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
