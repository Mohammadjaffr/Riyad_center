@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>إضافة عملية شراء</h2>

        <form method="POST" action="{{ route('purchases.store') }}">
            @csrf

            <div class="mb-3">
                <label>المورد</label>
                <select name="supplier_id" class="form-control" required>
                    <option value="">اختر المورد</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>تاريخ الشراء</label>
                <input type="date" name="purchase_date" class="form-control" required>
            </div>

            <hr>
            <h5>تفاصيل المنتجات</h5>

            <div id="items">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select name="product_id[]" class="form-control">
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="quantity[]" class="form-control" placeholder="الكمية" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="unit_price[]" class="form-control" placeholder="السعر" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="addRow()" class="btn btn-success">+</button>
                        <button type="button" onclick="deleteRow(this)" class="btn btn-danger">-</button>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label>ملاحظات</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
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
