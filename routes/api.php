<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/users', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);

Route::middleware(ApiAuthMiddleware::class)->group(function () {
    Route::get('/users/getupdate', [UserController::class, 'get']);
    Route::patch('/users/getupdate', [UserController::class, 'update']);
    Route::delete('/users/logout', [UserController::class, 'logout']);

    // Route::put('/expenses', [ExpenseController::class, 'update']);
    // Route::delete('/expenses', [ExpenseController::class, 'delete']);
    Route::get('expenses/filter', [ExpenseController::class, 'filterByDateRange']);

    Route::apiResource('expenses', ExpenseController::class);
    // Route untuk pemasukkan (Income)
    Route::apiResource('incomes', IncomeController::class);
});
