@extends('layouts.master')
@section('title' ,'إضافة موظف')
@section('content')



<div class="container py-4">
    <div class="bg-white rounded-4 p-4 shadow-sm">
        <h2 class="text-center mb-4" style="color: var(--dark-blue);">إضافة موظف </h2>
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('employees.form', ['employee' => null])
            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-blue ">حفظ البيانات</button>
                <a href="{{route('employees.index')}}" class="btn btn-outline-blue">رجوع</a>

            </div>

{{--            <button type="submit" class="btn btn-success">حفظ</button>--}}
{{--            <a href="{{ route('employees.index') }}" class="btn btn-secondary">رجوع</a>--}}
        </form>

    </div>
</div>
@endsection
