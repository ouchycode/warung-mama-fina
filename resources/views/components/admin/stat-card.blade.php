@props(['title', 'value', 'icon'])

<div class="bg-white border border-slate-200 shadow rounded-lg p-6">
    <div class="text-3xl mb-2">{{ $icon }}</div>
    <h4 class="text-lg font-bold text-slate-700">{{ $title }}</h4>
    <div class="text-2xl font-extrabold text-emerald-600 mt-1">{{ $value }}</div>
</div>
