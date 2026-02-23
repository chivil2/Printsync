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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_request_id')->constrained('service_requests')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->date('quote_date');
            $table->date('expiration_date'); // 30 days from quote_date
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('pending'); // 'pending', 'approved', 'rejected', 'converted_to_invoice'
            $table->boolean('convert_to_invoice_flag')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropForeign(['service_request_id']);
            $table->dropForeign(['customer_id']);
        });
        Schema::dropIfExists('quotations');
    }
};
