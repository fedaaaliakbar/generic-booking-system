<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم للإدارة</title>
    <style>
        :root {
            --primary-color: #0284c7;
            /* لون سماوي/أزرق مخصص للإدارة */
            --header-bg: #0f172a;
            /* لون غامق لتمييز الإدارة */
            --header-text: #ffffff;
            --bg-body: #f8fafc;
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
        }

        .logout-btn:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        .main-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            border-right: 4px solid var(--primary-color);
            padding-right: 10px;
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

        .action-btn {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            margin-left: 4px;
            cursor: pointer;
            border: none;
        }

        .btn-approve {
            background-color: #10b981;
            color: white;
        }

        .btn-approve:hover {
            background-color: #059669;
        }

        .btn-reject {
            background-color: #ef4444;
            color: white;
        }

        .btn-reject:hover {
            background-color: #dc2626;
        }

        .empty-text {
            text-align: center;
            color: #94a3b8;
            padding: 30px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        
        select {
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 12px;
            color: #334155;
            outline: none;
            background-color: #fff;
        }
        select:focus {
            border-color: var(--primary-color);
        }
    </style>
</head>

<body>

    <header class="main-header">
        <div>
            <h1>لوحة تحكم الإدارة (المدير)</h1>
            <p>مرحباً بك، يمكنك إدارة وقبول أو رفض جميع حجوزات النظام من هنا</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">تسجيل الخروج</button>
        </form>
    </header>

    <div class="main-container">
        @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <h2 class="section-title">إدارة جميع طلبات الحجوزات الواردة</h2>

        <div class="table-container">
            @if($allBookings->isEmpty())
            <p class="empty-text">لا توجد أي حجوزات مسجلة في النظام حالياً.</p>
            @else
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>رقم الحجز</th>
                        <th>اسم العميل</th>
                        <th>اسم الحجز</th>
                        <th>التاريخ والوقت</th>
                        <th>حالة الطلب</th>
                        <th>مقدم الخدمة المسؤول</th>
                        <th>الإجراءات والتحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allBookings as $booking)
                    <tr>
                        <td style="font-weight: 600;">#{{ $booking->id }}</td>
                        <td style="font-weight: 600;">{{ $booking->user->name }}</td>
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
                            <!-- نموذج تعيين الموظف المربوط بزر القبول -->
                            <form id="approve-form-{{ $booking->id }}" action="{{ route('admin.booking.status', [$booking->id, 'approved']) }}" method="POST" style="display: flex; align-items: center; gap: 6px;">
                                @csrf
                                <select name="provider_id" required>
                                    <option value="">-- اختر مقدم الخدمة --</option>
                                    @foreach($providers as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                            @else
                            <span style="color:#64748b; font-weight: 500;">
                                👤 {{ $booking->provider->name ?? 'غير معين' }}
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($booking->status == 'pending')
                            <div style="display: flex; align-items: center;">
                                <!-- زر القبول يقوم بإرسال نموذج التعيين البرمي المربوط به أعلاه -->
                                <button type="submit" form="approve-form-{{ $booking->id }}" class="action-btn btn-approve">
                                    قبول وتعيين
                                </button>

                                <form action="{{ route('admin.booking.status', [$booking->id, 'canceled']) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="action-btn btn-reject">رفض</button>
                                </form>
                            </div>
                            @else
                            <span style="color:#94a3b8; font-size:12px; font-weight: 500;">✔️ تم اتخاذ إجراء سابق</span>
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
