<div class="mb-3">
    <label>اسم المورد</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $supplier->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>رقم الهاتف</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $supplier->phone ?? '') }}">
</div>

<div class="mb-3">
    <label>العنوان</label>
    <textarea name="address" class="form-control">{{ old('address', $supplier->address ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>القسم</label>
    <select name="department_id" class="form-control" required>
        <option value="">اختر القسم</option>
        @foreach ($departments as $dep)
            <option value="{{ $dep->id }}" {{ old('department_id', $supplier->department_id ?? '') == $dep->id ? 'selected' : '' }}>
                {{ $dep->name }}
            </option>
        @endforeach
    </select>
</div>
