@extends('layouts.master')
@section('title', 'تفاصيل المنتج')

@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow">
            <h3 class="mb-4">تفاصيل المنتج</h3>
            <p><strong>اسم المنتج:</strong> {{ $purchase->name }}</p>
            <p><strong>رقم الموديل:</strong> {{ $purchase->model_num }}</p>
            <p><strong>الوصف:</strong> {{ $purchase->description }}</p>
            <p><strong>الكمية:</strong> {{ $purchase->quantity }}</p>
            <p><strong>سعر التكلفة:</strong> {{ $purchase->cost_price }}</p>
            <p><strong>سعر البيع:</strong> {{ $purchase->sell_price }}</p>
            <p class="text-black"><strong>القسم:</strong> {{ $purchase->department->name ?? '-' }}</p>
            <a href="{{ route('purchases.index') }}" class="btn btn-secondary mt-3">رجوع</a>
        </div>
    </div>
@endsection
