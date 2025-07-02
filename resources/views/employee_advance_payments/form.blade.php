    <div class="mb-3">
        <label for="employee_id" class="form-label fw-bold">الموظف</label>
        <select name="employee_id" class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right" required>
            <option value="">اختر موظف</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="amount" class="form-label fw-bold">المبلغ</label>
        <input type="number" step="0.01" name="amount" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" required>
    </div>

    <div class="mb-3">
        <label for="payment_date" class="form-label fw-bold">تاريخ الصرف</label>
        <input type="date" name="payment_date" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" value="{{ date('Y-m-d') }}" required>

        <label for="reason" class="form-label fw-bold">سبب الصرفية</label>
        <textarea name="reason" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right" required></textarea>
    </div>

    <div class="mb-3">
        <label for="notes" class="form-label fw-bold">ملاحظات إضافية (اختياري)</label>
        <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right"></textarea>
    </div>

