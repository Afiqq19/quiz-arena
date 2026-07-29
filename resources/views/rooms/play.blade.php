<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $room->title }} (Room)
        </h2>
    </x-slot>

    <div class="py-12" x-data="roomQuizApp()" x-init="initQuiz()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 bg-indigo-50 border-b border-indigo-100 flex justify-between items-center">
                    <div class="text-sm font-medium text-indigo-800">
                        Soal <span x-text="currentQuestionIndex + 1"></span> dari {{ $room->total_questions }}
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="button" @click="toggleSound()" class="text-xs font-bold px-3 py-1.5 rounded-full transition-colors flex items-center gap-1" :class="isSoundOn ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-200 text-gray-500'">
                            <span x-show="isSoundOn">🔊 Suara On</span>
                            <span x-show="!isSoundOn">🔇 Suara Off</span>
                        </button>
                        <div class="flex items-center space-x-2 text-rose-600 font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span x-text="formatTime(timeLeft)"></span>
                        </div>
                    </div>
                </div>
                
                <div class="w-full bg-gray-200 h-1.5">
                    <div class="bg-indigo-600 h-1.5 transition-all duration-300" :style="`width: ${((currentQuestionIndex + 1) / questions.length) * 100}%`"></div>
                </div>
            </div>

            <!-- Quiz Questions Container -->
            <form id="quizForm" action="{{ route('rooms.submit', $room) }}" method="POST">
                @csrf
                <template x-for="(question, index) in questions" :key="question.id">
                    <div x-show="currentQuestionIndex === index" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8" x-transition.opacity>
                        
                        <h3 class="text-xl font-medium text-gray-900 mb-6" x-text="question.question_text"></h3>
                        
                        <!-- Pilihan Ganda -->
                        <div class="space-y-4" x-show="question.question_type !== 'essay'">
                            <template x-for="option in question.shuffled_options" :key="option.key">
                                <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-colors" :class="answers[question.id] === option.key ? 'border-fuchsia-500 bg-fuchsia-900/30 text-white shadow-[0_0_15px_rgba(217,70,239,0.3)]' : 'border-gray-700 hover:bg-gray-800 text-gray-300'">
                                    <input type="radio" :name="`answers[${question.id}]`" :value="option.key" x-model="answers[question.id]" class="w-4 h-4 text-fuchsia-500 border-gray-600 focus:ring-fuchsia-500 focus:ring-offset-gray-900 bg-gray-800">
                                    <span class="ml-4 block font-medium" x-text="option.text"></span>
                                </label>
                            </template>
                        </div>

                        <!-- Esai -->
                        <div x-show="question.question_type === 'essay'" class="space-y-4">
                            <div class="bg-cyan-500/10 border border-cyan-500/30 rounded-xl p-3 flex items-center gap-2 text-cyan-400 text-sm">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Ketik jawaban Anda dalam <strong>1 kata</strong></span>
                            </div>
                            <input type="text" :name="`answers[${question.id}]`" x-model="answers[question.id]" class="w-full bg-gray-800 border-2 border-gray-700 rounded-xl px-6 py-4 text-white text-lg font-bold focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all placeholder-gray-500" placeholder="Ketik jawaban di sini..." autocomplete="off">
                        </div>
                        
                        <div class="mt-8 flex justify-end">
                            <button type="button" x-show="currentQuestionIndex < questions.length - 1" @click="nextQuestion()" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition">
                                Selanjutnya &rarr;
                            </button>
                            
                            <button type="button" x-show="currentQuestionIndex === questions.length - 1" @click="submitQuiz()" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition">
                                SELESAI
                            </button>
                        </div>
                    </div>
                </template>
            </form>
        </div>
        
        <!-- Loading Overlay -->
        <div x-show="isSubmitting" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
            <div class="bg-white p-6 rounded-lg shadow-xl text-center">
                <svg class="animate-spin -ml-1 mr-3 h-8 w-8 text-indigo-600 inline-block mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-lg font-medium">Menyimpan jawaban...</p>
            </div>
        </div>

        <!-- Countdown Overlay -->
        <div x-show="isCountingDown" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-gray-900 bg-opacity-95 text-white" x-transition style="display: none;">
            <h2 class="text-3xl md:text-5xl font-bold mb-4 text-indigo-400 tracking-widest uppercase text-center">Bersiaplah!</h2>
            <div class="text-[10rem] font-black text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-rose-500 animate-pulse drop-shadow-2xl" x-text="countdownNumber"></div>
            <p class="mt-8 text-xl text-gray-300 text-center px-4">Pertanyaan akan segera dimulai...</p>
        </div>
    </div>

    <script>
        function roomQuizApp() {
            return {
                questions: @json($questions),
                currentQuestionIndex: 0,
                answers: {},
                timeLeft: 0,
                timerInterval: null,
                isSubmitting: false,
                isSoundOn: true,
                isCountingDown: false,
                countdownNumber: 4,
                
                initQuiz() {
                    if(this.questions.length > 0) {
                        this.isCountingDown = true;
                        this.countdownNumber = 4;
                        
                        if (this.isSoundOn) {
                            let s = document.getElementById('soundStart');
                            s.currentTime = 0;
                            s.play().catch(e => {});
                        }
                        
                        let countdownInterval = setInterval(() => {
                            this.countdownNumber--;
                            if(this.countdownNumber <= 0) {
                                clearInterval(countdownInterval);
                                this.isCountingDown = false;
                                this.startTimerForCurrentQuestion();
                            }
                        }, 1000);
                    }
                },

                toggleSound() {
                    this.isSoundOn = !this.isSoundOn;
                    if(!this.isSoundOn) {
                        document.getElementById('soundTense').pause();
                    }
                },

                turnOnSoundStart() {
                    this.isSoundOn = true;
                    let s = document.getElementById('soundStart');
                    s.play().catch(e => {});
                },
                
                startTimerForCurrentQuestion() {
                    clearInterval(this.timerInterval);
                    this.timeLeft = {{ $room->timer_per_question ?? 30 }};
                    
                    if (this.isSoundOn && this.timeLeft > 10) {
                        let bgm = document.getElementById('bgMusic');
                        bgm.currentTime = 0;
                        bgm.play().catch(e => {});
                    }
                    
                    this.timerInterval = setInterval(() => {
                        this.timeLeft--;

                        if (this.isSoundOn && this.timeLeft === 10) {
                            let bgm = document.getElementById('bgMusic');
                            bgm.pause();
                            
                            let tenseSound = document.getElementById('soundTense');
                            tenseSound.currentTime = 0;
                            tenseSound.play().catch(e => {});
                        }

                        if (this.isSoundOn && this.timeLeft === 1) {
                            let ting = document.getElementById('tingSound');
                            ting.currentTime = 0;
                            ting.volume = 0.8;
                            ting.play().catch(e => {});
                        }

                        if (this.timeLeft <= 0) {
                            clearInterval(this.timerInterval);
                            this.autoNextQuestion(); // Waktu habis, pindah ke soal selanjutnya
                        }
                    }, 1000);
                },
                
                formatTime(seconds) {
                    const mins = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
                },
                
                syncProgress() {
                    fetch('{{ route('rooms.sync', $room->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ answers: this.answers })
                    }).catch(e => {});
                },
                
                nextQuestion() {
                    if (this.currentQuestionIndex < this.questions.length - 1) {
                        this.syncProgress();
                        this.currentQuestionIndex++;
                        
                        let bgm = document.getElementById('bgMusic');
                        bgm.pause();
                        let tenseSound = document.getElementById('soundTense');
                        tenseSound.pause();
                        tenseSound.currentTime = 0;

                        this.startTimerForCurrentQuestion();
                    }
                },
                
                autoNextQuestion() {
                    if (this.currentQuestionIndex < this.questions.length - 1) {
                        this.nextQuestion();
                    } else {
                        this.submitQuiz();
                    }
                },
                
                submitQuiz() {
                    clearInterval(this.timerInterval);
                    this.isSubmitting = true;
                    
                    let bgm = document.getElementById('bgMusic');
                    if (bgm) { bgm.pause(); }
                    let tenseSound = document.getElementById('soundTense');
                    if (tenseSound) { tenseSound.pause(); tenseSound.currentTime = 0; }
                    
                    fetch(document.getElementById('quizForm').action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ answers: this.answers })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.redirect) {
                            window.location.href = data.redirect;
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting quiz:', error);
                        alert('Terjadi kesalahan saat menyimpan kuis.');
                        this.isSubmitting = false;
                    });
                }
            }
        }
    </script>
    
    <!-- Audio Elements (File MP3 Diletakkan di Folder: public/audio/) -->
    <audio id="bgMusic" src="{{ asset('audio/quis-mulai.mp3') }}" loop preload="auto"></audio>
    <audio id="soundStart" src="{{ asset('audio/4 detik_suara-mulai.mp3') }}" preload="auto"></audio>
    <audio id="soundTense" src="{{ asset('audio/10 detik_suara-ngerjainn.mp3') }}" preload="auto"></audio>
    <audio id="tingSound" src="{{ asset('audio/sergei_spas--476798.mp3') }}" preload="auto"></audio>
</x-app-layout>
