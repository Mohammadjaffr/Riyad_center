<div class="mb-3">
    <label class="form-label fw-bold">اسم الزبون (اختياري)</label>
    <input type="text" name="customer_name" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right">

</div>
<div class="mb-3">
    <label class="form-label fw-bold">القسم</label>
    <select name="department_id" class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('department_id') ? 'is-invalid' : '' }}"  style="text-align: right" >
        <option value="">اختر القسم</option>
        @foreach($departments as $dep)
            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
        @endforeach
    </select>
    @error('department_id')
    <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
    @enderror
 </div>

<div class="mb-3">
    <label class="form-label fw-bold">تاريخ البيع</label>
    <input type="date" name="sale_date" class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('sale_date') ? 'is-invalid' : '' }}"   style="text-align: right" >
    @error('sale_date')
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
            <select name="product_id[]" class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('product_id[]') ? 'is-invalid' : '' }}"   style="text-align: right">
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
            <input type="number" name="quantity[]" class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('quantity[]') ? 'is-invalid' : '' }}"   style="text-align: right" placeholder="الكمية" >
            @error('quantity[]')
            <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="unit_price[]" class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('unit_price[]') ? 'is-invalid' : '' }}"   style="text-align: right" placeholder="السعر" >
            @error('unit_price[]')
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
    <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right"></textarea>
</div>

<button type="submit" class="btn btn-primary">حفظ</button>
<a href="{{route('sales.index')}}" class="btn btn-outline-blue">رجوع</a>


