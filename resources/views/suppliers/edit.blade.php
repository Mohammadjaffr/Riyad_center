@extends('layouts.master')
@section('title' ,'تعديل بيانات المورد')
@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
        <h2 class="text-center mb-4" style="color: var(--dark-blue);">تعديل بيانات المورد</h2>

        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('suppliers.form', ['supplier' => $supplier])

            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-blue "> تعديل البيانات</button>
            </div>
        </form>
        </div>
    </div>



@endsection
