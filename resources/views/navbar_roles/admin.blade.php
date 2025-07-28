{{--<ul class="navbar-nav gap-4">--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{url('/home')}}">الرئيسية</a>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="#">الأحذية</a>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="#">الملابس</a>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{url('/invoice')}}">إضافة فاتورة</a>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="#">قائمة الفواتير</a>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="#">المنتجات</a>--}}
{{--    </li>--}}
{{--</ul> --}}
{{--       --}}
        <li class="nav-item w-100">
            <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/dashboard/admin') }}">الرئيسية</a>
        </li>
<li class="nav-item w-100">
    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href=" ">الملف الشخصي</a>
</li>

        {{-- الأقسام Dropdown --}}
{{--        <li class="nav-item position-relative w-100">--}}
{{--            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="deptDropdown" role="button" onclick="deptDropdown(event)" aria-expanded="false">--}}
{{--                الأقسام--}}
{{--            </a>--}}
{{--            <div class="rounded-2 mt-2" id="deptDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">--}}
{{--                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('stock-adjustments.create') }}">إضافة جرد</a>--}}
{{--                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('stock-adjustments.index') }}">الجرد</a>--}}
{{--                --}}{{--                        <a class="dropdown-item-custom" href="{{ route('departments.index') }}">إضافة قسم</a>--}}
{{--            </div>--}}
{{--        </li>--}}
        {{-- الصلاحيات Dropdown --}}

        <li class="nav-item position-relative w-100">
            <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('admin.roles_permissions.index')}}">الصلاحيات</a>

{{--            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="roleDropdown" role="button" onclick="roleDropdown(event)" aria-expanded="false">--}}
{{--                الصلاحيات--}}
{{--            </a>--}}
{{--            <div class="rounded-2 mt-2" id="roleDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">--}}
{{--                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('admin.roles_permissions.index') }}">قائمة الصلاحيات</a>--}}
{{--                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('admin.permissions.store') }}">إضافة صلاحية</a>--}}

{{--            </div>--}}
        </li>
        {{--                <a class="nav-link sidebar-link-custom" href="{{ route('admin.roles_permissions.index') }}">قائمة الصلاحيات</a>--}}
        {{-- المنتجات Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="productsDropdown" role="button" onclick="productsDropdown(event)" aria-expanded="false">
                المنتجات
            </a>
            <div class="rounded-2 mt-2" id="productsDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('products.create') }}">إضافة منتج </a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('products.index') }}">عرض المنتجات</a>
            </div>
        </li>

        {{-- الفواتير Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="invoicesDropdown" role="button" onclick="toggleDropdown(event)" aria-expanded="false">
                الفواتير
            </a>
            <div class="rounded-2 mt-2" id="invoicesDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('invoices.create') }}">إضافة فاتورة</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/invoices') }}">قائمة الفواتير</a>
            </div>
        </li>

        {{-- الموظفين Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="empDropdown" role="button" onclick="empDropdown(event)" aria-expanded="false">
                الموظفين
            </a>
            <div class="rounded-2 mt-2" id="empDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('employees.create') }}">إضافة موظف</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('employees.index') }}">عرض الموظفين</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/employee-salaries') }}">رواتب الموظفين</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/employee-advance-payments') }}">السلف</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/payments') }}">الدفعات</a>
            </div>
        </li>

        {{-- إدارة المشتريات Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="purchasesDropdown" role="button" onclick="purchasesDropdown(event)" aria-expanded="false">
                إدارة المشتريات
            </a>
            <div class="rounded-2 mt-2" id="purchasesDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/suppliers') }}">الموردين </a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/purchases') }}">المشتريات </a>
            </div>
        </li>

        <li class="nav-item w-100">
            <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/sales') }}">المبيعات</a>
        </li>

        {{-- الراجع Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="returnDropdown" role="button" onclick="returnDropdown(event)" aria-expanded="false">
                الراجع
            </a>
            <div class="rounded-2 mt-2" id="returnDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('sales-returns.create') }}">إضافة راجع البيع</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('sales-returns.index') }}">عرض راجع البيع</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('purchase-returns.create') }}">إضافة راجع الشراء</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('purchase-returns.index') }}">عرض راجع الشراء</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('inventory-reports.index') }}">عرض التقارير</a>
            </div>
        </li>

        {{-- المخزون Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="reportDropdown" role="button" onclick="reportDropdown(event)" aria-expanded="false">
                المخزون
            </a>
            <div class="rounded-2 mt-2" id="reportDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/inventory-logs') }}">سجل المخزون</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('inventory-logs.report', ['type' => 'current']) }}">الجرد الحالي</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('inventory-logs.report', ['type' => 'monthly']) }}">الجرد الشهري</a>
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('inventory-logs.report', ['type' => 'yearly']) }}">الجرد السنوي</a>
            </div>
        </li>
<li class="nav-item w-100">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
                class="nav-link text-white fw-bold d-lg-none d-md-flex">
            تسجيل خروج
        </button>
    </form>
</li>

{{--<li class="nav-item position-relative w-100">--}}
{{--    <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="toggleAccountDropdown" role="button" onclick="toggleAccountDropdown(event)" aria-expanded="false">--}}
{{--        حسابي--}}
{{--    </a>--}}
{{--    <div class="rounded-2 mt-2" id="toggleAccountDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">--}}
{{--        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="">الملف الشخصي</a>--}}
{{--        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="">الاعدادات</a>--}}
{{--        <form action="{{ route('logout') }}" method="POST">--}}
{{--            @csrf--}}
{{--            <button type="submit"--}}
{{--                    class="nav-link text-white fw-bold d-lg-none d-md-flex">--}}
{{--                تسجيل خروج--}}
{{--            </button>--}}
{{--        </form>--}}

{{--    </div>--}}
{{--</li>--}}
