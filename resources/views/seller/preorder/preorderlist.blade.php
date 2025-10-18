@extends('layouts.main')

@section('title', $store->store_name . ' | Pre Order List')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/seller/preorder/preorderlist.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/section.css') }}">
@endsection



@section('content')
    <section class="general-section">
        <div class="section-header">
            <h1>🧾 Pre Order List</h1>
        </div>
        <div class="section-header-2">
            <a href="{{ route('seller.preorder.create', $store->account_code) }}" class="btn btn-add">
                + Add New PO
            </a>
        </div>

        {{-- ✅ Alert Success --}}
        @if (session('success'))
            <div id="successAlert" class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table class="item-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($poform as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="text-left">{{ $p->title }}</td>
                            <td class="text-left">{{ Str::limit($p->description, 50) }}</td>
                            <td>{{ $p->start_date }}</td>
                            <td>{{ $p->end_date }}</td>
                            <td>{{ $p->status }}</td>
                            <td>
                                <a href="{{ route('products.editPage', [$store->account_code, $p->slug]) }}"
                                    class="btn btn-edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('poform.destroy', [$store->account_code, $p->slug]) }}"
                                    method="POST" class="inline-form"
                                    onsubmit="return confirm('Apakah kamu yakin ingin menghapus po form ini?')">
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
