<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ShowData(){
        $json = File::get(base_path().'/resources/views/json');
        $data = json_decode($json);
        $product = [];
        foreach ($data as $key=>$item){
            if($key<100){
                $imageUri = 'http://www.calvista.com.au/Images/ProductImages/'.$item->columns->custitem_webimage1;
                $product = [];
                $product['itemid']= $item->columns->itemid;
                $product['description']= $item->columns->description;
                $product['upcode']= $item->columns->upccode;
                $product['class']= $item->columns->class->name;
                $product['genre']= $item->columns->custitem_genre->name;
                $product['brand']= $item->columns->custitem_brand_studio->name;
                $product['price']= $item->columns->price;
                $product['rrp']= $item->columns->custitem_rrp;
                dump($product);
            }
        };
        return view('post');
    }

    public function GetData(Request $request){
        dd($request);
        return view('post');
    }
}
