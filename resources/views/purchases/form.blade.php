            <div class="mb-3">
                <label class="form-label fw-bold">المورد</label>
                <select name="supplier_id" class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('supplier_id') ? 'is-invalid' : '' }}"   style="text-align: right" >
                    <option value="">اختر المورد</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">تاريخ الشراء</label>
                <input type="date" name="purchase_date" class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('purchase_date') ? 'is-invalid' : '' }}"   style="text-align: right" >
                @error('purchase_date')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <hr>
            <h5 style="color: var(--dark-blue);">تفاصيل المنتجات</h5>

            <div id="items">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select name="product_id[]" class="summary-input flex-grow-1 w-100 w-md-auto  {{ $errors->has('product_id[]') ? 'is-invalid' : '' }}"   style="text-align: right">
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id[]')
                        <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="quantity[]" class="summary-input flex-grow-1 w-100 w-md-auto  {{ $errors->has('quantity[]') ? 'is-invalid' : '' }}"   style="text-align: right" placeholder="الكمية" >
                        @error('quantity[]')
                        <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="unit_price[]" class="summary-input flex-grow-1 w-100 w-md-auto  {{ $errors->has('unit_price') ? 'is-invalid' : '' }}"   style="text-align: right" placeholder="السعر" >
                        @error('unit_price')
                        <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="addRow()" class="btn btn-success">+</button>
                        <button type="button" onclick="deleteRow(this)" class="btn btn-danger">-</button>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">ملاحظات</label>
                <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto  {{ $errors->has('notes') ? 'is-invalid' : '' }}"   style="text-align: right"></textarea>
                @error('notes')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">حفظ</button>
            <a href="{{route('purchases.index')}}" class="btn btn-outline-secondary">رجوع</a>


