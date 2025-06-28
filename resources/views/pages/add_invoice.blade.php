@extends('layouts.master')
@section('title', 'إنشاء فاتورة')
@section('content')
    <div class="container" style="background: #f6f7fa">
        <div class="invoice-container px-2 px-md-4">
            <!-- Header -->
            <div class="invoice-header px-2 rounded-4 mb-3">
                <h4>إضافة فاتورة جديدة</h4>
                <button class="btn btn-new-invoice mb-2 mb-md-0"><span> فاتورة جديدة </span></button>
            </div>
            <form action="{{ route('invoices.store') }}" method="POST">
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
                                <input  type="text"  name="invoice_num" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" style="text-align: right" placeholder="رقم الفاتورة">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">التاريخ:</label>
                                <input type="date"  name="invoice_date" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" style="text-align: right" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>


                    </div>
                </div>


                <div class="rounded-4 p-3 mb-3" style="background: #fff;">
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-md-3">
                            <label class="form-label fw-bold ">اسم العميل:</label>
                            <input type="text" name="customer_name" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" style="text-align: right" placeholder="اسم العميل">
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label fw-bold">اسم المنتج:</label>
                            <select name="product_id[]" class="summary-input flex-grow-1 w-100 w-md-auto "   style="text-align: right">

                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-12 col-md-2">
                            <label class="form-label fw-bold">الكمية:</label>
                            <input type="number" name="quantity[]" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" style="text-align: right" min="1" value="1">

                        </div>


                        <div class="col-12 col-md-2">
                            <label class="form-label fw-bold">سعر الوحدة:</label>
                            <input type="number" step="0.01" name="unit_price[]" class=" unit_price form-control summary-input flex-grow-1 w-100 w-md-auto bg-white " style="text-align: right;">
                        </div>
                        <div class="col-12 col-md-2">
                            <label class="form-label fw-bold"> الاجمالي:</label>
{{--                            <input type="text" class="form-control total_price" readonly>--}}
                            <input type="number" class=" total_price form-control summary-input flex-grow-1 w-100 w-md-auto bg-white " style="text-align: right" readonly>

                        </div>
                        {{--                            <div class="col-12 col-md-3">--}}
                        {{--                                <label class="form-label fw-bold">رقم الموديل:</label>--}}
                        {{--                                <select class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right">--}}
                        {{--                                    <option>اختر رقم الموديل</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="col-12 col-md-3">--}}
                        {{--                                <label class="form-label fw-bold">الصنف:</label>--}}
                        {{--                                <select class="summary-input flex-grow-1 w-100 w-md-auto"   style="text-align: right">--}}
                        {{--                                    <option>اختر الصنف</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}


                        {{--                        <div class="col-12 col-md-2">--}}
                        {{--                            <label class="form-label fw-bold">الخصم:</label>--}}
                        {{--                            <input type="number" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white" >--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-12 col-md-2">--}}
                        {{--                            <label class="form-label fw-bold">المجموع:</label>--}}
                        {{--                            <input type="number" class="form-control summary-input flex-grow-1 w-100 w-md-auto bg-white">--}}
                        {{--                        </div>--}}
                        <div class="col-12 col-md-2 d-flex align-items-end">
                            <button class="btn btn-new-invoice mt-2" id="add-item">إضافة </button>
                        </div>
                    </div>

                </div>

                <!-- Table -->
                <div class="table-responsive mb-3">
                    <table class="table table-bordered align-middle text-center custom-invoice-table mb-0 table-striped" style="background: #fff;">
                        <thead>
                        <tr>

                            <th >no</th>
                            <th>النوع</th>
                            <th>رقم الموديل</th>
                            <th>الكمية</th>
                            <th>اسم الوحدة</th>
                            <th>السعر الكلي</th>
                            <th>القسم</th>
                            <th>الخيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Jane Cooper</td>
                            <td>Jane Cooper</td>
                            <td>Jane Cooper</td>
                            <td>Jane Cooper</td>
                            <td>Jane Cooper</td>
                            <td>Jane Cooper</td>
                            <td>
                                <a href="#" class="text-success me-2 ms-3" title="تعديل">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <button type="button" class="text-danger btn-sm remove-item border-0" style="color: red"> <i class="fa fa-trash"></i></button>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
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
                                <input type="text" name="note" class=" summary-input flex-grow-1 w-100 w-md-auto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-start">
                            <div class="d-flex flex-column flex-md-row gap-2 justify-content-start">
                                <button type="submit" class="btn btn-primary ms-2" style="background:#1A3E5D; border:none;">حفظ</button>
                                <button class="btn btn-primary ms-2" style="background:#1A3E5D; border:none;">طباعة</button>
                                <button class="btn btn-primary" style="background:#1A3E5D; border:none;">عرض</button>
                                <button class="btn btn-outline-danger ms-2">إلغاء</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

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



