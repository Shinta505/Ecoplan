<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\WasteDetection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $articles = Article::where('is_published', true)
                         ->latest()
                         ->take(3)
                         ->get();

        $recentDetections = WasteDetection::where('user_id', $user->id)
                                        ->latest()
                                        ->take(3)
                                        ->get();

        $recentActivity = $user->pointTransactions()
                              ->latest()
                              ->take(5)
                              ->get();

        return view('dashboard', compact('articles', 'recentDetections', 'recentActivity'));
    }
}