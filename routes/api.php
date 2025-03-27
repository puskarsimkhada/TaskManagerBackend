<?php
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::prefix('api')->group(function () {
    Route::get('/tasks',[TaskController::class,'index'])->name('get-tasks');
    Route::post('/tasks',[TaskController::class,'store'])->name('post-blogs');
    Route::get('/tasks/{task}',[TaskController::class,'show'])->name('show-blogs');
    Route::put('/tasks/{task}',[TaskController::class,'update'])->name('update-blogs');
    Route::delete('/tasks/{task}',[TaskController::class,'destroy'])->name('delete-blogs');
    Route::get('/test', function () {
        return response()->json(['message' => 'API is working']);
    });
// });
