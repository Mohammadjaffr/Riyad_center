@extends('layouts.master')
@section('title' ,'الموردين')
@section('content')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">قائمة الموردين</h2>
            <a href="{{ route('suppliers.create') }}" class="btn btn-blue mb-2 mb-md-0">
                <i class="fa fa-plus"></i> إضافة مورد جديد
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Delete Confirmation Modal -->
{{--        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">--}}
{{--            <div class="modal-dialog">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        هل أنت متأكد من رغبتك في حذف هذا المورد؟ لا يمكن التراجع عن هذه العملية.--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>--}}
{{--                        <form id="deleteForm" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit" class="btn btn-danger">حذف</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">
                <div class="col-12 col-md-4">
                    <input type="text" class="form-control summary-input flex-grow-1 w-100 w-md-auto" placeholder="البحث ..." style="text-align: right;">
                </div>
                <div class="col-12 col-md-7"></div>
                <div class="col-4 col-md-1 text-center mb-2 mb-md-0">
                    <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fa fa-filter"></i> فلترة
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 900px;">
                    <thead class="table-light">
                    <tr>
                        <th>الاسم</th>
                        <th>الهاتف</th>
                        <th>العنوان</th>
                        <th>القسم</th>
                        <th>الخيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>{{ $supplier->department->name ?? '—' }}</td>
                            <td>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="text-success me-2 ms-3" title="تعديل">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    {{--                                    <button class="btn btn-link p-0 m-0 text-danger" onclick="return confirm('هل أنت متأكد؟')"><i class="fa fa-trash"></i></button>--}}
                                    <button type="button" class="btn btn-link p-0 m-0 text-danger" title="حذف" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $supplier->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
{{--                                <button class="btn btn-link p-0 m-0 text-danger delete-btn"--}}
{{--                                        data-id="{{ $supplier->id }}"--}}
{{--                                        data-bs-toggle="modal"--}}
{{--                                        data-bs-target="#deleteModal"--}}
{{--                                        title="حذف">--}}
{{--                                    <i class="fa fa-trash"></i>--}}
{{--                                </button>--}}

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
                <div class="modal-header bg-danger text-white ">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                </div>
                <div class="modal-body text-center">
                    <p>هل أنت متأكد أنك تريد حذف هذا المورد؟</p>
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
            const id = button.getAttribute('data-id');

            const form = document.getElementById('delete-form');
            form.action = `/suppliers/${id}`;
        });
    </script>

{{--        <script>--}}
{{--            document.addEventListener('DOMContentLoaded', function() {--}}
{{--                // Set up delete modal--}}
{{--                const deleteButtons = document.querySelectorAll('.delete-btn');--}}
{{--                const deleteForm = document.getElementById('deleteForm');--}}

{{--                deleteButtons.forEach(button => {--}}
{{--                    button.addEventListener('click', function() {--}}
{{--                        const supplierId = this.getAttribute('data-id');--}}
{{--                        const supplierName = this.closest('tr').querySelector('td:first-child').textContent;--}}
{{--                        deleteForm.action = `/suppliers/${supplierId}`;--}}
{{--                        document.getElementById('deleteModalLabel').textContent = `حذف المورد: ${supplierName}`;--}}
{{--                    });--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
    @endsection
