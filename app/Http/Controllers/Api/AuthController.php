<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Role;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;





//"token in postman": "1|RE8A4FTe7wyQpUdIWCCS1RFodmTnDxJMzJUkvBUA"
//"token in db table" : e42d3b812891fcbdc57baeb04a2e2e287b82b8bcc386a39c26768f0039c1f5fe


class AuthController extends Controller
{
    

    public function register(Request $request){



        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:5|max:25|confirmed',       
            //validation "confrmed" will swarch for the another field wirh password_confirmation name and apply validation rule on it
            /* 'role_id' => 'required|exists:roles,id', */
        ]);



        if($validator->fails()){
            return response()->json($validator->errors());
        }
        




        $studentRole = Role::where('name', 'student')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $studentRole->id,
        ]);



        $token = $user->createToken('auth-token');       //create token and ancrypt it then store it in db

        return ['token' => $token->plainTextToken];      //to return back its plan text


        
    }
}
