@extends('layouts.master')
@section('title' ,'إضافة سلفة')
@section('content')
<div class="container py-4">
    <div class="bg-white rounded-4 p-4 shadow-sm">
        <h2 class="text-center mb-4" style="color: var(--dark-blue);">إضافة سلفة / دفعة مقدمة لموظف</h2>

        <form action="{{ route('employee-advance-payments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('employee_advance_payments.form', ['employee_advance-payment' => null])

            <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-blue">حفظ السلفة</button>
            <a href="{{route('employee-advance-payments.index')}}" class="btn btn-outline-blue">رجوع</a>
            </div>
        </form>
    </div>
</div>
@endsection
