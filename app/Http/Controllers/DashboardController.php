<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Fetch only approved quizzes for the main catalog
        $quizzes = \App\Models\Quiz::with('creator')->withCount(['questions', 'attempts'])->where('status', 'approved')->get();
        
        // Fetch user's own created quizzes
        $myQuizzes = \App\Models\Quiz::withCount(['questions', 'attempts'])->where('created_by', auth()->id())->get();

        $completedQuizIds = \App\Models\Attempt::where('user_id', auth()->id())
                                               ->pluck('quiz_id')
                                               ->toArray();
                                               
        // Fetch user stats
        $totalScore = \App\Models\Attempt::where('user_id', auth()->id())
            ->where('is_practice', false)
            ->sum('score');
            
        $totalCompleted = count(array_unique($completedQuizIds));
                                               
        return view('dashboard', compact('quizzes', 'myQuizzes', 'completedQuizIds', 'totalScore', 'totalCompleted'));
    }

    public function adminIndex()
    {
        $totalQuizzes = \App\Models\Quiz::count();
        $pendingQuizzes = \App\Models\Quiz::where('status', 'pending')->count();
        $totalUsers = \App\Models\User::where('role', 'user')->count();
        $totalAttempts = \App\Models\Attempt::count();
        $pendingRevisions = \App\Models\QuestionRevision::with('question.quiz')->where('status', 'pending')->get();

        return view('admin.dashboard', compact('totalQuizzes', 'pendingQuizzes', 'totalUsers', 'totalAttempts', 'pendingRevisions'));
    }
}
