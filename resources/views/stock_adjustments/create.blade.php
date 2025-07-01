@extends('layouts.master')
@section('title', 'تعديل الجرد')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">تعديل يدوي للجرد</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('stock-adjustments.store') }}">
            @csrf

            <div class="mb-3">
                <label for="product_id" class="form-label fw-bold">المنتج</label>
                <select name="product_id" id="product_id" class="form-select">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (حالياً: {{ $product->quantity }})</option>
                    @endforeach
                </select>
                @error('product_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="new_quantity" class="form-label fw-bold">الكمية الجديدة</label>
                <input type="number" name="new_quantity" id="new_quantity" class="form-control" min="0">
                @error('new_quantity') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-bold">سبب التعديل (اختياري)</label>
                <input type="text" name="description" id="description" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> تنفيذ التعديل</button>
        </form>
    </div>
@endsection
