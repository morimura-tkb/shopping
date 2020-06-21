<?php

namespace App\Http\Controllers;
use App\Product;
use App\Connection;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(int $id,$page_id = 1){
        $results = Connection::where('ref1', $id+1)->orwhere('ref2', $id+1)->get();
        $count = $results->count();

        $ids = [];
        foreach($results as $connection) {
            $ids[] = $connection->product_id;
        }

        list($now,$max_page,$start_no) = $this -> paging($page_id,$count);

        $disp_ids = array_slice($ids,$start_no,MAX,true);
        $products = Product::whereIn('id',$disp_ids)->get();
         
        $subtitles = ['おすすめ','男性向け','女性向け','ギフト'];

        $data = ['products'=>$products,
                'id'=>$id,
                'subtitles'=>$subtitles,
                'count'=>$count,
                'now'=>$now,
                'max_page'=>$max_page];
    
        return view('products.index',$data);
    }

    public function search(request $request,$page_id){
        $keyword = $request->keyword;
        
        if (!$keyword) {
            return redirect('/shopping/products/0');
        }

        $count = Product::where('name', 'LIKE', "%$keyword%")->count();

        list($now,$max_page,$start_no) = $this -> paging($page_id,$count);
        $products = Product::where('name', 'LIKE', "%$keyword%")->skip($start_no)->take(1)->get();

        $data = ['products'=>$products,
                'keyword'=>$keyword,
                'count'=>$count,
                'now'=>$now,
                'max_page'=>$max_page];

        return view('products.search_result',$data);
    }

    public function paging($page_id,$count){
        define('MAX','1');
        $now = $page_id;
        $start_no = ($now - 1) * MAX;
        $max_page = ceil($count/MAX);
        return [$now,$max_page,$start_no];
    }

    public function stock_management($products){

    }
}
