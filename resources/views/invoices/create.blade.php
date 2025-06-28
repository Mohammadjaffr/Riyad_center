@extends('layouts.master')
@section('title', 'إنشاء فاتورة')
@section('content')
    <div class="container">
        <h2 class="mb-4">إنشاء فاتورة جديدة</h2>

        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col">
                    <label>اسم العميل</label>
                    <input type="text" name="customer_name" class="form-control">
                </div>

                <div class="col">
                    <label>القسم</label>
                    <select name="department_id" class="form-select">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>رقم الفاتورة</label>
                    <input type="number" name="invoice_num" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label>الموظف</label>
                    <select name="employee_id" class="form-select">
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label>تاريخ الفاتورة</label>
                    <input type="date" name="invoice_date" class="form-control" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col">
                    <label>طريقة الدفع</label>
                    <select name="payment_type" class="form-select">
                        <option value="نقدي">نقدي</option>
                        <option value="آجل">آجل</option>
                        <option value="تحويل">تحويل</option>
                    </select>
                </div>
            </div>

            <hr>

            <h5>عناصر الفاتورة</h5>
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
                <tr>
                    <td>
                        <select name="product_id[]" class="form-select">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="quantity[]" class="form-control quantity" min="1" value="1"></td>
                    <td><input type="number" step="0.01" name="unit_price[]" class="form-control unit_price"></td>
                    <td><input type="text" class="form-control total_price" readonly></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-item">حذف</button></td>
                </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-secondary mb-3" id="add-item">+ إضافة عنصر</button>

            <div class="row mb-3">
                <div class="col">
                    <label>الخصم</label>
                    <input type="number" step="0.01" name="discount_amount" class="form-control" value="0">
                </div>
                <div class="col">
                    <label>المدفوع</label>
                    <input type="number" step="0.01" name="paid_amount" class="form-control" value="0">
                </div>
                <div class="col">
                    <label>ملاحظات</label>
                    <input type="text" name="notes" class="form-control">
                </div>
                <div class="col">
                    <label>اجمالي الفاتوره</label>
                    <div class="border rounded p-2" id="invoice-total">0.00</div>
                    <input type="hidden" name="total_amount" id="total_amount">
                </div>
            </div>

            <button type="submit" class="btn btn-success">حفظ الفاتورة</button>
        </form>
    </div>
    <script>
        function calculateRowTotal(row) {
            const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
            const unitPrice = parseFloat(row.querySelector('.unit_price').value) || 0;
            const total = quantity * unitPrice;
            row.querySelector('.total_price').value = total.toFixed(2);
            return total;
        }

        function calculateInvoiceTotal() {
            let total = 0;
            document.querySelectorAll('#items-table tbody tr').forEach(row => {
                total += calculateRowTotal(row);
            });

            const discount = parseFloat(document.querySelector('[name="discount_amount"]').value) || 0;
            const grandTotal = total - discount;

            document.getElementById('invoice-total').textContent = grandTotal.toFixed(2);
            document.getElementById('total_amount').value = grandTotal.toFixed(2);
        }

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('quantity') || e.target.classList.contains('unit_price') || e.target.name === 'discount_amount') {
                calculateInvoiceTotal();
            }
        });

        // إعادة حساب بعد الإضافة
        document.getElementById('add-item').addEventListener('click', function () {
            const newRow = document.querySelector('#items-table tbody tr').cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            document.querySelector('#items-table tbody').appendChild(newRow);
        });

        // حذف صف
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('tr').remove();
                calculateInvoiceTotal();
            }
        });

        // تشغيل الحساب أول مرة
        document.addEventListener('DOMContentLoaded', calculateInvoiceTotal);
    </script>

    <script>
        document.getElementById('add-item').addEventListener('click', function () {
            let row = document.querySelector('#items-table tbody tr');
            let clone = row.cloneNode(true);
            clone.querySelectorAll('input').forEach(input => input.value = '');
            document.querySelector('#items-table tbody').appendChild(clone);
        });

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('quantity') || e.target.classList.contains('unit_price')) {
                let row = e.target.closest('tr');
                let qty = parseFloat(row.querySelector('.quantity').value) || 0;
                let price = parseFloat(row.querySelector('.unit_price').value) || 0;
                row.querySelector('.total_price').value = (qty * price).toFixed(2);
            }
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
@endsection
