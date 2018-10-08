<?php

namespace App\Console\Commands;

use Faker\Provider\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GetProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download Product Images';


    private $rootFolderPath;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->rootFolderPath = public_path('storage/uploads/');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $json = File::get(base_path().'/resources/views/json');
        $data = json_decode($json);
        foreach ($data as $key=>$item){
            if(true){
                    $image = $item->columns->custitem_webimage1;
                    $category = $item->columns->custitem_category_group->name;
                if(file_exists($this->rootFolderPath.$category.$image)){
                    continue;
                }else{
                    if(!file_exists($this->rootFolderPath.$category)){
                        mkdir($this->rootFolderPath.$category);
                        echo 'The folder '.$this->rootFolderPath.$category.' is created!'.PHP_EOL;
                    }
                    $imageUri = 'http://www.calvista.com.au/Images/ProductImages/'.$image;
                    $localimg = public_path('storage/uploads/'.$category.'/'.$item->columns->itemid.'.jpg');
                    file_put_contents($localimg,file_get_contents($imageUri));
                    echo  'The Image '.$localimg.' has been download!'.PHP_EOL;
                    $product = [];
                    $product['itemid']= $item->columns->itemid;
                    $product['description']= $item->columns->description;
                    $product['upcode']= $item->columns->upccode;
                    $product['class']= $item->columns->class->name;
                    $product['genre']= $item->columns->custitem_genre->name;
                    $product['brand']= $item->columns->custitem_brand_studio->name;
                    $product['price']= $item->columns->price;
                    $product['rrp']= $item->columns->custitem_rrp;
                    $newFile = fopen($this->rootFolderPath.$category.'/'.$item->columns->itemid.'.txt',"w") or die('System error! Please try again'.PHP_EOL);

                    foreach ($product as $line=>$value){
                        fwrite($newFile,$line.': '.$value."\r\n");
                    };
                    fclose($newFile);

                    //$results = print_r($product,true);
                    //file_put_contents('public/storage/uploads/'.$category.'/'.$item->columns->itemid.'.txt',$results,FILE_APPEND);
                    echo 'The file '.$this->rootFolderPath.$category.$item->columns->description.' is created!'.PHP_EOL;
                    echo $key.'/'.count($data).PHP_EOL;
                }
            }
        };
    }
}
