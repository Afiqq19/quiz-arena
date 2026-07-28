<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-red-500 hover:to-rose-500 shadow-lg shadow-red-500/30 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all active:scale-95 duration-150']) }}>
    {{ $slot }}
</button>
