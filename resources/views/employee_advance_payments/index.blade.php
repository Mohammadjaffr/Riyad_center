@extends('layouts.master')
@section('title' ,' سجل السُلف')
@section('content')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">سجل السُلف</h2>
            <a href="{{ route('employee-advance-payments.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
                <i class="fa fa-plus"></i>إضافة سلفة
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">
                <form method="GET" action="{{ route('employee-advance-payments.index') }}" class="col-md-6 col-lg-4 mb-3">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control summary-input"
                            placeholder="ابحث باسم الموظف أو رقم الهاتف..."
                            value="{{ request('search') }}"
                            style="text-align: right;height: 43px!important;"
                        >
                        <button class="btn btn-blue position-absolute rounded-circle my-1" style="left:25px;" type="submit">
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
                        <th>الموظف</th>
                        <th>المبلغ</th>
                        <th>السبب</th>
                        <th>التاريخ</th>
                        <th>الملاحظات</th>
                        <th>أدخلت بواسطة</th>
                        <th>تاريخ التسجيل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($advances as $advance)
                        <tr>
                            <td>{{ $advance->employee->name ?? '-' }}</td>
                            <td>{{ number_format($advance->amount, 2) }}</td>
                            <td>{{ $advance->reason }}</td>
                            <td>{{ $advance->payment_date }}</td>
                            <td>{{ $advance->notes ?? '-' }}</td>
                            <td>{{ $advance->creator->name ?? '-' }}</td>
                            <td>{{ $advance->created_at }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 bg-white">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-blue" id="filterModalLabel">فلترة السلف</h5>
                </div>

                <form method="GET" action="{{ route('employee-advance-payments.index') }}">
                    <div class="modal-body">
                        <div class="row g-3 text-dark-blue">
                            <!-- حقل البحث -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">بحث باسم الموظف أو رقم الهاتف</label>
                                <input
                                    type="text"
                                    name="search"
                                    class="summary-input w-100"
                                    value="{{ request('search') }}"
                                    placeholder="مثال: عادل، 777..."
                                    autocomplete="off"
                                />
                            </div>

                            <!-- الترتيب حسب المبلغ -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">الترتيب حسب المبلغ</label>
                                <select name="sort" class="summary-input w-100 text-dark-blue">
                                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>اختر</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>من الأقل إلى الأعلى</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>من الأعلى إلى الأقل</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <a href="{{ route('employee-advance-payments.index') }}" class="btn btn-outline-blue">
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

