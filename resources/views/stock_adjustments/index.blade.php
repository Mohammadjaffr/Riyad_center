@extends('layouts.master')
@section('title', 'سجل تعديلات الجرد')
@section('content')
    @if(session('success') || session('error'))
        <div class="message-center" style="position: fixed;left: 50%;transform: translate(-50%, -50%);z-index: 9999;padding: 20px;border-radius: 8px;text-align: center;animation: fadeInOut 4s forwards;
        {{ session('success') ? 'background: #4CAF50; color: white;' : 'background: #F44336; color: white;' }}">
            {{ session('success') ?? session('error') }}
        </div>
    @endif

    <style>
        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; visibility: hidden; }
        }
    </style>
    <div class="container py-4">
        <div class="d-flex justify-content-center align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">سجل تعديلات الجرد</h2>
         </div>

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
{{--            <div class="row g-2 align-items-center mb-3">--}}


{{--                <form method="GET" action="{{ route('stock-adjustments.index') }}" class="col-md-6 col-lg-4 mb-3 mt-4">--}}
{{--                    <div class="input-group" style="position: relative;">--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            name="search"--}}
{{--                            class="form-control summary-input w-100"--}}
{{--                            placeholder="ابحث باسم المنتج ..."--}}
{{--                            value="{{ request('search') }}"--}}
{{--                            style="text-align: right; height: 43px; padding-right: 40px;"--}}
{{--                        >--}}
{{--                        <button--}}
{{--                            class="search-btn "--}}
{{--                            type="submit"--}}
{{--                            style="position: absolute; left:15px; top: 50%; transform: translateY(-50%); background: none; border: none; z-index: 5;"--}}
{{--                        >--}}
{{--                            <i class="fa fa-search" style="color: #fff;"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}

{{--                </form>--}}
{{--                <div class="d-none d-lg-flex col-lg-6">--}}

{{--                </div>--}}


{{--                <div class="col-12 col-md-6 col-lg-2 mb-3 mb-md-0 d-flex justify-content-center align-items-center">--}}
{{--                    <!-- زر لفتح المودال -->--}}
{{--                    <button type="button" class="btn btn-blue w-100 w-md-auto filter-btn">--}}
{{--                        <i class="fa fa-filter"></i> <span class="d-inline">فلترة</span>--}}
{{--                    </button>--}}
{{--                </div>--}}

{{--            </div>--}}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
