<div class="row g-4 align-items-center">
    <div class="col-12 col-md-8">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-bold">اسم المنتج</label>
                <input type="text" name="name" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="اسم المنتج"  style="text-align: right" value="{{ old('name', $product->name ?? '') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">الوصف</label>
                <textarea name="description" class="summary-textarea flex-grow-1 w-100 w-md-auto"  >{{ old('description', $product->description ?? '') }}</textarea>

{{--                <input type="text" name="description" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right" placeholder="الوصف" required>--}}
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">صورة المنتج</label>
                <input type="file" name="product_image" class="form-control summary-input flex-grow-1 w-100 w-md-auto" accept="image/*" onchange="previewProductImage(event)">
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">رقم الموديل</label>
                <input type="text" name="model_num" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right; width: 200px" placeholder="رقم الموديل" value="{{ old('model_num', $product->model_num ?? '') }}">
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">كمية المخزون</label>
                <input type="number" name="quantity" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right; width: 200px" placeholder="كمية المخزون" min="0" value="{{ old('quantity', $product->quantity ?? 0) }}">
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">سعر البيع</label>
                <input type="number" name="sell_price" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right; width: 200px" placeholder="سعر البيع" min="0" step="0.01" value="{{ old('sell_price', $product->sell_price ?? 0) }}" required>
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">سعر التكلفة</label>
                <input type="number" name="cost_price" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right; width: 200px" placeholder="سعر التكلفة" min="0" step="0.01"  value="{{ old('cost_price', $product->cost_price ?? 0) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">القسم</label>
                <select name="department_id" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" required>
                    <option >القسم</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $product->department_id ?? '') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-new-invoice w-50 ">اضافة</button>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 text-center order-1 order-md-0 mb-3 mb-md-0">
        <img id="product-preview" src="{{ asset('assets/images/Add files-rafiki.png') }}" alt="Product Illustration" class="img-fluid " style="max-width: 220px;">
    </div>

</div>
