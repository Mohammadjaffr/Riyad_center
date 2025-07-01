@extends('layouts.master')
@section('title' ,'الجرد الشهري')
@section('content')
    <style>
        body { font-family: DejaVu Sans, sans-serif; direction: rtl; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
    </style>
    <h2 style="text-align: center;">تقرير الجرد الشهري - {{ now()->format('Y/m') }}</h2>
    <table>
        <thead>
        <tr>
            <th>المنتج</th>
            <th>النوع</th>
            <th>الكمية</th>
            <th>الوصف</th>
            <th>الموظف</th>
            <th>التاريخ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            <tr>
                <td>{{ $log->product->name }}</td>
                <td>{{ $log->change_type }}</td>
                <td>{{ $log->quantity }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->employee->name }}</td>
                <td>{{ $log->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
