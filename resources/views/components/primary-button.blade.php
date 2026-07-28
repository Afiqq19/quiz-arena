<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-fuchsia-600 to-blue-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-fuchsia-500 hover:to-blue-500 shadow-lg shadow-fuchsia-500/30 focus:outline-none focus:ring-2 focus:ring-fuchsia-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all active:scale-95 duration-150']) }}>
    {{ $slot }}
</button>
