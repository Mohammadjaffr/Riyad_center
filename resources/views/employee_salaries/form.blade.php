            <div class="mb-3">
                <label class="form-label fw-bold">الموظف</label>
                <select name="employee_id" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right"  required>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">المبلغ</label>
                <input type="number" step="0.01" name="amount" class="summary-input flex-grow-1 w-100 w-md-auto"   required>

            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">تاريخ الدفع</label>
                <input type="date" name="pay_date" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right"  value="{{ date('Y-m-d') }}" required>

            </div>


            <div class="mb-3">
                <label class="form-label fw-bold">ملاحظات</label>
                <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">حفظ</button>


