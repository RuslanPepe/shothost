<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {
    protected $guarded = false;

    protected $casts = [
        'paths' => 'array',
    ];
}
