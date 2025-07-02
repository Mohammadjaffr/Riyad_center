@extends('layouts.master')
@section('title', 'مرتجع شراء')

@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">إرجاع منتج من عملية شراء</h2>

        <form method="POST" action="{{ route('purchase-returns.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">اختر عملية الشراء</label>
                <select class="summary-input text-end flex-grow-1 w-100 w-md-auto" name="purchase_item_id" required>
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
                <input type="number" name="return_quantity" class="summary-input text-end flex-grow-1 w-100 w-md-auto" min="1" required>
                @error('return_quantity') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">سبب الإرجاع (اختياري)</label>
                <input type="text" name="reason" class="summary-input text-end flex-grow-1 w-100 w-md-auto">
            </div>
            <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-blue"> تنفيذ المرتجع</button>
            </div>
        </form>
        </div>
    </div>
@endsection
