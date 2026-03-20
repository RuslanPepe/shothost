<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Services\LinkServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageServices;

class LinkController extends Controller {
    public function index($id, LinkServices $linkServices){
        ['link' => $link, 'paths' => $paths] = $linkServices->showLink($id);
        $body = (new LinkResource($link))->toArray(request());
        return view('index', compact('paths', 'body'));
    }
    public function store(LinkRequest $request, LinkServices $linkServices, ImageServices $imageServices) {
        $data = $request->all();
        $data['paths'] = $linkServices->imageHandler($request->file('image'));
        $link = $linkServices->storeLink($data);
        return response()->json($link, 201);
    }
    public function show($path) {
        if (!file_exists(storage_path('app/private/images/' . $path))) {
            abort(404);
        }
        return response()->file(
            storage_path('app/private/images/' . $path),
        );
    }
}
