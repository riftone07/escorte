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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullable()->onDelete('cascade');
            $table->string('token')->unique();
            $table->string('device_id')->nullable();
            $table->string('device_type')->nullable(); // 'android', 'ios', 'web'
            $table->string('device_name')->nullable();
            $table->string('app_version')->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['user_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
