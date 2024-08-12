<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function all()
    {
        $admin = Admin::where('isDeleted', 0)->Paginate(5);
        return view('admin.users.list_user', compact('admin'));
    }
    public function softDeletedUser($id)
    {
        DB::table("admin")
            ->where("id", $id)
            ->update(['isDeleted' => 1]);
        return redirect()->route('user.all');
    }
    public function updateAdmin(Request $request, $id)
{
    $admin = Admin::find($id);
    if (!$admin) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    // Validation rules
    $rules = [
        'username' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|string|email|max:255|unique:admin,email,' . $id,
        'password' => 'sometimes|nullable|string|min:8|confirmed',
        'phone_number' => 'sometimes|required|string|max:15',
    ];
    $messages = [
        'email.unique' => 'Email đã tồn tại.',
        'current_password.required_with' => 'Mật khẩu hiện tại là bắt buộc khi thay đổi mật khẩu.',
        'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        'password.min' => 'Mật khẩu phải đủ 8 kí tự',
        // Add other custom messages as needed
    ];

    // Validate the request
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    if ($request->filled('password') && !Hash::check($request->input('current_password'), $admin->password)) {
        return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
    }

    // Update customer data if present in the request
    if ($request->has('username')) {
        $admin->username = $request->input('username');
    }
    if ($request->has('email')) {
        $admin->email = $request->input('email');
    }
    if ($request->filled('password')) {
        $admin->password = Hash::make($request->input('password'));
    }
    if ($request->has('phone_number')) {
        $admin->phone_number = $request->input('phone_number');
    }
    session()->forget('admin');
        session()->put('admin', $admin);
    // Save the updated customer
    $admin->save();
    return redirect()->back();
}
public function editUser($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.users.information_user', compact('admin'));
    }

public function updateInformationUser(Request $request, $id)
{
    $admin = Admin::find($id);
    if (!$admin) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    // Validation rules
    $rules = [
        'username' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|string|email|max:255|unique:admin,email,' . $id,
        'password' => 'sometimes|nullable|string|min:8|confirmed',
        'phone_number' => 'sometimes|required|string|max:15',
        'level' => 'sometimes|required'
    ];
    $messages = [
        'email.unique' => 'Email đã tồn tại.',
        'current_password.required_with' => 'Mật khẩu hiện tại là bắt buộc khi thay đổi mật khẩu.',
        'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        'password.min' => 'Mật khẩu phải đủ 8 kí tự',
        // Add other custom messages as needed
    ];

    // Validate the request
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    if ($request->filled('password') && !Hash::check($request->input('current_password'), $admin->password)) {
        return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
    }

    // Update customer data if present in the request
    if ($request->has('username')) {
        $admin->username = $request->input('username');
    }
    if ($request->has('email')) {
        $admin->email = $request->input('email');
    }
    if ($request->filled('password')) {
        $admin->password = Hash::make($request->input('password'));
    }
    if ($request->has('phone_number')) {
        $admin->phone_number = $request->input('phone_number');
    }
    if ($request->has('level')) {
        $admin->level = $request->input('level');
    }
    $admin->save();
    return redirect('/admin/list-user');
}
}
