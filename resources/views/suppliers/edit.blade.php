@extends('layouts.master')
@section('title' ,'تعديل بيانات المورد')
@section('content')
    <div class="container">
        <h2>تعديل بيانات المورد</h2>

        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('suppliers.form', ['supplier' => $supplier])

            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-new-invoice w-50 ">تعديل</button>
            </div>
        </form>
    </div>



@endsection
