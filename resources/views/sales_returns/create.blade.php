@extends('layouts.master')
@section('title', 'مرتجع بيع')

@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">إضافة مورد جديدإرجاع منتج من فاتورة</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('sales-returns.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">اختر المنتج من الفاتورة</label>
                <select class="summary-input text-end flex-grow-1 w-100 w-md-auto" name="invoice_item_id" required id="invoiceItemSelect">
                    <option  disabled selected>اختر منتجًا من فاتورة </option>
                    @foreach($invoices as $invoice)
                        @foreach($invoice->items as $item)
                            @php
                                $returnedQty = \App\Models\InventoryLog::where('change_type', 'مرتجع بيع')
                                    ->where('invoice_item_id', $item->id)
                                    ->sum('quantity');
                                $availableQty = $item->quantity - $returnedQty;
                            @endphp
                            @if($availableQty > 0)
                                <option
                                    value="{{ $item->id }}"
                                    data-product-name="{{ $item->productVariant->product->name ?? '-' }}"
                                    data-available-qty="{{ $availableQty }}"
                                    data-sold-qty="{{ $item->quantity }}"
                                >
                                    فاتورة #{{ $invoice->invoice_num }} -
                                    {{ $item->productVariant->product->name ?? '-' }}
                                    {{ $item->productVariant->size ? ' - ' . $item->productVariant->size : '' }}
                                    {{ $item->productVariant->color ? ' / ' . $item->productVariant->color : '' }}
                                    (مباعة: {{ $item->quantity }} - متاحة: {{ $availableQty }})
                                </option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
                @error('invoice_item_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">الكمية المرجعة</label>
                <input type="number" name="return_quantity" class="summary-input text-end flex-grow-1 w-100 w-md-auto" min="1" required id="returnQuantityInput">
                <div id="availableQtyHelp" class="form-text text-muted"></div>
                @error('return_quantity')
                <div class="text-danger">{{ $message }}</div>
                @enderror
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('invoiceItemSelect');
            const qtyInput = document.getElementById('returnQuantityInput');
            const helpText = document.getElementById('availableQtyHelp');

            function updateAvailableQty() {
                const selectedOption = select.options[select.selectedIndex];
                if (!selectedOption || selectedOption.value === "") {
                    helpText.textContent = '';
                    qtyInput.max = '';
                    qtyInput.value = '';
                    qtyInput.disabled = true;
                    return;
                }

                const availableQty = selectedOption.getAttribute('data-available-qty');
                helpText.textContent = `الكمية المتاحة للإرجاع: ${availableQty}`;
                qtyInput.max = availableQty;
                qtyInput.value = '';
                qtyInput.disabled = false;
            }

            select.addEventListener('change', updateAvailableQty);
            updateAvailableQty(); // في أول تحميل
        });
    </script>
@endsection
