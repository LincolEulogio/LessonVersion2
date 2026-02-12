@props(['status'])

@php
    $colors = [
        'P' => 'bg-emerald-500 shadow-emerald-500/30',
        'A' => 'bg-rose-500 shadow-rose-500/30',
        'L' => 'bg-amber-500 shadow-amber-500/30',
        '-' => 'bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-500',
    ];

    $bgClass = $colors[$status] ?? $colors['-'];
    $textColor = $status == '-' ? '' : 'text-white';
@endphp

<div
    class="w-8 h-8 rounded-lg {{ $bgClass }} flex items-center justify-center {{ $textColor }} text-[10px] font-black shadow-sm mx-auto">
    {{ $status }}
</div>
