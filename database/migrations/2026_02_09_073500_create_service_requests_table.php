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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('source'); // e.g., 'facebook', 'website', 'phone'
            $table->text('description');
            $table->string('status')->default('pending'); // e.g., 'pending', 'quoted', 'invoiced', 'completed', 'cancelled'
            $table->date('date');
            $table->string('c_name')->nullable();
            $table->string('a_name')->nullable();
            $table->string('p_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });
        Schema::dropIfExists('service_requests');
    }
};
