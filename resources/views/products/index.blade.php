@extends('layouts.master')
@section('title', 'المنتجات')
@section('content')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">المنتجات</h2>
            <a href="{{ route('products.create') }}" class="btn btn-blue mb-2 mb-md-0">
                <i class="fa fa-plus"></i> اضافة منتج جديد
            </a>
        </div>

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">
                <form method="GET" action="{{ route('products.index') }}" class="col-md-6 col-lg-4 mb-3">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control summary-input flex-grow-1 w-100 w-md-auto"
                            placeholder="ابحث باسم المنتج أو رقم الموديل..."
                            value="{{ request('search') }}"
                            style="text-align: right;"
                        >
                        <button class="btn btn-blue position-absolute rounded-circle mt-0 " style="left:25px;" type="submit">
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

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center table-striped custom-invoice-table" style="min-width: 1000px;">
                    <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>اسم المنتج</th>
                        <th>صورة المنتج</th>
                        <th>رقم الموديل</th>
                        <th>الوصف</th>
                        <th>القسم</th>
                        <th>المتغيرات</th>

                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <img src="{{ asset($product->product_image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 80px; max-height: 80px;">
                            </td>
                            <td>{{ $product->model_num }}</td>
                            <td>{{ Str::limit($product->description, 25) }}</td>
                            <td>{{ $product->department->name ?? '-' }}</td>

                            <td style="min-width: 280px;">

                                @if($product->variants->count() > 0)
                                    <table class="table table-bordered mb-0" style="font-size: 0.85rem;">
                                        <thead>
                                        <tr>
                                            <th>المقاس</th>
                                            <th>اللون</th>
                                            <th>كمية المخزون</th>
                                            <th>سعر التكلفة</th>
                                            <th>سعر البيع</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->variants as $variant)
                                            <tr>
                                                <td>{{ $variant->size }}</td>
                                                <td>{{ $variant->color }}</td>
                                                <td>{{ $variant->quantity }}</td>
                                                <td>{{ number_format($variant->cost_price, 2) }}</td>
                                                <td>{{ number_format($variant->sell_price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <span class="text-muted">لا توجد متغيرات</span>
                                @endif

                            </td>

                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="text-success me-2 ms-3" title="تعديل" >
                                    <i class="fa fa-pen"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-link p-0 m-0 text-danger" title="حذف" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $product->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $products->appends(request()->query())->links() }}

        </div>
    </div>

    <!-- فلترة -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content rounded-4 bg-white">
                <div class="modal-header">
                    <h5 class="modal-title text-dark-blue" id="filterModalLabel">فلترة المنتجات</h5>
                </div>
                <form method="GET" action="{{ route('products.index') }}">
                    <div class="modal-body ">
                        <div class="row g-3 text-dark-blue">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">بحث بالاسم أو رقم الموديل</label>
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    class="summary-input flex-grow-1 w-100 w-md-auto"
                                    value="{{ request('search') }}"
                                    placeholder="مثال: تيشيرت، 123abc"
                                    autocomplete="off"
                                />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">الترتيب</label>
                                <select name="sort" class="summary-input flex-grow-1 w-100 w-md-auto text-dark-blue">
                                    <option value="" disabled selected>اختر</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>تصاعدي</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>تنازلي</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-blue">إعادة تعيين</a>
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
                <div class="modal-header bg-danger text-white ">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                </div>
                <div class="modal-body text-center">
                    <p>هل أنت متأكد أنك تريد حذف هذا المنتج؟</p>
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
            form.action = `/products/${id}`;
        });
    </script>

@endsection
