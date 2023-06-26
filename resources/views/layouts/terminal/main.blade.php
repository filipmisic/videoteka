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
        <div>
            @yield('content')
        </div>
    </div>
    @yield('JS')
</body>
</html>