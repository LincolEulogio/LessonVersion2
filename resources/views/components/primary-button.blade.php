<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'px-8 py-4 rounded-2xl bg-indigo-600 text-white font-black text-[10px] uppercase tracking-[0.2em] transition-all shadow-lg hover:scale-105 active:scale-95 hover:bg-indigo-500 flex items-center justify-center gap-2 border-none']) }}>
    {{ $slot }}
</button>
