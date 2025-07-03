
<div class="container-fluid px-2">
    <div class="row g-3 mb-4">
        <!-- الموظفين -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card invoice-card text-center custom-shadow h-100">
                <div class="card-body p-3">
                    <div class="fw-bold text-white bg-dark-blue rounded-3 py-1 mb-2" style="font-size: 1.1rem;">الموظفين</div>
                    <div class="fs-2 fw-bold">10000</div>
                    <div class="mt-2">
                        <i class="fa fa-users fa-lg text-dark-blue"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- المبيعات -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card invoice-card text-center custom-shadow h-100">
                <div class="card-body p-3">
                    <div class="fw-bold text-white rounded-3 py-1 mb-2" style="background: #FFCF55; border-radius: 0.5rem; font-size: 1.1rem;">المبيعات</div>
                    <div class="fs-2 fw-bold">100</div>
                    <div class="mt-2">
                        <i class="fa fa-user-tie fa-lg" style="color: #FFCF55;"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- المخزون  -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card invoice-card text-center custom-shadow h-100">
                <div class="card-body p-3">
                    <div class="fw-bold text-white rounded-3 py-1 mb-2 card-bg-invoice-out" style="font-size: 1.1rem;">المخزون </div>
                    <div class="fs-2 fw-bold">10000</div>
                    <div class="mt-2">
                        <i class="fa fa-file-invoice fa-lg card-icon-invoice-out"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- الربح -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card invoice-card text-center custom-shadow h-100">
                <div class="card-body p-3">
                    <div class="fw-bold text-white bg-primary rounded-3 py-1 mb-2" style="font-size: 1.1rem; background: #1877f2 !important;">الربح</div>
                    <div class="fs-2 fw-bold">10000</div>
                    <div class="mt-2">
                        <i class="fa fa-file-invoice-dollar fa-lg" style="color: #1877f2;"></i>
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
                <div class="fw-bold fs-5 mb-1 card-title-dark">المدير</div>
                <div class="mb-1 " style="font-size: 1rem; ">اسم المستخدم: <span class="fw-normal">احمد</span></div>
                <div class="mb-0" style="font-size: 1rem; ">الهاتف: <span class="fw-normal">777249473</span></div>
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
                            <li><span class="dashboard-dot dashboard-dot-sellers"></span><span class="dashboard-filter-label">المبيعات</span></li>
                            <li><span class="dashboard-dot dashboard-dot-invoices"></span><span class="dashboard-filter-label"> المخزون</span></li>
                            <li><span class="dashboard-dot dashboard-dot-invoices-received"></span><span class="dashboard-filter-label"> الربح</span></li>
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
<script>
    const ctx = document.getElementById('dashboardBarChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['الربح', 'المخزون', 'المبيعات','الموظفين' ],
            datasets: [{
                label: 'عدد',
                data: [30, 25, 40, 32],
                backgroundColor: [
                    '#1877f2',  // الربح
                    '#A4C8E1', // المخزون
                    '#FFCF55', // المبيعات
                    '#11294F', // الموظفين


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

