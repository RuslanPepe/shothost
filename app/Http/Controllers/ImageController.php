<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller{
    public function index(){
        return view('home');
    }

    public function upload(Request $request){
        $name = [];
        logger($request);
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $name[] = $image->store('images', 'public');
            }
            return $name;
        }
        return 1;
    }
}
