@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.head')


<aside class="sidebar-custom d-none d-lg-flex flex-column align-items-center py-4 px-2">

    <div class="logo-container mb-2 text-center">
        <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo" class="img-fluid" style="max-width: 90px;">
        <div class="sidebar-desc text-center mt-2">
            <span class="d-block text-white-50 small" style="font-size: 10px;">
                HELMY AL-HAIDARI FOR GENERAL TRADE<br>
                لبيع جميع الأنشطة التجارية - خياطة و تفصيل الأزياء الرسمية
            </span>
        </div>
    </div>

    @php
        $employee = Auth::guard('employee')->user();
    @endphp
    <nav class="w-100">
        <ul class="nav flex-column gap-3 w-100 px-2">

            {{-- إذا كان أدمن يعرض كل شيء --}}
            @if($employee && $employee->department_id == 1)
                @include('sidebar_roles.admin')
            @else

                @if($employee && $employee->department_id == 2)
                    @include('sidebar_roles.clothes')
                @endif

                @if($employee && $employee->department_id == 3)
                    @include('sidebar_roles.shoes')
                @endif

            @endif
        </ul>
    </nav>
</aside>

<script>
    document.addEventListener('click', function (e) {
        if (!e.target.classList.contains('dropdown-toggle')) {
            document.querySelectorAll('[id$="Menu"]').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.sidebar-link-custom, .dropdown-item-custom').forEach(function (link) {
            link.addEventListener('click', function () {
                document.querySelectorAll('.sidebar-link-custom, .dropdown-item-custom').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>


