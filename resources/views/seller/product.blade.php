@extends('layouts.main')

@section('title', 'Master Products')

@section('content')
    <h1>Welcome Seller, {{ auth()->user()->name }}</h1>
    <p>Ini halaman dashboard khusus seller.</p>

    <div id="alertBox"
        style="display:none; margin-bottom:15px; padding:10px; border:1px solid #ddd; border-radius:4px; font-size:14px;">
    </div>

    <table class="product-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <div class="img-box">
                            <img src="{{ asset($p->image) }}" alt="{{ $p->name }}">
                        </div>
                    </td>
                    <td>{{ $p->name }}</td>
                    <td>{{ Str::limit($p->description, 50) }}</td>
                    <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td>{{ $p->quantity }}</td>
                    <td>
                        <a href="{{ route('products.editPage', [$store->account_code, $p->slug]) }}" class="btn btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Yakin mau hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>


    <style>
        /* ===== Table Style ===== */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .product-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .product-table tr:nth-child(even) {
            background-color: #fafafa;
        }

        .product-table tr:hover {
            background-color: #f1f1f1;
        }

        /* ===== Image Box ===== */
        .img-box {
            width: 60px;
            height: 60px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            margin: auto;
        }

        .img-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .img-box:hover img {
            transform: scale(1.3);
        }

        /* ===== Buttons ===== */
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-edit {
            background-color: #3498db;
            color: #fff;
            margin-right: 5px;
        }

        .btn-edit:hover {
            background-color: #2980b9;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        /* ===== Modal ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background: #fff;
            margin: 8% auto;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .close {
            float: right;
            font-size: 20px;
            cursor: pointer;
        }

        .modal-content label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        .modal-content input,
        .modal-content textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
    </style>


@endsection
