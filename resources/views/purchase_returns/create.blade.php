@extends('layouts.master')
@section('title', 'مرتجع شراء')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">إرجاع منتج من عملية شراء</h3>

        <form method="POST" action="{{ route('purchase-returns.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">اختر عملية الشراء</label>
                <select class="form-select" name="purchase_item_id" required>
                    <option value="">-- اختر منتجاً من عملية شراء --</option>
                    @foreach($purchases as $purchase)
                        @foreach($purchase->items as $item)
                            <option value="{{ $item->id }}">
                                شراء #{{ $purchase->id }} - {{ $item->product->name }} ({{ $item->quantity }} كمية مشتراة)
                            </option>
                        @endforeach
                    @endforeach
                </select>
                @error('purchase_item_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">الكمية المرجعة</label>
                <input type="number" name="return_quantity" class="form-control" min="1" required>
                @error('return_quantity') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">سبب الإرجاع (اختياري)</label>
                <input type="text" name="reason" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-undo"></i> تنفيذ المرتجع</button>
        </form>
    </div>
@endsection
