@props(['disabled' => false, 'error' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border ' .
        ($error ? 'border-rose-500' : 'border-slate-200 dark:border-slate-700') .
        ' text-slate-900 dark:text-white text-sm font-bold focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600',
]) !!}>
