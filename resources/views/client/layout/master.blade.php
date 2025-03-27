<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}" />
    <script src="{{ asset('assets/fontawesome/js/all.js') }}"></script>
</head>
<body style="direction: rtl">
    {{--Header--}}
    @include('client.layout.header')
    {{--Header--}}

    @yield('content')

    {{--Footer--}}
    @include('client.layout.footer')
    {{--Footer--}}
</body>
</html>
