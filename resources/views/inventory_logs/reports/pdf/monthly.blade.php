
    <style>
        body { font-family: DejaVu Sans, sans-serif; direction: rtl; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        .store-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e9ecef;
        }
        .store-logo img {
            width: 90px;
            height: auto;
            display: block;
        }
        .store-text {
            text-align: center;
        }
        .store-name {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 4px;
        }
        .store-details {
            font-size: 13px;
            color: #495057;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
        }
        .company-info {
            color: #6c757d;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
    <div class="store-header">
        <div class="store-logo">
            <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo" style="width:80px;height: 80px; margin-right: 45%">
        </div>
        <div class="store-text">
            <div class="store-name">مركز الرياض للملابس الرجالية الجاهزة والأحذية والبدلات</div>
            <div class="store-details">
                العنوان: القطن - شارع رئيسي | هاتف: 05455555
            </div>
        </div>
    </div>
    <h2 style="text-align: center;">تقرير الجرد الشهري - {{ now()->format('Y/m') }}</h2>
    <table>
        <thead>
        <tr>
            <th>المنتج</th>
            <th>النوع</th>
            <th>الكمية</th>
            <th>الوصف</th>
            <th>الموظف</th>
            <th>التاريخ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            <tr>
                <td>{{ $log->productVariant->product->name }}</td>
                <td>{{ $log->change_type }}</td>
                <td>{{ $log->quantity }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->employee->name }}</td>
                <td>{{ $log->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <div class="company-info">
            مركز الرياض للملابس الرجالية الجاهزة والأحذية والبدلات  <br>
            جميع الحقوق محفوظة © {{ date('Y') }}
        </div>
    </div>
