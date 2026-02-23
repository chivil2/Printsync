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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('serial_number')->unique();
            $table->text('description')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('status')->default('active'); // 'active', 'in_repair', 'retired'
            $table->integer('stock')->default(0);
            $table->integer('reorder_level')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
