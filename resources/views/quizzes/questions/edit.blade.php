<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center gap-3">
                <a href="{{ route('quizzes.edit', $quiz) }}" class="text-gray-400 hover:text-white transition-colors bg-gray-800 hover:bg-gray-700 p-2 rounded-xl border border-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                Edit Soal: {{ $quiz->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl relative shadow-lg shadow-red-500/10" role="alert">
                    <div class="flex items-center gap-2 font-bold mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Terdapat kesalahan:
                    </div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-800">
                <div class="p-8" x-data="{ questionType: '{{ $question->question_type ?? 'multiple_choice' }}' }">
                    <form action="{{ route('quizzes.questions.update', [$quiz, $question]) }}" method="POST" x-data="{ isSubmitting: false }" @submit="if(isSubmitting) { $event.preventDefault(); return; } isSubmitting = true;">
                        @csrf
                        @method('PUT')
                        
                        <!-- Tipe Soal Toggle -->
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-300 mb-3">Tipe Soal</label>
                            <div class="flex gap-4">
                                <label @click="questionType = 'multiple_choice'" class="flex-1 relative cursor-pointer">
                                    <input type="radio" name="question_type" value="multiple_choice" x-model="questionType" class="sr-only peer">
                                    <div class="p-4 rounded-xl border-2 transition-all text-center peer-checked:border-fuchsia-500 peer-checked:bg-fuchsia-500/10 peer-checked:shadow-lg peer-checked:shadow-fuchsia-500/20 border-gray-700 hover:border-gray-600 hover:bg-gray-800/50">
                                        <div class="text-3xl mb-2">📝</div>
                                        <span class="font-bold text-white text-sm">Pilihan Ganda</span>
                                        <p class="text-xs text-gray-400 mt-1">A, B, C, D</p>
                                    </div>
                                </label>
                                <label @click="questionType = 'essay'" class="flex-1 relative cursor-pointer">
                                    <input type="radio" name="question_type" value="essay" x-model="questionType" class="sr-only peer">
                                    <div class="p-4 rounded-xl border-2 transition-all text-center peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 peer-checked:shadow-lg peer-checked:shadow-cyan-500/20 border-gray-700 hover:border-gray-600 hover:bg-gray-800/50">
                                        <div class="text-3xl mb-2">✏️</div>
                                        <span class="font-bold text-white text-sm">Esai (1 Kata)</span>
                                        <p class="text-xs text-gray-400 mt-1">Jawaban singkat</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="question_text" class="block text-sm font-bold text-gray-300 mb-2">Pertanyaan</label>
                            <textarea name="question_text" id="question_text" rows="4" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" required>{{ $question->question_text }}</textarea>
                        </div>

                        <!-- Pilihan Ganda Fields -->
                        <div x-show="questionType === 'multiple_choice'" x-transition>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="option_a" class="block text-sm font-bold text-gray-300 mb-2">Opsi A</label>
                                    <input type="text" name="option_a" id="option_a" value="{{ $question->option_a }}" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" :required="questionType === 'multiple_choice'">
                                </div>
                                <div>
                                    <label for="option_b" class="block text-sm font-bold text-gray-300 mb-2">Opsi B</label>
                                    <input type="text" name="option_b" id="option_b" value="{{ $question->option_b }}" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" :required="questionType === 'multiple_choice'">
                                </div>
                                <div>
                                    <label for="option_c" class="block text-sm font-bold text-gray-300 mb-2">Opsi C</label>
                                    <input type="text" name="option_c" id="option_c" value="{{ $question->option_c }}" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" :required="questionType === 'multiple_choice'">
                                </div>
                                <div>
                                    <label for="option_d" class="block text-sm font-bold text-gray-300 mb-2">Opsi D</label>
                                    <input type="text" name="option_d" id="option_d" value="{{ $question->option_d }}" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" :required="questionType === 'multiple_choice'">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <label for="correct_option" class="block text-sm font-bold text-gray-300 mb-2">Kunci Jawaban</label>
                                    <select name="correct_option" id="correct_option" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all appearance-none cursor-pointer">
                                        <option value="A" class="bg-gray-800 text-white" {{ $question->correct_option == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" class="bg-gray-800 text-white" {{ $question->correct_option == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" class="bg-gray-800 text-white" {{ $question->correct_option == 'C' ? 'selected' : '' }}>C</option>
                                        <option value="D" class="bg-gray-800 text-white" {{ $question->correct_option == 'D' ? 'selected' : '' }}>D</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="timer_seconds_pg" class="block text-sm font-bold text-gray-300 mb-2">Waktu Mengerjakan (Detik)</label>
                                    <input type="number" name="timer_seconds" id="timer_seconds_pg" value="{{ $question->timer_seconds }}" min="5" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" :required="questionType === 'multiple_choice'" :disabled="questionType !== 'multiple_choice'">
                                </div>
                            </div>
                        </div>

                        <!-- Esai Fields -->
                        <div x-show="questionType === 'essay'" x-transition>
                            <div class="mb-4 bg-cyan-500/10 border border-cyan-500/50 text-cyan-400 px-4 py-3 rounded-xl flex items-start gap-3" role="alert">
                                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-sm">Jawaban esai harus <strong>1 kata saja</strong>. Sistem akan mencocokkan jawaban secara <strong>tidak peka huruf besar/kecil</strong> (case-insensitive).</span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <label for="essay_answer" class="block text-sm font-bold text-gray-300 mb-2">Kunci Jawaban (1 Kata)</label>
                                    <input type="text" name="essay_answer" id="essay_answer" value="{{ $question->essay_answer }}" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all" :required="questionType === 'essay'" placeholder="Contoh: Pancasila">
                                </div>
                                <div>
                                    <label for="timer_seconds_essay" class="block text-sm font-bold text-gray-300 mb-2">Waktu Mengerjakan (Detik)</label>
                                    <input type="number" name="timer_seconds" id="timer_seconds_essay" value="{{ $question->timer_seconds }}" min="5" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" :required="questionType === 'essay'" :disabled="questionType !== 'essay'">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800">
                            <a href="{{ route('quizzes.edit', $quiz) }}" class="px-6 py-3 rounded-xl font-bold text-gray-400 hover:text-white hover:bg-gray-800 transition-all">Batal</a>
                            <button type="submit" x-bind:disabled="isSubmitting" x-bind:class="{ 'opacity-50 cursor-not-allowed': isSubmitting }" class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold shadow-lg shadow-blue-500/30 transition-all">
                                <span x-show="!isSubmitting">{{ auth()->user()->role === 'admin' ? 'Simpan Perubahan' : 'Ajukan Revisi' }}</span>
                                <span x-show="isSubmitting" x-cloak>Menyimpan...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
