<?php
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
 
//For jwt token
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});



//For Task CRUD
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
