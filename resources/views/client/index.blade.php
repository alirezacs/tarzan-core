@extends('client.layout.master')

@section('content')
    <div class="container pt-28 pb-10 relative max-lg:hidden">
        <div class="navbar-container">
            <ul>
                <li class="relative group">
                    <a href="#">
                        دسته بندی
                        <FontAwesomeIcon
                            icon="{faChevronDown}"
                            fontSize="{10}"
                            class="pb-1"
                        />
                    </a>
                    <ul class="dropdown-menu-list">
                        <li class="text-black font-bold text-lg">
                            <a href="#">ایتم یک </a>
                        </li>
                        <li class="text-black font-bold text-lg">
                            <a href="#">ایتم دو </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="shipping">
                <span>ارسال رایگان برای خریدهای بالای ۵۰۰ هزار تومان</span>
            </div>
        </div>
    </div>

    <section class="container lg:p-0 max-lg:pt-20 h-full max-lg:px-2 max-lg:mt-5">
        <div class="container">
            <Carousel />


            <div class="banner-container">
                <div class="banner-box">
                    <img
                        src="{{ asset('assets/dog-banner.jpg') }}"
                        alt="banner"
                        width={450}
                        height={300}
                        class="banner-img"
                    />
                    <h6 class="banner-h6 text-[#734723]">
                        یکی بخرید
                        <br /> یکی رایگان ببرید
                    </h6>
                    <a href="/" class="banner-btn bg-[#734723]">
                        اکنون خریداری کنید
                    </a>
                </div>
                <div class="banner-box">
                    <img
                        src="{{ asset('assets/cat-banner.jpg') }}"
                        alt="banner"
                        width={450}
                        height={300}
                        class="banner-img"
                    />
                    <h6 class="banner-h6 text-[#4f3881] ">
                        لوازم ضروری
                        <br /> حیوانات خانگی
                    </h6>
                    <a href="/" class="banner-btn bg-[#4f3881]">
                        اکنون خریداری کنید
                    </a>
                </div>
                <div class="banner-box">
                    <img
                        src="{{ asset('assets/food-banner.jpg') }}"
                        alt="banner"
                        width={450}
                        height={300}
                        class="banner-img"
                    />
                    <h6 class="banner-h6 text-[#36616d]">
                        لوازم سرگرمی
                        <br /> سگ و گربه
                    </h6>
                    <a href="/" class="banner-btn bg-[#36616d] ">
                        اکنون خریداری کنید
                    </a>
                </div>
            </div>


        </div>
    </section>

    <section class="category-container">
        <div class="container my-28">
            <div class="container flex flex-col items-center gap-5">
                <div class="flex justify-between w-full items-center pb-10">
                    <h2 class="section-title">
                        <span> </span>
                        هرآنچه پت شما نیاز دارد
                    </h2>

                    <a href="#" class="show-all"> نمایش همه </a>
                </div>
                <div class="grid lg:grid-cols-5 max-md:grid-cols-2 gap-5">
                    <div class="category-card">
                        <a href="#" class="category-a">
                            <img src="{{ asset('assets/dog-beds.jpg') }}" width="250" alt="category" />
                            <span>تخت سگ</span>
                        </a>
                    </div>
                    <div class="category-card">
                        <a href="#" class="category-a">
                            <img src="{{ asset('assets/dog-clothing.jpg') }}" width="250" alt="category" />
                            <span>تخت سگ</span>
                        </a>
                    </div>
                    <div class="category-card">
                        <a href="#" class="category-a">
                            <img src="{{ asset('assets/dog-food.jpg') }}" width="250" alt="category" />
                            <span>تخت سگ</span>
                        </a>
                    </div>
                    <div class="category-card">
                        <a href="#" class="category-a">
                            <img src="{{ asset('assets/dog-toys.jpg') }}" width="250" alt="category" />
                            <span>تخت سگ</span>
                        </a>
                    </div>
                    <div class="category-card">
                        <a href="#" class="category-a">
                            <img src="{{ asset('assets/dog-treats.jpg') }}" width="250" alt="category" />
                            <span>تخت سگ</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-20">
        <div class="container flex flex-col items-center gap-5">
            <div class="flex w-full justify-between pb-10">
                <h2 class="section-title">
                    <span> </span>رتبه برتر
                </h2>
                <a href="/" class="show-all">
                    نمایش همه
                </a>
            </div>

            <div class="grid grid-flow-row lg:grid-cols-4 md:grid-cols-3 max-sm:grid-cols-2 gap-2 ">


                <a
                    href='/'
                    key={product.id}
                    class="shop-card"

                >
                    <div class="card-item relative">
                        <img
                            src="{{ asset('assets/product-4.jpg') }}"
                            alt="product"
                            width={300}
                            class="default-img"
                        />

                        <div class="like-product">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <div class="addTo-basket">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                    </div>
                    <div class="card-details text-center mt-2">
                        <div class="stars mb-2 flex items-center gap-1 ">
                            جای ستاره
                            <span class="pr-2 text-black-300">(۲)</span>
                        </div>
                        <span class="card-name block font-bold">نام محصول</span>
                        <span class="card-price block text-gray-500">
                            قیمت
                          </span>
                    </div>
                </a>


            </div>

        </div>
    </section>

    <section class="container py-28 relative">
        <div class="container flex flex-col items-center">
            <div class="flex w-full justify-between pb-10">
                <h2 class="section-title">
                    <span> </span>برندهای محبوب
                </h2>
                <a href="/" class="show-all">
                    نمایش همه
                </a>
            </div>
            <div class="grid lg:grid-cols-5 max-md:grid-cols-2 gap-2">
                <div class="border px-10 py-5 rounded-2xl">
                    <a href="/" class="brand-card">
                        <img src="{{ asset('assets/brand-1.jpg') }}" width={150} alt="brand" />
                    </a>
                </div>
                <div class="border px-10 py-5 rounded-2xl">
                    <a href="/" class="brand-card">
                        <img src="{{ asset('assets/brand-2.jpg') }}" width={150} alt="brand" />
                    </a>
                </div>
                <div class="border px-10 py-5 rounded-2xl">
                    <a href="/" class="brand-card">
                        <img src="{{ asset('assets/brand-3.jpg') }}" width={150} alt="brand" />
                    </a>
                </div>
                <div class="border px-10 py-5 rounded-2xl">
                    <a href="/" class="brand-card">
                        <img src="{{ asset('assets/brand-5.jpg') }}" width={150} alt="brand" />
                    </a>
                </div>
                <div class="border px-10 py-5 rounded-2xl">
                    <a href="/" class="brand-card">
                        <img src="{{ asset('assets/brand-3.jpg') }}" width={150} alt="brand" />
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
