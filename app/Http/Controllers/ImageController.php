<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller{
    public function index(){
        return view('home');
    }

    public function upload(Request $request){
        logger($request);

        return response()->json($request);
//        $name = [];
//        if($request->hasFile('image')){
//            foreach($request->file('image') as $image){
//                $name[] = $image->store('images', 'public');
//            }
//            return $name;
//        }
//        return response()->expire();
    }
}
