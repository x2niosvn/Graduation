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
        Schema::create('evaluation_situations', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự tăng
            $table->string('value')->unique(); // Trường value, có thể là một chuỗi
            $table->string('label'); // Trường label, có thể là một chuỗi
            $table->timestamps(); // Tạo trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_situations');
    }
};
