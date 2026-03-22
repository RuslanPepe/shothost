<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model {
    use SoftDeletes;
    protected $guarded = false;

    protected $casts = [
        'paths' => 'array',
        'expires_at' => 'datetime',
    ];

    public function LinkViews() {
        return $this->hasOne(LinkViews::class);
    }
}
