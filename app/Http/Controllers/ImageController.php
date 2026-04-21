<?php

namespace App\Http\Controllers;

use App\Services\ImageServices;
use App\Services\ZipServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ImageController extends Controller{
    public function show($path, ImageServices $imageServices) {
        return $imageServices->showPathImage($path);
    }

    public function downloadImagesAll(Request $request, ZipServices $zipServices) {
        $paths = (array) $request->paths;

        $tmpFile = $zipServices->MakeZip($paths);

        return response()->download($tmpFile, 'images.zip')->deleteFileAfterSend(true);
    }

    public function downloadImage(Request $request, ImageServices $imageServices) {
        $path = basename($request->path);

        $File = $imageServices->getPhoto($path);

        return response()->download($File, $path);
    }


}
