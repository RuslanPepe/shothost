<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkViews extends Model {
    protected $guarded = false;

    public function link() {
        return $this->belongsTo(Link::class);
    }
}
