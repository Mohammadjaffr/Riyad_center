        <li class="nav-item w-100">
            <a class="nav-link sidebar-link-custom" href="{{ route('dashboard.shoes') }}">لوحة الأحذية</a>
        </li>

        @can('عرض المنتجات')
            <li class="nav-item position-relative w-100">
                <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="productsSideDropdown" role="button" onclick="productsSideDropdown(event)" aria-expanded="false">
                    المنتجات
                </a>
                <div class="rounded-2 mt-2" id="productsSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                    <a class="dropdown-item-custom" href="{{ route('products.index') }}">عرض المنتجات</a>
                </div>
            </li>
        @endcan

        @can('عرض المشتريات')
            <li class="nav-item position-relative w-100">
                <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="purchasesSideDropdown" role="button" onclick="purchasesSideDropdown(event)" aria-expanded="false">
                    إدارة المشتريات
                </a>
                <div class="rounded-2 mt-2" id="purchasesSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
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
            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="returnSideDropdown" role="button" onclick="returnSideDropdown(event)" aria-expanded="false">
                الراجع
            </a>
            <div class="rounded-2 mt-2" id="returnSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
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
                <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="stockSideDropdown" role="button" onclick="stockSideDropdown(event)" aria-expanded="false">
                    المخزون
                </a>
                <div class="rounded-2 mt-2" id="stockSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
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
            <a href="#" class="nav-link sidebar-link-custom dropdown-toggle" id="invoicesSideDropdown" role="button" onclick="invoicesSideDropdown(event)" aria-expanded="false">
                الفواتير
            </a>
            <div class="rounded-2 mt-2" id="invoicesSideDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                @can('إضافة فاتورة')
                    <a class="dropdown-item-custom" href="{{ route('invoices.create') }}">إضافة فاتورة</a>
                @endcan
                @can('عرض الفواتير')
                    <a class="dropdown-item-custom" href="{{ route('invoices.index') }}">قائمة الفواتير</a>
                @endcan
            </div>
        </li>
