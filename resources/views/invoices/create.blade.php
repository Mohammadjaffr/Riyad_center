@extends('layouts.master')
@section('title', 'إنشاء فاتورة')
@section('content')
{{--    <div class="container">--}}
{{--        <h2 class="mb-4">إنشاء فاتورة جديدة</h2>--}}

{{--        <form action="{{ route('invoices.store') }}" method="POST">--}}
{{--            @csrf--}}

{{--            <div class="row mb-3">--}}
{{--                <div class="col">--}}
{{--                    <label>اسم العميل</label>--}}
{{--                    <input type="text" name="customer_name" class="form-control">--}}
{{--                </div>--}}

{{--                <div class="col">--}}
{{--                    <label>القسم</label>--}}
{{--                    <select name="department_id" class="form-select">--}}
{{--                        @foreach($departments as $department)--}}
{{--                            <option value="{{ $department->id }}">{{ $department->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="col">--}}
{{--                    <label>رقم الفاتورة</label>--}}
{{--                    <input type="number" name="invoice_num" class="form-control" required>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row mb-3">--}}
{{--                <div class="col">--}}
{{--                    <label>الموظف</label>--}}
{{--                    <select name="employee_id" class="form-select">--}}
{{--                        @foreach($employees as $emp)--}}
{{--                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="col">--}}
{{--                    <label>تاريخ الفاتورة</label>--}}
{{--                    <input type="date" name="invoice_date" class="form-control" value="{{ date('Y-m-d') }}">--}}
{{--                </div>--}}

{{--                <div class="col">--}}
{{--                    <label>طريقة الدفع</label>--}}
{{--                    <select name="payment_type" class="form-select">--}}
{{--                        <option value="نقدي">نقدي</option>--}}
{{--                        <option value="آجل">آجل</option>--}}
{{--                        <option value="تحويل">تحويل</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <hr>--}}

{{--            <h5>عناصر الفاتورة</h5>--}}
{{--            <table class="table table-bordered" id="items-table">--}}
{{--                <thead class="table-secondary">--}}
{{--                <tr>--}}
{{--                    <th>المنتج</th>--}}
{{--                    <th>الكمية</th>--}}
{{--                    <th>سعر الوحدة</th>--}}
{{--                    <th>الإجمالي</th>--}}
{{--                    <th>إجراء</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <td>--}}
{{--                        <select name="product_id[]" class="form-select">--}}
{{--                            @foreach($products as $product)--}}
{{--                                <option value="{{ $product->id }}">{{ $product->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </td>--}}
{{--                    <td><input type="number" name="quantity[]" class="form-control quantity" min="1" value="1"></td>--}}
{{--                    <td><input type="number" step="0.01" name="unit_price[]" class="form-control unit_price"></td>--}}
{{--                    <td><input type="text" class="form-control total_price" readonly></td>--}}
{{--                    <td><button type="button" class="btn btn-danger btn-sm remove-item">حذف</button></td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}

{{--            <button type="button" class="btn btn-secondary mb-3" id="add-item">+ إضافة عنصر</button>--}}

{{--            <div class="row mb-3">--}}
{{--                <div class="col">--}}
{{--                    <label>الخصم</label>--}}
{{--                    <input type="number" step="0.01" name="discount_amount" class="form-control" value="0">--}}
{{--                </div>--}}
{{--                <div class="col">--}}
{{--                    <label>المدفوع</label>--}}
{{--                    <input type="number" step="0.01" name="paid_amount" class="form-control" value="0">--}}
{{--                </div>--}}
{{--                <div class="col">--}}
{{--                    <label>ملاحظات</label>--}}
{{--                    <input type="text" name="notes" class="form-control">--}}
{{--                </div>--}}
{{--                <div class="col">--}}
{{--                    <label>اجمالي الفاتوره</label>--}}
{{--                    <div class="border rounded p-2" id="invoice-total">0.00</div>--}}
{{--                    <input type="hidden" name="total_amount" id="total_amount">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <button type="submit" class="btn btn-success">حفظ الفاتورة</button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--code 2--}}
{{--<div class="rounded-4 p-3 mb-3" style="background: #fff;">--}}
{{--    <div class="row g-2 mb-2">--}}
{{--        <div class="col-12 col-md-3">--}}
{{--            <label class="form-label fw-bold ">اسم العميل:</label>--}}
{{--            <input type="text" name="customer_name" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" style="text-align: right" placeholder="اسم العميل">--}}
{{--        </div>--}}
{{--        <div class="col-12 col-md-3">--}}
{{--            <label class="form-label fw-bold">اسم المنتج:</label>--}}
{{--            <select name="product_id[]" class="summary-input flex-grow-1 w-100 w-md-auto "   style="text-align: right">--}}

{{--                @foreach($products as $product)--}}
{{--                    <option value="{{ $product->id }}">{{ $product->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}

{{--        </div>--}}
{{--        <div class="col-12 col-md-2">--}}
{{--            <label class="form-label fw-bold">الكمية:</label>--}}
{{--            <input type="number" name="quantity[]" class="form-control summary-input flex-grow-1 w-100 w-md-auto quantity bg-white" style="text-align: right" min="1" value="1">--}}
{{--        </div>--}}
{{--        <div class="col-12 col-md-2">--}}
{{--            <label class="form-label fw-bold">سعر الوحدة:</label>--}}
{{--            <input type="number" step="0.01" name="unit_price[]" class=" unit_price form-control summary-input flex-grow-1 w-100 w-md-auto bg-white " style="text-align: right;">--}}
{{--        </div>--}}
{{--        <div class="col-12 col-md-2">--}}
{{--            <label class="form-label fw-bold"> الاجمالي:</label>--}}
{{--                                        <input type="text" class="form-control total_price" readonly>--}}
{{--            <input type="number" class="total_price form-control summary-input flex-grow-1 w-100 w-md-auto bg-white " style="text-align: right" readonly>--}}

{{--        </div>--}}
{{--        <div class="col-12 col-md-2 d-flex align-items-end">--}}
{{--        </div>--}}
{{--    </div>--}}

{{--</div>--}}

{{--<!-- Table -->--}}
{{--<div class="table-responsive mb-3">--}}
{{--    <table class="table table-bordered align-middle text-center custom-invoice-table mb-0 table-striped" style="background: #fff;" id="items-table">--}}
{{--        <thead>--}}
{{--        <tr>--}}

{{--            <th>no</th>--}}
{{--            <th>النوع</th>--}}
{{--            <th>رقم الموديل</th>--}}
{{--            <th>الكمية</th>--}}
{{--            <th>اسم الوحدة</th>--}}
{{--            <th>السعر الكلي</th>--}}
{{--            <th>القسم</th>--}}
{{--            <th>الخيارات</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td>1</td>--}}
{{--            <td>Jane Cooper</td>--}}
{{--            <td>Jane Cooper</td>--}}
{{--            <td>Jane Cooper</td>--}}
{{--            <td>Jane Cooper</td>--}}
{{--            <td>Jane Cooper</td>--}}
{{--            <td>Jane Cooper</td>--}}
{{--            <td>--}}
{{--                <a href="#" class="text-success me-2 ms-3" title="تعديل">--}}
{{--                    <i class="fa fa-pen"></i>--}}
{{--                </a>--}}
{{--                <button type="button" class="text-danger btn-sm remove-item border-0" style="color: red"> <i class="fa fa-trash"></i></button>--}}

{{--            </td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--</div>--}}


{{--here new code--}}

    <div class="container" style="background: #f6f7fa">
        <div class="invoice-container px-2 px-md-4">
            <!-- Header -->
            <div class="invoice-header px-2 rounded-4 mb-3">
                <h4>إضافة فاتورة جديدة</h4>
                <a href="{{ route('invoices.create') }}" class="btn btn-new-invoice mb-2 mb-md-0"><span> فاتورة جديدة </span></a>
            </div>
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
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
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">اسم الموظف:</label>
                                <select name="employee_id" class="summary-input flex-grow-1 w-100 w-md-auto" style="text-align: right">
                                    @foreach($employees as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">القسم</label>
                                <select name="department_id" class="summary-input flex-grow-1 w-100 w-md-auto "   style="text-align: right">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">رقم الفاتورة:</label>
                                <input  type="text"  name="invoice_num" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" style="text-align: right" placeholder="رقم الفاتورة"  value="{{ old('invoice_num', $invoice_num) }}" readonly required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">التاريخ:</label>
                                <input type="date"  name="invoice_date" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" style="text-align: right" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>


                    </div>
                </div>
                <div>
                    <table class="table table-bordered align-middle text-center custom-invoice-table mb-0 table-striped" id="items-table">
                        <thead class="table-secondary">
                        <tr>
                            <th>اسم العميل</th>
                            <th>المنتج</th>
                            <th>الكمية</th>
                            <th>سعر الصرف</th>
                            <th>سعر الوحدة</th>
                            <th>الإجمالي</th>
                            <th><i class="fa fa-trash"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" name="customer_name" class="summary-input flex-grow-1 w-100 w-md-auto "required></td>
                            <td>
                                <select name="product_id[]" class="summary-input flex-grow-1 w-100 w-md-auto "   style="text-align: right">

                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="quantity[]" class="summary-input flex-grow-1 w-100 w-md-auto  quantity" min="1" value="1"></td>
                            <td><input type="number" step="0.01" name="unit_price[]" class="summary-input flex-grow-1 w-100 w-md-auto  unit_price"></td>
                            <td><input type="number" step="0.01" name="exchange_rate" id="exchange_rate" class="summary-input flex-grow-1 w-100 w-md-auto exchange_rate"></td>
                            <td><input type="text" class="summary-input flex-grow-1 w-100 w-md-auto  total_price" readonly></td>
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
                                {{--                                <input type="text" class=" table-input ms-2" style="max-width:100px;">--}}
                                <input type="number" step="0.01" name="paid_amount" class=" table-input ms-2" style="max-width:100px;" value="0">

                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                            <div class="d-flex align-items-center justify-content-end">
                                <span class="fw-bold ms-2">الخصم</span>
                                {{--                                <input type="text" class=" table-input ms-2" style="max-width:100px;">--}}
                                <input type="number" step="0.01" name="discount_amount" class=" table-input ms-2" style="max-width:100px;" value="0">

                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                            <div class="d-flex align-items-center justify-content-end ">
                                <span class="fw-bold ms-2">طريقة الدفع</span>
                                {{--                                <input type="text" class=" table-input ms-2" style="max-width:100px;">--}}
                                <select name="payment_type" class="table-input ms-2">
                                    <option value="نقدي">نقدي</option>
                                    <option value="آجل">آجل</option>
                                    <option value="تحويل">تحويل</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center flex-column flex-md-row">
                                <span class="fw-bold ms-2 mb-2 mb-md-0">الملاحظات</span>
                                <textarea name="note" class=" summary-textarea flex-grow-1 w-100 w-md-auto">

                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-start">
                            <div class="d-flex flex-column flex-md-row gap-2 justify-content-start">
                                <button type="submit" class="btn btn-new-invoice ms-2" >حفظ</button>
                                <button type="button" class="btn btn-new-invoice" onclick="previewInvoice()" data-bs-toggle="modal" data-bs-target="#invoicePreviewModal">
                                    معاينة الفاتورة
                                </button>
                                {{--                                <button  href="{{ route('invoices.print') }}" class="btn btn-primary ms-2" style="background:#1A3E5D; border:none;">طباعة</button>--}}
                                <a  href="{{ route('invoices.index') }}" class="btn btn-outline-danger ms-2">إلغاء</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal للمعاينة -->
        <div class="modal fade" id="invoicePreviewModal" tabindex="-1" aria-labelledby="invoicePreviewLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl"> <!-- modal-xl لتكبير العرض -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="invoicePreviewLabel">معاينة الفاتورة</h5>
                    </div>
                    <div class="modal-body">
                        <div id="invoicePreview">
                            <p><strong>اسم العميل:</strong> <span id="preview_customer_name"></span></p>
                            <p><strong>القسم:</strong> <span id="preview_department"></span></p>
                            <p><strong>الموظف:</strong> <span id="preview_employee"></span></p>
                            <p><strong>تاريخ الفاتورة:</strong> <span id="preview_invoice_date"></span></p>

                            <table class="table table-bordered mt-3">
                                <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>الكمية</th>
                                    <th>السعر</th>
                                    <th>الإجمالي</th>
                                </tr>
                                </thead>
                                <tbody id="preview_items">
                                </tbody>
                            </table>

                            <p><strong>الخصم:</strong> <span id="preview_discount"></span> ريال</p>
                            <p><strong>المدفوع:</strong> <span id="preview_paid"></span> ريال</p>
                            <p><strong>المتبقي:</strong> <span id="preview_rest"></span> ريال</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function calculateRowTotal(row) {
            const quantity = parseFloat(row.querySelector('.quantity')?.value) || 0;
            const unitPrice = parseFloat(row.querySelector('.unit_price')?.value) || 0;
            const exchangeRate = parseFloat(document.getElementById('exchange_rate')?.value) || 1;
            const total = quantity * unitPrice * exchangeRate;
            row.querySelector('.total_price').value = total.toFixed(2);
            return total;
        }
        document.getElementById('exchange_rate').addEventListener('input', calculateInvoiceTotal);


        function calculateInvoiceTotal() {
            let total = 0;

            document.querySelectorAll('#items-table tbody tr').forEach(row => {
                total += calculateRowTotal(row);
            });

            const discount = parseFloat(document.querySelector('[name="discount_amount"]')?.value) || 0;
            const grandTotal = total - discount;

            document.getElementById('invoice-total').textContent = grandTotal.toFixed(2);
            document.getElementById('total_amount').value = grandTotal.toFixed(2);
        }

        function updateRemoveButtonsVisibility() {
            const rows = document.querySelectorAll('#items-table tbody tr');
            const shouldHide = rows.length === 1;

            rows.forEach(row => {
                const btn = row.querySelector('.remove-item');
                if (btn) {
                    btn.style.display = shouldHide ? 'none' : 'inline-block';
                }
            });
        }

        // إضافة صف جديد
        document.getElementById('add-item').addEventListener('click', function () {
            const tableBody = document.querySelector('#items-table tbody');
            const firstRow = tableBody.querySelector('tr');
            const newRow = firstRow.cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => {
                input.value = '';
                if (input.classList.contains('quantity')) input.value = 1;
            });

            tableBody.appendChild(newRow);
            calculateInvoiceTotal();
            updateRemoveButtonsVisibility();
        });

        // التحديث التلقائي عند التغيير
        document.addEventListener('input', function (e) {
            if (
                e.target.classList.contains('quantity') ||
                e.target.classList.contains('unit_price') ||
                e.target.name === 'discount_amount'
            ) {
                calculateInvoiceTotal();
            }
        });

        // حذف صف
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                const row = e.target.closest('tr');
                row.remove();
                calculateInvoiceTotal();
                updateRemoveButtonsVisibility();
            }
        });

        // عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', () => {
            calculateInvoiceTotal();
            updateRemoveButtonsVisibility();
        });

    </script>
<script>
    function previewInvoice() {
        const name = document.querySelector('[name="customer_name"]').value;
        const department = document.querySelector('[name="department_id"]').selectedOptions[0]?.text || '-';
        const employee = document.querySelector('[name="employee_id"]').selectedOptions[0]?.text || '-';
        const date = document.querySelector('[name="invoice_date"]').value;
        const discount = parseFloat(document.querySelector('[name="discount_amount"]').value) || 0;
        const paid = parseFloat(document.querySelector('[name="paid_amount"]').value) || 0;

        let total = 0;
        let tableBody = '';

        document.querySelectorAll('.product-row').forEach(row => {
            const productName = row.querySelector('[name="product_id[]"]').selectedOptions[0]?.text || '-';
            const modelNum = row.querySelector('.model_num')?.value || '-';
            const quantity = parseFloat(row.querySelector('[name="quantity[]"]').value) || 0;
            const price = parseFloat(row.querySelector('[name="unit_price[]"]').value) || 0;
            const lineTotal = quantity * price;

            total += lineTotal;

            tableBody += `
                <tr>
                    <td>${productName}</td>
                    <td>${modelNum}</td>
                    <td>${quantity}</td>
                    <td>${price.toFixed(2)}</td>
                    <td>${lineTotal.toFixed(2)}</td>
                </tr>
            `;
        });

        const rest = total - discount - paid;

        document.getElementById('preview_customer_name').innerText = name;
        document.getElementById('preview_department').innerText = department;
        document.getElementById('preview_employee').innerText = employee;
        document.getElementById('preview_invoice_date').innerText = date;
        document.getElementById('preview_discount').innerText = discount.toFixed(2);
        document.getElementById('preview_paid').innerText = paid.toFixed(2);
        document.getElementById('preview_rest').innerText = rest.toFixed(2);
        document.getElementById('preview_items').innerHTML = tableBody;
    }
</script>
<script>
    function previewInvoice() {
        // تعبئة الحقول العامة
        document.getElementById('preview_customer_name').innerText = document.querySelector('input[name="customer_name"]').value;

        const departmentSelect = document.querySelector('select[name="department_id"]');
        document.getElementById('preview_department').innerText = departmentSelect.options[departmentSelect.selectedIndex].text;

        const employeeSelect = document.querySelector('select[name="employee_id"]');
        document.getElementById('preview_employee').innerText = employeeSelect.options[employeeSelect.selectedIndex].text;

        document.getElementById('preview_invoice_date').innerText = document.querySelector('input[name="invoice_date"]').value;

        // العناصر (المنتجات)
        const tableBody = document.getElementById('preview_items');
        tableBody.innerHTML = ''; // تفريغ القديم

        const rows = document.querySelectorAll('#items-table tbody tr');
        rows.forEach(row => {
            const productSelect = row.querySelector('select[name="product_id[]"]');
            const productName = productSelect.options[productSelect.selectedIndex].text;

            const quantity = row.querySelector('input[name="quantity[]"]').value;
            const unitPrice = parseFloat(row.querySelector('input[name="unit_price[]"]').value || 0).toFixed(2);
            const exchangeRateInput = row.querySelector('input[name="exchange_rate"]');
            const exchangeRate = exchangeRateInput ? parseFloat(exchangeRateInput.value || 1) : 1;

            const total = (quantity * unitPrice * exchangeRate).toFixed(2);

            // حاول استعراض رقم الموديل إذا كان مخزنًا مع <option> باستخدام data-model

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${productName}</td>
                <td>${quantity}</td>
                <td>${unitPrice}</td>
                <td>${total}</td>
            `;
            tableBody.appendChild(tr);
        });

        // ملء القيم المالية
        document.getElementById('preview_discount').innerText = document.querySelector('input[name="discount_amount"]').value || 0;
        document.getElementById('preview_paid').innerText = document.querySelector('input[name="paid_amount"]').value || 0;

        const total = parseFloat(document.getElementById('invoice-total').innerText || 0);
        const discount = parseFloat(document.querySelector('input[name="discount_amount"]').value || 0);
        const paid = parseFloat(document.querySelector('input[name="paid_amount"]').value || 0);
        const rest = (total - discount - paid).toFixed(2);

        document.getElementById('preview_rest').innerText = rest;
    }
</script>



@endsection
