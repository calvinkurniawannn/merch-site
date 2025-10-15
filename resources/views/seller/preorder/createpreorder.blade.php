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
            <p class="subtitle">Tambahkan pre order baru di sini</p>
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

        <form action="" ethod="POST" enctype="multipart/form-data" class="add-form">
            {{-- ✅ Upload Gambar --}}
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="textarea" name="address" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" required>
                    <option value="" disabled selected>-- Select Gender --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" inputmode="numeric" pattern="[0-9]*" maxlength="15"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

        </form>


        <div class="form-footer">
            <a href="{{ route('seller.preorder.preorderlist', $store->account_code) }}" class="btn btn-cancel">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-save">
                <i class="fa-solid fa-floppy-disk"></i> Create Form
            </button>
        </div>
    </section>
@endsection
