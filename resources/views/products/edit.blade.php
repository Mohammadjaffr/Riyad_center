@extends('layouts.master')
@section('title', 'تعديل منتج')

@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">تعديل منتج</h2>

            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

{{--                @if ($errors->any())--}}
{{--                    <div class="alert alert-danger text-end">--}}
{{--                        <ul class="mb-0">--}}
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}

                @include('products.form', ['product' => $product])

                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-blue  ">  تعديل البيانات</button>
                </div>
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
