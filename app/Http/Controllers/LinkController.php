<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Models\LinkViews;
use App\Services\LinkServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageServices;

class LinkController extends Controller {
    public function index() {
        return view('home');
    }
    public function store(LinkRequest $request, LinkServices $linkServices, ImageServices $imageServices) {
        $data = $request->all();
        $data['paths'] = $imageServices->storeImage($request->file('image'));
        $link = $linkServices->storeLink($data);
        return response()->json($link, 201);
    }
    public function show($id, LinkServices $linkServices){
        try {
            DB::beginTransaction();
            $link = Link::where('uuid', $id)->orWhere('CustomLink', $id)->firstOrFail();
            $paths = $linkServices->showImage($link);
            $body = $link instanceof Link ? new LinkResource($link) : $link;
            $link->LinkViews->increment('views');
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            abort(400, $ex->getMessage());
//            return response()->json($ex->getMessage(), 400);
        }
        return view('show', compact('paths', 'body'));
    }
}
