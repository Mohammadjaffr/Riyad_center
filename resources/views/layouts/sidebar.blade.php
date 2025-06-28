@extends('layouts.head')
<aside class="sidebar-custom d-none d-lg-flex flex-column align-items-center py-4 px-2">
    <div class="logo-container mb-2">
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
                <a class="nav-link sidebar-link-custom dropdown-toggle" href="#" id="deptDropdown" role="button" onclick="deptDropdown(event)" aria-expanded="false">
                    الأقسام
                </a>
                <div class="  rounded-2 mt-2 text-center" id="deptDropdownMenu" style="display: none; width: 12rem !important;">

                    <a class="dropdown-item-custom" href="#">الملابس</a>
                    <a class="dropdown-item-custom" href="#">الأحذية</a>
{{--                    <a class="dropdown-item-custom" href="#">إضافة قسم</a>--}}
                </div>

            </li>

            <li class="nav-item position-relative">
                <a class="nav-link sidebar-link-custom dropdown-toggle" href="#" id="productsDropdown" role="button" onclick="productsDropdown(event)" aria-expanded="false">
                    المنتجات
                </a>
                <div class="  rounded-2 mt-2 text-center" id="productsDropdownMenu" style="display: none; width: 12rem !important;">
                    <a class="dropdown-item-custom" href="#">إضافة منتج </a>
                    <a class="dropdown-item-custom" href="#">عرض المنتجات</a>
                </div>
            </li>

            <li class="nav-item position-relative">
                <a class="nav-link sidebar-link-custom dropdown-toggle" href="#" id="invoicesDropdown" role="button" onclick="toggleDropdown(event)" aria-expanded="false">
                    الفواتير
                </a>
                <div class=" rounded-2 mt-2 text-center" id="invoicesDropdownMenu" style="display: none; width: 12rem !important;">

                    <a class="dropdown-item-custom" href="{{url('/invoice')}}">إضافة فاتورة</a>
<<<<<<< Updated upstream
                    <a class="dropdown-item-custom" href="#">عرض الفواتير</a>
=======
{{--                    <a class="dropdown-item-custom" href="#">قائمة الفواتير</a>--}}
                    <a class="dropdown-item-custom" href="{{url('/invoices')}}">قائمة الفواتير</a>
>>>>>>> Stashed changes
                </div>

            </li>
            <li class="nav-item position-relative">
                <a class="nav-link sidebar-link-custom dropdown-toggle" href="#" id="empDropdown" role="button" onclick="empDropdown(event)" aria-expanded="false">
                    الموظفين
                </a>
                <div class=" rounded-2 mt-2 text-center" id="empDropdownMenu" style="display: none; width: 12rem !important;">

                    <a class="dropdown-item-custom" href="#">إضافة موظف</a>
                    <a class="dropdown-item-custom" href="#">عرض الموظفين</a>
                </div>

            </li>



            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="#">المبيعات</a>
            </li>
            <li class="nav-item">
<<<<<<< Updated upstream
                <a class="nav-link sidebar-link-custom" href="#">المخزون</a>
            </li>
            <li class="nav-item position-relative">
                <a class="nav-link sidebar-link-custom dropdown-toggle" href="#" id="reportDropdown" role="button" onclick="reportDropdown(event)" aria-expanded="false">
                    التقارير
                </a>
                <div class=" rounded-2 mt-2 text-center" id="reportDropdownMenu" style="display: none; width: 12rem !important;">
                    <a class="dropdown-item-custom" href="#">إنشاء تقرير</a>
                    <a class="dropdown-item-custom" href="#">عرض التقارير</a>
                </div>

            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="#">الموردون</a>
=======
                <a class="nav-link sidebar-link-custom" href="{{url('/employees')}}">الموظفين</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="{{url('/products')}}">المنتجات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="{{url('/suppliers')}}">الموردين</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="{{url('/purchases')}}">المشتريات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="{{url('/sales')}}">المبيعات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="{{url('/employee-salaries')}}">رواتب الموظفين</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="{{url('/inventory-logs')}}">المخزون</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="{{url('/employee-advance-payments')}}">السلف</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link-custom" href="{{url('/payments')}}">الدفعات</a>
>>>>>>> Stashed changes
            </li>

        </ul>
    </nav>
</aside>


