@extends('client.layout.master')

@section('content')

    <section class="contactUs-container">
        <h2 class="route-title"> تماس با ما</h2>
        <span class="route-path"> خانه > تماس با ما </span>
        <div class="contact-box">
            <div class="flex flex-col p-10">
                <div class="text-start ">
                    <h5>خدمات مشتری</h5>
                </div>
                <div class="text-start mt-5">
                    <p>
                        آیا سوالی دارید یا فقط می خواهید با ما در ارتباط باشید؟ <br /> ما از
                        اینکه با شما در ارتباط باشیم خوشحال میشویم.
                    </p>
                </div>
                <div class="flex items-center justify-start my-5">
                    <div class="contact-icon-holder">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="contactUs-number">
                        <h6>تلفن</h6>
                        <p>021-12345678</p>
                    </div>
                </div>
                <div class="flex items-center justify-start ">
                    <div class="contact-icon-holder">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <div class="contactUs-email ">
                        <h6>ایمیل</h6>
                        <p>sayhello@funio.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
