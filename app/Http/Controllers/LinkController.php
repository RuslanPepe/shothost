<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use Illuminate\Http\Request;

class LinkController extends Controller {
    public function CreateLink(LinkRequest $request) {
        logger($request);
    }
}
