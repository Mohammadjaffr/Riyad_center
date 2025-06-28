@extends('layouts.master')
@section('title' ,'الصفحة الرئيسية')
@section('content')
    <div class="container">
        <h2>قائمة الأقسام</h2>

        <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">إضافة قسم جديد</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>اسم القسم</th>
                <th>التحكم</th>
            </tr>
            </thead>
            <tbody>
            @foreach($departments as $dep)
                <tr>
                    <td>{{ $dep->name }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $dep->id) }}" class="btn btn-sm btn-warning">تعديل</a>

                        <form action="{{ route('departments.destroy', $dep->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
