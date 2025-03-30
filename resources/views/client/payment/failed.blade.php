@extends('client.layout.master')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <img src="{{ asset('assets/failed-payment.jpg') }}" style="width: 500px" alt="">
        <p class="text-gray-700 font-bold text-5xl mb-5">عملیات خرید موفقیت امیز نبود!</p>
        <a href="{{ route('dashboard') }}" class="font-bold text-2xl bg-green-700 text-white py-2 px-[5rem] rounded-[10px]">پنل کاربری</a>
    </div>
@endsection
