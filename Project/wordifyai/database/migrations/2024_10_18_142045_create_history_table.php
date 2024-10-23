<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id();  // Tạo trường 'id' tự tăng
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Khóa ngoại liên kết với bảng users
            $table->string('action');  // Hành động của người dùng
            $table->timestamps();  // Tạo trường 'created_at' và 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }
};
