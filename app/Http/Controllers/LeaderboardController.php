<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboard = \App\Models\Attempt::with('user')
            ->selectRaw('user_id, sum(score) as total_score, count(id) as quizzes_taken')
            ->where('is_practice', false)
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->get();
            
        return view('leaderboard', compact('leaderboard'));
    }

    public function adminIndex()
    {
        $leaderboard = \App\Models\Attempt::with('user')
            ->selectRaw('user_id, sum(score) as total_score, count(id) as quizzes_taken')
            ->where('is_practice', false)
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->get();
            
        return view('admin.leaderboard.index', compact('leaderboard'));
    }
}
