<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-2.5 bg-gray-800 border border-gray-600 rounded-xl font-bold text-xs text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 disabled:opacity-25 transition-all active:scale-95 duration-150']) }}>
    {{ $slot }}
</button>
