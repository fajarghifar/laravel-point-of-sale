@props(['name', 'label'])

@php
    $currentSort = request('sort');
    $isAscending = $currentSort === $name;
    $isDescending = $currentSort === "-{$name}";

    // Determine next sort order
    if ($isAscending) {
        $nextSort = "-{$name}";
    } elseif ($isDescending) {
        $nextSort = $name;
    } else {
        $nextSort = $name;
    }

    $url = request()->fullUrlWithQuery(['sort' => $nextSort]);
@endphp

<a href="{{ $url }}" class="d-flex align-items-center text-nowrap sort-link" style="text-decoration: none; cursor: pointer; color: inherit;">
    {{ $label }}

    @if ($isAscending)
        <x-heroicon-s-chevron-up class="w-4 h-4 ml-1" />
    @elseif ($isDescending)
        <x-heroicon-s-chevron-down class="w-4 h-4 ml-1" />
    @else
        <x-heroicon-o-chevron-up-down class="w-4 h-4 ml-1" />
    @endif
</a>
