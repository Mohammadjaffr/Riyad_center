@extends('layouts.master')
@section('title', 'لوحة الملابس')
@section('content')
    @if(session('success') || session('error'))
        <div class="message-center" style="position: fixed;left: 50%;transform: translate(-50%, -50%);z-index: 9999;padding: 20px;border-radius: 8px;text-align: center;animation: fadeInOut 4s forwards;
        {{ session('success') ? 'background: #4CAF50; color: white;' : 'background: #F44336; color: white;' }}">
            {{ session('success') ?? session('error') }}
        </div>
    @endif

    <style>
        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; visibility: hidden; }
        }
    </style>
    <div class="container py-4">
        <h2 class="text-center mb-4 text-dark-blue">لوحة تحكم قسم الملابس</h2>

        <div class="container-fluid px-2">
            <div class="row g-3 mb-4">
                <!-- الموظفين -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card invoice-card text-center custom-shadow h-100">
                        <div class="card-body p-3">
                            <div class="fw-bold text-white bg-dark-blue rounded-3 py-1 mb-2" style="font-size: 1.1rem;">الموظفين</div>
                            <div class="fs-2 fw-bold">{{$totalEmployees }}</div>
                            <div class="mt-2">
                                <i class="fa fa-users fa-lg text-dark-blue"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- القطع المباعة -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card invoice-card text-center custom-shadow h-100">
                        <div class="card-body p-3">
                            <div class="fw-bold text-white rounded-3 py-1 mb-2" style="background: #FFCF55; border-radius: 0.5rem; font-size: 1.1rem;">القطع المباعة</div>
                            <div class="fs-2 fw-bold">{{ $totalSoldItems}}</div>
                            <div class="mt-2">
                                <i class="fa fa-chart-line fa-lg" style="color: #FFCF55;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- القطع المشتراة -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card invoice-card text-center custom-shadow h-100">
                        <div class="card-body p-3">
                            <div class="fw-bold text-white bg-dark-blue rounded-3 py-1 mb-2" style="font-size: 1.1rem;">القطع المشتراة</div>
                            <div class="fs-2 fw-bold">{{ $totalPurchasedItems}}</div>
                            <div class="mt-2">
                                <i class="fa fa-shopping-cart fa-lg text-dark-blue"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- القطع المتبقية -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card invoice-card text-center custom-shadow h-100">
                        <div class="card-body p-3">
                            <div class="fw-bold text-white rounded-3 py-1 mb-2 card-bg-invoice-out" style="font-size: 1.1rem;">القطع المتبقية</div>
                            <div class="fs-2 fw-bold">{{  $totalStockItems}}</div>
                            <div class="mt-2">
                                <i class="fa fa-boxes fa-lg card-icon-invoice-out"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12 col-lg-4 d-flex flex-column gap-3">
                    <!-- بطاقة المدير -->
                    <div class="card h-100 p-4 text-center custom-shadow" style="min-height: 230px;">
                        <div class="d-flex flex-column align-items-center mb-2">
                            <div class="manager-avatar-wrapper">
                                <img src="{{ asset('assets/images/user.png') }}" alt="User" class="manager-avatar-img">
                                <span class="manager-avatar-badge">
                            <i class="fa fa-check"></i>
                        </span>
                            </div>
                        </div>
                        <div class="fw-bold fs-5 mb-1 card-title-dark">موظف قسم الملابس</div>
                        <div class="mb-1 " style="font-size: 1rem; ">اسم المستخدم: <span class="fw-normal">{{Auth()->user()->name}}</span></div>
                        <div class="mb-0" style="font-size: 1rem; ">الهاتف: <span class="fw-normal">{{Auth()->user()->phone}}</span></div>
                    </div>
                    <!-- بطاقة نبذة عن المركز -->
                    <div class="card p-4 text-center custom-shadow" style="min-height: 150px;">
                        <div class="fw-bold fs-5 mb-2 card-title-dark">نبذة عن المركز</div>
                        <div class="text-muted" style="font-size: 1.1rem;">مركز متخصص لبيع الملابس والاحذية<br>و تفصيل الثياب والبدل</div>
                    </div>
                </div>
                <!-- المخطط -->
                <div class="col-12 col-lg-8">
                    <div class="card h-100 p-3">
                        <div class="d-flex flex-column align-items-center mb-2">
                            <div class="w-100 mb-2">
                                <ul class="dashboard-filters">
                                    <li><span class="dashboard-dot dashboard-dot-clients"></span><span class="dashboard-filter-label">الموظفين</span></li>
                                    <li><span class="dashboard-dot dashboard-dot-sellers"></span><span class="dashboard-filter-label">القطع المباعة</span></li>
                                    <li><span class="dashboard-dot dashboard-dot-invoices"></span><span class="dashboard-filter-label">القطع المشتراة</span></li>
                                    <li><span class="dashboard-dot dashboard-dot-invoices-received"></span><span class="dashboard-filter-label">القطع المتبقية</span></li>
                                </ul>
                            </div>
                            <div class="w-100">
                                <canvas id="dashboardBarChart" height="120" class="dashboard-chart-bg"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            const ctx = document.getElementById('dashboardBarChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['الموظفين', 'القطع المباعة', 'القطع المشتراة', 'القطع المتبقية'],
                    datasets: [{
                        label: 'عدد',
                        data: [{{ $totalEmployees }}, {{ $totalSoldItems }}, {{ $totalPurchasedItems }}, {{ $totalStockItems }}],
                        backgroundColor: [
                            '#11294F', // الموظفين
                            '#FFCF55', // القطع المباعة
                            '#11294F', // القطع المشتراة
                            '#A4C8E1', // القطع المتبقية
                        ],
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    indexAxis: 'x',
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { rtl: true }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { family: 'Cairo' }, color: '#11294F' }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: '#eee' },
                            ticks: { font: { family: 'Cairo' }, color: '#11294F' }
                        }
                    }
                }
            });
        </script>


    </div>
@endsection
