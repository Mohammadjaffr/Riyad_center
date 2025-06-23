@extends('layouts.master')
@section('title' ,'تسجيل الدخول')
@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-light-beige">
        <div class="login-card row bg-white rounded-5 shadow-lg overflow-hidden">
            <!-- Right Panel (Registration Form) -->
            <div class="col-md-6 p-5 d-flex flex-column justify-content-center">

                <div class="text-center mb-5 bg-white">
                    <img src="assets/images/logo.png" alt="Company Logo" class="img-fluid company-logo mb-3">
                </div>
                <form method="post">
                    <div class="mb-3">
                        <label for="regUsername" class="form-label text-dark-blue">اسم المستخدم</label>
                        <input type="text" class="form-control rounded-pill border-dark-blue" id="regUsername" name="regUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="regPassword" class="form-label text-dark-blue">كلمة السر</label>
                        <input type="password" class="form-control rounded-pill border-dark-blue" id="regPassword" name="regPassword" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark-blue rounded-pill py-2" name="lo">تسجيل الدخول</button>
                    </div>
                </form>
            </div>
            <!-- Left Panel (Image Section) -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-4 bg-dark-blue text-white">
                <h2 class="mb-4">تسجيل الدخول</h2>
                <img src="assets/images/login.png" alt="Register Illustration" class="img-fluid login-illustration">
            </div>


        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
