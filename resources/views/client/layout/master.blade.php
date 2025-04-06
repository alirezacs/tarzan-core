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
<body style="direction: rtl; position: relative">

@if(session()->exists('notification'))
    <div class="min-w-[300px] max-w-[600px] p-4 {{ session()->exists('notification-success') ? 'bg-green-700' : 'bg-red-700' }} text-white rounded-[8px] fixed z-[100] bottom-[5%] right-[3%] transition">
        {{ session()->get('notification') }}
    </div>
@endif

@include('client.layout.header')

@yield('content')

@include('client.layout.footer')
</body>

@yield('script')
</html>
