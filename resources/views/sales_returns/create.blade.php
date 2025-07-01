@extends('layouts.master')
@section('title', 'مرتجع بيع')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">إرجاع منتج من فاتورة</h3>

        <form method="POST" action="{{ route('sales-returns.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">اختر الفاتورة</label>
                <select class="form-select" name="invoice_item_id" required>
                    <option value="">-- اختر منتجًا من فاتورة --</option>
                    @foreach($invoices as $invoice)
                        @foreach($invoice->items as $item)
                            <option value="{{ $item->id }}">
                                فاتورة #{{ $invoice->invoice_num }} - {{ $item->product->name }} ({{ $item->quantity }} كمية مباعة)
                            </option>
                        @endforeach
                    @endforeach
                </select>
                @error('invoice_item_id') <div class="text-danger">{{ $message }}</div> @enderror
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
