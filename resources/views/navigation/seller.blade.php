<nav class="sidebar">
    <div class="sidebar-header">
        <h2 class="sidebar-title">
            <i class="fa-solid fa-store"></i>
            {{ $store->store_name ?? 'My Store' }}
        </h2>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard.home.seller', $store->account_code) }}"
                class="{{ request()->routeIs('seller.home') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('seller.products', $store->account_code) }}"
                class="{{ request()->routeIs('seller.products') ? 'active' : '' }}">
                <i class="fa-solid fa-box"></i> Produk
            </a>
        </li>
        <li>
            <a href="{{ route('seller.preorder.page', $store->account_code) }}"
                class="{{ request()->routeIs('seller.preoder.page') ? 'active' : '' }}">
                <i class="fa-solid fa-box"></i> Pre-Order
            </a>
        </li>

        <li>
            <a href="" class="{{ request()->routeIs('seller.orders') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-list"></i> Pesanan
            </a>
        </li>

        <li>
            <a href="" class="{{ request()->routeIs('seller.profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i> Profil
            </a>
        </li>

        <li>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
