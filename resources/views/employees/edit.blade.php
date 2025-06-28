@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>تعديل بيانات الموظف</h2>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('employees.form', ['employee' => $employee])

            <button type="submit" class="btn btn-primary">تحديث</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>



@endsection
