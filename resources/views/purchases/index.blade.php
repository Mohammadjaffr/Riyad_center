@extends('layouts.master')
@section('title' ,'المشتريات')
@section('content')



<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة المشتريات</h2>
        <a href="{{ route('purchases.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
            <i class="fa fa-plus"></i>إضافة عملية شراء
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                    <th>#</th>
                    <th>المورد</th>
                    <th>تاريخ الشراء</th>
                    <th>إجمالي المبلغ</th>
                    <th>الملاحظات</th>
                    <th>تم بواسطة</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($purchases as $purchase)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $purchase->supplier->name ?? '---' }}</td>
                        <td>{{ $purchase->purchase_date }}</td>
                        <td>{{ number_format($purchase->total_amount, 2) }}</td>
                        <td>{{ $purchase->notes ?? '-' }}</td>
                        <td>{{ $purchase->employee->name ?? '-' }}</td>
                        <td>
                            <a href="#" class="btn btn-sm ms-3 "><i class="fa fa-eye"></i></a>
                            <form action="#" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link p-0 m-0 text-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">لا توجد عمليات شراء حتى الآن</td>
                    </tr>
                @endforelse


                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
