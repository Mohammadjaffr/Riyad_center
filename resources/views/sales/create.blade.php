@extends('layouts.master')
@section('title' ,'تسجيل عملية بيع')
@section('content')
    <div class="container py-4">
        <div class="bg-white rounded-4 p-4 shadow-sm">
            <h2 class="text-center mb-4" style="color: var(--dark-blue);">تسجيل عملية بيع</h2>
            <form method="POST" action="{{ route('sales.store') }}" enctype="multipart/form-data">
                @csrf
                @include('sales.form', ['sale' => null])
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
