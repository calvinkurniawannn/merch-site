<nav>
    <h2>Seller Panel</h2>
    <ul>
        <li>
            <a href="{{ route('seller.products', ['account_code' => $store->account_code]) }}">Master Product</a>
        </li>
        <li>
            <a href="#">List Order</a>
        </li>
        <li>
            <a href="#">Invoice</a>
        </li>
    </ul>
</nav>
