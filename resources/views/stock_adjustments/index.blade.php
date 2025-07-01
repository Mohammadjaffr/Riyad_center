@extends('layouts.master')
@section('title', 'سجل تعديلات الجرد')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">سجل تعديلات الجرد</h3>

        <div class="table-responsive bg-white rounded-4 shadow p-3">
            <table class="table table-bordered text-center">
                <thead>
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
@endsection
