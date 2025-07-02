@extends('layouts.master')
@section('title', 'تعديل الجرد')

@section('content')
    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="bg-white rounded-4 p-4 shadow-sm" >
        <h3  class="text-center mb-4" style="color: var(--dark-blue);">تعديل يدوي للجرد</h3>



        <form method="POST" action="{{ route('stock-adjustments.store') }}">
            @csrf
            @include('stock_adjustments.form', ['stock-adjustment' => null])
            <div class="col-12 mt-3">
            <button type="submit" class="btn btn-blue"> تنفيذ التعديل</button>
                <a href="{{route('stock-adjustments.index')}}" class="btn btn-outline-blue">رجوع</a>

            </div>
        </form>
        </div>
    </div>
@endsection
