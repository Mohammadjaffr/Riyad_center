@extends('layouts.master')
@section('title' ,'تعديل يدوي للمخزون')
@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">تعديل يدوي للمخزون</h2>

            <form action="{{ route('inventory-logs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('inventory_logs.form', ['inventory-log' => null])

                <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                <a href="{{route('inventory-logs.index')}}" class="btn btn-outline-blue">رجوع</a>
                </div>

            </form>
        </div>
    </div>
@endsection
