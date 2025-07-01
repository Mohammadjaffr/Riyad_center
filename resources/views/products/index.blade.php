@extends('layouts.master')
@section('title', 'المنتجات')
@section('content')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">المنتجات</h2>
            <a href="{{ route('products.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
                <i class="fa fa-plus"></i> اضافة منتج جديد
            </a>
        </div>

        <div class="bg-white rounded-4 p-3 shadow-sm mb-3">
            <div class="row g-2 align-items-center mb-3">
                <form method="GET" action="{{ route('products.index') }}" class="col-4">
                    <input
                        type="text"
                        name="search"
                        class="form-control summary-input flex-grow-1 w-100 w-md-auto"
                        placeholder="البحث ..."
                        style="text-align: right;"
                        value="{{ request('search') }}"
                    >
                </form>

                <div class="col-2 col-md-7"></div>
                <div class="col-4 col-md-1 text-center mb-2 mb-md-0">
                    <!-- زر لفتح المودال -->
                    <button type="button" class="btn btn-new-invoice" data-bs-toggle="modal" data-bs-target="#filterModal">
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
                                    <button type="submit" class="btn btn-link p-0 m-0 text-danger" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟');">
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

    <!-- فلترة -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">فلترة المنتجات</h5>
                </div>
                <form method="GET" action="{{ route('products.index') }}">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">بحث بالاسم أو رقم الموديل</label>
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    class="form-control"
                                    value="{{ request('search') }}"
                                    placeholder="مثال: تيشيرت، 123abc"
                                    autocomplete="off"
                                />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">الترتيب</label>
                                <select name="sort" class="form-select">
                                    <option value="">اختر</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>تصاعدي</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>تنازلي</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">إعادة تعيين</a>
                        <button type="submit" class="btn btn-new-invoice">
                            <i class="fa fa-search"></i> تطبيق الفلتر
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
