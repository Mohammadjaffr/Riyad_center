@extends('layouts.head')
@section('title' ,'تسجيل الدخول')

    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-light-beige">
        <div class="login-card row bg-white rounded-5 shadow-lg overflow-hidden">

            <!-- Left Panel (Image Section) -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-4 bg-dark-blue text-white">
                <h2 class="mb-4">تسجيل الدخول</h2>
                <img src="{{asset('assets/images/login.png')}}" alt="Register Illustration" class="img-fluid login-illustration">
            </div>
            <div class="col-md-6 p-5 d-flex flex-column justify-content-center">

                <div class="text-center mb-5 bg-white">
                    <img src="{{asset('assets/images/logo.png')}} " alt="Company Logo" class="img-fluid company-logo mb-3">
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3" dir="rtl">
                        <label for="name" class="form-label text-dark-blue text-end">{{ __('اسم المستخدم') }}</label>
                        <input type="text"  class="form-control @error('name') is-invalid @enderror rounded-pill border-dark-blue" id="name" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback text-end" role="alert">
                         <strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>

                    <div class="mb-3" dir="rtl">
                        <label for="password" class="form-label text-dark-blue">{{ __('كلمة المرور') }}</label>
                        <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror rounded-pill border-dark-blue"  name="password"  autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback text-end" role="alert">
                         <strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark-blue rounded-pill py-2">تسجيل الدخول</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

