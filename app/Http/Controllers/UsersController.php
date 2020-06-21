<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserInfoChange;
use App\Http\Requests\UserPassChange;
use App\Product;
use App\Cart;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    public function userinfo()
    {
        $y_m_d = $this->year_month_day();
        $age = $this -> age();
        $data = ['age'=>$age,
                'old_year'=>$y_m_d[0],
                'old_month'=>$y_m_d[1],
                'old_day'=>$y_m_d[2]];
        return view('users.userinfo',$data);
    }

    public function userinfo_change(UserInfoChange $request){
        $id = Auth::user()->id;
        $name = User::find($id)->name;
        $email = User::find($id)->email;
        if($name != $request->name){
            User::find($id)->update(['name'=>$request->name]);
        }
        if($email != $request->email){
            User::find($id)->update(['email'=>$request->email]);
        }
        return redirect('/shopping/users/userinfo');
    }

    public function pass_change(UserPassChange  $request){
        //現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            $msg = "現在のパスワードが間違っています。";
            return view('users.message',$data);
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる
        if($request->current_password==$request->new_password) {
            $msg = "現在と同じパスワードです。";
            $data = ['msg'=>$msg];
            return view('users.userinfo',$data);
        }

        //パスワードを変更
        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();


        $msg = "パスワードを変更しました。";
        $data = ['msg'=>$msg];
        return view('users.userinfo',$data);
    }

    public function year_month_day(){
        $birthday = Auth::user()->birthday;
        $year = date('Y',strtotime($birthday));
        $month = date('n',strtotime($birthday));
        $day = date('j',strtotime($birthday));
        return [$year,$month,$day];
    }

    public function cash(){
        return view('users.cash');
    }

    public function age(){
         $birthday = Auth::user()->birthday;
         $dob = Carbon::parse($birthday);
         $age = $dob->age;
         return $age;
    }

    public function message(){
        return view('users.message');
    }

}
