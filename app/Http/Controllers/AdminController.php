<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
    public function log() {
        $breadcrumbs = [
            ['Log', true, route('admin.log.index')],
            ['Index', false],
        ];
        $title = 'All Log';
        $logs = Activity::latest()->get();

        return view('admin.log.index', compact('breadcrumbs', 'title', 'logs'));
    }
}
