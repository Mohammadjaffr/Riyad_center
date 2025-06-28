@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>إضافة قسم جديد</h2>

        <form action="{{ route('departments.store') }}" method="POST">
            @csrf

            @include('departments.form')

            <button type="submit" class="btn btn-success">حفظ</button>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>

@endsection
