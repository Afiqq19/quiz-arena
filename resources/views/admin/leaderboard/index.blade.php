<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight flex items-center gap-3">
            {{ __('Papan Peringkat (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-800">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider w-16">Peringkat</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Pemain</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Kuis Selesai</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Total Skor</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-800">
                            @forelse($leaderboard as $index => $row)
                                <tr class="hover:bg-gray-800/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($index == 0)
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-yellow-500/20 text-yellow-500 border border-yellow-500/30 font-black shadow-lg shadow-yellow-500/10">1</span>
                                        @elseif($index == 1)
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-400/20 text-gray-300 border border-gray-400/30 font-black shadow-lg shadow-gray-500/10">2</span>
                                        @elseif($index == 2)
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-600/20 text-amber-500 border border-amber-600/30 font-black shadow-lg shadow-amber-700/10">3</span>
                                        @else
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-800 text-gray-400 font-bold border border-gray-700">{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-fuchsia-600 to-blue-600 flex items-center justify-center text-white font-bold shadow-lg shadow-fuchsia-500/20">
                                                {{ substr($row->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-white">{{ $row->user->name }}</div>
                                                <div class="text-xs text-gray-500 mt-0.5">{{ $row->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20 text-sm font-bold min-w-[3rem]">
                                            {{ $row->quizzes_taken }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-lg font-black text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-blue-400">
                                            {{ number_format($row->total_score) }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-4 text-gray-600">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-300 mb-1">Papan Peringkat Kosong</h3>
                                        <p class="text-gray-500 text-sm">Belum ada pemain yang menyelesaikan kuis.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
