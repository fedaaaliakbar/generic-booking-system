<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // دالة لعرض صفحة تأكيد الحجز واختيار التاريخ
    public function create($service_id)
    {
        $service = Service::findOrFail($service_id);
        return view('book', compact('service'));
    }

    // دالة لاستقبال طلب الحجز وحفظه في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:now',
        ]);

        // حفظ الحجز في قاعدة البيانات
        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
            'status' => 'pending', 
        ]);

        return redirect()->route('dashboard')->with('success', 'تم تسجيل حجزك بنجاح!');
    }
    public function updateStatus(Request $request, $id, $status)
    {
        $booking = Booking::findOrFail($id);

        // إذا وافق المدير على الحجز، نقوم بحفظ الموظف المسؤول
        if ($status === 'approved') {
            $request->validate([
                'provider_id' => 'required|exists:users,id'
            ]);

            $booking->update([
                'status' => $status,
                'provider_id' => $request->provider_id
            ]);
        } else {
            // في حال الرفض
            $booking->update(['status' => $status]);
        }

        return redirect()->back()->with('success', 'تم تحديث حالة الحجز وتعيين الموظف بنجاح!');
    }

    public function cancel($id)
    {
        // جلب الحجز والتأكد أنه يخص المستخدم الحالي لمنع التلاعب البرمجي
        $booking = Booking::where('id', $id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();

        // السماح بالإلغاء فقط إذا كان الحجز قيد الانتظار
        if ($booking->status === 'pending') {
            $booking->update(['status' => 'canceled']);
            return redirect()->back()->with('success', 'تم إلغاء حجزك بنجاح.');
        }

    return redirect()->back()->with('error', 'لا يمكن إلغاء هذا الحجز لأنه تم اتخاذ إجراء سابق عليه.');
}


}
