        <li class="nav-item w-100">
            <a class="nav-link sidebar-link-custom" href="{{ url('/dashboard/admin') }}">الرئيسية</a>
        </li>


        {{-- الأقسام Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="deptSideDropdown" role="button" onclick="deptSideDropdown(event)" aria-expanded="false">
                الأقسام
            </a>
            <div class="rounded-2 mt-2" id="deptSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="dropdown-item-custom" href="{{ route('stock-adjustments.create') }}">إضافة جرد</a>
                <a class="dropdown-item-custom" href="{{ route('stock-adjustments.index') }}">الجرد</a>
                {{--                        <a class="dropdown-item-custom" href="{{ route('departments.index') }}">إضافة قسم</a>--}}
            </div>
        </li>
        {{-- الصلاحيات Dropdown --}}

        <li class="nav-item position-relative w-100">
            <a class="nav-link sidebar-link-custom" href="{{ route('admin.roles_permissions.index') }}">الصلاحيات</a>

            {{--            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="roleSideDropdown" role="button" onclick="roleSideDropdown(event)" aria-expanded="false">--}}
{{--                الصلاحيات--}}
{{--            </a>--}}
{{--            <div class="rounded-2 mt-2" id="roleSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">--}}
{{--                <a class="nav-link sidebar-link-custom" href="{{ route('admin.roles_permissions.index') }}">قائمة الصلاحيات</a>--}}
{{--                <a class="dropdown-item-custom" href="{{ route('admin.permissions.store') }}">إضافة صلاحية</a>--}}

{{--            </div>--}}
        </li>
        {{--                <a class="nav-link sidebar-link-custom" href="{{ route('admin.roles_permissions.index') }}">قائمة الصلاحيات</a>--}}
        {{-- المنتجات Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="productsSideDropdown" role="button" onclick="productsSideDropdown(event)" aria-expanded="false">
                المنتجات
            </a>
            <div class="rounded-2 mt-2" id="productsSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="dropdown-item-custom" href="{{ route('products.create') }}">إضافة منتج </a>
                <a class="dropdown-item-custom" href="{{ route('products.index') }}">عرض المنتجات</a>
            </div>
        </li>

        {{-- الفواتير Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="invoicesSideDropdown" role="button" onclick="invoicesSideDropdown(event)" aria-expanded="false">
                الفواتير
            </a>
            <div class="rounded-2 mt-2" id="invoicesSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="dropdown-item-custom" href="{{ route('invoices.create') }}">إضافة فاتورة</a>
                <a class="dropdown-item-custom" href="{{ url('/invoices') }}">قائمة الفواتير</a>
            </div>
        </li>

        {{-- الموظفين Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="empSideDropdown" role="button" onclick="empSideDropdown(event)" aria-expanded="false">
                الموظفين
            </a>
            <div class="rounded-2 mt-2" id="empSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="dropdown-item-custom" href="{{ route('employees.create') }}">إضافة موظف</a>
                <a class="dropdown-item-custom" href="{{ route('employees.index') }}">عرض الموظفين</a>
                <a class="dropdown-item-custom" href="{{ url('/employee-salaries') }}">رواتب الموظفين</a>
                <a class="dropdown-item-custom" href="{{ url('/employee-advance-payments') }}">السلف</a>
                <a class="dropdown-item-custom" href="{{ url('/payments') }}">الدفعات</a>
            </div>
        </li>

        {{-- إدارة المشتريات Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="purchasesSideDropdown" role="button" onclick="purchasesSideDropdown(event)" aria-expanded="false">
                إدارة المشتريات
            </a>
            <div class="rounded-2 mt-2" id="purchasesSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="dropdown-item-custom" href="{{ url('/suppliers') }}">الموردين </a>
                <a class="dropdown-item-custom" href="{{ url('/purchases') }}">المشتريات </a>
            </div>
        </li>

        <li class="nav-item w-100">
            <a class="nav-link sidebar-link-custom" href="{{ url('/sales') }}">المبيعات</a>
        </li>

        {{-- الراجع Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="returnSideDropdown" role="button" onclick="returnSideDropdown(event)" aria-expanded="false">
                الراجع
            </a>
            <div class="rounded-2 mt-2" id="returnSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="dropdown-item-custom" href="{{ route('sales-returns.create') }}">إضافة راجع البيع</a>
                <a class="dropdown-item-custom" href="{{ route('sales-returns.index') }}">عرض راجع البيع</a>
                <a class="dropdown-item-custom" href="{{ route('purchase-returns.create') }}">إضافة راجع الشراء</a>
                <a class="dropdown-item-custom" href="{{ route('purchase-returns.index') }}">عرض راجع الشراء</a>
            </div>
        </li>

        {{-- المخزون Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="stockSideDropdown" role="button" onclick="stockSideDropdown(event)" aria-expanded="false">
                المخزون
            </a>
            <div class="rounded-2 mt-2" id="stockSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                <a class="dropdown-item-custom" href="{{ url('/inventory-logs') }}">سجل المخزون</a>
                <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'current']) }}">الجرد الحالي</a>
                <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'monthly']) }}">الجرد الشهري</a>
                <a class="dropdown-item-custom" href="{{ route('inventory-logs.report', ['type' => 'yearly']) }}">الجرد السنوي</a>
                <a class="dropdown-item-custom" href="{{ route('inventory-reports.index') }}">عرض التقارير</a>

            </div>
        </li>

