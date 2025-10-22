<link rel="stylesheet" href="{{ asset('css/user/preorderform.css') }}">

<section class="preorder-section">

    <div class="section-header">
        <h1>{{ $preorderform->title }}</h1>
        <p class="subtitle">{{ $preorderform->description }}</p>
    </div>

    {{-- ✅ Customer Info Form --}}
    <form action="" method="POST" class="preorder-form">
        @csrf

        <div class="customer-info">
            <h2>🧍 Customer Information</h2>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="customer_name" required>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address" rows="2" required></textarea>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" required pattern="[0-9]+" title="Digits only">
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="">-- Select Gender --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>

        {{-- ✅ Product List Section --}}
        <div class="product-list">
            <h2>🛒 Products</h2>

            @foreach ($products as $p)
                <div class="product-item" data-product-id="{{ $p->id }}">
                    <div class="product-info">
                        <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}">
                        <div>
                            <h3>{{ $p->name }}</h3>
                            <p class="price">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="quantity-control">
                        <button type="button" class="btn-qty minus">−</button>
                        <input type="number" name="quantity[{{ $p->id }}]" value="0" min="0"
                            readonly>
                        <button type="button" class="btn-qty plus">+</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-footer">
            <button type="submit" class="btn-submit">Submit Pre Order</button>
        </div>
    </form>
</section>

{{-- ✅ JS: Quantity Logic --}}
<script>
    document.querySelectorAll('.product-item').forEach(item => {
        const minus = item.querySelector('.minus');
        const plus = item.querySelector('.plus');
        const input = item.querySelector('input[type="number"]');

        minus.addEventListener('click', () => {
            let val = parseInt(input.value);
            if (val > 0) input.value = val - 1;
        });

        plus.addEventListener('click', () => {
            let val = parseInt(input.value);
            input.value = val + 1;
        });
    });
</script>
