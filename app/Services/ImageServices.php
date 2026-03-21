<?php

namespace App\Services;

class ImageServices {

    public function storeImage($dataImage) {
        $result = [];
        foreach ($dataImage as $image) {
            logger(basename($image->store('images')));
            $result[] = [
                'path' => basename($image->store('images')),
                'mimeType' => $image->getMimeType()
            ];
        }
        return $result;
    }
    public function showPathImage($path) {
        if (!file_exists(storage_path('app/private/images/' . $path))) {
            abort(404);
        }
        return response()->file(
            storage_path('app/private/images/' . $path),
        );
    }
}
