<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Quiz;
use App\Models\RoomQuiz;
use App\Models\RoomParticipant;
use App\Models\RoomQuestion;
use App\Models\Question;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    // Halaman Buat Room (Guru)
    public function create()
    {
        $quizzes = Quiz::all();
        return view('rooms.create', compact('quizzes'));
    }

    // Proses Buat Room
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'quizzes' => 'required|array',
            'total_questions' => 'required|integer|min:1',
            'timer_per_question' => 'required|integer|min:5',
        ]);

        $code = strtoupper(Str::random(6));
        while(Room::where('code', $code)->exists()) {
            $code = strtoupper(Str::random(6));
        }

        $room = Room::create([
            'user_id' => auth()->id(),
            'code' => $code,
            'title' => $request->title,
            'status' => 'waiting',
            'timer_minutes' => 0, // deprecating this
            'timer_per_question' => $request->timer_per_question,
            'total_questions' => $request->total_questions,
        ]);

        foreach ($request->quizzes as $quiz_id) {
            RoomQuiz::create([
                'room_id' => $room->id,
                'quiz_id' => $quiz_id
            ]);
        }

        // Generate Soal Acak
        $questionIds = Question::whereIn('quiz_id', $request->quizzes)
            ->inRandomOrder()
            ->limit($request->total_questions)
            ->pluck('id');

        $order = 1;
        foreach($questionIds as $qId) {
            RoomQuestion::create([
                'room_id' => $room->id,
                'question_id' => $qId,
                'order_index' => $order++
            ]);
        }

        return redirect()->route('rooms.monitor', $room->id)->with('success', 'Room berhasil dibuat! Bagikan kode ini ke peserta.');
    }

    public function monitor(Room $room)
    {
        if ($room->user_id !== auth()->id()) abort(403);
        $room->load('participants.user');
        
        $quizzes = \App\Models\Quiz::all();
        $selectedQuizzes = \App\Models\RoomQuiz::where('room_id', $room->id)->pluck('quiz_id')->toArray();
        
        return view('rooms.monitor', compact('room', 'quizzes', 'selectedQuizzes'));
    }

    public function startRoom(Room $room)
    {
        if ($room->user_id !== auth()->id()) abort(403);
        
        $room->update(['status' => 'playing', 'code' => 'MULAI-' . Str::random(3)]);
        return redirect()->back()->with('success', 'Permainan dimulai! Kode room telah ditutup.');
    }

    public function closeRoom(Room $room)
    {
        if ($room->user_id !== auth()->id()) abort(403);
        
        if ($room->status === 'finished') {
            return redirect()->back()->with('error', 'Permainan sudah ditutup sebelumnya.');
        }

        $room->update(['status' => 'finished', 'code' => 'SELESAI-' . Str::random(3)]);

        // Calculate Winner
        $participants = $room->participants()->orderByDesc('score')->get();
        if ($participants->count() > 0) {
            $highestScore = $participants->first()->score;
            
            foreach ($participants as $participant) {
                $user = $participant->user;
                if ($user) {
                    if ($participant->score === $highestScore && $highestScore > 0) {
                        // Winner (or tie for first place)
                        $user->increment('room_streak');
                    } else {
                        // Loser
                        if ($user->room_streak > 0) {
                            $user->decrement('room_streak');
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Permainan ditutup! Peringkat bintang/mahkota telah diperbarui.');
    }

    public function updateSettings(Request $request, Room $room)
    {
        if ($room->user_id !== auth()->id()) abort(403);
        if ($room->status !== 'waiting') return back()->with('error', 'Tidak bisa mengubah pengaturan saat bermain.');

        $request->validate([
            'title' => 'required|string|max:255',
            'quizzes' => 'required|array',
            'timer_per_question' => 'required|integer|min:5',
            'total_questions' => 'required|integer|min:1',
        ]);

        $room->update([
            'title' => $request->title,
            'timer_per_question' => $request->timer_per_question,
            'total_questions' => $request->total_questions,
        ]);

        \App\Models\RoomQuiz::where('room_id', $room->id)->delete();
        foreach ($request->quizzes as $quiz_id) {
            \App\Models\RoomQuiz::create([
                'room_id' => $room->id,
                'quiz_id' => $quiz_id
            ]);
        }

        // Regenerate questions
        $questionIds = \App\Models\Question::whereIn('quiz_id', $request->quizzes)
            ->inRandomOrder()
            ->limit($request->total_questions)
            ->pluck('id');

        \App\Models\RoomQuestion::where('room_id', $room->id)->delete();

        $order = 1;
        foreach($questionIds as $qId) {
            \App\Models\RoomQuestion::create([
                'room_id' => $room->id,
                'question_id' => $qId,
                'order_index' => $order++
            ]);
        }

        return back()->with('success', 'Pengaturan Room berhasil diperbarui! Soal telah diacak ulang.');
    }

    public function getMonitorData(Room $room)
    {
        if ($room->user_id !== auth()->id()) abort(403);
        
        $participants = $room->participants()->with('user')->orderByDesc('score')->get();
        return response()->json([
            'status' => $room->status,
            'participants' => $participants
        ]);
    }

    // Siswa Join Room
    public function joinForm()
    {
        return view('rooms.join');
    }

    public function guestNameForm(Request $request)
    {
        $code = $request->code;
        if (!$code) return redirect()->route('landing');
        return view('rooms.guest-name', compact('code'));
    }

    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'guest_name' => 'nullable|string|max:50'
        ]);

        $room = Room::where('code', strtoupper($request->code))->first();

        if (!$room) {
            return back()->with('error', 'Kode Room tidak ditemukan.');
        }

        if ($room->status === 'playing') {
            return back()->with('error', 'Permainan di Ruang ini sedang berlangsung (sudah dimulai).');
        }
        
        if ($room->status === 'finished') {
            return back()->with('error', 'Permainan di Ruang ini telah selesai.');
        }

        $userId = auth()->id();
        
        // If guest and no name provided, redirect to ask name
        if (!$userId && empty($request->guest_name)) {
            return redirect()->route('rooms.guestName', ['code' => $request->code]);
        }

        $guestName = $userId ? null : $request->guest_name;

        // Cek jika belum join
        if ($userId) {
            $participant = RoomParticipant::where('room_id', $room->id)
                                        ->where('user_id', $userId)
                                        ->first();
        } else {
            // For guests, we rely on the session participant ID
            $participantId = session('room_participant_id_' . $room->id);
            $participant = $participantId ? RoomParticipant::find($participantId) : null;
        }

        if (!$participant) {
            $participant = RoomParticipant::create([
                'room_id' => $room->id,
                'user_id' => $userId,
                'guest_name' => $guestName,
                'status' => 'joined'
            ]);
            
            if (!$userId) {
                session(['room_participant_id_' . $room->id => $participant->id]);
            }
        }

        return redirect()->route('rooms.lobby', $room->id);
    }

    private function getParticipant(Room $room)
    {
        if (auth()->check()) {
            return RoomParticipant::where('room_id', $room->id)
                                  ->where('user_id', auth()->id())
                                  ->first();
        }
        
        $participantId = session('room_participant_id_' . $room->id);
        return $participantId ? RoomParticipant::find($participantId) : null;
    }

    public function lobby(Room $room)
    {
        $participant = $this->getParticipant($room);
        if (!$participant) return redirect()->route('landing')->with('error', 'Anda belum bergabung ke Room ini.');

        if ($room->status === 'playing') {
            return redirect()->route('rooms.play', $room->id);
        }

        return view('rooms.lobby', compact('room'));
    }

    public function checkStatus(Room $room)
    {
        $participants = $room->participants()->with('user')->get();
        
        $leaderboardIds = \App\Models\User::withCount(['attempts as total_score' => function($query) {
            $query->select(\Illuminate\Support\Facades\DB::raw('SUM(score)'));
        }])
        ->having('total_score', '>', 0)
        ->orderByDesc('total_score')
        ->pluck('id')->toArray();

        $participantData = $participants->map(function($p) use ($leaderboardIds) {
            $rankIndex = $p->user_id ? array_search($p->user_id, $leaderboardIds) : false;
            $globalRank = $rankIndex !== false ? ($rankIndex + 1) : '-';
            
            return [
                'id' => $p->id,
                'name' => $p->user_id ? $p->user->name : $p->guest_name . ' (Guest)',
                'global_rank' => $globalRank,
                'status' => $p->status,
                'score' => $p->score,
                'room_streak' => $p->user_id ? $p->user->room_streak : 0
            ];
        });

        return response()->json([
            'status' => $room->status,
            'participants' => $participantData
        ]);
    }

    // Siswa Play
    public function play(Room $room)
    {
        $participant = $this->getParticipant($room);
        if (!$participant) return redirect()->route('landing')->with('error', 'Silakan join ulang terlebih dahulu.');

        if ($room->status !== 'playing') {
            return redirect()->route('rooms.lobby', $room->id);
        }

        if ($participant->status === 'finished') {
            return redirect()->route('rooms.result', $room->id);
        }

        if ($participant->status === 'joined') {
            $participant->update(['status' => 'playing']);
        }

        $questions = $room->roomQuestions()->with('question')->get()->map(function($rq) {
            $q = $rq->question;
            if ($q->question_type === 'essay') {
                $q->shuffled_options = [];
            } else {
                $options = [
                    ['key' => 'A', 'text' => $q->option_a],
                    ['key' => 'B', 'text' => $q->option_b],
                    ['key' => 'C', 'text' => $q->option_c],
                    ['key' => 'D', 'text' => $q->option_d],
                ];
                shuffle($options);
                $q->shuffled_options = $options;
            }
            return $q;
        })->shuffle();

        return view('rooms.play', compact('room', 'questions'));
    }

    public function submit(Request $request, Room $room)
    {
        $participant = $this->getParticipant($room);
        if (!$participant) return response()->json(['success' => false, 'message' => 'Not found'], 404);
                                    
        $answers = $request->input('answers', []);
        $questions = $room->roomQuestions()->with('question')->get();
        
        $score = 0;
        $answersData = [];
        foreach($questions as $rq) {
            $selected = $answers[$rq->question->id] ?? null;
            
            if ($rq->question->question_type === 'essay') {
                $isCorrect = $selected !== null && strtolower(trim($selected)) === strtolower(trim($rq->question->essay_answer));
            } else {
                $isCorrect = ($selected === $rq->question->correct_option);
            }
            
            if ($isCorrect) {
                $score += 10;
            }
            
            $answersData[] = [
                'room_participant_id' => $participant->id,
                'question_id' => $rq->question->id,
                'selected_option' => $selected,
                'is_correct' => $isCorrect,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        
        \App\Models\RoomParticipantAnswer::insert($answersData);

        $participant->update([
            'score' => $score,
            'status' => 'finished',
            'finished_at' => now()
        ]);

        return response()->json([
            'redirect' => route('rooms.result', $room->id)
        ]);
    }

    public function syncProgress(Request $request, Room $room)
    {
        $participant = $this->getParticipant($room);
        if (!$participant) return response()->json(['success' => false], 404);
                                    
        $answers = $request->input('answers', []);
        $questions = $room->roomQuestions()->with('question')->get();
        
        $score = 0;
        foreach($questions as $rq) {
            $selected = $answers[$rq->question->id] ?? null;
            if ($selected !== null && $selected !== '') {
                if ($rq->question->question_type === 'essay') {
                    $isCorrect = strtolower(trim($selected)) === strtolower(trim($rq->question->essay_answer));
                } else {
                    $isCorrect = ($selected === $rq->question->correct_option);
                }
                
                if ($isCorrect) {
                    $score += 10;
                }
            }
        }
        
        $participant->update(['score' => $score]);

        return response()->json(['success' => true, 'score' => $score]);
    }

    public function result(Room $room)
    {
        $participant = $this->getParticipant($room);
        if (!$participant) return redirect()->route('landing')->with('error', 'Silakan join ulang terlebih dahulu.');

        // Get rank
        $rank = RoomParticipant::where('room_id', $room->id)
                               ->where('score', '>', $participant->score)
                               ->count() + 1;
                               
        $allParticipants = RoomParticipant::where('room_id', $room->id)
                               ->with('user')
                               ->orderByDesc('score')
                               ->get();

        return view('rooms.result', compact('room', 'participant', 'rank', 'allParticipants'));
    }

    public function export(Room $room)
    {
        if ($room->user_id !== auth()->id()) abort(403);
        
        $participants = $room->participants()->with('user')->orderByDesc('score')->get();
        $questions = $room->roomQuestions()->with('question')->get();
        $answers = \App\Models\RoomParticipantAnswer::whereIn('room_participant_id', $participants->pluck('id'))->get();
        
        $safeTitle = \Illuminate\Support\Str::slug($room->title);
        $filename = "Hasil_Kuis_{$safeTitle}_{$room->code}.xls";
        
        $headers = array(
            "Content-type"        => "application/vnd.ms-excel; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
        $html .= '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        $html .= '<style>';
        $html .= 'table { border-collapse: collapse; font-family: "Segoe UI", Arial, sans-serif; font-size: 11pt; }';
        $html .= 'th, td { border: 1px solid #d1d5db; padding: 8px 12px; vertical-align: middle; }';
        $html .= '.header-label { font-weight: bold; background-color: #f3f4f6; color: #1f2937; text-align: left; width: 350px; }';
        $html .= '.header-value { font-weight: bold; text-align: center; background-color: #ffffff; width: 200px; }';
        $html .= '.header-nama { background-color: #4f46e5; color: #ffffff; font-weight: bold; text-align: center; font-size: 12pt; padding: 12px 8px; }';
        $html .= '.question-text { font-weight: bold; background-color: #f9fafb; color: #374151; vertical-align: top; padding: 10px; }';
        $html .= '.answer-cell { text-align: center; vertical-align: top; padding: 10px; }';
        $html .= '</style>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<table>';
        
        // Row 1: Nama
        $html .= '<tr>';
        $html .= '<th class="header-label" style="background-color: #4f46e5; color: #ffffff; font-size: 12pt; text-align: center; padding: 12px 8px;">NAMA PESERTA</th>';
        foreach ($participants as $p) {
            $name = $p->user_id ? $p->user->name : $p->guest_name . ' (Guest)';
            $html .= "<th class=\"header-nama\">{$name}</th>";
        }
        $html .= '</tr>';
        
        // Row 2: Peringkat
        $html .= '<tr>';
        $html .= '<td class="header-label">🏆 Peringkat</td>';
        $rank = 1;
        foreach ($participants as $p) {
            $html .= "<td class=\"header-value\">{$rank}</td>";
            $rank++;
        }
        $html .= '</tr>';
        
        // Row 3: SKOR
        $html .= '<tr>';
        $html .= '<td class="header-label">⭐ Total Skor</td>';
        foreach ($participants as $p) {
            $html .= "<td class=\"header-value\" style=\"color: #4f46e5; font-size: 12pt;\">{$p->score}</td>";
        }
        $html .= '</tr>';
        
        // Row 4: DURASI
        $html .= '<tr>';
        $html .= '<td class="header-label">⏱️ Durasi Pengerjaan</td>';
        foreach ($participants as $p) {
            $durasi = '-';
            if ($p->finished_at && $p->created_at) {
                $start = \Carbon\Carbon::parse($p->created_at);
                $end = \Carbon\Carbon::parse($p->finished_at);
                $diff = $start->diffInSeconds($end);
                $minutes = floor($diff / 60);
                $seconds = $diff % 60;
                $durasi = "";
                if ($minutes > 0) $durasi .= "{$minutes} menit ";
                $durasi .= "{$seconds} detik";
            }
            $html .= "<td class=\"header-value\" style=\"font-weight: normal; color: #4b5563;\">{$durasi}</td>";
        }
        $html .= '</tr>';
        
        // Empty Spacer Row
        $html .= '<tr><td colspan="' . (count($participants) + 1) . '" style="background-color: #e5e7eb; height: 10px;"></td></tr>';

        // Row 5+: Questions
        foreach ($questions as $rq) {
            $html .= '<tr>';
            $html .= "<td class=\"question-text\">{$rq->question->question_text}</td>";
            
            foreach ($participants as $p) {
                $ans = $answers->where('room_participant_id', $p->id)->where('question_id', $rq->question->id)->first();
                if ($ans && $ans->selected_option) {
                    $optCol = 'option_' . strtolower($ans->selected_option);
                    $optText = $rq->question->$optCol ?? '';
                    $displayText = $ans->selected_option . '. ' . $optText;
                    
                    $color = $ans->is_correct ? '#16a34a' : '#ef4444';
                    $fontWeight = $ans->is_correct ? 'bold' : 'normal';
                    $html .= "<td class=\"answer-cell\" style=\"color: {$color}; font-weight: {$fontWeight};\">{$displayText}</td>";
                } else {
                    $html .= "<td class=\"answer-cell\" style=\"color: #9ca3af; font-style: italic;\">- Tidak Menjawab -</td>";
                }
            }
            $html .= '</tr>';
        }
        
        $html .= '</table></body></html>';

        return response($html, 200, $headers);
    }
}
