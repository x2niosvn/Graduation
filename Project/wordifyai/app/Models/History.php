<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';

    protected $fillable = [
        'user_id',
        'action',
    ];

    public $timestamps = true;  //  tự động cập nhật 'created_at'


    // Một lịch sử thuộc về một người dùng
    public function user()
    {
    return $this->belongsTo(User::class);
    }

}