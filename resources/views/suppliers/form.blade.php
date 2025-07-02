<div class="row g-4 align-items-center">
    <div class="col-12 col-md-8">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-bold">اسم المورد</label>
                <input type="text" name="name" class="summary-input text-end flex-grow-1 w-100 w-md-auto" value="{{ old('name', $supplier->name ?? '') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">رقم الهاتف</label>
                <input type="text" name="phone" class="summary-input text-end flex-grow-1 w-100 w-md-auto" value="{{ old('phone', $supplier->phone ?? '') }}">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">العنوان</label>
                <textarea name="address" class="summary-textarea text-end flex-grow-1 w-100 w-md-auto">{{ old('address', $supplier->address ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">القسم</label>
                <select name="department_id" class="summary-input text-end flex-grow-1 w-100 w-md-auto" required>
                    <option value="">اختر القسم</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $supplier->department_id ?? '') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 text-center order-1 order-md-0 mb-3 mb-md-0">
        <img id="product-preview" src="{{ asset('assets/images/Add files-rafiki.png') }}" alt="Product Illustration" class="img-fluid " style="max-width: 220px;">
    </div>
</div>
