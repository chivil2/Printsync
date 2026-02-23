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
        Schema::create('repair_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_request_id')->constrained('service_requests')->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained('equipment')->onDelete('cascade');
            $table->foreignId('technician_id')->constrained('users')->onDelete('cascade'); // Assuming technician is a user
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status')->default('scheduled'); // 'scheduled', 'in_progress', 'completed', 'cancelled'
            $table->text('description')->nullable();
            $table->text('parts_needed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repair_jobs', function (Blueprint $table) {
            $table->dropForeign(['service_request_id']);
            $table->dropForeign(['equipment_id']);
            $table->dropForeign(['technician_id']);
        });
        Schema::dropIfExists('repair_jobs');
    }
};
