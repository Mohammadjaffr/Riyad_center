@extends('layouts.head')


<nav class="main-navbar navbar navbar-expand-lg bg-dark-blue py-2">
    <div class="container-fluid">
        <!-- شعار المحل يظهر فقط عندما يكون العرض 991px أو أكثر -->
        <div class="logo-991 me-3" style="display: none;">
            <img src="{{asset('assets/images/logo2.png')}}" alt="Logo" style="max-width: 60px;">
        </div>
        <!-- صندوق البحث على اليمين -->
        <form class="d-flex align-items-center search-form position-relative" role="search" style="min-width: 220px;">
            <input class="form-control rounded-pill border-0 pe-5" type="search" placeholder="بحث" aria-label="بحث" style="padding-right: 2.2rem;">
            <span class="search-icon position-absolute" style="right: 18px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="#1A3E5D"
                     class="bi bi-search"
                     viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.442 1.398a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/></svg>
            </span>
        </form>
                <!-- زر التبديل -->
                <button class="navbar-toggler me-2 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- السايدبار (Offcanvas) -->
        <div class="offcanvas offcanvas-start bg-dark-blue text-white" tabindex="-1" id="mainNavbar" aria-labelledby="mainNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="mainNavbarLabel">القائمة</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav gap-4 me-5">
                    <li class="nav-item d-lg-none">
                        <div class="logo-554 me-3">
                            <img src="{{asset('assets/images/logo2.png')}}" alt="Logo" style="max-width: 60px;">
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{url('/home')}}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="#">الأحذية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="#">الملابس</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown">
                            حسابي
                        </a>
                        <ul class="dropdown-menu bg-white border-0">
                            <li><a class="dropdown-item text-blue text-end" href="#">حسابي الشخصي</a></li>
                            <li><a class="dropdown-item text-blue text-end" href="#">تغيير كلمة المرور</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item text-white" >
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger w-100 text-end" style="background: none; border: none;">تسجيل خروج</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{url('/invoice')}}">إضافة فاتورة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="#">قائمة الفواتير</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="#">المنتجات</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


