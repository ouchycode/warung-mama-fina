@props(['label', 'value', 'color' => 'gray'])

<div class="bg-{{ $color }}-50 border-l-4 border-{{ $color }}-600 p-4 rounded-xl shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-{{ $color }}-700 font-semibold">{{ $label }}</p>
            <h4 class="text-xl font-bold text-{{ $color }}-900 mt-1">{{ $value }}</h4>
        </div>
    </div>
</div>
