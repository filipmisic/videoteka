<!DOCTYPE html>
<link rel="stylesheet" href="{{ asset('/css/terminal.css') }}">
<head>
    <title>@yield('pageTitle')</title>
</head>
<body>
    <div class="container">
        <div class="header">                
            <div class="ml-10">
                {{ (Auth::guard('worker')->user()->stores->name) }}
                {{ (Auth::guard('worker')->user()->stores->adress) }}
            </div>
            <div>
                {{ Auth::guard('worker')->user()->name }} {{ Auth::guard('worker')->user()->surname }} 
            </div>
            <div class="mr-10">
                <a class="logout" href="/terminal/logout">Logout</a>
            </div>

        </div>
        <div class="topnav" id="myTopnav">
            <a href="/terminal/dashboard">Dashboard</a>
            <a href="/terminal/dashboard">Kasa</a>
            <a href="/terminal/dashboard/inventory">Inventar</a>
            <a href="/terminal/dashboard/delivery">Dostava</a>
            <a href="/terminal/dashboard/loyalty">Korisnici</a>
        </div>
        <br>
        <div class="margine">
            @yield('content')
        </div>
    </div>
    <script>

    </script>
    @yield('JS')
</body>
</html>