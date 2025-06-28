@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2 class="mb-4">قائمة المشتريات</h2>

        {{-- رسالة النجاح --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- زر إضافة --}}
        <div class="mb-3 text-end">
            <a href="{{ route('purchases.create') }}" class="btn btn-primary">إضافة عملية شراء جديدة</a>
        </div>

        {{-- جدول المشتريات --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>المورد</th>
                    <th>تاريخ الشراء</th>
                    <th>إجمالي المبلغ</th>
                    <th>الملاحظات</th>
                    <th>تم بواسطة</th>
                    <th>العمليات</th>
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
                            <a href="#" class="btn btn-sm btn-info">عرض</a>
                            <a href="#" class="btn btn-sm btn-warning">تعديل</a>
                            <form action="#" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">حذف</button>
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
    </div>@endsection
