<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Models\Products;
use App\Models\ProdImage;
use App\Models\Video;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductsController extends Controller
{
    public function add(Request $request){
        

        $validator = Validator::make($request->all(), 
              [ 'name'       =>       'required',
                'stock'      =>       'required',
                'price'      =>       'required',
                'description'=>       'required',
                'photo'      =>       'required|mimes:png,jpg|max:2048',
                'video'      =>       'required|mimes:mp4',
             ]); 

        $images = [];
        
        if($request->hasfile('photo')){
            
            $files = $request->file('photo');
            
            foreach($files as $file){
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('apiImage'),$name);
                $images[] = $name;
            }
        }       
        
        ProdImage::insert([
            'pic'=>implode('|',$images),
        ]);
        
        $videos = [];
        
        if($request->hasfile('video')){

            $files = $request->file('video');

            foreach($files as $file){
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('apiVideo'),$name);
                $videos[] = $name;
            }

        }       
       
        Video::insert([
            'video'=>implode('|',$videos),
        ]);
        
        $name = $request->input('name');
        $description = $request->input('description');
        $stock = $request->input('stock');
        $price = $request->input('price');
        $cost = strval($price);
        
        $qrdata= $name." ".$cost." ".$description;
        $qr = QrCode::size(100)->generate($qrdata);
       

        $pr = new Products;
        
        $pr->name = $name;
        $pr->price = $price;
        $pr->description = $description;
        $pr->stock = $stock;
        $pr->qrcode = $qr;

        $pr->save();

        

        $data = $request->user()->email;
        
        Mail::send('emails.productCreated',['pr'=>$pr],function($message) use ($data){
            
            $message->to($data,'XYZ Stores')->subject('Product created');
        });

      
        return $pr;

    }
}
