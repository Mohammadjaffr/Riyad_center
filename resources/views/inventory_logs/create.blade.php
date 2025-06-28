@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>تعديل يدوي للمخزون</h2>

        <form method="POST" action="{{ route('inventory-logs.store') }}">
            @csrf

            <div class="mb-3">
                <label>المنتج</label>
                <select name="product_id" class="form-control" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>نوع التغير</label>
                <select name="change_type" class="form-control" required>
                    <option value="شراء">شراء</option>
                    <option value="بيع">بيع</option>
                    <option value="تعديل يدوي">تعديل يدوي</option>
                </select>
            </div>

            <div class="mb-3">
                <label>الكمية</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>الوصف (اختياري)</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">حفظ</button>
        </form>
    </div>
@endsection
