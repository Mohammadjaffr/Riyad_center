@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>قائمة المنتجات</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">إضافة منتج جديد</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>الاسم</th>
                <th>صورة المنتج</th>
                <th>الموديل</th>
                <th>السعر</th>
                <th>الكمية</th>
                <th>القسم</th>
                <th>التحكم</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td> <img class="image-preview" src="http://127.0.0.1:8000/{{ $p->product_image }}"> </td>
                    <td>{{ $p->model_num }}</td>
                    <td>{{ $p->sell_price }}</td>
                    <td>{{ $p->quantity }}</td>
                    <td>{{ $p->department->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('products.edit', $p->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
