@extends('layouts.master')
@section('title', 'سجل مرتجعات الشراء')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">سجل مرتجعات الشراء</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive bg-white rounded-4 shadow p-3">
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th>المنتج</th>
                    <th>الكمية المرجعة</th>
                    <th>السبب</th>
                    <th>تم بواسطة</th>
                    <th>تاريخ الإرجاع</th>
                </tr>
                </thead>
                <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->product->name ?? '-' }}</td>
                        <td>{{ $log->quantity }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->employee->name }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">لا توجد مرتجعات شراء.</td></tr>
                @endforelse
                </tbody>
            </table>

            {{ $logs->links() }}
        </div>
    </div>
@endsection
