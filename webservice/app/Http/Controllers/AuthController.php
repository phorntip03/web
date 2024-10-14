<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ยังคงใช้โมเดล User สำหรับการจัดการผู้ใช้
use App\Models\FlowerShop; // เพิ่มโมเดล FlowerShop สำหรับร้านดอกไม้
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    // เพิ่มฟังก์ชันสำหรับการเข้าถึง FlowerShop
    public function getFlowerShops(Request $request)
    {
        // ตรวจสอบสิทธิ์ผู้ใช้ก่อนเข้าถึงข้อมูล FlowerShop
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // ดึงข้อมูล FlowerShop ที่ผู้ใช้สามารถเข้าถึง
        $flowerShops = FlowerShop::where('user_id', $user->id)->get();

        return response()->json($flowerShops);
    }
}
