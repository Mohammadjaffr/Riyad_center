@extends('layouts.master')
@section('title', 'تعديل فاتورة')
@section('content')
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
                            <label class="form-label fw-bold">رقم الفاتورة</label>
                            <input type="text" name="invoice_num" value="{{ $invoice->invoice_num }}" class="summary-input flex-grow-1 w-100 w-md-auto" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">التاريخ</label>
                            <input type="date" name="invoice_date" value="{{ $invoice->invoice_date }}" class="summary-input flex-grow-1 w-100 w-md-auto">
                        </div>
                    </div>
                </div>

                <!-- العناصر -->
                <table class="table table-bordered" id="items-table">
                    <thead class="table-secondary">
                    <tr>
                        <th>المنتج</th>
                        <th>الكمية</th>
                        <th>سعر الوحدة</th>
                        <th>الإجمالي</th>
                        <th>إجراء</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoice->items as $item)
                        <tr>
                            <td>
                                <select name="product_id[]" class="summary-input flex-grow-1 w-100 w-md-auto">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="quantity[]" class="summary-input flex-grow-1 w-100 w-md-auto quantity" value="{{ $item->quantity }}" min="1"></td>
                            <td><input type="number" name="unit_price[]" class="summary-input flex-grow-1 w-100 w-md-auto unit_price" step="0.01" value="{{ $item->unit_price }}"></td>
                            <td><input type="text" class="summary-input flex-grow-1 w-100 w-md-auto total_price" value="{{ $item->total_price }}" readonly></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-item">حذف</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

{{--                <button type="button" class="btn btn-secondary mt-2 mb-3" id="add-item">+ إضافة عنصر</button>--}}
                <button type="button" class="btn btn-new-invoice my-2" id="add-item">إضافة </button>

                <!-- الملخص -->
                <div class="summary-box-custom rounded-4 p-3 mb-4">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label>الخصم</label>
                            <input type="number" name="discount_amount" class="summary-input flex-grow-1 w-100 w-md-auto" value="{{ $invoice->discount_amount }}">
                        </div>
                        <div class="col-md-4">
                            <label>المدفوع</label>
                            <input type="number" name="paid_amount" class="summary-input flex-grow-1 w-100 w-md-auto" value="{{ $invoice->paid_amount }}">
                        </div>
                        <div class="col-md-4">
                            <label>طريقة الدفع</label>
                            <select name="payment_type" class="summary-input flex-grow-1 w-100 w-md-auto">
                                <option value="نقدي" {{ $invoice->payment_type == 'نقدي' ? 'selected' : '' }}>نقدي</option>
                                <option value="آجل" {{ $invoice->payment_type == 'آجل' ? 'selected' : '' }}>آجل</option>
                                <option value="تحويل" {{ $invoice->payment_type == 'تحويل' ? 'selected' : '' }}>تحويل</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label>ملاحظات</label>
                            <input type="text" name="notes" class="summary-input flex-grow-1 w-100 w-md-auto" value="{{ $invoice->notes }}">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-new-invoice">تحديث الفاتورة</button>
                        <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JS لحساب الإجماليات -->
    <script>
        function calculateRowTotal(row) {
            const qty = parseFloat(row.querySelector('.quantity').value) || 0;
            const price = parseFloat(row.querySelector('.unit_price').value) || 0;
            const total = qty * price;
            row.querySelector('.total_price').value = total.toFixed(2);
        }

        function updateAllTotals() {
            document.querySelectorAll('#items-table tbody tr').forEach(row => calculateRowTotal(row));
        }

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('quantity') || e.target.classList.contains('unit_price')) {
                updateAllTotals();
            }
        });

        document.getElementById('add-item').addEventListener('click', function () {
            const firstRow = document.querySelector('#items-table tbody tr');
            const newRow = firstRow.cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            document.querySelector('#items-table tbody').appendChild(newRow);
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                const row = e.target.closest('tr');
                row.remove();
            }
        });

        document.addEventListener('DOMContentLoaded', updateAllTotals);
    </script>
@endsection
