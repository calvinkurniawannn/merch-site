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
                        <th>Link Form</th>
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
                            <td style="position: relative;">
                                <i class="fa-solid fa-link copy-icon"
                                    data-link="{{ url($p->account_code . '/preorderform/' . $p->slug) }}"
                                    style="color:#007bff; cursor:pointer;"></i>
                                <span class="copy-status"
                                    style="display:none;
               color:green;
               font-size:12px;
               opacity:0;
               transition:opacity 0.4s ease;">
                                    Copied!
                                </span>
                            </td>

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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const icons = document.querySelectorAll('.copy-icon');

            icons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const link = this.getAttribute('data-link');
                    const status = this.nextElementSibling;

                    // ✅ Fallback copy function (works on localhost too)
                    function copyTextToClipboard(text) {
                        if (navigator.clipboard && window.isSecureContext) {
                            return navigator.clipboard.writeText(text);
                        } else {
                            const textArea = document.createElement("textarea");
                            textArea.value = text;
                            textArea.style.position = "fixed";
                            textArea.style.opacity = "0";
                            document.body.appendChild(textArea);
                            textArea.focus();
                            textArea.select();
                            document.execCommand('copy');
                            document.body.removeChild(textArea);
                            return Promise.resolve();
                        }
                    }

                    copyTextToClipboard(link).then(() => {
                        // ✅ Show fade-in effect
                        status.style.display = 'block';
                        status.style.opacity = '1';
                        this.style.color = 'green';

                        // 🕐 Fade out after 1 second
                        setTimeout(() => {
                            status.style.opacity = '0';
                            this.style.color = '#007bff';
                            setTimeout(() => {
                                status.style.display = 'none';
                            }, 400); // wait for fade-out animation
                        }, 1000);
                    }).catch(err => {
                        console.error('Failed to copy: ', err);
                        alert('⚠️ Unable to copy link. Please copy manually.');
                    });
                });
            });
        });
    </script>






@endsection
