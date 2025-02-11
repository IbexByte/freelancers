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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // ربط الخدمة (عند حذف الخدمة تُحذف تقييماتها أيضاً)
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            // ربط المستخدم الذي قام بالتقييم (تأكد من وجود جدول users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // تقييم رقمي من 1 إلى 5
            $table->unsignedTinyInteger('rating');
            // تعليق المستخدم (يمكن تركه فارغاً)
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
