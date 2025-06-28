@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>تعديل قسم</h2>

        <form action="{{ route('departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('departments.form', ['department' => $department])

            <button type="submit" class="btn btn-primary">تحديث</button>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>


@endsection
