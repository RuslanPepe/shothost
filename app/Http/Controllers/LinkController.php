<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Services\LinkServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ImageServices;

class LinkController extends Controller {
    public function index() {
        return view('home');
    }
    public function store(LinkRequest $request, LinkServices $linkServices, ImageServices $imageServices) {
        $data = $imageServices->storeImage($request->file('image'));
        $link = $linkServices->storeLink($data, $request->input('dataLink'));
        logger($request);
        logger($data);
        logger($link);

//        logger([$data, $link]);
//        return response()->json($link, 201);
    }
    public function show($id, LinkServices $linkServices) {
        $link = Link::where('uuid', $id)->orWhere('CustomLink', $id)->firstOrFail();
        $this->authorize('view', $link);
        $redirect = $linkServices->checkPassword($link);
        if ($redirect){return $redirect;}
        try {
            DB::beginTransaction();
            $paths = $linkServices->showImage($link);
            $body = $link instanceof Link ? new LinkResource($link) : $link;
            $access = $link->typeAccess;
            $link->linkViews->increment('views');
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            abort(400, $ex->getMessage());
//            return response()->json($ex->getMessage(), 400);
        }
        return view('show', compact('paths', 'body', 'access'));
    }
}
