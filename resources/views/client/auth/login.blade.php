@extends('client.layout.master')

@section('content')
    <section class="container text-center py-40 px-48 max-md:px-0 max-md:py-10 -z-10">
        <div class="flex justify-center relative w-full h-[35rem] overflow-hidden z-0">
            <div class="w-full max-md:w-[100%] flex justify-center items-center transition-transform duration-500 ease-in-out">
                <div class="relative w-1/2 left-0 z-10 flex flex-col justify-center items-center gap-16 rounded-l-3xl h-[35rem] px-4 max-lg:w-full lg:w-1/2">
                    <div class="signin-signup-btns">
                        <h4 class="signup-btn" onclick="handleClick('عضویت')">عضویت</h4>
                        <h4 class="signin-btn" onclick="handleClick('ورود')">ورود</h4>
                        <div class="btns-holder-login"></div>
                    </div>
                    <!-- "ورود" section  -->
                    <div class="loginForm">
                        <form action="{{ route('authentication') }}" method="POST" class="login-form">
                            @csrf
                            <input type="hidden" name="login_type" value="password">
                            <div class="form-group">
                                <input type="text" name="phone" placeholder="شماره تلفن" />
                                <label class="form-label">شماره تلفن</label>
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="رمز عبور" />
                                <label class="form-label">رمز عبور</label>
                                <i class="fa-regular fa-eye"></i>
                            </div>
                            <button class="login-btn" type="submit">ورود</button>
                            <p>در صورت فراموشی رمز عبور <span>کلیک کنید</span></p>
                        </form>
                    </div>

                    <!-- "عضویت" section  -->
                    <div class="signupForm">
                        <form action="{{ route('register') }}" method="POST" scroll="{false}" class="signup-form">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="first_name" placeholder="نام" required />
                                <label class="form-label"> نام </label>
                            </div>
                            @error('first_name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <input type="text" name="last_name" placeholder=" نام خانوادگی" required />
                                <label class="form-label"> نام خانوادگی </label>
                            </div>
                            @error('last_name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <input type="number" name="phone" placeholder=" تلفن" required />
                                <label class="form-label"> شماره تلفن </label>
                            </div>
                            @error('phone')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <input type="password" name="password" placeholder="رمزعبور" required />
                                <label class="form-label"> رمزعبور </label>
                            </div>
                            @error('password')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                            <button
                                class="bg-[--primary-color] text-white w-[30%] rounded-full py-2 px-5 duration-300 ease-in-out hover:bg-[--secondary-color] whitespace-nowrap"
                            >
                                 ثبت نام
                            </button>
                        </form>
                    </div>
                </div>
                <div class="login-pic w-1/2">
                    <img width="200" src="{{ asset('assets/logo-white.png') }}" alt="logo" />
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function handleClick(type) {
            const loginForm = document.querySelector(".loginForm");
            const signupForm = document.querySelector(".signupForm");
            const btnsHolder = document.querySelector(".btns-holder-login");
            const signupBtn = document.querySelector(".signup-btn");
            const signinBtn = document.querySelector(".signin-btn");

            if (type === "ورود") {
                loginForm.style.display = "block";
                signupForm.style.display = "none";
                btnsHolder.style.transform = "translateX(0)";
                signinBtn.classList.add("bg-active");
                signupBtn.classList.remove("bg-active");
            } else {
                loginForm.style.display = "none";
                signupForm.style.display = "block";
                btnsHolder.style.transform = "translateX(100%)";
                signupBtn.classList.add("bg-active");
                signinBtn.classList.remove("bg-active");
            }
        }
        handleClick('ورود')
    </script>
@endsection
