@extends('layouts.master')
@section('title', 'سجل تعديلات الجرد')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">سجل تعديلات الجرد</h2>
         </div>

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">


                <div class="col-12 col-md-4">
                    <input type="text" class="form-control summary-input flex-grow-1 w-100 w-md-auto" placeholder="البحث ..." style="text-align: right;">
                </div>
                <div class="col-12 col-md-7"></div>
                <div class="col-4 col-md-1 text-center mb-2 mb-md-0">
                    <!-- زر لفتح المودال -->
                    <button type="button" class="btn btn-new-invoice" >
                        <i class="fa fa-filter"></i> فلترة
                    </button>
                </div>
            </div>
            <div class="table-responsive ">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">
                    <tr>
                        <th>المنتج</th>
                        <th>الكمية المعدّلة</th>
                        <th>السبب</th>
                        <th>بواسطة</th>
                        <th>تاريخ التعديل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->product->name ?? '-' }}</td>
                            <td>{{ $log->quantity }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_by }}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">لا توجد بيانات</td></tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
{{--  mohammed's code  --}}
{{--    <div class="container py-4">--}}
{{--        <h3 class="mb-4">سجل تعديلات الجرد</h3>--}}

{{--        <div class="table-responsive bg-white rounded-4 shadow p-3">--}}
{{--            <table class="table table-bordered text-center">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>المنتج</th>--}}
{{--                    <th>الكمية المعدّلة</th>--}}
{{--                    <th>السبب</th>--}}
{{--                    <th>بواسطة</th>--}}
{{--                    <th>تاريخ التعديل</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @forelse($logs as $log)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $log->product->name ?? '-' }}</td>--}}
{{--                        <td>{{ $log->quantity }}</td>--}}
{{--                        <td>{{ $log->description }}</td>--}}
{{--                        <td>{{ $log->created_by }}</td>--}}
{{--                        <td>{{ $log->created_at }}</td>--}}
{{--                    </tr>--}}
{{--                @empty--}}
{{--                    <tr><td colspan="5">لا توجد بيانات</td></tr>--}}
{{--                @endforelse--}}
{{--                </tbody>--}}
{{--            </table>--}}

{{--           --}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
