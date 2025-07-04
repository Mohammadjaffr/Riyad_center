@extends('layouts.master')
@section('title', 'تعديل فاتورة')
@section('content')
    @if(session('error'))
        <div class="alert alert-danger text-end">{{ session('error') }}</div>
    @endif

    <div class="container" style="background: #f6f7fa">
        <div class="invoice-container px-2 px-md-4">
            <div class="invoice-header px-2 rounded-4 mb-3">
                <h4>تعديل الفاتورة رقم {{ $invoice->invoice_num }}</h4>
            </div>

            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- معلومات الفاتورة -->
                <div class="invoice-info-box rounded-4 p-3 mb-4">
                    <div class="row g-2 mb-2">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">اسم الموظف</label>
                            <select name="employee_id" class="summary-input flex-grow-1 w-100 w-md-auto">
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}" {{ $invoice->employee_id == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">القسم</label>
                            <select name="department_id" class="summary-input flex-grow-1 w-100 w-md-auto">
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ $invoice->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">اسم العميل</label>
                            <input type="text" name="customer_name" class="summary-input flex-grow-1 w-100 w-md-auto" value="{{ $invoice->customer_name }}">
                        </div>
                        <!-- <div class="col-md-3">
                            <label class="form-label fw-bold">رقم الفاتورة</label>
                            <input type="text" name="invoice_num" value="{{ $invoice->invoice_num }}" class="summary-input flex-grow-1 w-100 w-md-auto" readonly>
                        </div> -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">التاريخ</label>
                            <input type="date" name="invoice_date" value="{{ $invoice->invoice_date }}" class="summary-input flex-grow-1 w-100 w-md-auto" readonly>
                        </div>

                    </div>
                </div>

                <!-- العناصر -->
                <table class="table table-bordered align-middle text-center custom-invoice-table mb-0 table-striped" id="items-table">
                    <thead class="table-secondary">
                    <tr>
                        <th>المتغير (المقاس - اللون)</th>
                        <th>الكمية</th>
                        <th>سعر الوحدة</th>
                        <th>الإجمالي</th>
                        <th><i class="fa fa-trash"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoice->items as $item)
                        <tr>
                            <td>
                                <select name="variant_id[]" class="summary-input flex-grow-1 w-100 w-md-auto">
                                    @foreach($products as $product)
                                        @foreach($product->variants as $variant)
                                            <option value="{{ $variant->id }}"
                                                {{ $item->variant_id == $variant->id ? 'selected' : '' }}
                                                data-stock="{{ $variant->quantity }}"
                                                data-price="{{ $variant->sell_price }}">
                                                {{ $product->name }} - {{ $variant->size }} - {{ $variant->color }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="quantity[]" class="summary-input flex-grow-1 w-100 w-md-auto quantity" value="{{ $item->quantity }}" min="1"></td>
                            <td><input type="number" name="unit_price[]" class="summary-input flex-grow-1 w-100 w-md-auto unit_price" step="0.01" value="{{ $item->unit_price }}"></td>
                            <td><input type="text" class="summary-input flex-grow-1 w-100 w-md-auto total_price" value="{{ $item->total_price }}" readonly></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-item"><i class="fa fa-trash"></i></button></td>

{{--                            <td><button type="button" class="btn btn-danger btn-sm remove-item">حذف</button></td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>

{{--                <button type="button" class="btn btn-secondary mt-2 mb-3" id="add-item">+ إضافة عنصر</button>--}}
                <button type="button" class="btn btn-blue my-2" id="add-item">إضافة </button>

                <!-- الملخص -->
                <div class="summary-box-custom rounded-4 p-3 mb-4">
                <div class="row mb-2">
                            <div class="col-12 text-end">
                                <span class="fw-bold ms-5" style="font-size:1.2rem;">المجموع</span>
                                <!-- <span  class="fw-bold d-inline-block ms-3" style="font-size:1.2rem;" id="final_total">0.00</span> -->
                                <input type="text" id="final_total" class="summary-input flex-grow-1 w-100 w-md-auto" value="" readonly>

                                <input type="hidden" name="total_amount" id="total_amount">
                            </div>
                        </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label  class="form-label fw-bold">الخصم </label>
                            <input type="number" name="discount_amount" class="summary-input flex-grow-1 w-100 w-md-auto" value="{{ $invoice->discount_amount }}">
                        </div>
                        <div class="col-md-4">
                            <label  class="form-label fw-bold">المدفوع</label>
                            <input type="number" name="paid_amount" class="summary-input flex-grow-1 w-100 w-md-auto" value="{{ $invoice->paid_amount }}">
                        </div>
                        <div class="col-md-4">
                            <label  class="form-label fw-bold">طريقة الدفع</label>
                            <select name="payment_type" class="summary-input flex-grow-1 w-100 w-md-auto">
                                <option value="نقدي" {{ $invoice->payment_type == 'نقدي' ? 'selected' : '' }}>نقدي</option>
                                <option value="آجل" {{ $invoice->payment_type == 'آجل' ? 'selected' : '' }}>آجل</option>
                                <option value="تحويل" {{ $invoice->payment_type == 'تحويل' ? 'selected' : '' }}>تحويل</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="row mb-2">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">المجموع </label>
                            <input type="text" id="final_total" class="summary-input flex-grow-1 w-100 w-md-auto" value="" readonly>
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <label  class="form-label fw-bold">ملاحظات</label>
                            <textarea name="notes" class="summary-textarea flex-grow-1 w-100 w-md-auto">{{ $invoice->notes }}</textarea>
{{--                            <input type="text" name="notes" class="summary-input flex-grow-1 w-100 w-md-auto" value="{{ $invoice->notes }}">--}}
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-blue">تحديث الفاتورة</button>
                        <a href="{{ route('invoices.index') }}" class="btn btn-outline-danger">إلغاء</a>
                    </div>
                </div>
            </form>
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

    <!-- JS لحساب الإجماليات -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function calculateRowTotal(row) {
            const qty = parseFloat(row.querySelector('.quantity').value) || 0;
            const price = parseFloat(row.querySelector('.unit_price').value) || 0;
            const total = qty * price;
            row.querySelector('.total_price').value = total.toFixed(2);
        }
        function showQuantityModal(message) {
    document.getElementById('quantityModalMessage').innerText = message;
    var myModal = new bootstrap.Modal(document.getElementById('quantityModal'));
    myModal.show();
}

        function updateAllTotals() {
            let total = 0;
            document.querySelectorAll('#items-table tbody tr').forEach(row => {
                calculateRowTotal(row);
                total += parseFloat(row.querySelector('.total_price').value) || 0;
            });
            // الخصم كنسبة مئوية
            const discountPercent = parseFloat(document.querySelector('input[name=discount_amount]').value) || 0;
            const discountValue = total * (discountPercent / 100);
            const finalTotal = total - discountValue;
            document.getElementById('final_total').value = finalTotal.toFixed(2);
        }

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('quantity') || e.target.classList.contains('unit_price') || e.target.name === 'discount_amount') {
                updateAllTotals();
            }
            if (e.target.classList.contains('quantity')) {
                const qtyInput = e.target;
                const tr = qtyInput.closest('tr');
                const select = tr.querySelector('select');
                const selectedOption = select.options[select.selectedIndex];
                const maxStock = parseInt(selectedOption.getAttribute('data-stock')) || 0;
                let qty = parseInt(qtyInput.value) || 1;
                if (qty > maxStock) {
                    showQuantityModal('الكمية غير كافية في المخزن! الحد الأقصى المتاح: ' + maxStock);
                    // alert('الكمية غير كافية في المخزن! الحد الأقصى المتاح: ' + maxStock);
                    qtyInput.value = maxStock > 0 ? maxStock : 1;
                    updateAllTotals();
                }
            }
        });

        document.getElementById('add-item').addEventListener('click', function () {
            const firstRow = document.querySelector('#items-table tbody tr');
            const newRow = firstRow.cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            document.querySelector('#items-table tbody').appendChild(newRow);
            updateAllTotals();
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                const row = e.target.closest('tr');
                row.remove();
                updateAllTotals();
            }
        });

        document.addEventListener('DOMContentLoaded', updateAllTotals);
    </script>
@endsection
