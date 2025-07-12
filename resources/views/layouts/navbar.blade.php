@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.head')


<nav class="main-navbar navbar navbar-expand-lg bg-dark-blue py-2">
    <div class="container-fluid">
        <!-- شعار المحل يظهر فقط عندما يكون العرض 991px أو أكثر -->
        <div>
            <div class="logo-991 me-3" style="display: none;">
                <img src="{{asset('assets/images/logo2.png')}}" alt="Logo" style="max-width: 60px;">
            </div>
        </div>
        <!-- صندوق البحث على اليمين -->
        {{--        <form class="d-flex align-items-center search-form position-relative" role="search" style="min-width: 220px;">--}}
        {{--            <input class="form-control rounded-pill border-0 pe-5" type="search" placeholder="بحث" aria-label="بحث" style="padding-right: 2.2rem;">--}}
        {{--            <span class="search-icon position-absolute" style="right: 18px; top: 50%; transform: translateY(-50%); pointer-events: none;">--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg"--}}
        {{--                     width="16" height="16" fill="#1A3E5D"--}}
        {{--                     class="bi bi-search"--}}
        {{--                     viewBox="0 0 16 16">--}}
        {{--                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.442 1.398a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/></svg>--}}
        {{--            </span>--}}
        {{--        </form>--}}
        <!-- زر التبديل -->
        <button class="navbar-toggler me-2 border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- السايدبار (Offcanvas) -->
        <div class="offcanvas offcanvas-start  text-white bg-dark-blue " tabindex="-1" id="mainNavbar"
             style="width: 90%;"
             aria-labelledby="mainNavbarLabel">
            <div class="offcanvas-header text-white">
                <h5 class="offcanvas-title" id="mainNavbarLabel">القائمة</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                @php
                    $employee = Auth::guard('employee')->user();
                @endphp
                <ul class="navbar-nav ">

                    {{-- إذا كان أدمن يعرض كل شيء --}}
                    @if($employee && $employee->department_id == 1)
                        @include('navbar_roles.admin')
                    @else

                        @if($employee && $employee->department_id == 2)
                            @include('navbar_roles.clothes')
                        @endif

                        @if($employee && $employee->department_id == 3)
                            @include('navbar_roles.shoes')
                        @endif

                    @endif
                </ul>

            </div>
        </div>

        {{--        --}}
        <div class="d-none d-lg-flex">
            <div class="dropdown user-dropdown" style="position: static">
                <button class="btn user-dropdown-toggle d-flex align-items-center gap-2" type="button"
                        id="userDropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="{{ asset('assets/images/user.png') }}" alt="User" class="user-account-avatar">
                    <span class="user-dropdown-name">حسابي</span>

                </button>
                <ul class="dropdown-menu user-dropdown-menu text-center" aria-labelledby="userDropdownMenuButton">
                    <li class="py-2">
                        <img src="{{ asset('assets/images/user.png') }}" alt="User"
                             class="user-dropdown-menu-avatar mb-2">
                        <div class="fw-bold">{{Auth()->user()->name}}</div>
                        <div class="text-muted small">رقم الجوال :{{Auth()->user()->phone}}</div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-2 me-5" href="#"><i
                                class="fa fa-user"></i> الملف الشخصي</a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-2 me-5" href="#"><i
                                class="fa fa-cog"></i> الإعدادات</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider ">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="dropdown-item d-flex align-items-center justify-content-start gap-2 me-5 text-danger">
                                <i class="fa fa-sign-out-alt"></i> تسجيل خروج
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<script>
    function toggleDropdown(event) {
        event.preventDefault();
        var invoice_menu = document.getElementById('invoicesDropdownMenu');
        invoice_menu.style.display = (invoice_menu.style.display === 'block') ? 'none' : 'block';
    }
    function deptDropdown(event) {
        event.preventDefault();
        var menu = document.getElementById('deptDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

    }
    function empDropdown(event) {
        event.preventDefault();
        var menu = document.getElementById('empDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

    }
    function purchasesDropdown(event) {
        event.preventDefault();
        var menu = document.getElementById('purchasesDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

    }
    function reportDropdown(event) {
        event.preventDefault();
        var menu = document.getElementById('reportDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

    }
    function returnDropdown(event) {
        event.preventDefault();
        var menu = document.getElementById('returnDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

    }
    function roleDropdown(event) {
        event.preventDefault();
        var menu = document.getElementById('roleDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

    }
    function productsDropdown(event) {
        event.preventDefault();
        var menu = document.getElementById('productsDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

    }
    function toggleAccountDropdown(event) {
        event.preventDefault();
        var menu = document.getElementById('toggleAccountDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        document.addEventListener('click', function handler(e) {
            var dropdownItem = document.getElementById('toggleAccountDropdown');
            if (!dropdownItem.contains(e.target) && !menu.contains(e.target)) {
                menu.style.display = 'none';
                document.removeEventListener('click', handler);
            }
        });
    }
</script>

