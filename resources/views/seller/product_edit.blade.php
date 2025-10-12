@extends('layouts.main')

@section('title', 'Edit Product')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/seller/product_edit.css') }}">
@endsection

@section('content')
    <section class="edit-section">
        <div class="edit-header">
            <h1><i class="fa-solid fa-pen-to-square"></i> Edit Product</h1>
            <p class="subtitle">Update detail produk kamu di bawah ini</p>
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

        <form action="{{ route('products.update', [$store->account_code, $product->slug]) }}" method="POST"
            enctype="multipart/form-data" class="edit-form">
            @csrf
            @method('PUT')

            {{-- ✅ Gambar Produk --}}
            <div class="form-group">
                <label for="imageInput">Product Image</label>
                <input type="file" name="image" id="imageInput" accept="image/*">

                <div class="image-preview">
                    <img id="previewImage" src="{{ $product->image ? asset('storage/' . $product->image) : '#' }}"
                        alt="Product Image" style="{{ $product->image ? '' : 'display:none;' }}">
                </div>
            </div>

            {{-- ✅ Nama & Deskripsi --}}
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- ✅ Harga & Kuantitas --}}
            <div class="form-row">
                <div class="form-group">
                    <label>Price (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                        required>
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" min="0"
                        required>
                </div>
            </div>

            {{-- ✅ Submit --}}
            <div class="form-footer">
                <a href="{{ route('seller.products', $store->account_code) }}" class="btn btn-cancel">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-save">
                    <i class="fa-solid fa-floppy-disk"></i> Update Product
                </button>
            </div>
        </form>
    </section>

    {{-- ✅ Script Preview Image --}}
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
            } else {
                preview.style.display = 'none';
                preview.src = '#';
            }
        });
    </script>
@endsection
