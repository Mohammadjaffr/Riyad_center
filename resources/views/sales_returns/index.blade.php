@extends('layouts.master')
@section('title', 'سجل مرتجعات البيع')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">سجل مرتجعات البيع</h3>

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
@endsection
