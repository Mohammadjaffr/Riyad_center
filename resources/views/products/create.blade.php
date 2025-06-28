@extends('layouts.master')
@section('title', 'اضافة منتج')
@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">إضافة منتج</h2>
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                @include('products.form', ['product' => null])


            </form>

        </div>
    </div>
    <script>
    function previewProductImage(event) {
        const input = event.target;
        const preview = document.getElementById('product-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
@endsection
