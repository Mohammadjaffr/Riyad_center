<div class="row g-4 align-items-center">
    <div class="col-12 col-md-8">
        <div class="row g-3 ">
            <div class="col-12">
                <label class="form-label fw-bold">الاسم</label>
                <input type="text" name="name" class="summary-input text-end flex-grow-1 w-100 w-md-auto  {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $employee->name ?? '') }}" >
                @error('name')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">رقم الهاتف</label>
                <input type="text" name="phone" class="summary-input text-end flex-grow-1 w-100 w-md-auto {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone', $employee->phone ?? '') }}" autocomplete="off" >
                @error('phone')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">كلمة المرور</label>
                <input type="password" name="password" class="summary-input text-end flex-grow-1 w-100 w-md-auto {{ $errors->has('password') ? 'is-invalid' : '' }}"  autocomplete="off" {{ isset($employee) ? '' : '' }}>
                @error('password')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">الحالة</label>
                <select name="status" class="summary-input text-end flex-grow-1 w-100 w-md-auto {{ $errors->has('status') ? 'is-invalid' : '' }}" >
                    <option value="نشط" {{ old('status', $employee->status ?? '') == 'نشط' ? 'selected' : '' }}>نشط</option>
                    <option value="غير نشط" {{ old('status', $employee->status ?? '') == 'غير نشط' ? 'selected' : '' }}>غير نشط</option>
                </select>
                @error('status')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">الدور</label>
                <select type="text" name="roles_name" class="summary-input text-end flex-grow-1 w-100 w-md-auto {{ $errors->has('roles_name') ? 'is-invalid' : '' }}">
                    <option disabled selected>اختر الدور</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('roles_name')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-6">
                <label class="form-label fw-bold">الراتب</label>
                <input type="number" step="0.01" name="salary" class="summary-input  text-end flex-grow-1 w-100 w-md-auto {{ $errors->has('salary') ? 'is-invalid' : '' }}"  value="{{ old('salary', $employee->salary ?? '') }}" >
                @error('salary')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-6">
                <label class="form-label fw-bold">القسم</label>
                <select name="department_id" class="summary-input text-end flex-grow-1 w-100 w-md-auto {{ $errors->has('department_id') ? 'is-invalid' : '' }}"   style="text-align: right" >
                    <option >القسم</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
    </div>
    <div class="col-12 col-md-4 text-center order-1 order-md-0 mb-3 mb-md-0">
        <img id="product-preview" src="{{ asset('assets/images/account.png') }}" alt="Product Illustration" class="img-fluid " style="max-width: 220px;">
    </div>

</div>


