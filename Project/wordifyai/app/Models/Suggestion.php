<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'suggestion_text', 'status', 'admin_feedback'
    ];

    
    public $timestamps = true;  //  tự động cập nhật 'created_at'
}
