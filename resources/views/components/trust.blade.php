@php
    $proof = [
        ['icon' => 'badge',  'text' => '30+ years in business'],
        ['icon' => 'users',  'text' => '500+ facilities served'],
        ['icon' => 'shield', 'text' => 'Insured, bonded & guaranteed'],
        ['icon' => 'leaf',   'text' => 'Eco-friendly products'],
    ];
@endphp

<section aria-label="Trust indicators" class="border-b border-line bg-paper">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        <ul class="reveal-stagger grid grid-cols-2 gap-y-6 py-8 lg:grid-cols-4">
            @foreach ($proof as $item)
                <li class="flex items-center gap-3 px-2 lg:justify-center">
                    <span class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-blue-50 text-blue-600">
                        <x-icon name="{{ $item['icon'] }}" class="h-6 w-6" />
                    </span>
                    <span class="text-sm font-bold text-ink-strong">{{ $item['text'] }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>
