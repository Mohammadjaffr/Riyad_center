<!doctype html >
<html dir="rtl" lang="en">
@extends('layouts.head')

<body>
@include('layouts.navbar')


<div class="main-content">
    @include('layouts.sidebar')
    <div class="content">
        @yield('content')
    </div>

</div>

<script src="{{asset('assets/Js/custom-Js.js')}}"></script>
</body>
</html>
