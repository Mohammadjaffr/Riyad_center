@extends('layouts.master')
@section('title' ,'إضافة عملية شراء ')
@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">إضافة عملية شراء</h2>
            <form method="POST" action="{{ route('purchases.store') }}" enctype="multipart/form-data">
                @csrf
                @include('purchases.form', ['purchase' => null])


            </form>

        </div>
    </div>
    <script>
        function addRow() {
            const html = document.querySelector('#items .row').outerHTML;
            document.getElementById('items').insertAdjacentHTML('beforeend', html);
        }
        function deleteRow(button) {
            const row = button.closest('.row');
            if (document.querySelectorAll('#items .row').length > 1) {
                row.remove();
            } else {
                alert("لا يمكن حذف كل الصفوف، يجب أن يبقى صف واحد على الأقل");
            }
        }
    </script>
@endsection

