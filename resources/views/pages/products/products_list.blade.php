@extends('layouts.master')
@section('title', 'المنتجات')
@section('content')
<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="mb-3 mb-md-0" style="color: var(--dark-blue);">المنتجات</h2>
        <a href="{{ route('products.create') }}" class="btn btn-new-invoice mb-2 mb-md-0">
            <i class="fa fa-plus"></i> اضافة منتج جديد
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
            <table class="table table-hover align-middle text-center table table-striped" style="min-width: 900px;">
                <thead class="table-light">
                <tr>
                    <th>id</th>
                    <th>اسم المنتج</th>
                    <th>دورة المنتج</th>
                    <th>رقم الموديل</th>
                    <th>الوصف</th>
                    <th>كمية المخزون</th>
                    <th>سعر التكلفة</th>
                    <th>سعر البيع</th>
                    <th>القسم</th>
                    <th>الخيارات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->created_at ? $product->created_at->format('m/d/y') : '' }}</td>
                        <td>{{ $product->model_num }}</td>
                        <td>{{ Str::limit($product->description, 15) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->cost_price }}</td>
                        <td>{{ $product->sell_price }}</td>
                        <td>{{ $product->department->name ?? '' }}</td>
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
@endsection
