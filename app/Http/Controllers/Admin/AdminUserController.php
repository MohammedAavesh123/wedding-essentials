<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $data = Admin::orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = Admin::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('admin.users.index')
                        ->with('success','Admin user created successfully');
    }

    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $user = Admin::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($id)],
            'password' => 'nullable|same:confirm-password', // nullable for update
            'roles' => 'required'
        ]);
    
        $input = $request->except(['password', 'confirm-password', 'roles']);
        
        if(!empty($request->input('password'))){ 
            $input['password'] = Hash::make($request->input('password'));
        }

        $user->update($input);
        
        // Detach old roles and assign new
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('admin.users.index')
                        ->with('success','Admin user updated successfully');
    }

    public function destroy($id)
    {
        if(auth('admin')->id() == $id) {
            return redirect()->route('admin.users.index')->with('error', 'Cannot delete yourself!');
        }
        Admin::find($id)->delete();
        return redirect()->route('admin.users.index')
                        ->with('success','User deleted successfully');
    }
}
