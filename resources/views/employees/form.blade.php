
<div class="mb-3">
    <label>الاسم</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>رقم الهاتف</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone ?? '') }}" required>
</div>

<div class="mb-3">
    <label>كلمة المرور</label>
    <input type="password" name="password" class="form-control" {{ isset($employee) ? '' : 'required' }}>
</div>

<div class="mb-3">
    <label>الحالة</label>
    <select name="status" class="form-control" required>
        <option value="نشط" {{ old('status', $employee->status ?? '') == 'نشط' ? 'selected' : '' }}>نشط</option>
        <option value="غير نشط" {{ old('status', $employee->status ?? '') == 'غير نشط' ? 'selected' : '' }}>غير نشط</option>
    </select>
</div>

<div class="mb-3">
    <label>الدور</label>
    <input type="text" name="role" class="form-control" value="{{ old('role', $employee->role ?? '') }}" required>
</div>

<div class="mb-3">
    <label>الراتب</label>
    <input type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary', $employee->salary ?? '') }}" required>
</div>

<div class="mb-3">
    <label>القسم</label>
    <select name="department_id" class="form-control" required>
        <option value="">اختر القسم</option>
        @foreach ($departments as $dep)
            <option value="{{ $dep->id }}" {{ old('department_id', $employee->department_id ?? '') == $dep->id ? 'selected' : '' }}>
                {{ $dep->name }}
            </option>
        @endforeach
    </select>
</div>
