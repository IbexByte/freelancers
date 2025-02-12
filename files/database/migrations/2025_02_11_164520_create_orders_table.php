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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('service_id')->constrained()->onDelete('cascade');
        $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
        $table->enum('status', [
            'pending_approval',
            'approved',
            'in_progress',
            'delivered',
            'completed',
            'cancelled'
        ])->default('pending_approval');
        $table->text('notes')->nullable();
        $table->timestamp('requested_at')->useCurrent();
        $table->timestamp('approved_at')->nullable();
        $table->timestamp('delivered_at')->nullable();
        $table->timestamp('completed_at')->nullable();
        $table->timestamp('estimated_delivery_time')->nullable();
        $table->timestamps();
        
        // إضافة indexes لتحسين الأداء
        $table->index('status');
        $table->index('estimated_delivery_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
