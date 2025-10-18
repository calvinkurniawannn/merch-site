@extends('layouts.main')

@section('title', $store->store_name . ' | Create Pre Order')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/seller/preorder/createpreorder.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/footer-form.css') }}">
@endsection



@section('content')
    <section class="general-section">
        <div class="section-header">
            <h1><i class="fa-solid fa-circle-plus"></i> Add New Pre Order Form</h1>
            <p class="subtitle">Tambahkan form pre order baru di sini</p>
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
                            "{{ route('seller.preorder.preorderlist', ['account_code' => $store->account_code]) }}";
                    }, 600);
                }, 1000);
            </script>
        @endif

        <form action="{{ route('post.poform', $store->account_code) }}" method="POST" enctype="multipart/form-data"
            class="add-form">
            @csrf
            <div class="form-group">
                <label>Banner Image</label>
                <input type="file" name="banner" id="imageInput" accept="image/*">

                <div class="image-preview">
                    <img id="previewImage" src="#" alt="Preview" style="display:none;">
                </div>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="textarea" name="description" required>
            </div>
            <div class="form-group">
                <label>Date</label>
                <div class="form-input">
                    <input class="date" type="date" name ="start_date" required>
                    <input class="date" type="date" name ="end_date" required>
                </div>
            </div>

            <div class="form-footer">
                <a href="{{ route('seller.preorder.preorderlist', $store->account_code) }}" class="btn btn-cancel">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-save">
                    <i class="fa-solid fa-floppy-disk"></i> Create Form
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
