@extends('layouts.master')
@section('title', 'سجل مرتجعات البيع')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">سجل مرتجعات البيع</h2>
            <a href="{{ route('sales-returns.create') }}" class="btn btn-blue mb-2 mb-md-0">
                <i class="fa fa-plus"></i>إضافة راجع البيع
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
                <div class="col-4 col-md-1 text-center mb-2 mb-md-0">
                    <!-- زر لفتح المودال -->
                    <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fa fa-filter"></i> فلترة
                    </button>
                </div>
            </div>
            <div class="table-responsive ">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">
                    <tr>
                        <th>المنتج</th>
                        <th>الكمية المرجعة</th>
                        <th>السبب</th>
                        <th>تم بواسطة</th>
                        <th>التاريخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>
                                {{ $log->productVariant->product->name ?? '-' }}
                                {{ $log->productVariant->size ? ' - ' . $log->productVariant->size : '' }}
                                {{ $log->productVariant->color ? ' / ' . $log->productVariant->color : '' }}
                            </td>
                            <td>{{ $log->quantity }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->employee->name ?? '-' }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">لا توجد مرتجعات حتى الآن</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
{{--mohammed's code --}}
{{--    <div class="container py-4">--}}
{{--        <h3 class="mb-4">سجل مرتجعات البيع</h3>--}}

{{--        @if(session('success'))--}}
{{--            <div class="alert alert-success">{{ session('success') }}</div>--}}
{{--        @endif--}}

{{--        <div class="table-responsive bg-white rounded-4 shadow p-3">--}}
{{--            <table class="table table-bordered text-center">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>المنتج</th>--}}
{{--                    <th>الكمية المرجعة</th>--}}
{{--                    <th>السبب</th>--}}
{{--                    <th>تم بواسطة</th>--}}
{{--                    <th>التاريخ</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @forelse($logs as $log)--}}
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            {{ $log->productVariant->product->name ?? '-' }}--}}
{{--                            {{ $log->productVariant->size ? ' - ' . $log->productVariant->size : '' }}--}}
{{--                            {{ $log->productVariant->color ? ' / ' . $log->productVariant->color : '' }}--}}
{{--                        </td>--}}
{{--                        <td>{{ $log->quantity }}</td>--}}
{{--                        <td>{{ $log->description }}</td>--}}
{{--                        <td>{{ $log->employee->name ?? '-' }}</td>--}}
{{--                        <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>--}}
{{--                    </tr>--}}
{{--                @empty--}}
{{--                    <tr>--}}
{{--                        <td colspan="5">لا توجد مرتجعات حتى الآن</td>--}}
{{--                    </tr>--}}
{{--                @endforelse--}}
{{--                </tbody>--}}
{{--            </table>--}}

{{--            {{ $logs->links() }}--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
