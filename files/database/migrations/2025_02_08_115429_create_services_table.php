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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('delivery_time'); 
            $table->decimal('price', 10, 2);
            $table->boolean('status')->default(true); // مفعلة أم لا
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // مزود الخدمة
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // تصنيف الخدمة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
