<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);

        return view('admin.users.list', [
            'title' => 'Danh sách người dùng',
            'users' => $users
        ]);
    }
    public function create()
    {
        $levels = [0 => 'Admin', 1 => 'User'];
        return view('admin.users.add', [
            'title' => 'Thêm Người Dùng Mới',
            'levels' => $levels
        ]);
    }


    public function store(Request $request)
    {
        // Validation logic here
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        try {
            // Create a new user based on form data
            $users = new User();
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            $users->password = Hash::make($request->input('password'));
            $users->level = $request->input('level');
            // Save users to the database

            $users->save();

            // Redirect to users list or show success message
            return redirect()->back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            // Handle any exceptions, e.g., database errors
            return redirect()->back()->with('error', 'User creation failed: ' . $e->getMessage());
        }

    }

    public function edit($id)
    {
        $levels = [0 => 'Admin', 1 => 'User'];
        $users = User::findOrFail($id);
        return view('admin.users.edit',[
            'title'=> 'Chỉnh sửa',
            'users' => $users,
            'levels' => $levels
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validation logic here
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        try {
            // Update user data based on form data
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->has('password') && $request->input('password') != null) {
                // Only hash the password if it's not null
                $user->password = Hash::make($request->input('password'));
            }

            $user->level = $request->input('level');

            // Save updated user to the database
            $user->save();

            return redirect('/admin/users/list')
                ->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            // Handle any exceptions, e.g., database errors
            return redirect()->back()->with('error', 'User failed to update: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        // Find the user by ID
        $users = User::findOrFail($id);

        // Delete the user from the database
        $users->delete();

        // Redirect to user list or show success message
        return redirect()->route('admin.users.list')->with('success', 'User deleted successfully');
    }

    public function show($id)
    {
        $users = User::findOrFail($id);
        return view('admin.users.list',[
            'users' => $users
        ]);
    }

}
