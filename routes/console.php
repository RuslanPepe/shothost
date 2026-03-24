<?php

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//Schedule::call(function () {
//    Link::where('expires_at', '<', now())->delete();
//})->hourly();

Schedule::call(function () {
    Link::join('link_views', 'link_views.link_id', '=', 'links.id')
        ->whereColumn('link_views.views', '>', 'links.deleteAfter')
        ->select('links.*')
        ->delete();
})->everyFiveSeconds();
