<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextAnalysis extends Model
{
    protected $table = 'text_analysis';

    protected $fillable = [
        'user_id',
        'text_content',
        'analysis_result',
        'type_of_analysis',
        'evaluation',
        'status',
        'analysis_evaluation_code',
    ];

    public $timestamps = true;  //  tự động cập nhật 'created_at'


    // Một bài phân tích thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    


}
