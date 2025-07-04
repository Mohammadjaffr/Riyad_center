@extends('layouts.master')
@section('title', 'تفاصيل المنتج')

@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow">
            <h3 class="mb-4 text-dark-blue">تفاصيل المشتريات</h3>

            @foreach ($purchase_items as $item)
                <p class="text-dark-blue"><strong>اسم المنتج:</strong> {{ $item->product->name }}</p>
                <p class="text-dark-blue"><strong>رقم الموديل:</strong> {{ $item->product->model_num }}</p>
                <p class="text-dark-blue"><strong>الوصف:</strong> {{ $item->product->description }}</p>
                <p  class="text-dark-blue"><strong>الكمية:</strong> {{ $item->quantity }}</p>
{{--                <p class="text-dark-blue"><strong>سعر التكلفة:</strong> {{ $item->product->cost_price }}</p>--}}
{{--                <p class="text-dark-blue"><strong>سعر البيع:</strong> {{ $item->product->sell_price }}</p>--}}
                <hr>
            @endforeach

            <p class="text-dark-blue"><strong>القسم:</strong> {{ $purchase->department->name ?? '-' }}</p>
            <a href="{{ route('purchases.index') }}" class="btn btn-blue mt-3">رجوع</a>
        </div>
    </div>
@endsection
