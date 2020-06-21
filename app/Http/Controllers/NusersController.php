<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NusersController extends Controller
{
    public function member(){
        return view('nusers.member');
    }
    
    public function login(){

        return view('nusers.login');
    }

    public function register(){
        return view('nusers.register');
    }

    public function search(){
        return view('nusers.search_result');
    }
}
