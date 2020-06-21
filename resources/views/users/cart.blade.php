@extends('layouts.layout')

@section('styles')
<style type="text/css">
.cart_table{
    margin:20px;
    height:300px;
    width:80%;
}

.not_cart{
    margin:20px;
}
</style>
@endsection

@section('title','会員情報')

@section('subtitle','カート')

@section('content')


@if(0<$carts->count())
@foreach($carts as $cart)
<table class="cart_table" border="1"> 
    <tr><th width=30%>商品名</th><th colspan="2">{{$cart->product->name}}</th></tr>
    <tr><th>個数</th><th><form action="/shopping/users/cart/change" method="POST">@csrf
            <input type="hidden" name="cart_id" value={{$cart->id}}>
            <input type="number" name="number" min=1 max={{ $cart->product->stock + $cart->number}} value={{$cart->number}}>
            <input type="submit" value="変更"></form></th>
    <th><form action="/shopping/users/cart/delete" method="POST">@csrf
            <input type="hidden" name="cart_id" value={{$cart->id}}>
            <input type="submit" name="delete" value="削除"></form></th></tr>
    <tr><th>値段</th><th colspan="2">{{$cart->number * $cart->product->price}}円</th></tr>
</table>
@endforeach
@else
    <h1 class="not_cart">カートに商品はありません。</h1>
@endif

@endsection




