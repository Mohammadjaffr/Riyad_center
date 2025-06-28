@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>تعديل بيانات الموظف</h2>

        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('suppliers.form', ['supplier' => $supplier])

            <button type="submit" class="btn btn-primary">تحديث</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>



@endsection
