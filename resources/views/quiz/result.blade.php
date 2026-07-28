<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hasil Kuis: {{ $attempt->quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Result Summary Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8 border-t-4 {{ $attempt->score > 50 ? 'border-green-500' : 'border-rose-500' }}">
                <div class="p-8 text-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Skor Kamu</h3>
                    <div class="text-6xl font-extrabold my-4 {{ $attempt->score > 50 ? 'text-green-600' : 'text-rose-600' }}">
                        {{ $attempt->score }}
                    </div>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 max-w-2xl mx-auto">
                        <div class="text-center bg-gray-50 rounded-xl p-3">
                            <p class="text-[10px] md:text-sm text-gray-500 uppercase tracking-wide mb-1">Benar</p>
                            <p class="text-xl md:text-2xl font-semibold text-gray-900">{{ $attempt->answers->where('is_correct', true)->count() }}</p>
                        </div>
                        <div class="text-center bg-gray-50 rounded-xl p-3">
                            <p class="text-[10px] md:text-sm text-gray-500 uppercase tracking-wide mb-1">Salah / Kosong</p>
                            <p class="text-xl md:text-2xl font-semibold text-gray-900">{{ $attempt->answers->where('is_correct', false)->count() }}</p>
                        </div>
                        <div class="text-center bg-gray-50 rounded-xl p-3">
                            <p class="text-[10px] md:text-sm text-gray-500 uppercase tracking-wide mb-1">Total Soal</p>
                            <p class="text-xl md:text-2xl font-semibold text-gray-900">{{ $attempt->total_questions }}</p>
                        </div>
                        <div class="text-center bg-gray-50 rounded-xl p-3">
                            <p class="text-[10px] md:text-sm text-gray-500 uppercase tracking-wide mb-1">Waktu</p>
                            @php
                                $duration = $attempt->started_at && $attempt->finished_at ? $attempt->finished_at->diffInSeconds($attempt->started_at) : 0;
                                $minutes = floor($duration / 60);
                                $seconds = $duration % 60;
                                $timeString = $minutes > 0 ? "{$minutes}m {$seconds}s" : "{$seconds}s";
                            @endphp
                            <p class="text-xl md:text-2xl font-semibold text-gray-900">{{ $timeString }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-center space-x-4">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Kembali ke Dashboard
                        </a>
                        <a href="{{ route('leaderboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                            Cek Leaderboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Review Answers -->
            <h3 class="text-xl font-bold text-gray-900 mb-6">Pembahasan Soal</h3>
            
            <div class="space-y-6">
                @foreach($attempt->answers as $index => $answer)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border {{ $answer->is_correct ? 'border-green-200' : 'border-rose-200' }}">
                        <div class="p-6">
                            <div class="flex items-start mb-4">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold text-white mr-3 {{ $answer->is_correct ? 'bg-green-500' : 'bg-rose-500' }}">
                                    {{ $index + 1 }}
                                </span>
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ $answer->question->question_text }}</h4>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pl-11">
                                <!-- User's Answer -->
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Jawaban Kamu</p>
                                    @if($answer->selected_option)
                                        @php
                                            $userOptionField = 'option_' . strtolower($answer->selected_option);
                                        @endphp
                                        <p class="font-medium {{ $answer->is_correct ? 'text-green-700' : 'text-rose-700' }}">
                                            {{ $answer->selected_option }}. {{ $answer->question->$userOptionField }}
                                        </p>
                                    @else
                                        <p class="font-medium text-gray-500 italic">Tidak dijawab (waktu habis)</p>
                                    @endif
                                </div>
                                
                                <!-- Correct Answer -->
                                <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                                    <p class="text-xs text-green-600 uppercase font-semibold mb-1">Kunci Jawaban</p>
                                    @php
                                        $correctOptionField = 'option_' . strtolower($answer->question->correct_option);
                                    @endphp
                                    <p class="font-medium text-green-800">
                                        {{ $answer->question->correct_option }}. {{ $answer->question->$correctOptionField }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>
</x-app-layout>
