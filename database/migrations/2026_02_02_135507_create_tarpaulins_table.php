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
        Schema::create('tarpaulins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('print_job_id')->constrained()->onDelete('cascade');
            $table->decimal('width', 8, 2);
            $table->decimal('height', 8, 2);
            $table->integer('quantity');
            $table->string('material')->default('standard'); // standard, heavy-duty
            $table->string('layout_file_path')->nullable();
            $table->string('status')->default('to_be_printed'); // to_be_printed, printing, printed, finished
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarpaulins');
    }
};