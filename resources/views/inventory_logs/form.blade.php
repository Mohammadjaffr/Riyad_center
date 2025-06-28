
    <div class="mb-3">
        <label class="form-label fw-bold">المنتج</label>
        <select name="product_id" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right" required>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">نوع التغير</label>
        <select name="change_type" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right" required>
            <option value="شراء">شراء</option>
            <option value="بيع">بيع</option>
            <option value="تعديل يدوي">تعديل يدوي</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">الكمية</label>
        <input type="number" name="quantity" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right"  required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">الوصف (اختياري)</label>
        <textarea name="description" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right" ></textarea>
    </div>



