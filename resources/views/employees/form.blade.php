{{--<main>--}}
{{--<div class="mb-3">--}}
{{--    <label>الاسم</label>--}}
{{--    <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name ?? '') }}" required>--}}
{{--</div>--}}

{{--<div class="mb-3">--}}
{{--    <label>رقم الهاتف</label>--}}
{{--    <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone ?? '') }}" required>--}}
{{--</div>--}}

{{--<div class="mb-3">--}}
{{--    <label>كلمة المرور</label>--}}
{{--    <input type="password" name="password" class="form-control" {{ isset($employee) ? '' : 'required' }}>--}}
{{--</div>--}}

{{--<div class="mb-3">--}}
{{--    <label>الحالة</label>--}}
{{--    <select name="status" class="form-control" required>--}}
{{--        <option value="نشط" {{ old('status', $employee->status ?? '') == 'نشط' ? 'selected' : '' }}>نشط</option>--}}
{{--        <option value="غير نشط" {{ old('status', $employee->status ?? '') == 'غير نشط' ? 'selected' : '' }}>غير نشط</option>--}}
{{--    </select>--}}
{{--</div>--}}

{{--<div class="mb-3">--}}
{{--    <label>الدور</label>--}}
{{--    <input type="text" name="role" class="form-control" value="{{ old('role', $employee->role ?? '') }}" required>--}}
{{--</div>--}}

{{--<div class="mb-3">--}}
{{--    <label>الراتب</label>--}}
{{--    <input type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary', $employee->salary ?? '') }}" required>--}}
{{--</div>--}}

{{--<div class="mb-3">--}}
{{--    <label>القسم</label>--}}
{{--    <select name="department_id" class="form-control" required>--}}
{{--        <option value="">اختر القسم</option>--}}
{{--        @foreach ($departments as $dep)--}}
{{--            <option value="{{ $dep->id }}" {{ old('department_id', $employee->department_id ?? '') == $dep->id ? 'selected' : '' }}>--}}
{{--                {{ $dep->name }}--}}
{{--            </option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--</div>--}}
{{--</main>--}}
<div class="row g-4 align-items-center">
    <div class="col-12 col-md-8">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-bold">الاسم</label>
                <input type="text" name="name" class="summary-input flex-grow-1 w-100 w-md-auto" value="{{ old('name', $employee->name ?? '') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">رقم الهاتف</label>
                <input type="text" name="phone" class="summary-input flex-grow-1 w-100 w-md-auto" value="{{ old('phone', $employee->phone ?? '') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">كلمة المرور</label>
                <input type="password" name="password" class=" summary-input flex-grow-1 w-100 w-md-auto" {{ isset($employee) ? '' : 'required' }}>
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">الحالة</label>
                <select name="status" class="summary-input flex-grow-1 w-100 w-md-auto" required>
                    <option value="نشط" {{ old('status', $employee->status ?? '') == 'نشط' ? 'selected' : '' }}>نشط</option>
                    <option value="غير نشط" {{ old('status', $employee->status ?? '') == 'غير نشط' ? 'selected' : '' }}>غير نشط</option>
                </select>

            </div>
            <div class="col-6">
                <label class="form-label fw-bold">الدور</label>
                <input type="text" name="role" class="summary-input flex-grow-1 w-100 w-md-auto"  value="{{ old('role', $employee->role ?? '') }}" required>
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">الراتب</label>
                <input type="number" step="0.01" name="salary" class="summary-input flex-grow-1 w-100 w-md-auto"  value="{{ old('salary', $employee->salary ?? '') }}" required>
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">القسم</label>
                <select name="department_id" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" required>
                    <option >القسم</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-new-invoice w-50 ">اضافة</button>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 text-center order-1 order-md-0 mb-3 mb-md-0">
        <img id="product-preview" src="{{ asset('assets/images/account.png') }}" alt="Product Illustration" class="img-fluid " style="max-width: 220px;">
    </div>

</div>


