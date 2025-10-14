@extends('layouts.main')

@section('title', 'Master Products')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/seller/preorder.css') }}">
@endsection



@section('content')
    <section class="preorder-section">
        <div class="preorder-header">
            <h1>🧾 Create Pre-Order Form</h1>
            <a href="" class="btn btn-back">← Back to List</a>
        </div>

        <form action="" method="POST" class="preorder-form">
            @csrf

            <div class="form-group">
                <label for="title">Form Title</label>
                <input type="text" id="title" name="title" class="form-control"
                    placeholder="e.g. Merchandise Pre-Order 2025" required>
            </div>

            <div id="questions-container" class="scrollable">
                <div class="question-box">
                    <div class="question-header">
                        <label>Pertanyaan</label>
                        <button type="button" class="btn btn-sm btn-danger remove-question">✖ Hapus Pertanyaan</button>
                    </div>

                    <input type="text" name="questions[0][text]" class="form-control" placeholder="Tulis pertanyaan..."
                        required>

                    <div class="options mt-2">
                        <label>Pilihan Jawaban</label>
                        <div class="option-item">
                            <input type="text" name="questions[0][options][]" class="form-control mb-2"
                                placeholder="Pilihan 1" required>

                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline add-option">+ Tambah Pilihan</button>
                </div>
            </div>

            <div class="action-buttons">
                <button type="button" id="add-question" class="btn btn-primary">+ Tambah Pertanyaan</button>
                <button type="submit" class="btn btn-success">💾 Simpan Form</button>
            </div>
        </form>
    </section>

    {{-- ================== SCRIPT ================== --}}
    <script>
        let questionCount = 1;

        // ➕ Tambah Pertanyaan
        document.getElementById('add-question').addEventListener('click', function() {
            const container = document.getElementById('questions-container');
            const html = `
        <div class="question-box">
            <div class="question-header">
                <label>Pertanyaan</label>
                <button type="button" class="btn btn-sm btn-danger remove-question">✖ Hapus Pertanyaan</button>
            </div>

            <input type="text" name="questions[${questionCount}][text]" class="form-control" placeholder="Tulis pertanyaan..." required>

            <div class="options mt-2">
                <label>Pilihan Jawaban</label>

                <!-- ✅ Pilihan pertama TANPA tombol hapus -->
                <div class="option-item">
                    <input type="text" name="questions[${questionCount}][options][]" class="form-control mb-2" placeholder="Pilihan 1" required>
                </div>
            </div>

            <button type="button" class="btn btn-sm btn-outline add-option">+ Tambah Pilihan</button>
        </div>
    `;
            container.insertAdjacentHTML('beforeend', html);
            questionCount++;
            container.scrollTo({
                top: container.scrollHeight,
                behavior: 'smooth'
            });
        });

        // ➕ Tambah Pilihan
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-option')) {
                const optionsDiv = e.target.previousElementSibling;
                const inputName = optionsDiv.querySelector('input').name;
                const html = `
            <div class="option-item">
                <input type="text" name="${inputName}" class="form-control mb-2" placeholder="Pilihan tambahan" required>
                <button type="button" class="btn btn-sm btn-outline remove-option">🗑 Hapus</button>
            </div>
        `;
                optionsDiv.insertAdjacentHTML('beforeend', html);
                optionsDiv.scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
            }
        });

        // ❌ Hapus Pertanyaan
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-question')) {
                e.target.closest('.question-box').remove();
            }
        });

        // 🗑 Hapus Pilihan (kecuali yang pertama)
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-option')) {
                const optionContainer = e.target.closest('.options');
                const allOptions = optionContainer.querySelectorAll('.option-item');

                // Cegah menghapus jika tinggal satu atau ini adalah yang pertama
                if (allOptions.length <= 1) return;

                e.target.closest('.option-item').remove();
            }
        });
    </script>

@endsection
