@extends('layouts.master')
@section('title' ,'تعديل بيانات الموظف')
@section('content')
    <div class="container">
        <h2>تعديل بيانات الموظف</h2>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('employees.form', ['employee' => $employee])
            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-blue "> تعديل البيانات</button>
            </div>

{{--            <button type="submit" class="btn btn-primary">تحديث</button>--}}
{{--            <a href="{{ route('employees.index') }}" class="btn btn-secondary">رجوع</a>--}}
        </form>
    </div>



@endsection
