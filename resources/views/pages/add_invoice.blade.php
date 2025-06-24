@extends('layouts.master')
@section('title' ,'إضافة فاتورة')
@section('content')
    <body style="background: #f6f7fa">
    <div class="invoice-container px-2 px-md-4">
        <!-- Header -->
        <div class="invoice-header px-2 rounded-4 mb-3">
            <h4>إضافة فاتورة جديدة</h4>
            <button class="btn btn-new-invoice mb-2 mb-md-0"><span> فاتورة جديدة </span></button>
        </div>
        <!-- Invoice Info -->
        <div class="invoice-info-box rounded-4 p-3 mb-4">
            <div class="row align-items-center text-center">
                <!-- Right Info -->
                <div class="col-12 col-md-4 text-end mb-3 mb-md-0">
                    <div class="fw-bold">اسم الموظف: <span class="fw-normal">محمد</span></div>
                    <br class="d-none d-md-block"><br class="d-none d-md-block"><br class="d-none d-md-block">
                    <div class="fw-bold">اسم العميل: <span class="fw-normal">محمد</span></div>
                </div>
                <!-- Logo Center -->
                <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
                    <img src="{{asset('assets/images/logo.png')}}" alt="Logo" style="max-width: 70px;">
                    <br class="d-none d-md-block"><br class="d-none d-md-block">
                    <div class="fw-bold">رقم الفاتورة: <span class="fw-normal">171829</span></div>
                </div>
                <!-- Left Info -->
                <div class="col-12 col-md-4 text-end">
                    <div class="fw-bold">القسم: <span class="fw-normal">الملابس</span></div>
                    <br class="d-none d-md-block"><br class="d-none d-md-block">
                    <div class="fw-bold">التاريخ: <span class="fw-normal">16/6/2025</span></div>
                </div>
            </div>
        </div>
        <!-- Table -->
        <div class="table-responsive mb-3">
            <table class="table table-borderless align-middle text-center custom-invoice-table mb-0">
                <thead>
                <tr>
                    <th>النوع</th>
                    <th>رقم الموديل</th>
                    <th>الصنف</th>
                    <th>الكمية</th>
                    <th>سعر الوحدة</th>
                    <th>السعر الكلي</th>
                    <th>الخصم</th>
                    <th>المجموع</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <select class="table-input">
                            <option>تيشيرت</option>
                            <option>بنطال</option>
                            <option>قميص</option>
                        </select>
                    </td>
                    <td><input type="text" class=" table-input" value="1111"></td>
                    <td><input type="text" class=" table-input" value="رجالي"></td>
                    <td>
                        <input type="number" class="table-input" value="1" min="1" style="width:70px;">
                    </td>
                    <td><input type="text" class="table-input"></td>
                    <td><input type="text" class="table-input"></td>
                    <td><input type="text" class="table-input"></td>
                    <td><input type="text" class="table-input"></td>
                    <td>
                        <button class="btn btn-delete-row-table"><span>&#10006;</span></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <button class="btn btn-new-invoice mb-2">إضافة صنف</button>
        <!-- Summary -->
        <div class="summary-box-custom rounded-4 p-3 mb-4">
            <div class="row mb-2">
                <div class="col-12 text-end">
                    <span class="fw-bold ms-5" style="font-size:1.2rem;">الإجمالي</span>
                    <span class="fw-bold d-inline-block ms-3" style="font-size:1.2rem;">1000000000000</span>
                </div>
            </div>
            <div class="row mb-2 align-items-center gx-2">
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <div class="d-flex align-items-center justify-content-end">
                        <span class="fw-bold ms-2">المدفوع</span>
                        <input type="text" class=" table-input ms-2" style="max-width:100px;">
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <div class="d-flex align-items-center justify-content-end">
                        <span class="fw-bold ms-2">المتبقي</span>
                        <input type="text" class=" table-input ms-2" style="max-width:100px;">
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <div class="d-flex align-items-center justify-content-end ">
                        <span class="fw-bold ms-2">طريقة الدفع</span>
                        <input type="text" class=" table-input ms-2" style="max-width:100px;">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex align-items-center flex-column flex-md-row">
                        <span class="fw-bold ms-2 mb-2 mb-md-0">الملاحظات</span>
                        <input type="text" class=" summary-input flex-grow-1 w-100 w-md-auto">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-start">
                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-start">
                        <button class="btn btn-primary ms-2" style="background:#1A3E5D; border:none;">حفظ</button>
                        <button class="btn btn-primary ms-2" style="background:#1A3E5D; border:none;">طباعة</button>
                        <button class="btn btn-primary" style="background:#1A3E5D; border:none;">عرض</button>
                        <button class="btn btn-outline-danger ms-2">إلغاء</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
