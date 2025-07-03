<div class="mb-3">
    <label class="form-label fw-bold">اسم الزبون (اختياري)</label>
    <input type="text" name="customer_name" class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right">

</div>
<div class="mb-3">
    <label class="form-label fw-bold">القسم</label>
    <select name="department_id" class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('department_id') ? 'is-invalid' : '' }}"  style="text-align: right" >
        <option value="">اختر القسم</option>
        @foreach($departments as $dep)
            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
        @endforeach
    </select>
    @error('department_id')
    <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
    @enderror
 </div>

<div class="mb-3">
    <label class="form-label fw-bold">تاريخ البيع</label>
    <input type="date" name="sale_date" class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('sale_date') ? 'is-invalid' : '' }}"   style="text-align: right" >
    @error('sale_date')
    <span class="invalid-feedback text-end d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
    @enderror
</div>

<hr>
<h5 style="color: var(--dark-blue);">تفاصيل المنتجات</h5>

<table class="table table-bordered align-middle text-center custom-invoice-table mb-0 table-striped" id="items-table">
    <thead class="table-secondary">
    <tr>
        <th>المتغير (المقاس - اللون)</th>
        <th>الكمية</th>
        <th>سعر الوحدة</th>
        <th>سعر الصرف</th>
        <th>الإجمالي</th>
        <th><i class="fa fa-trash"></i></th>
    </tr>
    </thead>
    <tbody>
    <tr class="product-row">
        <td>
            <select name="variant_id[]" class="summary-input flex-grow-1 w-100 w-md-auto variant-select" style="text-align: right" required>
                <option  disabled selected>اختر متغير</option>
                @foreach($products as $product)
                    @foreach($product->variants as $variant)
                        <option value="{{ $variant->id }}" data-price="{{ $variant->sell_price }}" data-stock="{{ $variant->quantity }}">
                            {{ $product->name }} - {{ $variant->size }} - {{ $variant->color }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </td>
        <td><input type="number" name="quantity[]" class="summary-input flex-grow-1 w-100 w-md-auto quantity" min="1" value="1" required></td>
        <td><input type="number" step="0.01" name="unit_price[]" class="summary-input flex-grow-1 w-100 w-md-auto unit_price" required readonly></td>
        <td><input type="number" step="0.01" name="exchange_rate[]" class="summary-input flex-grow-1 w-100 w-md-auto exchange_rate" value="1"></td>
        <td><input type="text" class="summary-input flex-grow-1 w-100 w-md-auto total_price" readonly></td>
        <td><button type="button" class="btn btn-danger btn-sm remove-item"><i class="fa fa-trash"></i></button></td>
    </tr>
    </tbody>
</table>
<button type="button" class="btn btn-new-invoice my-2" id="add-item">إضافة </button>

<div class="mb-3">
    <label class="form-label fw-bold">ملاحظات</label>
    <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto"   style="text-align: right"></textarea>
</div>

<button type="submit" class="btn btn-primary">حفظ</button>
<a href="{{route('sales.index')}}" class="btn btn-outline-blue">رجوع</a>


<script>
    // تحديث السعر عند تغيير المتغير
    document.addEventListener('change', function(e) {
        if (e.target.matches('.variant-select')) {
            const select = e.target;
            const tr = select.closest('tr');
            const selectedOption = select.options[select.selectedIndex];
            const price = selectedOption.getAttribute('data-price') || 0;
            const stock = selectedOption.getAttribute('data-stock') || 0;

            tr.querySelector('.unit_price').value = parseFloat(price).toFixed(2);
            tr.querySelector('.quantity').max = stock;
            tr.querySelector('.quantity').value = 1;

            updateRowTotal(tr);
            updateInvoiceTotal();
        }
    });

    // تحديث الإجمالي لكل صف عند تغيير الكمية أو سعر الوحدة
    document.addEventListener('input', function(e) {
        if (e.target.matches('.quantity') || e.target.matches('.unit_price') || e.target.matches('.exchange_rate')) {
            const tr = e.target.closest('tr');
            updateRowTotal(tr);
            updateInvoiceTotal();
        }
    });

    // إضافة صف جديد
    document.getElementById('add-item').addEventListener('click', function () {
        const tbody = document.querySelector('#items-table tbody');
        const firstRow = tbody.querySelector('tr');
        const newRow = firstRow.cloneNode(true);

        // إعادة تعيين القيم في الصف الجديد
        newRow.querySelector('select.variant-select').selectedIndex = 0;
        newRow.querySelector('.unit_price').value = '';
        newRow.querySelector('.quantity').value = 1;
        newRow.querySelector('.quantity').max = '';
        newRow.querySelector('.exchange_rate').value = 1;
        newRow.querySelector('.total_price').value = '';

        tbody.appendChild(newRow);
    });

    // حذف صف
    document.querySelector('#items-table tbody').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item') || e.target.closest('.remove-item')) {
            const rows = this.querySelectorAll('tr');
            if (rows.length > 1) {
                e.target.closest('tr').remove();
                updateInvoiceTotal();
            } else {
                alert('يجب أن تحتوي الفاتورة على عنصر واحد على الأقل');
            }
        }
    });

    function updateRowTotal(tr) {
        const qtyInput = tr.querySelector('.quantity');
        const unitPriceInput = tr.querySelector('.unit_price');
        const exchangeRateInput = tr.querySelector('.exchange_rate');
        const totalInput = tr.querySelector('.total_price');

        let qty = parseFloat(qtyInput.value);
        let unitPrice = parseFloat(unitPriceInput.value);
        let exchangeRate = parseFloat(exchangeRateInput.value);

        if (isNaN(qty) || qty < 1) qty = 1;
        if (isNaN(unitPrice) || unitPrice < 0) unitPrice = 0;
        if (isNaN(exchangeRate) || exchangeRate < 0) exchangeRate = 1;

        const total = qty * unitPrice * exchangeRate;
        totalInput.value = total.toFixed(2);
    }

    function updateInvoiceTotal() {
        let total = 0;
        document.querySelectorAll('#items-table tbody tr').forEach(tr => {
            const totalInput = tr.querySelector('.total_price');
            let val = parseFloat(totalInput.value);
            if (!isNaN(val)) total += val;
        });

        document.getElementById('invoice-total').textContent = total.toFixed(2);
        document.getElementById('total_amount').value = total.toFixed(2);
    }

    // تحديث الإجمالي عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('#items-table tbody tr').forEach(tr => {
            updateRowTotal(tr);
        });
        updateInvoiceTotal();
    });

    // معاينة الفاتورة - تعيين بيانات النموذج إلى النافذة المنبثقة
    function previewInvoice() {
        document.getElementById('preview_customer_name').textContent = document.querySelector('input[name=customer_name]').value;
        document.getElementById('preview_department').textContent = document.querySelector('select[name=department_id] option:checked').textContent;
        document.getElementById('preview_employee').textContent = document.querySelector('select[name=employee_id] option:checked').textContent;
        document.getElementById('preview_invoice_date').textContent = document.querySelector('input[name=invoice_date]').value;

        // افرغ جدول العناصر
        const previewItems = document.getElementById('preview_items');
        previewItems.innerHTML = '';

        // املأ الجدول بالعناصر
        document.querySelectorAll('#items-table tbody tr').forEach(tr => {
            const variantText = tr.querySelector('select.variant-select option:checked')?.textContent || '';
            const qty = tr.querySelector('.quantity').value || 0;
            const unitPrice = tr.querySelector('.unit_price').value || 0;
            const total = tr.querySelector('.total_price').value || 0;

            if (!variantText) return;

            const row = document.createElement('tr');
            row.innerHTML = `
                    <td>${variantText}</td>
                    <td>${qty}</td>
                    <td>${parseFloat(unitPrice).toFixed(2)}</td>
                    <td>${parseFloat(total).toFixed(2)}</td>
                `;
            previewItems.appendChild(row);
        });

        // الخصم، المدفوع، المتبقي
        const discount = parseFloat(document.querySelector('input[name=discount_amount]').value) || 0;
        const paid = parseFloat(document.querySelector('input[name=paid_amount]').value) || 0;
        const totalAmount = parseFloat(document.getElementById('total_amount').value) || 0;
        const rest = totalAmount - discount - paid;

        document.getElementById('preview_discount').textContent = discount.toFixed(2);
        document.getElementById('preview_paid').textContent = paid.toFixed(2);
        document.getElementById('preview_rest').textContent = rest.toFixed(2);
    }

    document.addEventListener('input', function(e) {
        if (e.target.matches('.quantity')) {
            const qtyInput = e.target;
            const tr = qtyInput.closest('tr');
            const select = tr.querySelector('select.variant-select');
            const selectedOption = select.options[select.selectedIndex];
            const maxStock = parseInt(selectedOption.getAttribute('data-stock')) || 0;
            let qty = parseInt(qtyInput.value) || 1;
            if (qty > maxStock) {
                alert('الكمية غير كافية في المخزن! الحد الأقصى المتاح: ' + maxStock);
                qtyInput.value = maxStock > 0 ? maxStock : 1;
                updateRowTotal(tr);
                updateInvoiceTotal();
            }
        }
    });
</script>
