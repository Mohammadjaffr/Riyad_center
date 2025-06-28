<div class="mb-3">
    <label>اسم المنتج</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>رقم الموديل</label>
    <input type="text" name="model_num" class="form-control" value="{{ old('model_num', $product->model_num ?? '') }}" required>
</div>

<div class="mb-3">
    <label>صورة المنتج</label>
    <input type="file" name="product_image" class="form-control">
    @if(isset($product) && $product->product_image)
        <img src="{{ asset('storage/' . $product->product_image) }}" width="100" class="mt-2">
    @endif
</div>

<div class="mb-3">
    <label>الوصف</label>
    <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>الكمية</label>
    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity ?? 0) }}">
</div>

<div class="mb-3">
    <label>سعر التكلفة</label>
    <input type="number" step="0.01" name="cost_price" class="form-control" value="{{ old('cost_price', $product->cost_price ?? 0) }}">
</div>

<div class="mb-3">
    <label>سعر البيع</label>
    <input type="number" step="0.01" name="sell_price" class="form-control" value="{{ old('sell_price', $product->sell_price ?? 0) }}">
</div>

<div class="mb-3">
    <label>القسم</label>
    <select name="department_id" class="form-control" required>
        <option value="">اختر القسم</option>
        @foreach ($departments as $dep)
            <option value="{{ $dep->id }}" {{ old('department_id', $product->department_id ?? '') == $dep->id ? 'selected' : '' }}>
                {{ $dep->name }}
            </option>
        @endforeach
    </select>
</div>
