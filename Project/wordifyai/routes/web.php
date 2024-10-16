<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('homepage');
});

//tất cả user đã xác thực
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// người dùng có vai trò admin (role_id = 2)
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});



//người dùng có vai trò user (role_id = 1)
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');


    Route::get('/ask-openai', function () {
        return view('ask-openai-form'); // Hiển thị form
    });
    
    Route::post('/ask-openai', [OpenAIController::class, 'askOpenAI']);
});



// Profile cho tất cả user đã đăng nhập
Route::middleware('auth')->group(function () {



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';