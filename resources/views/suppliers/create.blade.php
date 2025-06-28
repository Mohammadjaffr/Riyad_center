@extends('layouts.master')
@section('title' ,'إضافة مورد')
@section('content')

    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">إضافة مورد جديد</h2>
            <form method="POST" action="{{ route('suppliers.store') }}" enctype="multipart/form-data">
                @csrf
                @include('suppliers.form', ['supplier' => null])
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-new-invoice w-50 ">اضافة</button>
                </div>


            </form>

        </div>
    </div>


@endsection
