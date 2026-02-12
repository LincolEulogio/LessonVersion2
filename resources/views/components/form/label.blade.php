@props(['value'])

<label {!! $attributes->merge([
    'class' => 'block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mb-2',
]) !!}>
    {{ $value ?? $slot }}
</label>
