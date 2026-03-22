<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkViews extends Model {
    protected $guarded = false;

    public function Link() {
        return $this->belongsTo(Link::class);
    }
}
