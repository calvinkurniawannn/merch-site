@extends('layouts.main')

@section('title', 'Edit Product')

@section('content')
    <h1>Edit Product: {{ $product->name }}</h1>

    {{-- Alert Success --}}
    @if (session('success'))
        <div id="successAlert"
            style="padding:10px; background:#d4edda; border:1px solid #c3e6cb; color:#155724; 
                    margin-bottom:15px; border-radius:4px; opacity:1; transition: opacity 0.5s ease;">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                let alertBox = document.getElementById("successAlert");
                alertBox.style.opacity = "0"; // mulai fade out
                setTimeout(function() {
                    window.location.href =
                        "{{ route('seller.products', ['account_code' => $store->account_code]) }}";
                }, 500); // tunggu fade out selesai (0.5 detik)
            }, 1000); // tampil 1 detik sebelum fade out
        </script>
    @endif

    <form action="{{ route('products.update', [$store->account_code, $product->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $product->id }}">

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required>{{ old('description', $product->description) }}</textarea><br><br>

        <label>Price:</label><br>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" required><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" min="0"
            required><br><br>

        <button type="submit">Update Product</button>
    </form>
@endsection
