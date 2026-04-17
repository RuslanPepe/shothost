<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageServices {

    public function storeImage($request) {
        $dataImage = $request;
        foreach ($dataImage as $image) {
            $data['paths'] = [
                'path' => basename($image->store('images', 'public')),
                'mimeType' => $image->getMimeType()
            ];
        }
        return $data;
    }
    public function showPathImage($path) {
        if (!file_exists(storage_path('app/private/images/' . $path))) {
            abort(404);
        }
        return Storage::url('app/private/images/' . $path);
    }

    public function getPhoto($path) {
        return storage_path('app/public/images/'.$path);
    }
}
