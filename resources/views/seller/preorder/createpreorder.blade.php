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
                    alertBox.style.transition = "opacity 0.6s ease";
                    alertBox.style.opacity = "0";
                    setTimeout(() => {
                        window.location.href =
                            "{{ route('seller.preorder.preorderlist', ['account_code' => $store->account_code]) }}";
                    }, 600);
                }, 2000); // ⏱️ show for 2 seconds before fade out
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
                    <input class="date" type="date" name="start_date" id="start_date" required>
                    <input class="date" type="date" name="end_date" id="end_date" required>
                </div>
                {{-- inline validation message --}}
                <small id="dateError" style="color: red; display: none; margin-top: 4px;">
                    ⚠️ End date cannot be earlier than start date.
                </small>
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
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const dateError = document.getElementById('dateError');
        const form = document.querySelector('.add-form');

        function validateDates() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (startDateInput.value && endDateInput.value && endDate < startDate) {
                dateError.style.display = 'block';
                endDateInput.style.borderColor = 'red';
                return false;
            } else {
                dateError.style.display = 'none';
                endDateInput.style.borderColor = '';
                return true;
            }
        }

        startDateInput.addEventListener('change', validateDates);
        endDateInput.addEventListener('change', validateDates);

        form.addEventListener('submit', function(e) {
            if (!validateDates()) {
                e.preventDefault();
            }
        });
    </script>

@endsection
