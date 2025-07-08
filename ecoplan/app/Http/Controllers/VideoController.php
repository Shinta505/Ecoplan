<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('is_active', true)
                      ->orderBy('created_at', 'desc')
                      ->get();
                      
        return view('videos.index', compact('videos'));
    }
}