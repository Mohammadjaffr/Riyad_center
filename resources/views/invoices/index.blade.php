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
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة الفواتير</h2>
            <a href="{{ route('invoices.create') }}" class="btn btn-blue mb-2 mb-md-0">
                <i class="fa fa-plus"></i> اضافة  فاتورة
            </a>
        </div>
        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">
                <form method="GET" action="{{ route('invoices.index') }}" class="col-md-6 col-lg-4 mb-3">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control summary-input flex-grow-1 w-100 w-md-auto "
                            placeholder="ابحث برقم الفاتورة أو اسم الموظف..."
                            value="{{ request('search') }}"
                            style="text-align: right; height: 43px!important;"
                        >
                        <button class="btn btn-blue position-absolute rounded-circle my-1  " style="left:25px;" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>


                <div class="col-2 col-md-7"></div>
                <div class="col-4 col-md-1 text-center mb-2 mb-md-0">
                    <!-- زر لفتح المودال -->
                    <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fa fa-filter"></i> فلترة
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
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="text-dark-blue me-2 ms-3" title="عرض" >
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
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 bg-white">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-blue" id="filterModalLabel">فلترة الفواتير</h5>
                </div>
                <form method="GET" action="{{ route('invoices.index') }}">
                    <div class="modal-body">
                        <div class="row g-3 text-dark-blue">
                            <!-- حقل البحث -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">بحث برقم الفاتورة أو اسم الموظف</label>
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    class="summary-input flex-grow-1 w-100 w-md-auto"
                                    value="{{ request('search') }}"
                                    placeholder="مثال: 10025 أو أحمد علي"
                                    autocomplete="off"
                                />
                            </div>

                            <!-- حقل الترتيب -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">الترتيب حسب التاريخ</label>
                                <select name="sort" class="summary-input flex-grow-1 w-100 w-md-auto text-dark-blue">
                                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>اختر</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>تصاعدي (الأقدم أولاً)</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>تنازلي (الأحدث أولاً)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <!-- زر إعادة تعيين الفلترة -->
                        <a href="{{ route('invoices.index') }}" class="btn btn-outline-blue">
                            <i class="fa fa-undo"></i> إعادة تعيين
                        </a>

                        <!-- زر تنفيذ الفلترة -->
                        <button type="submit" class="btn btn-blue">
                            <i class="fa fa-search"></i> تطبيق الفلتر
                        </button>
                    </div>
                </form>
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

