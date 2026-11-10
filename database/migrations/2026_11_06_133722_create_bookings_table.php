<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // العميل
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // الخدمة المحجوزة
            $table->foreignId('provider_id')->nullable()->constrained('users')->onDelete('set null');
             // اسم مقدم الخدمة أو الموظف المسؤول
            $table->dateTime('booking_date'); // تاريخ ووقت الحجز بالتحديد
            $table->string('status')->default('pending'); // حالة الحجز: معلق، مقبول، ملغى
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
