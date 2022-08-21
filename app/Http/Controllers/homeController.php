<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index(){
        if(Auth::user()->role_id == 1){
            return redirect()->route('admin.home');
        }
        else{
            return redirect()->route('home');
        }
    }
}
