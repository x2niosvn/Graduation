<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function show_history()
    {
        //$histories = History::all();

        // Lấy ra tất cả lịch sử id người dùng hiện tại
        $histories = History::where('user_id', auth()->id())->get();
        
        return view('dashboard', compact('histories'));
    }
}