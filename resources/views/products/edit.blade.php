@extends('layouts.master')
@section('title' ,'تعديل بيانات المنتج')
@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
        <h2 class="text-center mb-4" style="color: var(--dark-blue);">تعديل بيانات المنتج</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('products.form', ['product' => $product])


            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-new-invoice w-50 ">تعديل</button>
            </div>
        </form>
    </div>
    </div>



@endsection
