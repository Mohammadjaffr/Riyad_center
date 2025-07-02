            <div class="mb-3">
                <label class="form-label fw-bold">الموظف</label>
                <select name="employee_id" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right"  >
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                    @endforeach
                        @error('employee_id')
                        <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">المبلغ</label>
                <input type="number" step="0.01" name="amount" class="summary-input flex-grow-1 w-100 w-md-auto"   >
                @error('amount')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">تاريخ الدفع</label>
                <input type="date" name="pay_date" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right"  value="{{ date('Y-m-d') }}" >
                @error('pay_date')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label fw-bold">ملاحظات</label>
                <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right"></textarea>
                @error('notes')
                <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">حفظ</button>
            <a href="{{route('employee-salaries.index')}}"  class="btn btn-outline-blue">رجوع</a>


