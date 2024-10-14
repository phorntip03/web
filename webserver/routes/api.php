<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlowerController;

// Route for login
Route::post('/login', [AuthController::class, 'login']);

// Route for user info (authenticated)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route for logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// เพิ่มเส้นทางสำหรับ FlowerController ที่คุณต้องการสร้าง
Route::middleware('auth:sanctum')->get('/flowers', [FlowerController::class, 'index']); // แสดงทั้งหมด
Route::middleware('auth:sanctum')->get('/flowers/{id}', [FlowerController::class, 'show']); // แสดงเฉพาะไอดี
Route::middleware('auth:sanctum')->put('/flowers/{id}', [FlowerController::class, 'update']);
Route::middleware('auth:sanctum')->post('/flowers', [FlowerController::class, 'store']); // เพิ่มข้อมูล
Route::middleware('auth:sanctum')->delete('/flowers/{id}', [FlowerController::class, 'destroy']); // ลบข้อมูล

