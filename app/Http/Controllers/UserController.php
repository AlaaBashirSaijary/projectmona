<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

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
}
