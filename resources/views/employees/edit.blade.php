@extends('layouts.master')
@section('title' ,'تعديل بيانات الموظف')
@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">تعديل بيانات الموظف</h2>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('employees.form', ['employee' => $employee])
            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-blue "> تعديل البيانات</button>
                <a href="{{route('employees.index')}}" class="btn btn-outline-blue">رجوع</a>

            </div>

{{--            <button type="submit" class="btn btn-primary">تحديث</button>--}}
{{--            <a href="{{ route('employees.index') }}" class="btn btn-secondary">رجوع</a>--}}
        </form>
    </div>
    </div>


@endsection
