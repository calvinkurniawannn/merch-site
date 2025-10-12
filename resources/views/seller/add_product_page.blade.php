@extends('layouts.main')

@section('title', 'Add New Product')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/seller/add_product.css') }}">
@endsection

@section('content')
    <section class="add-section">
        <div class="add-header">
            <h1><i class="fa-solid fa-circle-plus"></i> Add New Product</h1>
            <p class="subtitle">Tambahkan produk baru ke toko kamu di sini</p>
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

        <form action="{{ route('post.product', [$store->account_code]) }}" method="POST" enctype="multipart/form-data"
            class="add-form">
            @csrf

            {{-- ✅ Upload Gambar --}}
            <div class="form-group">
                <label>Product Image</label>
                <input type="file" name="image" id="imageInput" accept="image/*" required>

                <div class="image-preview">
                    <img id="previewImage" src="#" alt="Preview" style="display:none;">
                </div>
            </div>

            {{-- ✅ Nama & Deskripsi --}}
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" placeholder="Enter product name" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" placeholder="Enter product description" required></textarea>
            </div>

            {{-- ✅ Harga & Kuantitas --}}
            <div class="form-row">
                <div class="form-group">
                    <label>Price (Rp)</label>
                    <input type="number" name="price" step="0.01" placeholder="0.00" required>
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" min="0" placeholder="0" required>
                </div>
            </div>

            {{-- ✅ Tombol Aksi --}}
            <div class="form-footer">
                <a href="{{ route('seller.products', $store->account_code) }}" class="btn btn-cancel">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-save">
                    <i class="fa-solid fa-floppy-disk"></i> Save Product
                </button>
            </div>
        </form>
    </section>

    {{-- ✅ Preview Gambar --}}
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
