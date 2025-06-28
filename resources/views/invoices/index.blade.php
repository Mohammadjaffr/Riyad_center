@extends('layouts.master')
@section('title', 'الفواتير')
@section('content')
    @if(session('success') || session('error'))
        <div class="message-center" style="position: fixed;left: 50%;transform: translate(-50%, -50%);z-index: 9999;padding: 20px;border-radius: 8px;text-align: center;animation: fadeInOut 4s forwards;
        {{ session('success') ? 'background: #4CAF50; color: white;' : 'background: #F44336; color: white;' }}">
            {{ session('success') ?? session('error') }}
        </div>
    @endif

    <style>
        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; visibility: hidden; }
        }
    </style>
{{--    <div class="container">--}}
{{--        <h2 class="mb-3">قائمة الفواتير</h2>--}}

{{--        @if(session('success'))--}}
{{--            <div class="alert alert-success">{{ session('success') }}</div>--}}
{{--        @endif--}}

{{--        <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">+ إضافة فاتورة</a>--}}

{{--        <table class="table table-bordered text-center">--}}
{{--            <thead class="table-light">--}}
{{--            <tr>--}}
{{--                <th>رقم الفاتورة</th>--}}
{{--                <th>العميل</th>--}}
{{--                <th>القسم</th>--}}
{{--                <th>الموظف</th>--}}
{{--                <th>الإجمالي</th>--}}
{{--                <th>المدفوع</th>--}}
{{--                <th>المتبقي</th>--}}
{{--                <th>تاريخ</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($invoices as $invoice)--}}
{{--                <tr>--}}
{{--                    <td>{{ $invoice->invoice_num }}</td>--}}
{{--                    <td>{{ $invoice->customer_name ?? '-' }}</td>--}}
{{--                    <td>{{ $invoice->department->name }}</td>--}}
{{--                    <td>{{ $invoice->employee->name }}</td>--}}
{{--                    <td>{{ number_format($invoice->total_amount, 2) }}</td>--}}
{{--                    <td>{{ number_format($invoice->paid_amount, 2) }}</td>--}}
{{--                    <td>{{ number_format($invoice->rest_amount, 2) }}</td>--}}
{{--                    <td>{{ $invoice->invoice_date }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة الفواتير</h2>
            <a href="{{ route('invoices.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
                <i class="fa fa-plus"></i> اضافة  فاتورة
            </a>
        </div>
        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">


                <div class="col-12 col-md-4">
                    <input type="text" class="form-control summary-input flex-grow-1 w-100 w-md-auto" placeholder="البحث ..." style="text-align: right;">
                </div>
                <div class="col-12 col-md-7"></div>
                <div class="col-12 col-md-1 text-center mb-2 mb-md-0">
                    <button class="summary-input flex-grow-1 w-100 w-md-auto" style="border-radius: 10px;">
                        <i class="fa fa-filter"></i>

                    </button>
                </div>
            </div>
            <div class="table-responsive ">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">

                    <tr>
                        <th>رقم الفاتورة</th>
                        <th> العميل</th>
                        <th>القسم </th>
                        <th>الموظف</th>
                        <th>الإجمالي </th>
                        <th>المدفوع </th>
                        <th>المتبقي </th>
                        <th>التاريخ</th>
                        <th>الخيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->invoice_num }}</td>
                        <td>{{ $invoice->customer_name ?? '-' }}</td>
                        <td>{{ $invoice->department->name }}</td>
                        <td>{{ $invoice->employee->name }}</td>
                        <td>{{ number_format($invoice->total_amount, 2) }}</td>
                        <td>{{ number_format($invoice->paid_amount, 2) }}</td>
                        <td>{{ number_format($invoice->rest_amount, 2) }}</td>
                        <td>{{ $invoice->invoice_date }}</td>
                        <td>
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="text-success me-2 ms-3" title="عرض" >
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="text-success me-2 ms-3" title="تعديل" >
                                <i class="fa fa-pen"></i>
                            </a>


                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-link p-0 m-0 text-danger" title="حذف" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $invoice->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                </div>
                <div class="modal-body text-center">
                    <p>هل أنت متأكد أنك تريد حذف هذه الفاتورة؟</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form method="POST" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">نعم، حذف</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const invoiceId = button.getAttribute('data-id');

            const form = document.getElementById('delete-form');
            form.action = `/invoices/${invoiceId}`;
        });
    </script>

@endsection
