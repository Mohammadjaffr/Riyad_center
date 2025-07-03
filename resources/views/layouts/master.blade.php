<!doctype html >
<html dir="rtl" lang="ar">
@extends('layouts.head')
<style>
    body {
        /*margin: 0;*/
        /*padding: 0;*/
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        padding-top: 100px;
        padding-right: 15rem;

    }
    /*.main-content {*/
    /*    flex: 1;*/
    /*    display: flex;*/
    /*}*/
    /*.sidebar {*/
    /*    width: 240px;*/
    /*    background-color: #f8f9fa;*/
    /*}*/
    /*.content {*/
    /*    flex: 1;*/
    /*    padding: 20px;*/
    /*}*/
    @media (max-width: 991.98px) {
        body {
            padding-right: 0;
        }

    }
</style>

<body>
@include('layouts.navbar')


<div class="main-content">
    @include('layouts.sidebar')
    <div class="content">
        @yield('content')
    </div>

</div>

<script src="{{asset('assets/Js/custom-Js.js')}}"></script>
@include('layouts.footer')
</body>
</html>
