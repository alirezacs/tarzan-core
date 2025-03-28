<header class="w-full z-10">
    <div
        class="container mx-auto flex justify-between items-center py-5 px-5"
    >
        <div class="hamburger-menu text-black">
            <button onClick="{toggleSidebar}">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <div class="flex items-center gap-10">
            <div class="logo">
                <img src="{{ asset('assets/logo.png') }}" alt="logo" />
            </div>
            <nav class="max-lg:hidden">
                <div class="navbar text-black">
                    <ul class="flex items-center gap-6">
                        <li class="relative group beforeBlack">
                            <a href="#">
                                خانه
                                <i class="fa-solid fa-chevron-down text-base"></i>
                            </a>
                            <ul class="dropdown-menu-list">
                                <li>
                                    <a href="#">پروفایل</a>
                                </li>
                            </ul>
                        </li>
                        <li class="relative group beforeBlack">
                            <a href="#">
                                فروشگاه
                                <i class="fa-solid fa-chevron-down text-base"></i>
                            </a>
                            <ul class="dropdown-menu-list">
                                <li>
                                    <a href="#"> محصول ۱ </a>
                                </li>
                                <li>
                                    <a href="#">محصول ۲ </a>
                                </li>
                                <li>
                                    <a href="#">محصول ۳ </a>
                                </li>
                            </ul>
                        </li>
                        <li class="relative group beforeBlack">
                            <a href="#">
                                برند ها
                                <i class="fa-solid fa-chevron-down text-base"></i>
                            </a>
                            <ul class="dropdown-menu-list">
                                <li>
                                    <a href="#"> برند ۱ </a>
                                </li>
                                <li>
                                    <a href="#"> برند ۲ </a>
                                </li>
                                <li>
                                    <a href="#"> برند ۳ </a>
                                </li>
                            </ul>
                        </li>
                        <li class="relative group beforeBlack">
                            <a href="#">
                                وبلاگ
                                <i class="fa-solid fa-chevron-down text-base"></i>
                            </a>
                            <ul class="dropdown-menu-list">
                                <li>
                                    <a href="#"> وبلاگ </a>
                                </li>
                            </ul>
                        </li>
                        <li class="relative group beforeBlack">
                            <a href="#">
                                صفحات
                                <i class="fa-solid fa-chevron-down text-base"></i>
                            </a>
                            <ul class="dropdown-menu-list">
                                <li>
                                    <a href="#">درباره ما </a>
                                </li>
                                <li>
                                    <a href="#"> سوالات متداول </a>
                                </li>
                                <li>
                                    <a href="#">تماس با ما </a>
                                </li>
                                <li>
                                    <a href="#">صفحه ورود </a>
                                </li>
                                <li>
                                    <a href="#"> درخواست ها </a>
                                </li>
                                <li>
                                    <a href="#">صفحه ۴۰۴</a>
                                </li>
                                <li>
                                    <a href="#">صفحه تراکنش</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div
            class="flex items-center text-black max-sm:gap-2 max-lg:gap-4 lg:gap-7 text-xl max-md:text-base h-9 max-lg:hidden"
        >
            <div class="zoom">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="login-header">
                <button onClick="{handleUserIconClick}" class="user-icon-button">
                    <i class="fa-regular fa-user"></i>
                </button>
            </div>
            <div class="liked-list">
                <i class="fa-regular fa-heart"></i>
            </div>
            <div class="cart">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count bg-white text-black">۰</span>
            </div>
        </div>
    </div>
</header>
