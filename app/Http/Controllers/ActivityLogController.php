<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        return view('activity.index', [
            'activities' => Activity::with(['causer'])->orderBy('id','DESC')->get(),
        ]);
    }
}
