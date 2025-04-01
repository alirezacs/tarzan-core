@extends('client.layout.master')

@section('content')

    <section class="requests-container">
        <h2 class="black-route-title">درخواست ها</h2>
        <span class="black-route-path"> خانه > درخواست ها</span>
    </section>

    <section class="request-container">
        <h2 class="text-black font-bold text-4xl max-md:text-xl mb-5"> درخواست ویزیت </h2>
        <div class="flex justify-between">
            <h6 class="font-bold text-2xl max-md:text-base w-fit "> درخواست ملاقات :</h6>
            <p class="text-base max-md:text-xs text-gray-500 w-7/12">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                از طراحان گرافیک است. لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                صنعت چاپ و با استفاده از طراحان گرافیک است.
            </p>
        </div>
        <div class="flex justify-between">
            <h6 class="font-bold text-2xl max-md:text-base  w-fit "> چرا پتیو :</h6>
            <p class="text-base max-md:text-xs text-gray-500 w-7/12">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                از طراحان گرافیک است. لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                صنعت چاپ و با استفاده از طراحان گرافیک است.
            </p>
        </div>
        <div class="flex justify-between">
            <h6 class="font-bold text-2xl max-md:text-base  w-fit "> مزیت های پتیو :</h6>
            <p class="text-base max-md:text-xs text-gray-500 w-7/12">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                از طراحان گرافیک است. لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                صنعت چاپ و با استفاده از طراحان گرافیک است.
            </p>
        </div>
        <div class="flex items-center justify-center">
            <button class="request-btn" onClick={handleOpenModal}>
                ثبت درخواست
            </button>
        </div>

    </section>

    <section class="container">
        <h2 class="section-title my-5">
            <span> </span> برنامه های آینده
        </h2>
        <div class="plan-box">
            <h6 class="font-bold text-4xl max-lg:text-xl text-black my-5">
                ملاقات پت ها و سرگرمی های دیگر
            </h6>
            <div class="portfolio-box m-0">
                <img src="/dist/meeting.jpg" width={1200} height={300} alt="portfolio" />
            </div>
            <div class="future-details">
                <p class="text-base font-medium text-black-300 text-center mt-10">

                    "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                    ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و
                    کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. لورم ایپسوم
                    متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان
                    که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع
                    با هدف بهبود ابزارهای کاربردی می باشد"
                </p>
            </div>
        </div>
        <hr />
        <div class="plan-box">
            <h6 class="font-bold text-4xl max-lg:text-xl text-black my-5">
                جفت یابی و ازدواج
            </h6>
            <div class="portfolio-box m-0">
                <img src='/dist/love.jpg' width={1200} height={300} alt="portfolio" />
            </div>
            <div class="future-details">
                <p class="text-base font-medium text-black-300 text-center mt-10 w-full">

                    "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                    ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و
                    کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. لورم ایپسوم
                    متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان
                    که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع
                    با هدف بهبود ابزارهای کاربردی می باشد"
                </p>
            </div>
        </div>
        <hr />
    </section>

@endsection
