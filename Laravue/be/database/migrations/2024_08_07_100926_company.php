<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id'); //id manager chính là id của công ty 
            $table->string('company'); //tên công ty
            $table->text('description')->default('Công ty chưa có mô tả'); //mô tả công ty
            $table->timestamp('since')->default(DB::raw('CURRENT_TIMESTAMP')); //thời gian thành lập công ty
        });
        DB::statement('ALTER TABLE manager AUTO_INCREMENT = 1200300');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
