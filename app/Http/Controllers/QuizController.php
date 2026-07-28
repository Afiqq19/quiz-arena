<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Attempt;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            $query = Quiz::with('creator')->withCount('questions')->orderByDesc('created_at');
            
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }
            
            $quizzes = $query->get();
            return view('quizzes.index', compact('quizzes'));
        } else {
            // For normal users, we don't show the index view from here, they see it on their dashboard.
            // But if they access it, redirect to dashboard.
            return redirect()->route('dashboard');
        }
    }

    public function create()
    {
        $categories = Quiz::select('category')->whereNotNull('category')->distinct()->pluck('category');
        return view('quizzes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
        ]);

        $status = auth()->user()->role === 'admin' ? 'approved' : 'pending';

        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'created_by' => auth()->id(),
            'status' => $status,
        ]);

        return redirect()->route('quizzes.edit', $quiz)->with('success', 'Kuis berhasil dibuat. Silakan tambahkan soal.');
    }

    public function edit(Quiz $quiz)
    {
        if (auth()->user()->role !== 'admin' && $quiz->created_by !== auth()->id()) abort(403);
        
        $categories = Quiz::select('category')->whereNotNull('category')->distinct()->pluck('category');
        $quiz->load('questions');
        return view('quizzes.edit', compact('quiz', 'categories'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        if (auth()->user()->role !== 'admin' && $quiz->created_by !== auth()->id()) abort(403);
        
        if (auth()->user()->role !== 'admin' && $quiz->status === 'approved') {
            return redirect()->route('quizzes.edit', $quiz)->with('error', 'Kuis yang sudah rilis tidak dapat diubah informasinya. Silakan hubungi Admin.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
        ]);
        
        $status = $quiz->status;
        if (auth()->user()->role !== 'admin') {
            $status = 'pending'; // Reset to pending if edited by user
        }

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'status' => $status,
        ]);

        return redirect()->route('quizzes.edit', $quiz)->with('success', 'Info kuis diperbarui.');
    }

    public function destroy(Quiz $quiz)
    {
        if (auth()->user()->role !== 'admin' && $quiz->created_by !== auth()->id()) abort(403);
        
        if (auth()->user()->role !== 'admin' && $quiz->status === 'approved') {
            // Transfer ownership instead of deleting if approved
            $admin = \App\Models\User::where('role', 'admin')->first();
            $quiz->update(['created_by' => $admin->id]);
            return redirect()->route('dashboard')->with('success', 'Kuis telah dihapus dari daftar Anda (Diambil alih oleh sistem karena sudah rilis).');
        }

        $quiz->delete();
        
        $redirectRoute = auth()->user()->role === 'admin' ? 'quizzes.index' : 'dashboard';
        return redirect()->route($redirectRoute)->with('success', 'Kuis berhasil dihapus.');
    }
    
    public function moderate(Request $request, Quiz $quiz)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);
        
        if ($request->status === 'approved' && $quiz->questions()->count() < 10) {
            return back()->with('error', 'Gagal menyetujui: Kuis harus memiliki minimal 10 soal!');
        }
        
        $quiz->update(['status' => $request->status]);
        
        return back()->with('success', 'Status kuis berhasil diubah menjadi ' . $request->status);
    }

    public function togglePublish(Request $request, Quiz $quiz)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $status = $request->input('status', 'pending');
        $quiz->update(['status' => $status]);
        
        return back()->with('success', 'Kuis berhasil ditarik dan dikembalikan ke status Menunggu.');
    }

    public function users()
    {
        $users = User::where('role', 'user')->withCount('attempts')->get();
        return view('admin.users.index', compact('users'));
    }

    public function attempts(Request $request)
    {
        $query = Attempt::with(['user', 'quiz'])->orderByDesc('created_at');
        
        if ($request->has('quiz_id') && $request->quiz_id != '') {
            $query->where('quiz_id', $request->quiz_id);
        }
        
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        $attempts = $query->paginate(20);
        $quizzes = Quiz::all();
        $users = User::where('role', 'user')->get();

        return view('admin.attempts.index', compact('attempts', 'quizzes', 'users'));
    }
}
