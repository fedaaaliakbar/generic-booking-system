<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class ServiceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. لوحة تحكم المدير
        if ($user->role === 'admin') {
            $allBookings = Booking::orderBy('booking_date', 'asc')->get();
            // جلب قائمة مقدمي الخدمات لكي يتمكن المدير من تعيينهم في الحجوزات
            $providers = \App\Models\User::where('role', 'provider')->get();
            return view('admin-dashboard', compact('allBookings', 'providers'));
        }

        // 2. لوحة تحكم مقدم الخدمة (الموظف)
        if ($user->role === 'provider') {
            // جلب الحجوزات المعينة لهذا الموظف فقط والتي تم قبولها
            $providerBookings = Booking::where('provider_id', $user->id)
                ->where('status', 'approved')
                ->orderBy('booking_date', 'asc')
                ->get();
            return view('provider-dashboard', compact('providerBookings'));
        }

        // 3. لوحة تحكم العميل العادي
        $services = Service::all();
        $userBookings = Booking::where('user_id', $user->id)
            ->orderBy('booking_date', 'asc')
            ->get();

        return view('dashboard', compact('services', 'userBookings'));
    }

}
