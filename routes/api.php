<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth:sanctum'])->group(function() {

    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::post('/books', [BookController::class, 'store'])->middleware('pustakawan');
    Route::patch('/books/{id}', [BookController::class, 'update'])->middleware('pustakawan');
    Route::delete('/books/{id}', [BookController::class, 'delete'])->middleware('pustakawan');

    Route::post('/borrow', [BorrowController::class, 'store'])->middleware('borrower');
    Route::delete('/borrow/{id}', [BorrowController::class, 'delete'])->middleware('pustakawan');


    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'saya']);
 });

Route::get('/books', [BookController::class, 'index']);
Route::get('/borrow', [BorrowController::class, 'index']);

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/pregister', [AuthenticationController::class, 'registerPustakawan']);
Route::post('/login', [AuthenticationController::class, 'login']);
