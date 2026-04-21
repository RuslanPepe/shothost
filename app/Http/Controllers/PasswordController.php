<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordLinkRequest;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller {
    public function passwordIndex($id) {
        return view('password.index', compact('id'));
    }
    public function passwordCheck(Request $request) {
        $link = Link::where('uuid', $request['id'])->orWhere('CustomLink', $request['id'])->firstOrFail();
        if (Hash::check($request['password'], $link->password)) {
            session([$request->id => true]);
        }
        return redirect('/');
    }
}
