@php
 function checkActive(string $uri)
{
    return $_SERVER["REQUEST_URI"]==$uri?'active bg-gradient-primary':'';
}

@endphp
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main" xmlns="">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/" >
            <img src="assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Cash And Carry</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @auth
            @can("create",App\Models\User::class)
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Dashboard</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{checkActive("/")}}" href="{{url('/')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Enteries</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{checkActive("/category")}}" href="{{url('/category')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Category</span>
                </a>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white{{checkActive("/product")}} " href="{{url('/product')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{checkActive("/clients")}}" href="{{url('/clients')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Clients</span>
                </a>
            </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{checkActive("/stock")}}" href="{{url('/stock')}}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                            </div>
                            <span class="nav-link-text ms-1">Stock</span>
                        </a>
                    </li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Payemnts</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{checkActive("/payments")}}" href="{{url('/payments')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">Payment</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{checkActive("/expense")}}" href="{{url('/expense')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Expense</span>
                </a>
            </li>
            @endcan
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Sale</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{checkActive("/sale")}}" href="{{url('/sale')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">Sale</span>
                </a>
            </li>
                @can("viewAny",App\Models\User::class)
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Ledgers</h6>
                    </li>

            <li class="nav-item">
                <a class="nav-link text-white {{checkActive("/customerledger")}} " href="{{url('/customerledger')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Customer Ledger</span>
                </a>
            </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{checkActive("/vendorledger")}}" href="{{url('/vendorledger')}}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">assignment</i>
                            </div>
                            <span class="nav-link-text ms-1">VendorLedger</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white {{checkActive("/stockledger")}}" href="{{ url('/stockledger') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">inventory</i>
                            </div>
                            <span class="nav-link-text ms-1">Stock Ledger</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{checkActive("/saleledger")}}" href="{{ url('/saleledger') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">point_of_sale</i>
                            </div>
                            <span class="nav-link-text ms-1">Sale Ledger</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{checkActive("/ledger")}}" href="{{ url('/ledger') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">book</i>
                            </div>
                            <span class="nav-link-text ms-1">General Ledger</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white{{checkActive("/profit-loss")}}" href="{{ url('/profit-loss') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">trending_down</i>
                            </div>
                            <span class="nav-link-text ms-1">Profit & Loss Ledger</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white{{checkActive("/stock-inhand")}}" href="{{ url('/stock-inhand') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">store</i>
                            </div>
                            <span class="nav-link-text ms-1">Stock In Hand</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Settings</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{checkActive("/user")}}" href="{{url('/user')}}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">User Management</span>
                        </a>
                    </li>


                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            document.getElementById('logout-link').addEventListener('click', function (event) {
                                event.preventDefault();
                                document.getElementById('logout-form').submit();
                            });
                        });

                    </script>
        </ul>
        @endcan
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <span class="nav-link-text ms-1">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        </ul>
        @endauth
    </div>
</aside>

