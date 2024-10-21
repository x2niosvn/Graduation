<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationSituation extends Model
{
    protected $table = 'evaluation_situations'; // Tên bảng
    protected $fillable = ['value', 'label']; // Các trường có thể gán giá trị
}
