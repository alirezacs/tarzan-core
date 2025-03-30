@extends('client.layout.master')

@section('content')

    <section class="aboutUs-container">
        <h2 class="aboutUs-title">درباره</h2>
        <h2 class="aboutUs-sub">پتیو بدانید</h2>
    </section>
    <section
        class="aboutUs-image-holder "
        style="background-image: url('{{ asset('assets/about-1.jpg') }}'); background-repeat: no-repeat; background-position: center;"
    >
        <div class="container p-40 max-xl:py-10 max-md:p-0">
            <div class="flex items-center justify-between ">
                <div class="flex flex-col w-1/2 gap-20 max-xl:gap-10 max-md:gap-0">
                    <h2 class="text-5xl max-xl:text-2xl max-md:text-xs font-bold ">
                        ما همیشه بخاطر مشتریان خود اینجا هستیم.
                    </h2>
                    <p class="text-sm max-md:text-[0.5rem] font-normal text-black-300">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                        استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
                        در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                        نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                    </p>
                    <a
                        href="/"
                        class="bg-black text-white rounded-full w-fit px-5 py-2 font-bold text-lg duration-300 ease-in-out hover:bg-white hover:text-black max-md:text-[0.5rem] max-md:p-0 max-md:px-2 max-md:h-5 max-md:flex max-md:items-center"
                    >
                        بیشتر بدانید
                    </a>
                </div>
                <div></div>
            </div>
        </div>
    </section>
    <section
        class="aboutUs-image-holder"
        style="background-image: url('{{ asset('assets/about-2.jpg') }}'); background-repeat: no-repeat; background-position: center;"
    >
        <div class="container p-40 max-xl:py-10 max-md:px-0 max-md:p-0 ">
            <div class="flex items-center justify-between ">
                <div></div>
                <div class="flex flex-col w-1/2 gap-20 max-xl:gap-10 max-md:gap-0">
                    <h2 class="text-5xl max-xl:text-2xl max-md:text-xs font-bold ">
                        ما سخت کار می کنیم و پیروز می شویم.
                    </h2>
                    <p class="text-sm max-md:text-[0.5rem] font-normal text-black-300">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                        استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
                        در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                        نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                    </p>
                    <a
                        href="/"
                        class="bg-black text-white rounded-full w-fit px-5 py-2 font-bold text-lg duration-300 ease-in-out hover:bg-white hover:text-black max-md:text-[0.5rem] max-md:p-0 max-md:px-2 max-md:h-5 max-md:flex max-md:items-center "
                    >
                        بیشتر بدانید
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-10 relative border-bottom">
        <div class="container">

            <section class="container">
                <h2 class="section-title my-5">
                    <span> </span> نظرات کاربران
                </h2>
            </section>

        </div>
    </section>
    <section class="mt-20 text-center flex flex-col gap-10">
        <h2 class="font-bold text-5xl text-[--primary-color] ">#پتیو</h2>
        <span>لحظات درخشان خود را با پتیو به اشتراک بگذارید!</span>
        <div class="grid lg:grid-cols-6 max-lg:grid-cols-3 max-md:grid-cols-2 gap-1">

            <div class="instaImg-container">
                <img src="{{ asset('assets/insta1.jpg') }}" alt="pic" />
            </div>
            <div class="instaImg-container">
                <img src="{{ asset('assets/insta2.jpg') }}" alt="pic" />
            </div>
            <div class="instaImg-container">
                <img src="{{ asset('assets/insta3.jpg') }}" alt="pic" />
            </div>
            <div class="instaImg-container">
                <img src="{{ asset('assets/insta4.jpg') }}" alt="pic" />
            </div>
            <div class="instaImg-container">
                <img src="{{ asset('assets/insta5.jpg') }}" alt="pic" width={350} />
            </div>
            <div class="instaImg-container">
                <img src="{{ asset('assets/insta6.jpg') }}" alt="pic" />
            </div>

        </div>
    </section>

@endsection
