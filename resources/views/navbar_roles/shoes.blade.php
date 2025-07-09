        <li class="nav-item w-100">
            <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('dashboard.shoes') }}">لوحة الأحذية</a>
        </li>

        @can('عرض المنتجات')
            <li class="nav-item position-relative w-100">
                <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="productsDropdown" role="button" onclick="productsDropdown(event)" aria-expanded="false">
                    المنتجات
                </a>
                <div class="rounded-2 mt-2" id="productsDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('products.index') }}">عرض المنتجات</a>
                </div>
            </li>
        @endcan

        @can('عرض المشتريات')
            <li class="nav-item position-relative w-100">
                <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="purchasesDropdown" role="button" onclick="purchasesDropdown(event)" aria-expanded="false">
                    إدارة المشتريات
                </a>
                <div class="rounded-2 mt-2" id="purchasesDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/purchases') }}">المشتريات</a>
                </div>
            </li>
        @endcan

        @can('عرض المبيعات')
            <li class="nav-item w-100">
                <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/sales') }}">المبيعات</a>
            </li>
        @endcan

        {{-- الراجع Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="returnDropdown" role="button" onclick="returnDropdown(event)" aria-expanded="false">
                الراجع
            </a>
            <div class="rounded-2 mt-2" id="returnDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                @can('إضافة مرتجع البيع')
                    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('sales-returns.create') }}">إضافة راجع البيع</a>
                @endcan
                @can('عرض مرتجع البيع')
                    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('sales-returns.index') }}">عرض راجع البيع</a>
                @endcan
                @can('إضافة مرتجع الشراء')
                    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('purchase-returns.create') }}">إضافة راجع الشراء</a>
                @endcan
                @can('عرض مرتجع الشراء')
                    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('purchase-returns.index') }}">عرض راجع الشراء</a>
                @endcan
                @can('عرض تقارير المخزون')
                    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('inventory-reports.index') }}">عرض التقارير</a>
                @endcan
            </div>
        </li>

        {{-- المخزون Dropdown --}}
        @can('المخزون')
            <li class="nav-item position-relative w-100">
                <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="reportDropdown" role="button" onclick="reportDropdown(event)" aria-expanded="false">
                    المخزون
                </a>
                <div class="rounded-2 mt-2" id="reportDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                    @can('عرض سجل المخزون')
                        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ url('/inventory-logs') }}">سجل المخزون</a>
                    @endcan
                    @can('عرض الجرد الحالي')
                        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('inventory-logs.report', ['type' => 'current']) }}">الجرد الحالي</a>
                    @endcan
                    @can('عرض الجرد الشهري')
                        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('inventory-logs.report', ['type' => 'monthly']) }}">الجرد الشهري</a>
                    @endcan
                    @can('عرض الجرد السنوي')
                        <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('inventory-logs.report', ['type' => 'yearly']) }}">الجرد السنوي</a>
                    @endcan
                </div>
            </li>
        @endcan
        {{-- الفواتير Dropdown --}}
        <li class="nav-item position-relative w-100">
            <a href="#" class="nav-link text-white fw-bold d-lg-none d-md-flex dropdown-toggle" id="invoicesDropdown" role="button" onclick="toggleDropdown(event)" aria-expanded="false">
                الفواتير
            </a>
            <div class="rounded-2 mt-2" id="invoicesDropdownMenu" style="display: none; width: 12rem !important; text-align: right;">
                @can('إضافة فاتورة')
                    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('invoices.create') }}">إضافة فاتورة</a>
                @endcan
                @can('عرض الفواتير')
                    <a class="nav-link text-white fw-bold d-lg-none d-md-flex" href="{{ route('invoices.index') }}">قائمة الفواتير</a>
                @endcan
            </div>
        </li>
