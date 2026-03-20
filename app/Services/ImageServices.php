<?php

namespace App\Services;

class ImageServices {

    public function imageHandler($dataImage) {
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
}
