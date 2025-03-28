@extends('client.layout.master')

@section('header')

@endsection

@section('content')

    <div class="relative w-full h-[70vh] mb-4">
        <img src="{{ asset('assets/bg-profile.jpg') }}" class="object-cover object-top w-full h-full" alt="">
        <div class="w-full h-full absolute top-0 right-0 flex flex-col justify-center items-center">
            <h1 class="text-white text-[4rem] font-bold">پروفایل</h1>
            <span class="text-white">خانه > پروفایل</span>
        </div>
    </div>

    <div class="container">
        <div class="grid grid-cols-3 gap-3">
            <div class="flex flex-col rounded-[8px] bg-[#e5e7eb] py-5 px-2 shadow-lg">
                <div class="relative flex items-center border-b-2 border-gray-300 border-solid pb-3">
                    <div class="w-[60px] h-[60px] rounded-full overflow-hidden border-solid border-2 border-gray-800">
                        <img src="{{ asset('assets/insta3.jpg') }}" class="w-full h-full object-cover object-center" alt="">
                    </div>
                    <div class="mr-2">
                        <span>علیرضا مردانی</span>
                    </div>
                    <button class="absolute left-0 top-4 w-[35px] h-[35px] flex items-center justify-center rounded-full border-gray-800 border-2">
                        <i class="fa-solid fa-sign-out-alt"></i>
                    </button>
                </div>
                <div class="p-3">
                    <ul class="flex flex-col">
                        <li class="flex items-center mb-3 text-[18px]">
                            <i class="fa-solid fa-home"></i>
                            <span class="mr-2">داشبورد</span>
                        </li>
                        <li class="flex items-center mb-3 text-[18px]">
                            <i class="fa-solid fa-user"></i>
                            <span class="mr-2">پروفایل</span>
                        </li>
                        <li class="flex items-center mb-3 text-[18px]">
                            <i class="fa-solid fa-basket-shopping"></i>
                            <span class="mr-2">سفارشات</span>
                        </li>
                        <li class="flex items-center mb-3 text-[18px]">
                            <i class="fa-solid fa-heart"></i>
                            <span class="mr-2">علاقه مندی ها</span>
                        </li>
                        <li class="flex items-center mb-3 text-[18px]">
                            <i class="fa-solid fa-stethoscope"></i>
                            <span class="mr-2">درخواست ها</span>
                        </li>
                        <li class="flex items-center mb-3 text-[18px]">
                            <i class="fa-solid fa-address-book"></i>
                            <span class="mr-2">ادرس ها</span>
                        </li>
                        <li class="flex items-center mb-3 text-[18px]">
                            <i class="fa-solid fa-dog"></i>
                            <span class="mr-2">پت های من</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-span-2 flex flex-col rounded-[8px] bg-[#e5e7eb] py-5 px-2 shadow-lg">
            </div>
        </div>
    </div>

@endsection
