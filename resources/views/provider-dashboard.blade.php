<div>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
</div>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم مقدم الخدمة</title>
    <style>
        :root {
            --primary-color: #10b981;       /* لون أخضر مخصص للموظفين */
            --header-bg: #064e3b;           /* لون أخضر داكن */
            --header-text: #ffffff;
            --bg-body: #f8fafc;
        }
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-body); margin: 0; padding: 0; color: #334155;
        }
        .main-header {
            background-color: var(--header-bg); color: var(--header-text); padding: 20px 40px;
            display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .main-header h1 { margin: 0; font-size: 24px; }
        .main-header p { margin: 4px 0 0 0; font-size: 13px; color: #a7f3d0; }
        .logout-btn {
            background-color: transparent; border: 1px solid #047857; color: #d1fae5;
            padding: 8px 16px; border-radius: 8px; cursor: pointer; text-decoration: none; font-size: 14px;
        }
        .logout-btn:hover { background-color: #10b981; color: white; }
        .main-container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .section-title {
            font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 20px;
            border-right: 4px solid var(--primary-color); padding-right: 10px;
        }
        .table-container { background-color: white; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .bookings-table { width: 100%; border-collapse: collapse; text-align: right; }
        .bookings-table th { background-color: #f8fafc; color: #475569; padding: 16px; font-weight: 600; font-size: 14px; border-bottom: 1px solid #e2e8f0; }
        .bookings-table td { padding: 16px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        .empty-text { text-align: center; color: #94a3b8; padding: 30px; font-size: 14px; }
    </style>
</head>
<body>

    <header class="main-header">
        <div>
            <h1>مرحباً بك: {{ Auth::user()->name }}</h1>
            <p>لوحة التحكم الفنية - جدول مواعيدك ومهامك المعتمدة الحالية</p>
        </div>
        <!-- زر تسجيل الخروج المستقل والآمن -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">تسجيل الخروج</button>
        </form>
    </header>

    <div class="main-container">
        <h2 class="section-title">جدول أعمالي المجدول الحالي</h2>

        <div class="table-container">
            @if($providerBookings->isEmpty())
                <p class="empty-text">لا توجد لديك مهام أو حجوزات معتمدة حالياً في جدولك.</p>
            @else
                <table class="bookings-table">
                    <thead>
                        <tr>
                            <th>رقم المهمة</th>
                            <th>الخدمة المطلوبة</th>
                            <th>اسم العميل</th>
                            <th>التاريخ والوقت المعين</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($providerBookings as $booking)
                            <tr>
                                <td style="font-weight: 600;">#{{ $booking->id }}</td>
                                <td style="font-weight: 600; color: #047857;">{{ $booking->service->name }}</td>
                                <td style="color: #1e293b;">{{ $booking->user->name }}</td>
                                <td style="color: #64748b;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d - g:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</body>
</html>