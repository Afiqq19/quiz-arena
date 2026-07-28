<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight flex items-center gap-3">
            {{ __('Histori Pengerjaan Kuis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-800 mb-8 p-6 relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent opacity-100 pointer-events-none"></div>
                
                <form action="{{ route('admin.attempts.index') }}" method="GET" class="flex flex-col md:flex-row gap-6 relative z-10">
                    <div class="flex-1">
                        <label for="quiz_id" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Filter Kuis</label>
                        <select name="quiz_id" id="quiz_id" class="block w-full bg-gray-800 border-gray-700 text-white rounded-xl focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            <option value="">Semua Kuis</option>
                            @foreach($quizzes as $quiz)
                                <option value="{{ $quiz->id }}" {{ request('quiz_id') == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="user_id" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Filter Pemain</label>
                        <select name="user_id" id="user_id" class="block w-full bg-gray-800 border-gray-700 text-white rounded-xl focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            <option value="">Semua Pemain</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end gap-3 mt-4 md:mt-0">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-bold text-white shadow-lg shadow-indigo-500/30 hover:from-indigo-500 hover:to-purple-500 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-900">
                            Terapkan Filter
                        </button>
                        @if(request('quiz_id') || request('user_id'))
                        <a href="{{ route('admin.attempts.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-800 border border-gray-700 rounded-xl font-bold text-gray-300 hover:text-white hover:bg-gray-700 transition-all">
                            Reset
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-800">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Pemain</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Kuis</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Skor</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-800">
                            @forelse($attempts as $attempt)
                                <tr class="hover:bg-gray-800/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 font-medium">
                                        {{ $attempt->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-emerald-500 to-teal-500 flex items-center justify-center text-white text-xs font-bold shadow-lg shadow-emerald-500/20">
                                                {{ substr($attempt->user->name, 0, 1) }}
                                            </div>
                                            <div class="text-sm font-bold text-white">{{ $attempt->user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-indigo-400">{{ $attempt->quiz->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-sm font-bold min-w-[3.5rem]">
                                            {{ $attempt->score }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('quiz.result', $attempt) }}" class="inline-flex items-center gap-2 text-indigo-400 hover:text-indigo-300 font-bold px-3 py-1.5 rounded-lg hover:bg-indigo-500/10 transition-colors">
                                            Lihat Detail <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-4 text-gray-600">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-300 mb-1">Tidak Ada Histori</h3>
                                        <p class="text-gray-500 text-sm">Belum ada pengerjaan kuis yang sesuai dengan filter.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $attempts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
