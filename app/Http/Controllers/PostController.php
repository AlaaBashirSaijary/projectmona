<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {

        if (!auth()->check()) {
            return response()->json(['error' => 'يجب تسجيل الدخول للوصول إلى هذه الصفحة.'], 401);}
        if (auth()->user()->hasRole('admin')) {
            $posts = Post::all(); // المدير يرى جميع المنشورات
        } else {
            $posts = Post::where('user_id', auth()->id())->get(); // المستخدم يرى منشوراته فقط
        }

        return response()->json($posts);
    }

    public function store(PostRequest $request)
    {
        // إنشاء منشور جديد مع تعيين user_id للمستخدم الحالي
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(), // تعيين user_id للمستخدم الحالي
        ]);

        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        // التحقق من الدور أو ملكية المنشور
        if (auth()->user()->hasRole('admin') || $post->user_id == auth()->id()) {
            return response()->json($post);
        }

        return response()->json(['error' => 'غير مسموح لك بالوصول إلى هذا المنشور.'], 403);
    }

    public function update(PostRequest $request, Post $post)
    {
        // التحقق من الدور أو ملكية المنشور
        if (auth()->user()->hasRole('admin') || $post->user_id == auth()->id()) {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return response()->json($post, 200);
        }

        return response()->json(['error' => 'غير مسموح لك بتعديل هذا المنشور.'], 403);
    }

    public function destroy(Post $post)
    {

        if (auth()->user()->hasRole('admin') || $post->user_id == auth()->id()) {
            $post->delete();
            return response()->json(['message' => 'تم حذف المنشور بنجاح.'], 200);
        }

        return response()->json(['error' => 'غير مسموح لك بحذف هذا المنشور.'], 403);
    }
}
