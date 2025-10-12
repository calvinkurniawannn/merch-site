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
                alertBox.style.opacity = "0";
                setTimeout(function() {
                    window.location.href =
                        "{{ route('seller.products', ['account_code' => $store->account_code]) }}";
                }, 500);
            }, 1000);
        </script>
    @endif

    <form action="{{ route('products.update', [$store->account_code, $product->slug]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Gambar Produk --}}
        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">

            <div class="mt-3 text-center">
                @if ($product->image)
                    <img id="previewImage" src="{{ asset('storage/' . $product->image) }}" alt="Current Product Image"
                        style="max-height: 200px; border:1px solid #ccc; border-radius:10px; padding:5px;">
                @else
                    <img id="previewImage" src="#" alt="Image Preview"
                        style="display:none; max-height: 200px; border:1px solid #ccc; border-radius:10px; padding:5px;">
                @endif
            </div>
        </div>

        {{-- Data Produk --}}
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                    class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" min="0"
                    class="form-control" required>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success px-4">Update Product</button>
        </div>
    </form>

    {{-- Script preview gambar --}}
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImage');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.style.display = 'block';
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
