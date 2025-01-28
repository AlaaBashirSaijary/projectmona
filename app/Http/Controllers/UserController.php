<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function toggleRole($id)
    {
        $user = User::findOrFail($id);
        if ($user->hasRole('admin')) {
            // إذا كان المستخدم لديه دور "admin"، قم بتغييره إلى "user"
            $user->removeRole('admin');
            $user->assignRole('user');
            $message = 'User role changed to user';
        } else {
            $user->removeRole('user');
            $user->assignRole('admin');
            $message = 'User role changed to admin';
        }
        return response()->json(['message' => $message, 'user' => $user]);
    }

    public function getAdmins()
    {
        // الحصول على جميع المستخدمين الذين لديهم دور "admin"
        $admins = User::role('admin')->get();

        // إرجاع النتيجة كـ JSON
        return response()->json(['admins' => $admins]);
    }

    public function getAllUsersIfAdmin()
    {
        // التحقق من أن المستخدم الحالي لديه دور "admin"
        if (Auth::user()->hasRole('admin')) {
            // استرجاع جميع المستخدمين من قاعدة البيانات
            $users = User::all();
            return response()->json(['users' => $users]);
        } else {
            // إذا لم يكن المستخدم الحالي لديه دور "admin"، قم بإرجاع رسالة خطأ
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }
    public function banUser($id)
    {
        // التحقق من أن المستخدم الحالي لديه دور "admin"
        if (Auth::user()->hasRole('admin')) {
            // البحث عن المستخدم المراد حظره
            $user = User::findOrFail($id);

            // تحديث حقل `is_banned` ليكون `true`
            $user->update(['is_banned' => true]);

            return response()->json(['message' => 'User banned successfully', 'user' => $user]);
        } else {
            // إذا لم يكن المستخدم الحالي لديه دور "admin"، قم بإرجاع رسالة خطأ
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }
    public function deleteUser($id)
    {
        // التحقق من أن المستخدم الحالي لديه دور "admin"
        if (Auth::user()->hasRole('admin')) {
            // البحث عن المستخدم المراد حذفه
            $user = User::findOrFail($id);

            // حذف المستخدم
            $user->delete();

            return response()->json(['message' => 'User deleted successfully']);
        } else {
            // إذا لم يكن المستخدم الحالي لديه دور "admin"، قم بإرجاع رسالة خطأ
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }
}
