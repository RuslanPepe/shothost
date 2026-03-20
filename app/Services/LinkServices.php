<?php

namespace App\Services;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LinkServices {
    public function showLink($id) {
        $link = Link::where('uuid', $id)
            ->orWhere('CustomLink', $id)
            ->firstOrFail();

        foreach ($link->paths as $path) {
            $paths[] = $path['path'];
        }
        return [
            'link' => $link,
            'paths' => $paths,
        ];
    }
    public function storeLink($data) {
        $data['expires_at'] = Carbon::now()->addDays((int)$data['lifetime']);
        unset($data['image']);
        $data['uuid'] = Str::uuid()->toString();
        return Link::create($data);
    }
}
