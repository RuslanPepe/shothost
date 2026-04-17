<?php

namespace App\Services;

use App\Models\Link;
use App\Models\LinkViews;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Services\ImageServices;

class LinkServices {
    public function showImage($link) {
        foreach ($link->paths as $path) {
            $paths[] = 'storage/images/'.$path['path'];
        }
        return $paths;
    }
    public function storeLink($data, $request) {
        logger($data);
        $request['expires_at'] = Carbon::now()->addDays((int)$request['lifetime']);
        $request['paths'] = $data['paths'];
        $request['uuid'] = Str::uuid()->toString();
        $request['password'] = $request['password'] ? Hash::make($request['password']) : '';
        logger($request);
        $link = Link::create($request);
//        LinkViews::create(['link_id' => $link->id]);
        return $link;
    }
    public function checkPassword($link) {
        if (!empty($link->password) && !session()->has($link->uuid)) {
            return redirect(route('password.index',['id' => $link->uuid]));
        }
        if (session()->has($link->uuid)) {
            session()->forget($link->uuid);
        }
    }
}
