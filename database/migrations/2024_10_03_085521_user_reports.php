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
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('report_date');
            $table->time('log_in');
            $table->time('log_out');
            $table->json('breaks');
            $table->time('break_total');
            $table->time('total_time');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id') 
                ->on('users')
                ->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('user_reports');
    }
};
