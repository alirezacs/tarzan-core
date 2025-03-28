<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}" />
    @vite('resources/css/app.css')

    @yield('header')
</head>
<body style="direction: rtl;">

@include('client.layout.header')

@yield('content')

@include('client.layout.footer')
</body>

@yield('script')
</html>
