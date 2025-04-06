@extends('client.layout.master')

@section('header')
    <link rel="stylesheet" href="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.css"/>
    <script src="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.js"></script>
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
                            <button class="flex items-center w-full" onclick="changeProfilePage('profile-basket')">
                                <i class="fa-solid fa-basket-shopping"></i>
                                <span class="mr-2">سبد خرید</span>
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
                            <span class="text-[15px] text-gray-600 mb-4">سفارشات</span>
                            <div class="flex justify-end">
                                <span class="text-[18px] font-bold">{{ count($orders) }}</span>
                                <span class="text-[15px] text-gray-600 mr-2">عدد</span>
                            </div>
                        </div>
                        <div class="shadow-lg bg-white rounded-[8px] flex flex-col p-4">
                            <span class="text-[15px] text-gray-600 mb-4">درخواست های شما</span>
                            <div class="flex justify-end">
                                <span class="text-[18px] font-bold">{{ count($requests) }}</span>
                                <span class="text-[15px] text-gray-600 mr-2">عدد</span>
                            </div>
                        </div>
                        <div class="shadow-lg bg-white rounded-[8px] flex flex-col p-4">
                            <span class="text-[15px] text-gray-600 mb-4">پت ها شما</span>
                            <div class="flex justify-end">
                                <span class="text-[18px] font-bold">{{ count($pets) }}</span>
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
                <div class="profile-page flex flex-col" id="profile-orders">
                    <div class="flex justify-between items-center py-4 px-5 mb-4" style="border-bottom: 2px solid #9ca3af">
                        <span class="text-[28px] font-bold">
                            لیست سفارشات شما
                        </span>
                    </div>
                    <div>
                        <table class="w-full">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">شماره سفارش</th>
                                <th class="px-4 py-3">قیمت نهایی</th>
                                <th class="px-4 py-3">تاریخ</th>
                                <th class="px-4 py-3">تعداد محصولات</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                                @if($orders)
                                    @foreach($orders as $order)
                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3 text-sm border">{{ $order->id }}</td>
                                            <td class="px-4 py-3 text-ms border">{{ $order->total_price }}</td>
                                            <td class="px-4 py-3 text-xs border">{{ \Morilog\Jalali\Jalalian::forge($order->created_at)->format('%A, %d %B %y') }}</td>
                                            <td class="px-4 py-3 text-sm border">{{ count($order->orderItems) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="p-3 text-center">هیچ سفارشی ندارید</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="profile-page flex flex-col" id="profile-basket">
                    <div class="flex justify-between items-center py-4 px-5 mb-4" style="border-bottom: 2px solid #9ca3af">
                        <span class="text-[28px] font-bold">
                            سبد خرید شما
                        </span>
                    </div>
                    <div>
                        <table class="w-full">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">محصول</th>
                                <th class="px-4 py-3">قیمت</th>
                                <th class="px-4 py-3">تعداد</th>
                                <th class="px-4 py-3">تخفیف</th>
                                <th class="px-4 py-3">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @if($basket = auth()->user()->basket && count($items = auth()->user()->basket->basketItems))
                                @foreach($items as $item)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-sm border">
                                            @if($item->basketable_type === 'App\Models\ProductVariant')
                                                {{ $item->basketable->title }}
                                            @else
                                                درخواست
                                                {{ $item->basketable->request_type->name }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-ms border">{{ $item->total_price }} تومان</td>
                                        <td class="px-4 py-3 text-ms border">{{ $item->quantity }}</td>
                                        <td class="px-4 py-3 text-ms border">{{ $item->total_discount }} تومان</td>
                                        <td class="px-4 py-3 text-sm border flex items-center">
                                            <form action="{{ route('basket.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="basket_id" value="{{ $item->id }}">
                                                <button class="py-2 px-[3rem] bg-red-700 text-white rounded-[8px]">
                                                    حذف
                                                </button>
                                            </form>
                                            <form action="{{ route('basket.increase') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="basket_item_id" value="{{ $item->id }}">
                                                <button class="py-2 px-[3rem] bg-gray-300 rounded-[8px]">
                                                    اضافه کردن
                                                </button>
                                            </form>
                                            <form action="{{ route('basket.decrease') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="basket_item_id" value="{{ $item->id }}">
                                                <button class="py-2 px-[3rem] bg-gray-300 rounded-[8px]">
                                                    کم کردن
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="p-3 text-center">
                                        سبد خرید شما خالی میباشد
                                        <a href="{{ route('product.index') }}" class="underline text-blue-900">محصولات</a>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="flex items-center justify-between p-3 border-gray-400 border-solid border-t-2 mt-2">
                            <span class="text-gray-800">
                                مجموع سبد خرید شما:
                                <span class="text-xl font-bold">{{ auth()->user()->basket->basketItems ? auth()->user()->basket->basketItems()->sum('total_price') : 0 }}</span>
                                تومان
                            </span>
                            <form action="{{ route('basket.pay') }}" method="POST">
                                @csrf
                                <button class="rounded-[8px] font-bold text-white bg-green-800 text-sm py-2 px-[5rem]">
                                    نهایی کردن خرید
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="profile-page flex flex-col" id="profile-favorites">
                    <div class="flex justify-between items-center py-4 px-5 mb-4" style="border-bottom: 2px solid #9ca3af">
                        <span class="text-[28px] font-bold">
                            لیست علاقه مندی ها
                        </span>
                        <a href="{{ route('product.index') }}">لیست محصولات</a>
                    </div>
                    <div>
                        <table class="w-full">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">عکس</th>
                                <th class="px-4 py-3">اسم محصول</th>
                                <th class="px-4 py-3">قیمت</th>
                                <th class="px-4 py-3">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @if($favorites)
                                @foreach($favorites as $favorite)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-sm border">
                                            <div class="w-[40px] h-[40px] rounded-full overflow-hidden border-solid border-gray-800 border-2">
                                                <img src="{{ $favorite->getFirstMediaUrl('thumbnail') }}" alt="">
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-ms border">{{ $favorite->title }}</td>
                                        <td class="px-4 py-3 text-ms border">{{ $favorite->product_variants->first()->price }}</td>
                                        <td class="px-4 py-3 text-sm border">
                                            <button class="bg-red-500 text-white py-1 px-3 rounded-[8px]">حذف از لیست</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="p-3 text-center">لیست محصولات مورد علاقه شما خالی میباشد</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="profile-page flex flex-col" id="profile-requests">
                    <div class="flex justify-between items-center py-4 px-5 mb-4" style="border-bottom: 2px solid #9ca3af">
                        <span class="text-[28px] font-bold">
                            درخواست های شما
                        </span>
                    </div>
                    <div>
                        <table class="table-fixed">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">درخواست</th>
                                <th class="px-4 py-3">پت</th>
                                <th class="px-4 py-3">نوع رسیدگی</th>
                                <th class="px-4 py-3">دامپزشک</th>
                                <th class="px-4 py-3">وضعیت</th>
                                <th class="px-4 py-3">ادرس</th>
                                <th class="px-4 py-3">مبلغ پرداختی شما</th>
                                <th class="px-4 py-3">تاریخ رسیدگی</th>
                                <th class="px-4 py-3">اورژانسی</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @if($requests)
                                @foreach($requests as $request)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-sm border">{{ $request->request_type->name }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ $request->pet ? $request->pet->name : 'پت حذف شده' }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ $request->handling_type->name }}</td>
                                        <td class="px-4 py-3 text-sm border">Dr. {{ $request->veterinarian ? $request->veterinarian->first_name . ' ' . $request->veterinarian->last_name : 'در انتظار دامپزشک' }}</td>
                                        <td class="px-4 py-3 text-sm border">
                                            @switch($request->status)
                                                @case(null)
                                                    در حال بررسی
                                                @break
                                                @case('pending_pay')
                                                    در انتظار پرداخت
                                                @break
                                                @case('completed')
                                                    تکمیل شده
                                                @break
                                                @case('canceled')
                                                    لغو شده
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="px-4 py-3 text-sm border">{{ $request->address ? $request->address->name : 'ادرس حذف شده' }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ $request->total_paid }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ \Morilog\Jalali\Jalalian::forge($request->handling_date)->format('%A, %d %B %y') }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ $request->is_emergency ? 'هست' : 'نیست' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="profile-page flex flex-col" id="profile-addresses">
                    <div class="flex justify-between items-center py-4 px-5 mb-4" style="border-bottom: 2px solid #9ca3af">
                        <span class="text-[28px] font-bold">
                            ادرس های شما
                        </span>
                        <button class="bg-green-700 text-white py-1 px-5 rounded-[8px]" onclick="openModal('createAddressModal')">
                            ادرس جدید
                        </button>
                    </div>
                    <div>
                        <table class="table-fixed w-full">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3 text-center">اسم</th>
                                <th class="px-4 py-3 text-center">ادرس</th>
                                <th class="px-4 py-3 text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @if($addresses)
                                @foreach($addresses as $address)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-sm border text-center">{{ $address->name }}</td>
                                        <td class="px-4 py-3 text-sm border text-center">{{ $address->address }}</td>
                                        <td class="px-4 py-3 text-sm border text-center">
                                            <form action="{{ route('address.destroy', $address->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="bg-red-500 text-white py-1 px-3" type="submit">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="border-solid border-gray-500 border-t-2 mt-2 pt-2">
                        </div>
                    </div>
                </div>
                <div class="profile-page flex flex-col" id="profile-pets">
                    <div class="flex justify-between items-center py-4 px-5 mb-4" style="border-bottom: 2px solid #9ca3af">
                        <span class="text-[28px] font-bold">
                            پت های شما
                        </span>
                        <button class="bg-green-700 text-white py-1 px-5 rounded-[8px]" onclick="openModal('createPetModal')">
                            پت جدید
                        </button>
                    </div>
                    <div>
                        <table class="table-fixed w-full">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">اسم</th>
                                <th class="px-4 py-3">تاریخ تولد</th>
                                <th class="px-4 py-3">جنسیت</th>
                                <th class="px-4 py-3">رنگ پوست</th>
                                <th class="px-4 py-3">نژاد</th>
                                <th class="px-4 py-3">دسته بندی</th>
                                <th class="px-4 py-3">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @if($pets)
                                @foreach($pets as $pet)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-sm border">{{ $pet->name }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ $pet->birthdate }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ $pet->gender }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ $pet->skin_color }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ $pet->breed->name }}</td>
                                        <td class="px-4 py-3 text-sm border">{{ $pet->PetCategory->name }}</td>
                                        <td class="px-4 py-3 text-sm border">
                                            <form action="{{ route('pet.destroy', $pet->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="bg-red-500 text-white py-1 px-3" type="submit">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">هیج پتی در سیستم ما ثبت نکرده اید</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden justify-center items-center w-full h-full absolute top-0 right-0 bg-black/50" id="createAddressModal" onclick="closeModal(event, 'createAddressModal')">
        <div class="min-w-[40%] p-4 bg-white shadow-md shadow-white rounded-[10px] flex flex-col">
            <form action="{{ route('address.store') }}" method="POST">
                @csrf
                <input type="text" placeholder="نام ادرس" class="w-full border-gray-400 border-solid border-b-2 outline-none p-2 mb-3" name="name">
                <input type="text" placeholder="ادرس" class="w-full border-gray-400 border-solid border-b-2 outline-none p-2 mb-3" name="address" id="address-field">
                <input type="hidden" name="latitude">
                <input type="hidden" name="longitude">
                <div class="w-full h-[300px] mb-3" id="map"></div>
                <button class="bg-green-600 rounded-[8px] text-white py-1 px-5 text-sm">ثبت ادرس</button>
            </form>
        </div>
    </div>
    <div class="hidden justify-center items-center w-full h-full absolute top-0 right-0 bg-black/50" id="createPetModal" onclick="closeModal(event, 'createPetModal')">
        <div class="min-w-[40%] p-4 bg-white shadow-md shadow-white rounded-[10px] flex flex-col">
            <form action="{{ route('pet.store') }}" method="POST" class="flex flex-col">
                @csrf
                <label for="pet_category_id">دسته بندی پت شما:</label>
                <select name="pet_category_id" id="pet_category_id" class="w-full border-gray-400 border-solid border-b-2 outline-none p-2 mb-4">
                    @foreach($petCategories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <label for="breed_id">نژاد پت شما:</label>
                <select name="breed_id" id="breed_id" class="w-full border-gray-400 border-solid border-b-2 outline-none p-2 mb-4">
                    @foreach($breeds as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <label for="name">نام پت شما</label>
                <input type="text" id="name" placeholder="نام پت شما" class="w-full border-gray-400 border-solid border-b-2 outline-none p-2 mb-4" name="name">
                <label for="name">تاریخ تولد پت شما</label>
                <input type="date" id="birthdate" class="w-full border-gray-400 border-solid border-b-2 outline-none p-2 mb-4" name="birthdate">
                <label for="gender">جنسیت پت شما:</label>
                <select name="gender" id="gender" class="w-full border-gray-400 border-solid border-b-2 outline-none p-2 mb-4">
                    <option value="male">نر</option>
                    <option value="female">ماده</option>
                </select>
                <label for="skin_color">رنگ پوست پت شما:</label>
                <input type="color" placeholder="رنگ پوست پت شما" name="skin_color" id="skin_color" class="border-gray-400 border-solid border-b-2 outline-none p-2 mb-4">


                <button class="bg-green-600 rounded-[8px] text-white py-1 px-5 text-sm">ذخیره</button>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        let current = new URL(document.URL).hash.slice(1) || 'profile-dashboard';
        console.log(current)
        const changeProfilePage = (tab) => {
            let pages = document.querySelectorAll('.profile-page');
            pages.forEach(page => {
                page.classList.add('hidden');
            })
            document.getElementById(tab).classList.remove('hidden');
        }
        changeProfilePage(current);

        const openModal = (modal) => {
            document.getElementById(modal).style.display = 'flex';
        }
        const closeModal = (event, modal) => {
            if(event.target.id === modal){
                document.getElementById(modal).style.display = 'none';
                document.querySelector('body').style.overflow = 'auto';
            }
        }

        const changeAddressTab = (tab) => {
            if(tab === 'address'){
                document.getElementById('address-tab-btn').classList.add('bg-gray-500');
                document.getElementById('address-tab-btn').classList.add('text-white');
                document.getElementById('location-tab-btn').classList.remove('bg-gray-500', 'text-white');
                document.getElementById('address-tab').classList.remove('hidden');
                document.getElementById('location-tab').classList.add('hidden');
            }else{
                document.getElementById('location-tab-btn').classList.add('bg-gray-500');
                document.getElementById('location-tab-btn').classList.add('text-white');
                document.getElementById('address-tab-btn').classList.remove('bg-gray-500', 'text-white');
                document.getElementById('location-tab').classList.remove('hidden');
                document.getElementById('address-tab').classList.add('hidden');
            }
        }
    </script>
    <script type="module">
        const testLMap = new L.Map("map", {
            key: "web.6f4550c9ebef4894b5dd2e2fe5c7f62c",
            maptype: "neshan",
            poi: false,
            center: [35.699756, 51.338076],
            zoom: 14,
        })
        let marker = L.marker([35.699756, 51.338076], {draggable: true})
            .addTo(testLMap)
            .on('dragend', e => {
                getAddress(e.target.getLatLng().lat, e.target.getLatLng().lng);
                document.getElementsByName('latitude')[0].value = e.target.getLatLng().lat;
                document.getElementsByName('longitude')[0].value = e.target.getLatLng().lng;
            });
        const getAddress = async (lat, lng) => {
            await fetch(`https://api.neshan.org/v5/reverse?lat=${lat}&lng=${lng}`, {
                headers: {
                    "Api-Key": "service.11acc59616cc4c5f89f67c860a1fb3eb"
                }
            })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'OK'){
                        document.getElementById('address-field').setAttribute('value', data.formatted_address);
                    }
                });
        }
    </script>
@endsection
