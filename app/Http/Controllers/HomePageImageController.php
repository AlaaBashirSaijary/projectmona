<?php

namespace App\Http\Controllers;
use App\Models\HomePageImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomePageImageController extends Controller
{
    public function index()
    {
        $images = HomePageImage::all();
        //dd($images);
        foreach ($images as $image) {
            $image->image_path = asset('/storage/'. $image->image_path);
        }
        return response()->json($images);
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePath = $request->file('image')->store('images', 'public');
        $image = HomePageImage::create([
            'image_path' => $imagePath,
        ]);

        return response()->json($image, 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // تحقق من أن الملف صورة (اختياري)
        ]);
        $image = HomePageImage::findOrFail($id);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($image->image_path);
            $request->file('image')->store('images', 'public');


        }
        $image->save();
        $image->image_path = asset('/storage/'. $image->image_path);
        return response()->json($image);
    }
    public function destroy($id)
    {
        $image = HomePageImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return response()->json(null, 204);
    }
    public function show($id)
{
    $image = HomePageImage::findOrFail($id);
    $image->image_path = asset('/storage/'. $image->image_path);
    return response()->json($image);
}
}
