<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
        // Hiển thị danh sách người dùng
        public function index()
        {
            $users = User::all();
            return view('admin.user_management', compact('users'));
        }

        public function create()
        {
            return view('admin.create_user');
        }



    // Lưu người dùng mới
    public function store(Request $request)
    {
        // Validate the request with custom error messages
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'role_id' => 'required|integer',
        ]);
    
        // Create the user if validation passes
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);
    
        return redirect()->route('user-management')->with('success', 'User created successfully');
    }
    
    




    // Hiển thị form chỉnh sửa người dùng
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|integer',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('user-management')->with('success', 'User information updated successfully');
    }










    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user-management')->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->route('user-management')->with('success', 'User deleted successfully');
    }

}











