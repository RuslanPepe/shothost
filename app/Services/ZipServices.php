<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipServices {
    public function makeZip($paths) {
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
            $file = basename($file);
            $fullPath = 'images/' . $file;
            if ($disk->exists($fullPath)) {
                $zip->addFromString($file, $disk->get($fullPath));
                $hasFiles = true;
            } else {
                abort(403,'File not found: ');
            }
        }

        $zip->close();

        if (!$hasFiles) {
            @unlink($tmpFile);
            abort(404, 'No files to download');
        }

        return $tmpFile;
    }
}
