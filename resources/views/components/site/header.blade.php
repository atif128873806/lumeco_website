@php
    $nav = [
        ['label' => 'Home', 'href' => '#top'],
        ['label' => 'Services', 'href' => '#services'],
        ['label' => 'About', 'href' => '#about'],
        ['label' => 'Why Lumeco', 'href' => '#why'],
        ['label' => 'Reviews', 'href' => '#reviews'],
        ['label' => 'Contact', 'href' => '#contact'],
    ];
@endphp

<header
    data-header
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
    class="sticky top-0 z-50 border-b border-line bg-paper text-ink shadow-sm"
>
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-5 py-3 sm:px-8">
        {{-- Logo --}}
        <a href="#top" class="flex items-center gap-2.5" aria-label="{{ config('site.name') }} home">
            <img src="/img/logo-mark.png" alt="" width="44" height="44" class="h-11 w-11 rounded-xl">
            <span class="font-display text-2xl font-extrabold tracking-tight text-blue-600">{{ config('site.name') }}</span>
        </a>

        {{-- Desktop nav --}}
        <nav class="hidden items-center gap-1 lg:flex" aria-label="Primary">
            @foreach ($nav as $item)
                <a href="{{ $item['href'] }}"
                   class="rounded-md px-3 py-2 text-[0.95rem] font-semibold text-ink-strong transition-colors hover:text-blue-600">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- CTA + mobile toggle --}}
        <div class="flex items-center gap-2 sm:gap-3">
            <a href="#estimate"
               class="hidden items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-white transition-colors hover:bg-blue-700 sm:inline-flex">
                Get a Free Estimate
            </a>

            <button type="button" @click="open = !open"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-lg border border-line text-ink-strong lg:hidden"
                    :aria-expanded="open.toString()" aria-controls="mobile-menu" aria-label="Toggle menu">
                <svg x-show="!open" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                <svg x-show="open" x-cloak class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M6 6l12 12M18 6 6 18" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" x-show="open" x-cloak x-transition.opacity.duration.200ms
         class="border-t border-line bg-paper px-5 pb-6 pt-2 lg:hidden">
        <nav class="flex flex-col" aria-label="Mobile">
            @foreach ($nav as $item)
                <a href="{{ $item['href'] }}" @click="open = false"
                   class="border-b border-line py-3.5 text-base font-semibold text-ink-strong">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
        <a href="#estimate" @click="open = false"
           class="mt-5 inline-flex w-full items-center justify-center rounded-lg bg-blue-600 py-3 text-sm font-bold uppercase tracking-wide text-white">
            Get a Free Estimate
        </a>
    </div>
</header>
