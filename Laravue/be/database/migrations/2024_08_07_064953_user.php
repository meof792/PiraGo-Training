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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); //id manager chính là id của công ty 
            $table->string('username'); //tên đăng nhập
            $table->string('password'); //mật khẩu
            $table->date('birthday')->nullable();
            $table->string('id_card')->nullable();
            $table->string('path')->nullable(); //đường dẫn ảnh cá nhân
            $table->integer('in_company'); //tên công ty
            $table->integer('is_manager')->default(0);
            $table->timestamp('since')->default(DB::raw('CURRENT_TIMESTAMP')); //thời gian thành lập công ty
        });
        DB::statement('ALTER TABLE manager AUTO_INCREMENT = 1200300');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
