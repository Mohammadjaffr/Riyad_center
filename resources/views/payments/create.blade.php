@extends('layouts.master')
@section('title', 'إضافة دفعة')
@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
        <h2 class="text-center mb-4" style="color: var(--dark-blue);">إضافة دفعة جديدة</h2>

        <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('payments.form', ['payment' => null])


            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
        </form>
    </div>
    </div>
@endsection
