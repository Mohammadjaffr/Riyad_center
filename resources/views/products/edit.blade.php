@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>تعديل بيانات الموظف</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('products.form', ['product' => $product])

            <button type="submit" class="btn btn-primary">تحديث</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>



@endsection
