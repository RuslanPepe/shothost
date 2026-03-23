<?php

namespace App\Http\Controllers;

use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ImageController extends Controller{
    public function show($path, ImageServices $imageServices) {
        return $imageServices->showPathImage($path);
    }
//    public function download(Request $request) {
//        $paths = ['public/images/'.$request->path];
//        logger($paths);
//        $zip = new ZipArchive();
//        $zipFilename = 'images.zip';
//
//        $tmpFile = tempnam(sys_get_temp_dir(), 'zip');
//        if ($tmpFile === false) {
//            abort(500, 'Could not create temporary file');
//        }
//
//        if ($zip->open($tmpFile, ZipArchive::CREATE) === TRUE) {
//            foreach ($paths as $path) {
//                logger('add: '.$path);
//                if (Storage::exists($path)) {
//                    $zip->addFromString(basename($path), Storage::get($path));
//                }
//            }
//            $zip->close();
//        } else {
//            abort(500);
//        }
//        return response()->download($tmpFile, $zipFilename)->deleteFileAfterSend(true);
//    }

//    public function download(Request $request)
//    {
//        $paths = (array) $request->paths; // ожидаем массив путей
//        $zipFilename = 'images.zip';
//        $tmpFile = tempnam(sys_get_temp_dir(), 'zip');
//
//        if ($tmpFile === false) {
//            abort(500, 'Could not create temporary file');
//        }
//
//        $zip = new ZipArchive();
//        if ($zip->open($tmpFile, ZipArchive::CREATE) !== TRUE) {
//            abort(500, 'Could not create zip file');
//        }
//
//        $hasFiles = false;
//
//        foreach ($paths as $file) {
//            $fullPath = Storage::disk('public')->path('images/' . $file);
//            if (file_exists($fullPath)) {
//                $zip->addFile($fullPath, basename($fullPath));
//                $hasFiles = true;
//            } else {
//                logger('File not found: ' . $fullPath);
//            }
//        }
//
//        $zip->close();
//
//        if (!$hasFiles) {
//            abort(404, 'No files to download');
//        }
//
//        return response()->download($tmpFile, $zipFilename)->deleteFileAfterSend(true);
//    }

    public function downloadImageAll(Request $request)
    {
        $paths = (array) $request->paths;

        if (empty($paths)) {
            abort(400, 'No paths provided');
        }

        $tmpFile = tempnam(sys_get_temp_dir(), 'zip');

        if ($tmpFile === false) {
            abort(500, 'Could not create temporary file');
        }

        $zip = new ZipArchive();
        if ($zip->open($tmpFile, ZipArchive::CREATE) !== true) {
            abort(500, 'Could not create zip file');
        }

        $hasFiles = false;
        $disk = Storage::disk('public');

        foreach ($paths as $file) {
            $fullPath = 'images/' . $file;
            if ($disk->exists($fullPath)) {
                $zip->addFromString($file, $disk->get($fullPath));
                $hasFiles = true;
            } else {
                logger('File not found: ' . $fullPath);
            }
        }

        $zip->close();

        if (!$hasFiles) {
            @unlink($tmpFile);
            abort(404, 'No files to download');
        }

        return response()->download($tmpFile, 'images.zip')->deleteFileAfterSend(true);
    }


}
