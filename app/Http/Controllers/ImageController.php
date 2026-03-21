<?php

namespace App\Http\Controllers;

use App\Services\ImageServices;
use Illuminate\Http\Request;

class ImageController extends Controller{
    public function show($path, ImageServices $imageServices) {
        return $imageServices->showPathImage($path);
    }
}
