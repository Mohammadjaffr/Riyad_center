@extends('layouts.head')
<body style="background: #f6f7fa" dir="rtl">
<div class="container main-content">
    <!-- Logo and description -->
    <div class="logo-search">
        <img src="{{asset('assets/images/logo.png')}}" alt="Logo">
        <div class="desc">
            HELMY AL-HAIDARI FOR GENERAL TRADE<br>
            لبيع جميع الأنشطة التجارية - خياطة و تفصيل الأزياء الرسمية
        </div>
    </div>
    <!-- Filter and Search Row -->
    <div class="row align-items-center mb-4 g-2">
        <div class="col-md-3 col-12">
            <div class="position-relative">
                <input type="text" class="search-bar w-100" placeholder="بحث" style="text-align: right; padding-right: 2.2rem;">
                <span style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1A3E5D" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.442 1.398a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/>
                    </svg>
                </span>
            </div>
        </div>
        <div class="col-md-7 col-12"></div>
{{--        <div class="col-md-2 col-12">--}}
{{--            <button class="btn btn-filter w-100">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1A3E5D"--}}
{{--                     class="bi bi-funnel" viewBox="0 0 16 16">--}}
{{--                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .39.812l-4.607 5.758A1.5 1.5 0 0 0 9 9.243V13.5a.5.5 0 0 1-.724.447l-2-1A.5.5 0 0 1 6 12.5V9.243a1.5 1.5 0 0 0-.783-1.673L.61 1.812A.5.5 0 0 1 1.5 1.5z"/>--}}
{{--                </svg> فلتر</button>--}}
{{--        </div>--}}


    </div>
    <!-- Table -->
    <div class="table-responsive">
        <table class="table search-table align-middle text-center text-end">
            <thead>
            <tr>
                <th class="text-end">اسم المنتج</th>
                <th class="text-end">السعر</th>
                <th class="text-end">المخزون</th>
                <th class="text-end">النوع</th>
                <th class="text-end"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-end">تيشيرت أخضر</td>
                <td class="text-end">$950.00</td>
                <td class="text-end"><span class="stock-green">25 قطعة</span></td>
                <td class="text-end">رجالي</td>
                <td class="text-end"><button class="btn btn-primary">اضف الى الفاتورة</button></td>
            </tr>
            <tr>
                <td class="text-end">تيشيرت أخضر</td>
                <td class="text-end">$900.00</td>
                <td class="text-end"><span class="stock-green">20 قطعة</span></td>
                <td class="text-end">نسائي</td>
                <td class="text-end"><button class="btn btn-primary">اضف الى الفاتورة</button></td>
            </tr>
            <tr>
                <td class="text-end">تيشيرت أحمر</td>
                <td class="text-end">$900.00</td>
                <td class="text-end"><span class="stock-red">-33 قطعة</span></td>
                <td class="text-end">رجالي</td>
                <td class="text-end"><button class="btn btn-primary">اضف الى الفاتورة</button></td>
            </tr>
            <tr>
                <td class="text-end">تيشيرت أبيض</td>
                <td class="text-end">$900.00</td>
                <td class="text-end"><span class="stock-green">25 قطعة</span></td>
                <td class="text-end">رجالي</td>
                <td class="text-end"><button class="btn btn-primary">اضف الى الفاتورة</button></td>
            </tr>
            <tr>
                <td class="text-end">تيشيرت أزرق</td>
                <td class="text-end">$900.00</td>
                <td class="text-end"><span class="stock-green">25 قطعة</span></td>
                <td class="text-end">رجالي</td>
                <td class="text-end"><button class="btn btn-primary">اضف الى الفاتورة</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
