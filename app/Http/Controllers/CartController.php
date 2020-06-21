<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function products_cart(){
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $stocks = [];
        foreach($carts as $cart){
            $stocks[] = Product::where('id',$cart->product_id)->first()->stock;
        }
        $data = ['carts'=>$carts];
        return view('users.cart', $data);
    }

  

    public function add_cart(Request $request){//product_id,number
        $product_id = $request->product_id;
        $number = $request->number;
        $limited = $this->age_limited($product_id);
        if ($limited==0) {
            if ($this->number_check($number)==1) {
                $confirm = $this->confirm($product_id, Auth::user()->id);
                if ($confirm!=0) {
                    $cart =  Cart::where('id', $confirm)->first();
                    $old_number = $cart->number;
                    $total_number = $old_number + $number;
                    $this -> stock_management($product_id, $old_number, $total_number);
                    Cart::where('id', $confirm)->update(['number'=>$total_number]);
                } else {
                    $this->add($product_id, $number);
                }
                return $this->products_cart();
            } else {
                $msg = "申し訳ありませんが、在庫がございませんでした。";
                return view('users.message',['msg'=>$msg]);
            }
        }else{
            $msg = "$limited"."歳未満の方は購入できません。";
            return view('users.message',['msg'=>$msg]);
        }
    }

    //カートにすでにその商品があればidを返し、ないなら0を返す
    public function confirm($product_id,$user_id){
        $count = Cart::where('user_id',$user_id)->where('product_id',$product_id)->count();
       if($count != 0){
           $cart = Cart::where('user_id',$user_id)->where('product_id',$product_id)->first();
           return $cart->id;
       }
       return 0;
    }

    public function delete(Request $request){//cart_id
        
        
        $cart = Cart::where('id',$request->cart_id)->first();
        $product_id = $cart->product_id;
        $old_number = $cart->number;
       
        $this->stock_management($product_id,$old_number,0);

        
        Cart::where('id',$request->cart_id)->delete();

        return $this->products_cart();
    }

    public function change(Request $request){//cart_id,number
        $cart = Cart::where('id',$request->cart_id)->first();
        $old_number = $cart->number;
        $product_id = $cart->product_id;
        $number = $request->number;


        $this->stock_management($product_id,$old_number,$number);
        Cart::where('id',$request->cart_id)->update(['number'=>$number]);
      

        return $this->products_cart();
    }

    public function add($product_id,$number){
        
        $stock = Product::where('id',$product_id)->first()->stock;
        $this->number_check($number);

        $this->stock_management($product_id,0,$number);
        if( $number > $stock){
            $number = $stock;
        }
        $param = ['user_id'=>Auth::user()->id,
                    'product_id'=>$product_id,
                    'number'=>$number];
                Cart::insert($param);
        
        
    }

    public function number_check($number){
        if($number==0){
            return 0;
        }else{
            return 1;
        }
    }

    public function stock_management($product_id,$old_number,$number){
        $stock = Product::where('id',$product_id)->first()->stock;
        $new_stock = $stock + $old_number - $number;
        Product::where('id',$product_id)->update(['stock'=>$new_stock]);
        return;
    }

    public function age_limited($product_id){
            $birthday = Auth::user()->birthday;
            $age = Carbon::parse($birthday)->age;
            $limited = Product::find($product_id)->limited;
            if($age<$limited){
                return $limited;
            }else{
                return 0;
            }
    }
}
