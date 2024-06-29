{{-- <!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--  <head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <!-- CSRF Token -->--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    <title>Point Of Sale</title>--}}
{{--    <!-- Fonts -->--}}
{{--    --}}{{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--        <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet"> --}}
{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('font/bootstrap-icons.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('datatables.min.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> @livewireStyles @livewireScripts <style></style>--}}
{{--  </head>--}}
{{--  <body>--}}
{{--    <div id="app">--}}
{{--        <nav class="navbar navbar-expand-md navbar-dark bg-danger shadow-sm">--}}
{{--        <div class="container">--}}
{{--          <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--           <img src="{{ asset('assets/images/logo.png') }}" alt="">--}}
{{--          </a>--}}
{{--          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--          </button>--}}
{{--          <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--            <!-- Left Side Of Navbar -->--}}
{{--            <ul class="navbar-nav me-auto"> @auth <li class="nav-item">--}}
{{--                <a class="nav-link" href="/">Home</a>--}}
{{--              </li> @can("create",App\Models\User::class) <li class="nav-item dropdown">--}}
{{--                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Entires </a>--}}
{{--                <div class="dropdown-menu">--}}
{{--                  <a class="dropdown-item" href="{{url('/category')}}">Categories</a>--}}
{{--                  <a class="dropdown-item" href="{{url('/product')}}">Products</a>--}}
{{--                  <a class="dropdown-item" href="{{url('/clients')}}">Clients</a>--}}
{{--              </li>--}}
{{--              <li class="nav-item dropdown">--}}
{{--                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Stock </a>--}}
{{--                <div class="dropdown-menu">--}}
{{--                  <a class="dropdown-item" href="{{url('/stock-entry')}}">Stock Entry</a>--}}
{{--                  <a class="dropdown-item" href="{{url('/stock')}}">Stock List</a>--}}
{{--              </li>--}}
{{--              <li class="nav-item">--}}
{{--                <a class="nav-link" href="/payments">Payments</a>--}}
{{--              </li>--}}
{{--              <li class="nav-item">--}}
{{--                <a class="nav-link" href="/expense">Expense</a>--}}
{{--              </li> @endcan <li class="nav-item">--}}
{{--                <a class="nav-link" href="/sale">Sale</a>--}}
{{--              </li> @can("viewAny",App\Models\User::class) <li class="nav-item dropdown">--}}
{{--                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Ledgers </a>--}}
{{--                <div class="dropdown-menu">--}}
{{--                  <a class="dropdown-item" href="{{url('/customerledger')}}">Customer Ledger </a>--}}
{{--                  <a class="dropdown-item" href="{{url('/vendorledger')}}">Vendor Ledger </a>--}}
{{--                  <a class="dropdown-item" href="{{url('/stockledger')}}">Stock Ledger </a>--}}
{{--                  <a class="dropdown-item" href="{{url('/saleledger')}}">Sale Ledger </a>--}}
{{--                  <a class="dropdown-item" href="{{url('/ledger')}}">General Ledger </a>--}}
{{--                  <a class="dropdown-item" href="{{url('/profit-loss')}}">Profit & Loss Ledger </a>--}}
{{--                  <a class="dropdown-item" href="{{url('/stock-inhand')}}">Stock IN Hand</a>--}}
{{--              </li> @if(auth()->user()->username=="admin") <li class="nav-item">--}}
{{--                <a class="nav-link" href="/user">User Managnement</a>--}}
{{--              </li> @endif @endcan @endauth--}}
{{--            </ul>--}}
{{--            <!-- Right Side Of Navbar -->--}}
{{--            <ul class="navbar-nav ms-auto">--}}
{{--              <!-- Authentication Links --> @guest @if (Route::has('login')) <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--              </li> @endif @if (Route::has('register')) <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--              </li> @endif @else <li class="nav-item dropdown">--}}
{{--                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                  {{ Auth::user()->username }}--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                    {{ __('Logout') }}--}}
{{--                  </a>--}}
{{--                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>--}}
{{--                </div>--}}
{{--              </li> @endguest--}}
{{--            </ul>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </nav>--}}
{{--      <main class="py-4"> @yield('content') </main>--}}
{{--    </div>--}}
{{--  </body>--}}
{{--  <!-- Scripts -->--}}
{{--  <script src="{{ asset('js/jquery.min.js')  }}"></script>--}}
{{--  <script src="{{ asset('js/app.js') }}"></script>--}}
{{--  <script src="{{ asset('datatables.min.js')  }}"></script>--}}
{{--</html> --}}
