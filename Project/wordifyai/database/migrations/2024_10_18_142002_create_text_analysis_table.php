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
        Schema::create('text_analysis', function (Blueprint $table) {
            $table->id();  // Tạo trường 'id' tự tăng
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Khóa ngoại liên kết với bảng users
            $table->text('text_content');  // Nội dung văn bản
            $table->text('analysis_result');  // Kết quả phân tích
            $table->string('type_of_analysis');  // Loại phân tích
            $table->text('evaluation');  // Đánh giá
            $table->string('status')->default('pending');  // Trạng thái (mặc định là 'pending')
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
        Schema::dropIfExists('text_analysis');
    }
};
