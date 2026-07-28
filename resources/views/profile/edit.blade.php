<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl tracking-tight text-white flex items-center gap-2">
            <svg class="w-7 h-7 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            {{ __('Profil Akun Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="p-6 sm:p-10 bg-gray-900 border border-gray-700 shadow-2xl shadow-black/40 rounded-3xl backdrop-blur-md relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-fuchsia-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
                <div class="text-white relative z-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-gray-900 border border-gray-700 shadow-2xl shadow-black/40 rounded-3xl backdrop-blur-md relative overflow-hidden">
                <div class="absolute top-0 left-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>
                <div class="text-white relative z-10">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-rose-950/20 border border-rose-900/50 shadow-2xl shadow-black/40 rounded-3xl backdrop-blur-md relative overflow-hidden">
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-rose-500/10 rounded-full blur-3xl translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
                <div class="text-white relative z-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
