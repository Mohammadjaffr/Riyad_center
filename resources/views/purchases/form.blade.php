            <div class="mb-3">
                <label class="form-label fw-bold">المورد</label>
                <select name="supplier_id" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" required>
                    <option value="">اختر المورد</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">تاريخ الشراء</label>
                <input type="date" name="purchase_date" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" required>
            </div>

            <hr>
            <h5 style="color: var(--dark-blue);">تفاصيل المنتجات</h5>

            <div id="items">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select name="product_id[]" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right">
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="quantity[]" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" placeholder="الكمية" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="unit_price[]" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" placeholder="السعر" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="addRow()" class="btn btn-success">+</button>
                        <button type="button" onclick="deleteRow(this)" class="btn btn-danger">-</button>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">ملاحظات</label>
                <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">حفظ</button>


