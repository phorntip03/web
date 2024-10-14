<?php

namespace App\Http\Controllers;

use App\Models\FlowerShop; // เปลี่ยนจาก Product เป็น FlowerShop
use Illuminate\Http\Request;
use App\Http\Resources\FlowerShopResource; // สร้าง resource สำหรับ FlowerShop
use Illuminate\Support\Facades\Log;

class FlowerShopController extends Controller
{

    public function index()
    {
        return FlowerShopResource::collection(FlowerShop::all()); // เปลี่ยนเป็น FlowerShop::all()
    }

    public function store(Request $request)
    {
        try {
            // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
            ]);

            // สร้างสินค้าใหม่
            $flowerShop = FlowerShop::create($validatedData); // เปลี่ยนเป็น FlowerShop

            // ส่งการตอบกลับ JSON พร้อมข้อมูลสินค้าใหม่
            return response()->json($flowerShop, 201);

        } catch (\Exception $e) {
            // บันทึกข้อผิดพลาดลงใน log
            Log::error($e->getMessage());

            // ส่งการตอบกลับ JSON พร้อมรายละเอียดข้อผิดพลาด
            return response()->json(['error' => $e->getMessage()], 500); // เพิ่มการแสดงข้อผิดพลาดใน response
        }
    }

    public function show($id)
    {
        return FlowerShop::find($id); // เปลี่ยนเป็น FlowerShop::find()
    }

    public function update(Request $request, $id)
    {
        try {
            // ค้นหาผลิตภัณฑ์ตามไอดี
            $flowerShop = FlowerShop::findOrFail($id); // เปลี่ยนเป็น FlowerShop

            // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
            ]);

            // อัปเดตข้อมูลของผลิตภัณฑ์
            $flowerShop->update($validatedData); // เปลี่ยนเป็น FlowerShop

            // ส่งการตอบกลับ JSON พร้อมข้อมูลสินค้าใหม่
            return response()->json($flowerShop, 200);

        } catch (\Illuminate\Database\QueryException $e) {
            // แสดงข้อความข้อผิดพลาดจากฐานข้อมูล
            return response()->json(['error' => $e->getMessage()], 500);

        } catch (\Exception $e) {
            // แสดงข้อความข้อผิดพลาดทั่วไป
            return response()->json(['error' => 'มีบางอย่างผิดพลาดในกระบวนการอัปเดตข้อมูล'], 500);
        }
    }

    public function destroy($id)
    {
        // ค้นหาสินค้าในฐานข้อมูล
        $flowerShop = FlowerShop::find($id); // เปลี่ยนเป็น FlowerShop

        // ตรวจสอบว่าสินค้ามีอยู่หรือไม่
        if (!$flowerShop) {
            return response()->json(['error' => 'Product not found.'], 404); // เปลี่ยนข้อความให้ตรงกับ FlowerShop
        }

        // ลบสินค้า
        $flowerShop->delete();

        // ส่งการตอบกลับ JSON พร้อมข้อความสำเร็จ
        return response()->json(['success' => 'ลบร้านดอกไม้เรียบร้อยแล้ว.'], 200); // ปรับข้อความให้ตรงกับร้านดอกไม้
    }
}
