<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\AdminController;


//Đối với user chưa đăng nhập
Route::get('/text-analysis-evaluation-guest', [OpenAIController::class, 'showAnalysisGuestForm'])->name('text-analysis-evaluation-guest');
Route::post('/text-analysis-guest', [OpenAIController::class, 'AnalysisAndEvaluationGuest'])->name('guest-analyze-evaluation-text');




Route::get('/', function () {
    return view('homepage');
});

//tất cả user đã xác thực
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');










// Profile cho tất cả user đã đăng nhập
Route::middleware('auth')->group(function () {


// người dùng có vai trò admin (role_id = 2)
Route::middleware(['auth', 'role:2'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/user-management', [AdminController::class, 'index'])->name('user-management');



    Route::get('/user-management/create', [AdminController::class, 'create'])->name('user.create');
    Route::post('/user-management', [AdminController::class, 'store'])->name('user.store');
    Route::get('/user-management/{id}/edit', [AdminController::class, 'edit'])->name('user.edit');
    Route::put('/user-management/{id}', [AdminController::class, 'update'])->name('user.update');
    Route::delete('/user-management/{id}', [AdminController::class, 'destroy'])->name('user.destroy');


});
    



    Route::get('/text-analysis-evaluation', [OpenAIController::class, 'showAnalysisForm'])->name('text-analysis-evaluation');
    Route::post('/text-analysis', [OpenAIController::class, 'AnalysisAndEvaluation'])->name('analyze-evaluation-text');
    Route::get('/analysis-evaluation-history', [OpenAIController::class, 'showAnalysisEvaluationHistory'])->name('analysis-evaluation-history');
    Route::get('/analysis-evaluation-history/{id}', [OpenAIController::class, 'getAnalysisDetail']);
    Route::delete('/analysis-evaluation-history/{id}', [OpenAIController::class, 'destroy']);





    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';