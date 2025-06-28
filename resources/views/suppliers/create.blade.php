@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>إضافة موظف جديد</h2>

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            @include('suppliers.form', ['supplier' => null])

            <button type="submit" class="btn btn-success">حفظ</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>


@endsection
