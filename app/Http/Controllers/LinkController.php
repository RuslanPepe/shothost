<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Models\Link;
use App\Services\LinkServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller {
    public function index($id) {
        $paths = [];
        $link = Link::where('uuid', $id)
            ->orWhere('CustomLink', $id)
            ->firstOrFail()->paths;

        foreach ($link as $path) {
            $paths[] = $path['path'];
        }

//        $file = asset('storage/'.$paths[0]);
        $file = storage_path('app/private/' . $paths[0]);


//        return response()->file(
//
//        );



//        $file = Storage::disk('public')->get($paths[0]);
//        $type = Storage::disk('public')->mimeType($paths[0]);
//        return response($file, 200)->header('Content-Type', $type);
        return view('index', compact('file'));
    }
    public function store(LinkRequest $request, LinkServices $linkServices) {
        $data = $request->all();
        $data['paths'] = $linkServices->imageHandler($request->file('image'));
        $link = $linkServices->storeLink($data);

        return response()->json($link);
    }
}
