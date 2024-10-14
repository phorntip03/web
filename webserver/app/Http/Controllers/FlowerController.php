<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flower; // แทนที่ด้วยโมเดลของคุณ

class FlowerController extends Controller
{
    public function index()
    {
        return Flower::all(); // แสดงทั้งหมด
    }

    public function show($id)
    {
        return Flower::findOrFail($id); // แสดงเฉพาะไอดี
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // เพิ่มกฎการตรวจสอบข้อมูลที่จำเป็นอื่น ๆ
        ]);

        $flower = Flower::create($request->all()); // เพิ่มข้อมูล

        return response()->json($flower, 201); // ส่งคืนข้อมูลที่ถูกสร้าง
    }

    public function update(Request $request, $id)
{
    $flower = Flower::findOrFail($id);
    $flower->update($request->all());
    return response()->json($flower, 200);
}

public function destroy($id) 
{
    $flower = Flower::findOrFail($id);
    $flower->delete(); // ลบข้อมูล

    // ส่งคืนข้อความ JSON พร้อมสถานะ 200 OK
    return response()->json(['message' => 'ลบเรียบร้อย'], 200);
}

}
