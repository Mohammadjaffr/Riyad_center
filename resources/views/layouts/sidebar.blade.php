@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.head')


<aside class="sidebar-custom d-none d-lg-flex flex-column align-items-center py-4 px-2">

    <div class="logo-container mb-2 text-center">
        <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo" class="img-fluid" style="max-width: 90px;">
        <div class="sidebar-desc text-center mt-2">
            <span class="d-block text-white-50 small" style="font-size: 10px;">
                HELMY AL-HAIDARI FOR GENERAL TRADE<br>
                لبيع جميع الأنشطة التجارية - خياطة و تفصيل الأزياء الرسمية
            </span>
        </div>
    </div>

    @php
        $employee = Auth::guard('employee')->user();
    @endphp

    {{-- إذا كان أدمن يعرض كل شيء --}}
    @if($employee && $employee->department_id == 1))

        <nav class="w-100">
            <ul class="nav flex-column gap-3 w-100 px-2">

                <li class="nav-item w-100">
                    <a class="nav-link sidebar-link-custom" href="{{ url('/home') }}">الرئيسية</a>
                </li>


                {{-- الأقسام Dropdown --}}
                <li class="nav-item position-relative w-100">
                    <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="deptDropdown" role="button" onclick="deptDropdown(event)" aria-expanded="false">
                        الأقسام
                    </a>
                    <div class="rounded-2 mt-2" id="deptDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                        <a class="dropdown-item-custom" href="{{ route('stock-adjustments.create') }}">إضافة جرد</a>
                        <a class="dropdown-item-custom" href="{{ route('stock-adjustments.index') }}">الجرد</a>
                        <a class="dropdown-item-custom" href="{{ route('departments.index') }}">إضافة قسم</a>
                    </div>
                </li>
                <li class="nav-item position-relative w-100">
                    <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="roleDropdown" role="button" onclick="roleDropdown(event)" aria-expanded="false">
                        الصلاحيات
                    </a>
                    <div class="rounded-2 mt-2" id="roleDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                        <a class="nav-link sidebar-link-custom" href="{{ route('admin.roles_permissions.index') }}">قائمة الصلاحيات</a>
                        <a class="dropdown-item-custom" href="{{ route('admin.permissions.store') }}">إضافة صلاحية</a>

                    </div>
                </li>
                <a class="nav-link sidebar-link-custom" href="{{ route('admin.roles_permissions.index') }}">قائمة الصلاحيات</a>
                {{-- المنتجات Dropdown --}}
                <li class="nav-item position-relative w-100">
                    <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="productsDropdown" role="button" onclick="productsDropdown(event)" aria-expanded="false">
                        المنتجات
                    </a>
                    <div class="rounded-2 mt-2" id="productsDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                        <a class="dropdown-item-custom" href="{{ route('products.create') }}">إضافة منتج </a>
                        <a class="dropdown-item-custom" href="{{ route('products.index') }}">عرض المنتجات</a>
                    </div>
                </li>

                {{-- الفواتير Dropdown --}}
                <li class="nav-item position-relative w-100">
                    <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="invoicesDropdown" role="button" onclick="toggleDropdown(event)" aria-expanded="false">
                        الفواتير
                    </a>
                    <div class="rounded-2 mt-2" id="invoicesDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                        <a class="dropdown-item-custom" href="{{ route('invoices.create') }}">إضافة فاتورة</a>
                        <a class="dropdown-item-custom" href="{{ url('/invoices') }}">قائمة الفواتير</a>
                    </div>
                </li>

                {{-- الموظفين Dropdown --}}
                <li class="nav-item position-relative w-100">
                    <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="empDropdown" role="button" onclick="empDropdown(event)" aria-expanded="false">
                        الموظفين
                    </a>
                    <div class="rounded-2 mt-2" id="empDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                        <a class="dropdown-item-custom" href="{{ route('employees.create') }}">إضافة موظف</a>
                        <a class="dropdown-item-custom" href="{{ route('employees.index') }}">عرض الموظفين</a>
                        <a class="dropdown-item-custom" href="{{ url('/employee-salaries') }}">رواتب الموظفين</a>
                        <a class="dropdown-item-custom" href="{{ url('/employee-advance-payments') }}">السلف</a>
                        <a class="dropdown-item-custom" href="{{ url('/payments') }}">الدفعات</a>
                    </div>
                </li>

                {{-- إدارة المشتريات Dropdown --}}
                <li class="nav-item position-relative w-100">
                    <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="purchasesDropdown" role="button" onclick="purchasesDropdown(event)" aria-expanded="false">
                        إدارة المشتريات
                    </a>
                    <div class="rounded-2 mt-2" id="purchasesDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                        <a class="dropdown-item-custom" href="{{ url('/suppliers') }}">الموردين </a>
                        <a class="dropdown-item-custom" href="{{ url('/purchases') }}">المشتريات </a>
                    </div>
                </li>

                <li class="nav-item w-100">
                    <a class="nav-link sidebar-link-custom" href="{{ url('/sales') }}">المبيعات</a>
                </li>

                {{-- الراجع Dropdown --}}
                <li class="nav-item position-relative w-100">
                    <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="returnDropdown" role="button" onclick="returnDropdown(event)" aria-expanded="false">
                        الراجع
                    </a>
                    <div class="rounded-2 mt-2" id="returnDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                        <a class="dropdown-item-custom" href="{{ route('sales-returns.create') }}">إضافة راجع البيع</a>
                        <a class="dropdown-item-custom" href="{{ route('sales-returns.index') }}">عرض راجع البيع</a>
                        <a class="dropdown-item-custom" href="{{ route('purchase-returns.create') }}">إضافة راجع الشراء</a>
                        <a class="dropdown-item-custom" href="{{ route('purchase-returns.index') }}">عرض راجع الشراء</a>
                        <a class="dropdown-item-custom" href="{{ route('inventory-reports.index') }}">عرض التقارير</a>
                    </div>
                </li>

                {{-- المخزون Dropdown --}}
                <li class="nav-item position-relative w-100">
                    <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="reportDropdown" role="button" onclick="reportDropdown(event)" aria-expanded="false">
                        المخزون
                    </a>
                    <div class="rounded-2 mt-2" id="reportDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                        <a class="dropdown-item-custom" href="{{ url('/inventory-logs') }}">سجل المخزون</a>
                        <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'current']) }}">الجرد الحالي</a>
                        <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'monthly']) }}">الجرد الشهري</a>
                        <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'yearly']) }}">الجرد السنوي</a>
                    </div>
                </li>
            </ul>
        </nav>

    @else

        @if($employee && $employee->department_id == 2)
            <li class="nav-item w-100">
                <a class="nav-link sidebar-link-custom" href="{{ route('dashboard.clothes') }}">لوحة ملابس</a>
            </li>
            <li class="nav-item position-relative w-100">
                    @can('عرض المنتجات')
                        <a class="nav-link sidebar-link-custom" href="{{ route('products.index') }}">المنتجات</a>
                    @endcan
            </li>

            <li class="nav-item position-relative w-100">
                @can('عرض المشتريات')
                    <a class="nav-link sidebar-link-custom" href="{{ route('purchases.index') }}">المشتريات</a>
                @endcan
            </li>


            @can('عرض المبيعات')
                <li class="nav-item w-100">
                    <a class="nav-link sidebar-link-custom" href="{{ url('/sales') }}">المبيعات</a>
                </li>
            @endcan

            {{-- الراجع Dropdown --}}
            <li class="nav-item position-relative w-100">
                <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="returnDropdown" role="button" onclick="returnDropdown(event)" aria-expanded="false">
                    الراجع
                </a>
                <div class="rounded-2 mt-2" id="returnDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                    @can('إضافة مرتجع البيع')
                    <a class="dropdown-item-custom" href="{{ route('sales-returns.create') }}">إضافة راجع البيع</a>
                    @endcan
                    @can('عرض مرتجع البيع')
                    <a class="dropdown-item-custom" href="{{ route('sales-returns.index') }}">عرض راجع البيع</a>
                        @endcan
                        @can('عرض تقارير المخزون')
                    <a class="dropdown-item-custom" href="{{ route('inventory-reports.index') }}">عرض التقارير</a>
                        @endcan
                </div>
            </li>

            {{-- المخزون Dropdown --}}
            @can('المخزون')
            <li class="nav-item position-relative w-100">
                <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="reportDropdown" role="button" onclick="reportDropdown(event)" aria-expanded="false">
                    المخزون
                </a>
                <div class="rounded-2 mt-2" id="reportDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">

                    @can('عرض سجل المخزون')
                        <a class="dropdown-item-custom" href="{{ url('/inventory-logs') }}">سجل المخزون</a>
                    @endcan

                    @can('عرض الجرد الحالي')
                        <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'current']) }}">الجرد الحالي</a>
                    @endcan

                    @can('عرض الجرد الشهري')
                        <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'monthly']) }}">الجرد الشهري</a>
                    @endcan

                    @can('عرض الجرد السنوي')
                        <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'yearly']) }}">الجرد السنوي</a>
                    @endcan

                </div>
            </li>
            @endcan
            <li class="nav-item position-relative w-100">
                <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="invoicesDropdown" role="button" onclick="toggleDropdown(event)" aria-expanded="false">
                    الفواتير
                </a>
                <div class="rounded-2 mt-2" id="invoicesDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">

                    @can('إضافة فاتورة')
                        <a class="dropdown-item-custom" href="{{ route('invoices.create') }}">إضافة فاتورة</a>
                    @endcan

                    @can('عرض قائمة الفواتير')
                        <a class="dropdown-item-custom" href="{{ url('/invoices') }}">قائمة الفواتير</a>
                    @endcan

                </div>
            </li>

        @endif


        @if($employee && $employee->department_id == 3)
                <li class="nav-item w-100">
                    <a class="nav-link sidebar-link-custom" href="{{ route('dashboard.shoes') }}">لوحة الأحذية</a>
                </li>

                @can('عرض المنتجات')
                    <li class="nav-item position-relative w-100">
                        <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="productsDropdown" role="button" onclick="productsDropdown(event)" aria-expanded="false">
                            المنتجات
                        </a>
                        <div class="rounded-2 mt-2" id="productsDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                            <a class="dropdown-item-custom" href="{{ route('products.index') }}">عرض المنتجات</a>
                        </div>
                    </li>
                @endcan

                @can('عرض المشتريات')
                    <li class="nav-item position-relative w-100">
                        <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="purchasesDropdown" role="button" onclick="purchasesDropdown(event)" aria-expanded="false">
                            إدارة المشتريات
                        </a>
                        <div class="rounded-2 mt-2" id="purchasesDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                            <a class="dropdown-item-custom" href="{{ url('/purchases') }}">المشتريات</a>
                        </div>
                    </li>
                @endcan

                @can('عرض المبيعات')
                    <li class="nav-item w-100">
                        <a class="nav-link sidebar-link-custom" href="{{ url('/sales') }}">المبيعات</a>
                    </li>
                @endcan

                {{-- الراجع Dropdown --}}
                    <li class="nav-item position-relative w-100">
                        <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="returnDropdown" role="button" onclick="returnDropdown(event)" aria-expanded="false">
                            الراجع
                        </a>
                        <div class="rounded-2 mt-2" id="returnDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                            @can('إضافة مرتجع البيع')
                                <a class="dropdown-item-custom" href="{{ route('sales-returns.create') }}">إضافة راجع البيع</a>
                            @endcan
                            @can('عرض مرتجع البيع')
                                <a class="dropdown-item-custom" href="{{ route('sales-returns.index') }}">عرض راجع البيع</a>
                            @endcan
                            @can('إضافة مرتجع الشراء')
                                <a class="dropdown-item-custom" href="{{ route('purchase-returns.create') }}">إضافة راجع الشراء</a>
                            @endcan
                            @can('عرض مرتجع الشراء')
                                <a class="dropdown-item-custom" href="{{ route('purchase-returns.index') }}">عرض راجع الشراء</a>
                            @endcan
                            @can('عرض تقارير المخزون')
                                <a class="dropdown-item-custom" href="{{ route('inventory-reports.index') }}">عرض التقارير</a>
                            @endcan
                        </div>
                    </li>

                {{-- المخزون Dropdown --}}
                @can('المخزون')
                    <li class="nav-item position-relative w-100">
                        <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="reportDropdown" role="button" onclick="reportDropdown(event)" aria-expanded="false">
                            المخزون
                        </a>
                        <div class="rounded-2 mt-2" id="reportDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                            @can('عرض سجل المخزون')
                                <a class="dropdown-item-custom" href="{{ url('/inventory-logs') }}">سجل المخزون</a>
                            @endcan
                            @can('عرض الجرد الحالي')
                                <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'current']) }}">الجرد الحالي</a>
                            @endcan
                            @can('عرض الجرد الشهري')
                                <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'monthly']) }}">الجرد الشهري</a>
                            @endcan
                            @can('عرض الجرد السنوي')
                                <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'yearly']) }}">الجرد السنوي</a>
                            @endcan
                        </div>
                    </li>
                @endcan
                {{-- الفواتير Dropdown --}}
                    <li class="nav-item position-relative w-100">
                        <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="invoicesDropdown" role="button" onclick="toggleDropdown(event)" aria-expanded="false">
                            الفواتير
                        </a>
                        <div class="rounded-2 mt-2" id="invoicesDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                            @can('إضافة فاتورة')
                                <a class="dropdown-item-custom" href="{{ route('invoices.create') }}">إضافة فاتورة</a>
                            @endcan
                            @can('عرض الفواتير')
                                <a class="dropdown-item-custom" href="{{ route('invoices.index') }}">قائمة الفواتير</a>
                            @endcan
                        </div>
                    </li>


            @endif


    @endif



