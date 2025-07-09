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
