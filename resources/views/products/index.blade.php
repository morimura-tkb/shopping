@extends('layouts.layout')

@section('styles')
<style type="text/css">
.products_table{
    margin:20px;
    height:300px;
    width:80%;
}

 .not_page{
     color:#2d4bce;
     text-decoration:underline;
 }

 .page{
     font-size:20px;
     margin:5px;
     position:relative;
     left:40px;
 }

 .stock_msg{
     color:red;
 }
</style>

@endsection

@section('title','商品について')


@section('subtitle',$subtitles[$id])

@section('content')
    <div class="products">
        @foreach($products as $product)
            <table class="products_table" border="1">
                <tr height=30% width=40%><th rowspan="2">商品写真</th>
                    <th colspan="3">商品名:{{$product->name}}<br>
                @if($product->stock==0)
                <p class="stock_msg">在庫がありません。<p>
                @elseif($product->stock <= 10)
                <p class="stock_msg">残り{{$product->stock}}点です。<p>
                @endif
                </th></tr>
                <tr height=30%><th width=30%>値段:{{$product->price}}円</th>
                <form action="/shopping/users/cart" method="POST">
                @csrf
                    <th width=15%>個数:<input type="number" value=1 min=1 name="number" max={{$product->stock}}></th>
                    <input type="hidden" name="product_id" value={{$product->id}}>
                    <th width=15%><input type="submit" class="products_cart" value="カートに追加"></th></form></tr>
                <tr height=40%><th colspan="4">商品説明</th></tr>
            </table>
        @endforeach


        <div class="page">
        @for($i = 0; $i <= $max_page+1; $i++)
            @if($i==0)
                @if($now==1)
                <input type="button" class="front_page" value="前のページ" disabled>
                @else
                <input type="button" class="front_page" onclick="location.href='{{route('shopping.index',['id'=>$id,'page_id'=>$now-1])}}'" value="前のページ">                
                @endif
            @elseif ($i == $now)
               {{$now}}
            @elseif($i==$max_page+1)
                @if($now==$max_page)
                <input type="button" class="back_page" value="次のページ" disabled>
                @else
                <input type="button" class="back_page" onclick="location.href='{{route('shopping.index',['id'=>$id,'page_id'=>$now+1])}}'" value="次のページ">
                @endif
            @else
               <a class="not_page" href="{{route('shopping.index',['id'=>$id,'page_id'=>$i])}}">{{$i}}</a>
            @endif
        @endfor
        </div>
    </div>
@endsection


