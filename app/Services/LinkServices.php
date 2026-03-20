<?php

namespace App\Services;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LinkServices {
    public function storeLink($data) {
        $data['expires_at'] = Carbon::now()->addDays((int)$data['lifetime']);
        unset($data['image']);
        $data['uuid'] = Str::uuid()->toString();
        return Link::create($data);
    }

    public function imageHandler($dataImage) {
        $result = [];

        foreach ($dataImage as $image) {
            $result[] = [
                'path' => $image->store('images'),
                'mimeType' => $image->getMimeType()
            ];
        }

        return $result;
    }
}
