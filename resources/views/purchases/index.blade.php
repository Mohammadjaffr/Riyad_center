@extends('layouts.master')
@section('title' ,'المشتريات')
@section('content')



<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة المشتريات</h2>
        <a href="{{ route('purchases.create') }}" class="btn btn-blue mb-2 mb-md-0">
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
            <form method="GET" action="{{ route('purchases.index') }}" class="col-md-6 col-lg-4 mb-3">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control summary-input"
                        placeholder="ابحث برقم الفاتورة أو اسم المورد..."
                        value="{{ request('search') }}"
                        style="text-align: right;"
                    >
                    <button class="btn btn-blue position-absolute rounded-circle mt-0" style="left:25px;" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="col-2 col-md-7"></div>
            <div class="col-4 col-md-1 text-center mb-2 mb-md-0">
                <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fa fa-filter"></i> فلترة
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
                            <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-sm ms-3 "><i class="fa fa-eye"></i></a>
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
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-dark-blue" id="filterModalLabel">فلترة المشتريات</h5>
            </div>

            <form method="GET" action="{{ route('purchases.index') }}">
                <div class="modal-body">
                    <div class="row g-3 text-dark-blue">
                        <!-- حقل البحث -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">بحث برقم الفاتورة أو اسم المورد</label>
                            <input
                                type="text"
                                name="search"
                                class="summary-input w-100"
                                value="{{ request('search') }}"
                                placeholder="مثال: فاتورة 00123، المورد علي"
                                autocomplete="off"
                            />
                        </div>

                        <!-- الترتيب حسب التاريخ -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">الترتيب حسب تاريخ الفاتورة</label>
                            <select name="sort" class="summary-input w-100 text-dark-blue">
                                <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>اختر</option>
                                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>من الأقدم إلى الأحدث</option>
                                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>من الأحدث إلى الأقدم</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <a href="{{ route('purchases.index') }}" class="btn btn-outline-blue">
                        <i class="fa fa-undo"></i> إعادة تعيين
                    </a>
                    <button type="submit" class="btn btn-blue">
                        <i class="fa fa-search"></i> تطبيق الفلتر
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
