<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد حجز الخدمة</title>

    <!-- ستايل داخلي مخصص ومحمي لترتيب المظهر بدقة 100% بدون انترنت أو سيرفرات خارجية -->
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-w: 600px;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 22px;
            color: #1f2937;
            margin: 0;
        }

        .header p {
            font-size: 14px;
            color: #6b7280;
            margin: 4px 0 0 0;
        }

        .back-link {
            font-size: 14px;
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .service-info {
            background-color: #e0e7ff;
            border: 1px solid #c7d2fe;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .service-info h3 {
            margin: 0;
            color: #312e81;
            font-size: 18px;
        }

        .service-info p {
            margin: 4px 0 0 0;
            color: #4338ca;
            font-size: 14px;
        }

        .price-badge {
            background-color: #ffffff;
            color: #4338ca;
            font-weight: 800;
            font-size: 20px;
            padding: 8px 16px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 24px;
            text-align: right;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 16px;
            box-sizing: border-box;
            color: #374151;
            text-align: right;
        }

        .form-control:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .btn-submit {
            width: 100%;
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
            padding: 14px;
            font-size: 16px;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.2s;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .btn-submit:hover {
            background-color: #4338ca;
        }

        .error-text {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">

            <!-- رأس الصفحة وزر العودة -->
            <div class="header">
                <div>
                    <h1>تأكيد حجز الخدمة</h1>
                    <p>قم باختيار الوقت والتاريخ لجدولة موعدك فوراً</p>
                </div>
                <a href="{{ route('dashboard') }}" class="back-link">
                    ← العودة للرئيسية
                </a>
            </div>

            <!-- بطاقة تفاصيل الخدمة المختارة -->
            <div class="service-info">
                <div>
                    <h3>{{ $service->name }}</h3>
                    <p>⏱️ مدة الجلسة: {{ $service->duration_minutes }} دقيقة</p>
                </div>
                <div class="price-badge">
                    {{ $service->price }} د.ب
                </div>
            </div>

            <!-- نموذج الحجز وإدخال التاريخ -->
            <form action="{{ route('book.store') }}" method="POST">
                @csrf
                <!-- إرسال معرف الخدمة مخفي -->
                <input type="hidden" name="service_id" value="{{ $service->id }}">

                <div class="form-group">
                    <label for="booking_date">اختر التاريخ والوقت المناسبين:</label>
                    <input type="datetime-local" id="booking_date" name="booking_date" required class="form-control">
                    <script>
                        // كود لمنع اختيار تواريخ قديمة مباشرة من الشاشة
                        document.addEventListener("DOMContentLoaded", function() {
                            const now = new Date();
                            // تنسيق الوقت ليطابق الصيغة المطلوبة في حقول datetime-local
                            const formattedDateTime = now.toISOString().slice(0, 16);
                            document.getElementById("booking_date").min = formattedDateTime;
                        });
                    </script>

                    @error('booking_date')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    تأكيد وإرسال طلب الحجز الآن
                </button>
            </form>

        </div>
    </div>

</body>

</html>