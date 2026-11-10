<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - نظام الحجوزات</title>

    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --header-bg: #1e293b;
            --header-text: #ffffff;
            --bg-body: #f8fafc;
            --card-bg: #ffffff;
            --price-bg: #f0fdf4;
            --price-text: #166534;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-body);
            margin: 0;
            padding: 0;
            color: #334155;
        }

        .main-header {
            background-color: var(--header-bg);
            color: var(--header-text);
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .main-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .main-header p {
            margin: 4px 0 0 0;
            font-size: 13px;
            color: #94a3b8;
        }

        .logout-btn {
            background-color: transparent;
            border: 1px solid #475569;
            color: #cbd5e1;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            border-color: #f1f5f9;
        }

        .main-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            border-right: 4px solid var(--primary-color);
            padding-right: 10px;
        }

        .services-grid {
            display: grid;
            grid-template-cols: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 50px;
        }

        .service-card {
            background-color: var(--card-bg);
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 18px;
            color: #1e293b;
        }

        .price-tag {
            background-color: var(--price-bg);
            color: var(--price-text);
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            white-space: nowrap;
        }

        .card-body p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin: 0 0 20px 0;
        }

        .card-footer {
            border-top: 1px solid #f1f5f9;
            padding-top: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .duration {
            font-size: 13px;
            color: #94a3b8;
        }

        .book-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.2s;
            text-align: center;
        }

        .book-btn:hover {
            background-color: var(--primary-hover);
        }

        .table-container {
            background-color: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        .bookings-table th {
            background-color: #f8fafc;
            color: #475569;
            padding: 16px;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 1px solid #e2e8f0;
        }

        .bookings-table td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #334155;
        }

        .bookings-table tr:hover {
            background-color: #f8fafc;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-pending {
            background-color: #fef9c3;
            color: #713f12;
        }

        .status-approved {
            background-color: #dcfce7;
            color: #14532d;
        }

        .status-canceled {
            background-color: #fee2e2;
            color: #7f1d1d;
        }

        .empty-text {
            text-align: center;
            color: #94a3b8;
            padding: 30px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- الهيدر العلوي الاحترافي -->
    <header class="main-header">
        <div>
            <h1>نظام الحجوزات العام</h1>
            <p>مرحباً بك في لوحة تحكمك الشخصية وجدولة خدماتك</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">تسجيل الخروج</button>
        </form>
    </header>

    <div class="main-container">

        <!-- إشعار النجاح -->
        @if(session('success'))
        <div class="alert-success">
            <span style="margin-left: 10px; font-size: 18px;">✅</span>
            {{ session('success') }}
        </div>
        @endif

        <!-- قسم الخدمات المتاحة -->
        <h2 class="section-title">الخدمات المتاحة للحجز</h2>

        @if($services->isEmpty())
        <div class="table-container">
            <p class="empty-text">لا توجد خدمات متاحة حالياً في السستم.</p>
        </div>
        @else
        <div class="services-grid">
            @foreach($services as $service)
            <div class="service-card">
                <div>
                    <div class="card-header">
                        <h3>{{ $service->name }}</h3>
                        <span class="price-tag">{{ $service->price }} د.ب</span>
                    </div>
                    <div class="card-body">
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="duration">⏱️ {{ $service->duration_minutes }} دقيقة</span>
                    <a href="{{ route('book.create', $service->id) }}" class="book-btn">احجز الآن</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- قسم استعراض الحجوزات الحالية -->
        <h2 class="section-title">مواعيدي وحجوزاتي الحالية</h2>

        <div class="table-container">
            @if($userBookings->isEmpty())
            <p class="empty-text">لم تقم بإجراء أي حجوزات بعد. اختر خدمة من الأعلى وابدأ الحجز!</p>
            @else
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>رقم الحجز</th>
                        <th>الخدمة المطلوبة</th>
                        <th>التاريخ والوقت المعين</th>
                        <th>حالة الطلب الحالية</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userBookings as $booking)
                    <tr>
                        <td style="font-weight: 600;">#{{ $booking->id }}</td>
                        <!-- استدعاء اسم الخدمة تلقائياً عبر العلاقة البرمجية -->
                        <td style="font-weight: 600; color: var(--primary-color);">{{ $booking->service->name }}</td>
                        <td style="color: #64748b;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d - g:i A') }}</td>
                        <td>
                            @if($booking->status == 'pending')
                            <span class="status-badge status-pending">⏳ قيد الانتظار</span>
                            @elseif($booking->status == 'approved')
                            <span class="status-badge status-approved">✅ مقبول</span>
                            @else
                            <span class="status-badge status-canceled">❌ ملغى</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->status == 'pending')
                            <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في إلغاء هذا الحجز؟');">
                                @csrf
                                <button type="submit" style="background-color: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;">
                                    إلغاء الحجز
                                </button>
                            </form>
                            @else
                            <span style="color: #94a3b8; font-size: 12px;">لا توجد إجراءات</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            @endif
        </div>

    </div>

</body>

</html>