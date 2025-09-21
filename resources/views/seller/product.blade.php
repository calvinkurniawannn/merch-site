@extends('layouts.main')

@section('title', 'Master Products')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Welcome Seller, {{ auth()->user()->name }}</h1>
    <p class="mb-6">Ini halaman dashboard khusus seller.</p>

    <div id="alertBox" class="hidden mb-4 p-3 rounded border text-sm"></div>

    <table class="table-auto w-full border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Image</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Description</th>
                <th class="px-4 py-2 border">Price</th>
                <th class="px-4 py-2 border">Quantity</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $i => $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border text-center">{{ $i + 1 }}</td>
                    <td class="px-4 py-2 border text-center">
                        <img src="{{ asset($p->image) }}" alt="{{ $p->name }}" class="h-16 mx-auto">
                    </td>
                    <td class="px-4 py-2 border">{{ $p->name }}</td>
                    <td class="px-4 py-2 border">{{ Str::limit($p->description, 50) }}</td>
                    <td class="px-4 py-2 border text-right">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border text-center">{{ $p->quantity }}</td>
                    <td class="px-4 py-2 border text-center">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm editBtn"
                            data-id="{{ $p->id }}">
                            Edit
                        </button>

                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Yakin mau hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal --}}
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Edit Product</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="block">Name</label>
                    <input type="text" name="name" id="name" class="w-full border rounded px-2 py-1">
                </div>

                <div class="mb-3">
                    <label class="block">Description</label>
                    <textarea name="description" id="description" class="w-full border rounded px-2 py-1"></textarea>
                </div>

                <div class="mb-3">
                    <label class="block">Price</label>
                    <input type="number" name="price" id="price" class="w-full border rounded px-2 py-1">
                </div>

                <div class="mb-3">
                    <label class="block">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="w-full border rounded px-2 py-1">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeModal" class="bg-gray-400 px-3 py-1 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('editModal');
        const closeModal = document.getElementById('closeModal');
        const form = document.getElementById('editForm');
        const alertBox = document.getElementById('alertBox');

        // handle edit click -> buka modal + load data dari server
        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                fetch(`/products/${id}/json`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('name').value = data.name;
                        document.getElementById('description').value = data.description;
                        document.getElementById('price').value = data.price;
                        document.getElementById('quantity').value = data.quantity;

                        form.dataset.id = id; // simpan id di form
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    })
                    .catch(err => console.error('Error fetch product JSON:', err));
            });
        });

        // handle form submit via AJAX
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const id = form.dataset.id;
            const formData = new FormData(form);

            fetch(`/products/${id}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        // tampilkan notif sukses
                        alertBox.textContent = data.message;
                        alertBox.className =
                            "mb-4 p-3 rounded border text-sm bg-green-100 border-green-400 text-green-700";
                        alertBox.classList.remove('hidden');

                        // tutup modal
                        modal.classList.remove('flex');
                        modal.classList.add('hidden');

                        // reload tabel setelah 1.2 detik
                        setTimeout(() => location.reload(), 1200);
                    } else {
                        // tampilkan notif gagal
                        alertBox.textContent = "Gagal update produk!";
                        alertBox.className =
                            "mb-4 p-3 rounded border text-sm bg-red-100 border-red-400 text-red-700";
                        alertBox.classList.remove('hidden');
                    }
                })
                .catch(err => {
                    console.error('Error update product:', err);
                    alertBox.textContent = "Terjadi error saat update produk!";
                    alertBox.className =
                        "mb-4 p-3 rounded border text-sm bg-red-100 border-red-400 text-red-700";
                    alertBox.classList.remove('hidden');
                });
        });

        // handle close modal
        closeModal.addEventListener('click', () => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });
    </script>

@endsection
