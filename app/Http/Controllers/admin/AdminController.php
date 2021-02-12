<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;

use App\Models\Role;
use App\Models\User;




class AdminController extends Controller
{
    



    public function index(){

        $superAdminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();

        $data['admins'] = User::whereIn('role_id', [$superAdminRole->id, $adminRole->id])
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('admin.admins.index')->with($data);
    }





    public function create(){

        $data['roles'] = Role::select('id', 'name')
        ->whereIn('name', ['superadmin', 'admin'])
        ->get();

        return view('admin.admins.create')->with($data);
    }


    public function store(Request $request){

        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:5|max:25|confirmed',       
            //validation "confrmed" will swarch for the another field wirh password_confirmation name and apply validation rule on it
            'role_id' => 'required|exists:roles,id',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);



        event(new Registered($user));



            return redirect(url("dashboard/admins"));
    }





    public function promote($id){

        $admin = User::findOrFail($id);

        $admin->update([
            'role_id' => Role::select('id')->where('name', 'superadmin')->first()->id,
        ]);
        
        return back();
    }



    public function demote($id){

        $superadmin = User::findOrFail($id);

        $superadmin->update([
            'role_id' => Role::select('id')->where('name', 'admin')->first()->id,
        ]);
        
        return back();
    }



}
