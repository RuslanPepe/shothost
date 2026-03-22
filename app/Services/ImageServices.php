<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageServices {

    public function storeImage($dataImage) {
        $result = [];
        foreach ($dataImage as $image) {
            $result[] = [
                'path' => basename($image->store('images')),
                'mimeType' => $image->getMimeType()
            ];
        }
        return $result;
    }
    public function showPathImage($path) {

//        logger(Storage::url($path));
//
//        return Storage::url($path);

        if (!file_exists(storage_path('app/private/images/' . $path))) {
            abort(404);
        }
//        logger(public_path('app/public/DPT46LawXwAYiyfjSTD24R9i1brFZr7qtmPkBBHf.jpg'));
        return response()->file(
            storage_path('app/private/images/' . $path)
        );
    }
}
