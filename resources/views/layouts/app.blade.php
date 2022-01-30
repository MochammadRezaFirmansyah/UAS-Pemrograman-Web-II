<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Commerce') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
</head>
<body>      
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'E-Commerce') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        <li>
                            <a href="{{ route('products.index') }}" class="nav-link">Market</a>
                        </li>
                        <!-- carts -->
                        <li class="nav-item">
                            <a href="{{ route('carts.index') }}" class="btn btn-primary btn-block">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart 
                                <span class="badge badge-pill badge-danger"> 
                                    @if(session('cart')) 
                                        {{ count(session('cart')) }}
                                    @else 
                                        0 
                                    @endif
                                </span>
                            </a>
                        </li>
                        <!-- carts -->
                        <!-- product -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Products
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="/admin/products?admin_id={{ Auth::user()->id }}">List</a>
                              <a class="dropdown-item" href="{{ route('admin.products.create') }}">Tambah</a>
                            </div>
                          </li>
                        <!-- Orders -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Orders
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('admin.orders.index') }}">List</a>
                            </div>
                          </li>
                        @endauth
                        @guest
                        <li>
                            <a href="{{ route('products.index') }}" class="nav-link">Market</a>
                        </li>
                        <!-- carts -->
                        <li class="nav-item">
                            <a href="{{ route('carts.index') }}" class="btn btn-primary btn-block">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart 
                                <span class="badge badge-pill badge-danger"> 
                                    @if(session('cart')) 
                                        {{ count(session('cart')) }}
                                    @else 
                                        0 
                                    @endif
                                </span>
                            </a>
                        </li>
                        <!-- carts -->
                        @endguest
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a href="{{ url('/home') }}" class="dropdown-item">Home</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (session()->has('success'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    @yield('script')
    <script src="{{ asset('fontawesome/js/all.min.css') }}"></script>
</body>
</html>
