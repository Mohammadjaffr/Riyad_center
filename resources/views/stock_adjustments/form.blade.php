<div class="row g-4 align-items-center">

    <div class="col-12">
        <label for="product_id" class="form-label fw-bold">المنتج</label>
        <select name="product_id" id="product_id" class="summary-input flex-grow-1 w-100 w-md-auto" style="text-align: right;">
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} (حالياً: {{ $product->quantity }})</option>
            @endforeach
        </select>
        @error('product_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="new_quantity" class="form-label fw-bold">الكمية الجديدة</label>
        <input type="number" name="new_quantity" id="new_quantity" class="summary-input flex-grow-1 w-100 w-md-auto" min="0" style="text-align: right;">
        @error('new_quantity') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label fw-bold">سبب التعديل (اختياري)</label>
        <input type="text" name="description" id="description" class="summary-input flex-grow-1 w-100 w-md-auto" style="text-align: right;">
    </div>
{{--    --}}


</div>

