@extends('layouts.master')
@section('title', 'المنتجات')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة الفواتير</h2>
            <a href="{{ route('invoices.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
                <i class="fa fa-plus"></i> اضافة  فاتورة
            </a>
        </div>
        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">


                <div class="col-12 col-md-4">
                    <input type="text" class="form-control summary-input flex-grow-1 w-100 w-md-auto" placeholder="البحث ..." style="text-align: right;">
                </div>
                <div class="col-12 col-md-7"></div>
                <div class="col-12 col-md-1 text-center mb-2 mb-md-0">
                    <button class="summary-input flex-grow-1 w-100 w-md-auto" style="border-radius: 10px;">
                        <i class="fa fa-filter"></i>

                    </button>
                </div>
            </div>
            <div class="table-responsive ">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">
                    <tr>
                        <th>رقم الفاتورة</th>
                        <th> العميل</th>
                        <th>القسم </th>
                        <th>الموظف</th>
                        <th>الإجمالي </th>
                        <th>المدفوع </th>
                        <th>المتبقي </th>
                        <th>التاريخ</th>
                        <th>الخيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>
                            <a href="" class="text-success me-2 ms-3" title="تعديل" >
                                <i class="fa fa-pen"></i>
                            </a>
                            <form action="" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 m-0 text-danger" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟');">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
