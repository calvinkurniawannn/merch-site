@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add New Product</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('post.product', [$store->account_code]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Image Input + Preview --}}
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" id="imageInput" class="form-control" accept="image/*" required>
                        <div class="mt-3 text-center">
                            <img id="previewImage" src="#" alt="Image Preview"
                                style="display:none; max-height: 200px; border:1px solid #ccc; border-radius:10px; padding:5px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Enter product description" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" step="0.01" class="form-control" placeholder="0.00"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" min="0" required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JavaScript Preview --}}
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
