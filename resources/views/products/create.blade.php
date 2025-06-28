@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>إضافة منتج جديد</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('products.form', ['product' => null])

            <button type="submit" class="btn btn-success">حفظ</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>


@endsection
