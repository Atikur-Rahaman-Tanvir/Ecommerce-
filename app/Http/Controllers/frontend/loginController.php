<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if(!$validator->fails()){

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return response()->json(['success' =>'Login Successfully']);
            }
            else{
                return response()->json(['not_match' => 'Email or Password No Matched']);
            }

        }
        else{
            return response()->json(['fails' => $validator->errors()]);
        }
    }
}
