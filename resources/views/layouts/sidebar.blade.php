@extends('layouts.head')
<aside class="sidebar-custom d-none d-lg-flex flex-column align-items-center py-4 px-2">
    <div class="logo-container mb-5">
        <img src="{{asset('assets/images/logo2.png')}}" alt="Logo" class="img-fluid" style="max-width: 90px;">
        <div class="sidebar-desc text-center mt-2">
                <span class="d-block text-white-50 small" style="font-size: 10px;">
                     HELMY AL-HAIDARI FOR GENERAL TRADE<br>
            لبيع جميع الأنشطة التجارية - خياطة و تفصيل الأزياء الرسمية
                </span>
        </div>
    </div>
    <nav class="">
        <ul class="nav flex-column gap-3 w-100">
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="{{url('/home')}}">الرئيسية</a>
            </li>


            <li class="nav-item position-relative">
                <a class="nav-link sidebar-link-custom dropdown-toggle" href="#" id="invoicesDropdown" role="button" onclick="toggleDropdown(event)" aria-expanded="false">
                    الفواتير
                </a>
                <div class=" container bg-white rounded-2 mt-2" id="invoicesDropdownMenu" style="display: none; width: 12rem !important;">

                    <a class="dropdown-item-custom" href="{{url('/invoice')}}">إضافة فاتورة</a>
                    <a class="dropdown-item-custom" href="#">قائمة الفواتير</a>
                </div>

            </li>
            <li class="nav-item position-relative">
                <a class="nav-link sidebar-link-custom dropdown-toggle" href="#" id="deptDropdown" role="button" onclick="deptDropdown(event)" aria-expanded="false">
                    الأقسام
                </a>
                <div class=" container bg-white rounded-2 mt-2" id="deptDropdownMenu" style="display: none; width: 12rem !important;">

                    <a class="dropdown-item-custom" href="#">الملابس</a>
                    <a class="dropdown-item-custom" href="#">الأحذية</a>
                </div>

            </li>

            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="#">المنتجات</a>
            </li>
        </ul>
    </nav>
</aside>


