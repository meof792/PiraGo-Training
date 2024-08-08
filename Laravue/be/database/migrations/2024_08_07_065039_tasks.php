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
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id'); //id task
            $table->string('name'); //tên của task
            $table->text('description'); //mô tả task
            $table->integer('incompany'); //id của công ty
            $table->date('deadline'); //ngày hết hạn

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');    
    }
};
