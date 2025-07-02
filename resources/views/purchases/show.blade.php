@extends('layouts.master')
@section('title', 'تفاصيل المنتج')

@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow">
            <h3 class="mb-4 text-dark-blue">تفاصيل المنتج</h3>
            <p class="text-dark-blue"><strong>اسم المنتج:</strong> {{ $purchase->name }}</p>
            <p class="text-dark-blue"><strong>رقم الموديل:</strong> {{ $purchase->model_num }}</p>
            <p class="text-dark-blue"><strong>الوصف:</strong> {{ $purchase->description }}</p>
            <p class="text-dark-blue"><strong>الكمية:</strong> {{ $purchase->quantity }}</p>
            <p class="text-dark-blue"><strong>سعر التكلفة:</strong> {{ $purchase->cost_price }}</p>
            <p class="text-dark-blue"><strong>سعر البيع:</strong> {{ $purchase->sell_price }}</p>
            <p class="text-dark-blue"><strong>القسم:</strong> {{ $purchase->department->name ?? '-' }}</p>
            <a href="{{ route('purchases.index') }}" class="btn btn-blue mt-3">رجوع</a>
        </div>
    </div>
@endsection
