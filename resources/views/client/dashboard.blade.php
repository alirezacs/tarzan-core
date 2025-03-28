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
                        <img src="{{ auth()->user()->getFirstMedia('avatar') ? auth()->user()->getFirstMediaUrl('avatar') : asset('assets/default-avatar.jpg') }}" class="w-full h-full object-cover object-center" alt="">
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
                        <li class="mb-3 text-[18px]">
                            <button class="flex items-center w-full" onclick="changeProfilePage('profile-dashboard')">
                                <i class="fa-solid fa-home"></i>
                                <span class="mr-2">داشبورد</span>
                            </button>
                        </li>
                        <li class="mb-3 text-[18px]">
                            <button class="flex items-center w-full" onclick="changeProfilePage('profile-profile')">
                                <i class="fa-solid fa-user"></i>
                                <span class="mr-2">پروفایل</span>
                            </button>
                        </li>
                        <li class="mb-3 text-[18px]">
                            <button class="flex items-center w-full" onclick="changeProfilePage('profile-orders')">
                                <i class="fa-solid fa-basket-shopping"></i>
                                <span class="mr-2">سفارشات</span>
                            </button>
                        </li>
                        <li class="mb-3 text-[18px]">
                            <button class="flex items-center w-full" onclick="changeProfilePage('profile-favorites')">
                                <i class="fa-solid fa-heart"></i>
                                <span class="mr-2">علاقه مندی ها</span>
                            </button>
                        </li>
                        <li class="mb-3 text-[18px]">
                            <button class="flex items-center w-full" onclick="changeProfilePage('profile-requests')">
                                <i class="fa-solid fa-stethoscope"></i>
                                <span class="mr-2">درخواست ها</span>
                            </button>
                        </li>
                        <li class="mb-3 text-[18px]">
                            <button class="flex items-center w-full" onclick="changeProfilePage('profile-addresses')">
                                <i class="fa-solid fa-address-book"></i>
                                <span class="mr-2">ادرس ها</span>
                            </button>
                        </li>
                        <li class="mb-3 text-[18px]">
                            <button class="flex items-center w-full" onclick="changeProfilePage('profile-pets')">
                                <i class="fa-solid fa-dog"></i>
                                <span class="mr-2">پت های من</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-span-2 flex flex-col rounded-[8px] bg-[#e5e7eb] py-5 px-2 shadow-lg">
                <div class="profile-page flex flex-col" id="profile-dashboard">
                    <div class="flex justify-between items-center py-4 px-5 mb-4" style="border-bottom: 2px solid #9ca3af">
                        <span class="text-[28px] font-bold">
                            پنل کاربری <span class="text-[12px] text-gray-400">(خوش امدی علیرضا)</span>
                        </span>
                    </div>
                    <div class="grid grid-cols-4 gap-3">
                        <div class="shadow-lg bg-white rounded-[8px] flex flex-col p-4">
                            <span class="text-[15px] text-gray-600 mb-4">سفارشات فعال شما</span>
                            <div class="flex justify-end">
                                <span class="text-[18px] font-bold">۱۵</span>
                                <span class="text-[15px] text-gray-600 mr-2">عدد</span>
                            </div>
                        </div>
                        <div class="shadow-lg bg-white rounded-[8px] flex flex-col p-4">
                            <span class="text-[15px] text-gray-600 mb-4">درخواست های فعال شما</span>
                            <div class="flex justify-end">
                                <span class="text-[18px] font-bold">۱۵</span>
                                <span class="text-[15px] text-gray-600 mr-2">عدد</span>
                            </div>
                        </div>
                        <div class="shadow-lg bg-white rounded-[8px] flex flex-col p-4">
                            <span class="text-[15px] text-gray-600 mb-4">پت های شما</span>
                            <div class="flex justify-end">
                                <span class="text-[18px] font-bold">۱۵</span>
                                <span class="text-[15px] text-gray-600 mr-2">عدد</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-page flex flex-col" id="profile-profile">
                    <div class="flex justify-between items-center py-4 px-5 mb-4" style="border-bottom: 2px solid #9ca3af">
                        <span class="text-[28px] font-bold">
                            ویرایش پروفایل
                        </span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center bg-gray-300 p-4 rounded-[8px] shadow-xl mb-[3rem]">
                            <div class="w-[80px] h-[80px] rounded-full overflow-hidden border-2 border-gray-800 border-solid hover:border-teal-600 transition">
                                <img src="{{ auth()->user()->getFirstMedia('avatar') ? auth()->user()->getFirstMediaUrl('avatar') : asset('assets/default-avatar.jpg') }}" class="w-full h-full object-cover" alt="">
                            </div>
                            <div class="flex flex-col mr-2">
                                <span class="font-bold">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>
                                <span class="text-[10px] text-gray-400">برای تغییر آوتار، آواتار جدید خود را در فرم زیر اپلود کنید.</span>
                            </div>
                        </div>
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-2 gap-3 px-5">
                                <div class="flex flex-col">
                                    <label for="first_name" class="text-gray-600 font-bold mb-2"><span class="text-red-600">*</span> نام</label>
                                    <input type="text" placeholder="نام کوچیک شما" name="first_name" value="{{ auth()->user()->first_name }}" class="bg-transparent border-solid border-gray-100 border-b-2 outline-none text-[12px] placeholder:text-[12px] text-gray-600">
                                </div>
                                <div class="flex flex-col">
                                    <label for="first_name" class="text-gray-600 font-bold mb-2"><span class="text-red-600">*</span> نام خانوادگی</label>
                                    <input type="text" placeholder="نام خانوادگی شما" name="last_name" value="{{ auth()->user()->last_name }}" class="bg-transparent border-solid border-gray-100 border-b-2 outline-none text-[12px] placeholder:text-[12px] text-gray-600">
                                </div>
                                <div class="flex flex-col">
                                    <label for="email" class="text-gray-600 font-bold mb-2">ایمیل</label>
                                    <input type="email" placeholder="ایمیل شما" name="email" class="bg-transparent border-solid border-gray-100 border-b-2 outline-none text-[12px] placeholder:text-[12px] text-gray-600">
                                </div>
                                <div class="flex flex-col">
                                    <label for="avatar" class="text-gray-600 font-bold mb-2">آواتار</label>
                                    <input type="file" name="avatar">
                                </div>
                                <div class="col-span-full mt-4">
                                    <button type="submit" class="py-1 px-5 bg-green-600 text-white rounded-[8px]">
                                        ذخیره اطلاعات
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        let current = 'profile-profile';
        const changeProfilePage = (tab) => {
            let pages = document.querySelectorAll('.profile-page');
            pages.forEach(page => {
                page.classList.add('hidden');
            })
            document.getElementById(tab).classList.remove('hidden');
        }
        changeProfilePage(current);
    </script>
@endsection
