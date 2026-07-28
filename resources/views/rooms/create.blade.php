<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl tracking-tight text-gray-800">
            {{ __('Buat Room Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('rooms.store') }}" method="POST">
                        @csrf
                        
                        <!-- Judul Room -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Ruangan (Room Title)</label>
                            <input type="text" name="title" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Misal: Ujian Tengah Semester IPA">
                        </div>

                        <!-- Pilih Kuis -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Sumber Soal (Kuis)</label>
                            <p class="text-xs text-gray-500 mb-3">Anda bisa memilih lebih dari satu kuis. Sistem akan mengumpulkan semua soal dari kuis terpilih.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-60 overflow-y-auto p-4 border rounded-md">
                                @foreach($quizzes as $quiz)
                                    <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="checkbox" name="quizzes[]" value="{{ $quiz->id }}" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                        <div class="flex-1">
                                            <span class="block text-sm font-medium text-gray-900">{{ $quiz->title }}</span>
                                            <span class="block text-xs text-gray-500">{{ $quiz->questions()->count() }} Soal tersedia</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Jumlah Pertanyaan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Total Pertanyaan yang Ditampilkan</label>
                                <input type="number" name="total_questions" min="1" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Misal: 12">
                                <p class="text-xs text-gray-500 mt-1">Sistem akan memilih acak X soal dari Kuis yang dicentang di atas.</p>
                            </div>

                            <!-- Waktu Pengerjaan Per Soal -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Waktu per Soal (Detik)</label>
                                <input type="number" name="timer_per_question" min="5" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="30" placeholder="Misal: 30">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition">
                                Buat Room Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
