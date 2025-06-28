
<div class="mb-3">
    <label class="form-label fw-bold">اختر الفاتورة</label>
    <select name="invoice_id"  class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right;" >
        @foreach($invoices as $invoice)
            <option value="{{ $invoice->id }}">فاتورة رقم {{ $invoice->invoice_num }} - {{ $invoice->customer_name }}</option>
        @endforeach
    </select>
 </div>


<div class="mb-3">
    <label class="form-label fw-bold">تاريخ الدفع</label>
    <input type="date" name="payment_date" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" value="{{ date('Y-m-d') }}">

</div>
<div class="mb-3">
    <label class="form-label fw-bold">المبلغ</label>
    <input type="number" step="0.01" name="amount" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right" required>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">طريقة الدفع</label>
    <select name="payment_method"  class="summary-input flex-grow-1 w-100 w-md-auto"  style="text-align: right" >
        <option value="نقدي">نقدي</option>
        <option value="تحويل">تحويل</option>
        <option value="آجل">آجل</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">ملاحظات</label>
    <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right"></textarea>
</div>