</aside>

<script>
    function roleDropdown(e) {
        e.preventDefault();
        let menu = document.getElementById('deptDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
    function deptDropdown(e) {
        e.preventDefault();
        let menu = document.getElementById('deptDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
    function productsDropdown(e) {
        e.preventDefault();
        let menu = document.getElementById('productsDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
    function toggleDropdown(e) {
        e.preventDefault();
        let menu = document.getElementById('invoicesDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
    function empDropdown(e) {
        e.preventDefault();
        let menu = document.getElementById('empDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
    function purchasesDropdown(e) {
        e.preventDefault();
        let menu = document.getElementById('purchasesDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
    function returnDropdown(e) {
        e.preventDefault();
        let menu = document.getElementById('returnDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
    function reportDropdown(e) {
        e.preventDefault();
        let menu = document.getElementById('reportDropdownMenu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }

    document.addEventListener('click', function(e) {
        if(!e.target.classList.contains('dropdown-toggle')){
            document.querySelectorAll('[id$="Menu"]').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });

    // لتفعيل active عند الضغط (اختياري)
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.sidebar-link-custom, .dropdown-item-custom').forEach(function(link){
            link.addEventListener('click', function(){
                document.querySelectorAll('.sidebar-link-custom, .dropdown-item-custom').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>


