@extends('layouts.master')
@section('title' ,'إضافة راتب')
@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">إضافة راتب</h2>
            <form method="POST" action="{{ route('employee-salaries.store') }}" enctype="multipart/form-data">
                @csrf
                @include('employee_salaries.form', ['employee_salaries' => null])
            </form>

        </div>
    </div>
@endsection

