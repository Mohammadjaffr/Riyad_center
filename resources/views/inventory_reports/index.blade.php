@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="mb-4">تقرير حركات المخزون</h2>

        <form method="GET" class="mb-3">
            <select name="type" class="form-select w-auto d-inline-block">
                <option value="" {{ request('type') == '' ? 'selected' : '' }}>كل الحركات</option>
                <option value="شراء" {{ request('type') == 'شراء' ? 'selected' : '' }}>شراء</option>
                <option value="بيع" {{ request('type') == 'بيع' ? 'selected' : '' }}>بيع</option>
                <option value="مرتجع شراء" {{ request('type') == 'مرتجع شراء' ? 'selected' : '' }}>مرتجع شراء</option>
                <option value="مرتجع بيع" {{ request('type') == 'مرتجع بيع' ? 'selected' : '' }}>مرتجع بيع</option>
                <option value="تعديل يدوي" {{ request('type') == 'تعديل يدوي' ? 'selected' : '' }}>تعديل يدوي</option>
            </select>

            <button type="submit" class="btn btn-primary">فلترة</button>
        </form>

        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>المنتج</th>
                <th>المقاس</th>
                <th>اللون</th>
                <th>النوع</th>
                <th>الكمية</th>
                <th>الوصف</th>
                <th>الموظف</th>
                <th>تاريخ العملية</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->productVariant->product->name ?? '-' }}</td>
                    <td>{{ $log->productVariant->size ?? '-' }}</td>
                    <td>{{ $log->productVariant->color ?? '-' }}</td>
                    <td>{{ __("{$log->change_type}") }}</td>
                    <td>{{ $log->quantity }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->employee->name ?? '-' }}</td>
                    <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $logs->withQueryString()->links() }}
    </div>
@endsection
