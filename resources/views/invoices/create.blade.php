@extends('layouts.master')
@section('title', 'إنشاء فاتورة')
@section('content')
    <div class="container" style="background: #f6f7fa">
        <div class="invoice-container px-2 px-md-4">
            <!-- Header -->
            <div class="invoice-header px-2 rounded-4 mb-3">
                <h4>إضافة فاتورة جديدة</h4>
                <a href="{{ route('invoices.create') }}" class="btn btn-new-invoice mb-2 mb-md-0"><span> فاتورة جديدة </span></a>
            </div>
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h5>أخطاء في التحقق من صحة البيانات:</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <h5>خطأ:</h5>
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Invoice Info -->
                <div class="invoice-info-box rounded-4 p-3 mb-4">
                    <div class="row align-items-center ">
                        <!-- Right Info -->
                        <div class="col-12 col-md-4 text-end mb-3 mb-md-0">

                        </div>
                        <!-- Logo Center -->
                        <div class="col-12 col-md-4 text-center mb-3 mb-md-0 align-items-center">
                            <img src="{{asset('assets/images/logo.png')}}" alt="Logo" style="max-width: 100px;">
                            <br class="d-none d-md-block"><br class="d-none d-md-block">
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">اسم الموظف:</label>
                                <select name="employee_id" class="summary-input flex-grow-1 w-100 w-md-auto" style="text-align: right" required>
                                    @foreach($employees as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">القسم</label>
                                <select name="department_id" class="summary-input flex-grow-1 w-100 w-md-auto "   style="text-align: right" required>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">رقم الفاتورة:</label>
                                <input  type="number"  name="invoice_num" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" style="text-align: right" placeholder="رقم الفاتورة"  value="{{ old('invoice_num', $invoice_num) }}" readonly required>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">اسم العميل:</label>
                                <input type="text" name="customer_name" class="summary-input flex-grow-1 w-100 w-md-auto " required>

                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">التاريخ:</label>
                                <input type="date"  name="invoice_date" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" style="text-align: right" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-12 col-md-4">

                                <label class="form-label fw-bold">طريقة الدفع:</label>
                                <select name="payment_type" class="summary-input flex-grow-1 w-100 w-md-auto "   style="text-align: right">
                                    <option value="نقدي">نقدي</option>
                                    <option value="آجل">آجل</option>
                                    <option value="تحويل">تحويل</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
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
                    </div>
                    <button type="button" class="btn btn-new-invoice my-2" id="add-item">إضافة </button>


                    <!-- Summary -->
                    <div class="summary-box-custom rounded-4 p-3 mb-4">
                        <div class="row mb-2">
                            <div class="col-12 text-end">
                                <span class="fw-bold ms-5" style="font-size:1.2rem;">المجموع</span>
                                <span  class="fw-bold d-inline-block ms-3" style="font-size:1.2rem;" id="invoice-total">0.00</span>
                                <input type="hidden" name="total_amount" id="total_amount">
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center gx-2">
                            <div class="col-12 col-md-4 mb-2 mb-md-0">
                                <div class="d-flex align-items-center justify-content-end">
                                    <span class="fw-bold ms-2">المدفوع</span>
                                    <input type="number" step="0.01" name="paid_amount" class="table-input ms-2" style="max-width:100px;" value="0">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-2 mb-md-0">
                                <div class="d-flex align-items-center justify-content-end">
                                    <span class="fw-bold ms-2">الخصم</span>
                                    <input type="number" step="0.01" name="discount_amount" class="table-input ms-2" style="max-width:100px;" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex align-items-center flex-column flex-md-row">
                                    <span class="fw-bold ms-2 mb-2 mb-md-0">الملاحظات</span>
                                    <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-start">
                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-start">
                                    <button type="submit" class="btn btn-new-invoice">حفظ</button>
                                    <button type="button" class="btn btn-new-invoice" onclick="previewInvoice()" data-bs-toggle="modal" data-bs-target="#invoicePreviewModal">
                                        معاينة الفاتورة
                                    </button>
                                    <a href="{{ route('invoices.index') }}" class="btn btn-outline-danger ms-2">إلغاء</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal للمعاينة -->
        <div class="modal fade" id="invoicePreviewModal" tabindex="-1" aria-labelledby="invoicePreviewLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-dark-blue text-white">
                        <h5 class="modal-title fw-bold" id="invoicePreviewLabel">
                            <i class="fa fa-eye me-2"></i>
                            معاينة الفاتورة
                        </h5>

                        <button type="button" class="btn-close btn-close-white ms-5" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div id="invoicePreview">
                            <!-- معلومات الفاتورة الأساسية -->
                            <div class="invoice-info-box rounded-4 p-4 mb-4">
                                <div class="row">
                                    <div class="col-12 text-center mb-3">
                                        <img src="{{asset('assets/images/logo.png')}}" alt="Logo" style="max-width: 80px;">
                                        <h4 class="text-dark-blue mt-2 mb-0">فاتورة</h4>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="fw-bold text-dark-blue me-3" style="min-width: 100px;">اسم العميل:</span>
                                            <span id="preview_customer_name" class="fw-normal border-bottom border-2 border-dark-blue px-2 py-1 flex-grow-1"></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="fw-bold text-dark-blue me-3" style="min-width: 100px;">القســـــــــــــم:</span>
                                            <span id="preview_department" class="fw-normal border-bottom border-2 border-dark-blue px-2 py-1 flex-grow-1"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="fw-bold text-dark-blue me-3" style="min-width: 100px;">الموظـــــــــــف:</span>
                                            <span id="preview_employee" class="fw-normal border-bottom border-2 border-dark-blue px-2 py-1 flex-grow-1"></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="fw-bold text-dark-blue me-3" style="min-width: 100px;">تاريخ الفاتورة:</span>
                                            <span id="preview_invoice_date" class="fw-normal border-bottom border-2 border-dark-blue px-2 py-1 flex-grow-1"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- جدول المنتجات -->
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered align-middle text-center custom-invoice-table table-striped">
                                    <thead class="table-secondary">
                                    <tr>
                                        <th class="fw-bold">المتغير (المقاس - اللون)</th>
                                        <th class="fw-bold">الكمية</th>
                                        <th class="fw-bold">سعر الوحدة</th>
                                        <th class="fw-bold">الإجمالي</th>
                                    </tr>
                                    </thead>
                                    <tbody id="preview_items">
                                    </tbody>
                                </table>
                            </div>

                            <!-- ملخص المبالغ -->
                            <div class="summary-box-custom rounded-4 p-4">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="d-flex  align-items-center">
                                            <span class="fw-bold text-dark-blue ms-1">الخصم:</span>
                                            <span id="preview_discount" class="fw-bold ms-1">0.00</span>
                                            <span class="text-muted">%</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex  align-items-center">
                                            <span class="fw-bold text-dark-blue ms-1">المدفوع:</span>
                                            <span id="preview_paid" class="fw-bold  ms-1">0.00</span>
                                            <span class="text-muted">ريال</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex  align-items-center">
                                            <span class="fw-bold text-dark-blue ms-1">المتبقي:</span>
                                            <span id="preview_rest" class="fw-bold  ms-1">0.00</span>
                                            <span class="text-muted">ريال</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal for Quantity Error -->
<div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quantityModalLabel">تنبيه</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button> -->
      </div>
      <div class="modal-body" id="quantityModalMessage">
        <!-- سيتم وضع رسالة الخطأ هنا -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        //   تحديث المجموع بالنسبة  للخصم 
            const discountPercent = parseFloat(document.querySelector('input[name=discount_amount]').value) || 0;
            const discountValue = total * (discountPercent / 100);
            const finalTotal = total - discountValue;

            document.getElementById('invoice-total').textContent = finalTotal.toFixed(2);
            document.getElementById('total_amount').value = finalTotal.toFixed(2);
        }

        // تحديث الإجمالي عند تغيير الخصم
        document.querySelector('input[name=discount_amount]').addEventListener('input', function() {
            updateInvoiceTotal();
        });

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
        function showQuantityModal(message) {
    document.getElementById('quantityModalMessage').innerText = message;
    var myModal = new bootstrap.Modal(document.getElementById('quantityModal'));
    myModal.show();
}

        // التحقق من الكمية عند إدخالها
        document.addEventListener('input', function(e) {
            if (e.target.matches('.quantity')) {
                const qtyInput = e.target;
                const tr = qtyInput.closest('tr');
                const select = tr.querySelector('select.variant-select');
                const selectedOption = select.options[select.selectedIndex];
                const maxStock = parseInt(selectedOption.getAttribute('data-stock')) || 0;
                let qty = parseInt(qtyInput.value) || 1;
                if (qty > maxStock) {
                    showQuantityModal('الكمية غير كافية في المخزن! الحد الأقصى المتاح: ' + maxStock);
                    // alert('الكمية غير كافية في المخزن! الحد الأقصى المتاح: ' + maxStock);
                    qtyInput.value = maxStock > 0 ? maxStock : 1;
                    updateRowTotal(tr);
                    updateInvoiceTotal();
                }
            }
        });
    </script>
@endsection
