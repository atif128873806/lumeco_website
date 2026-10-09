<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#12233f">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title ?? 'Admin' }} · {{ config('site.name') }}</title>
    <link rel="icon" type="image/png" href="/img/logo-mark.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-surface-2 text-ink antialiased">
    <div class="min-h-screen">
        {{-- Top bar --}}
        <header class="sticky top-0 z-40 border-b border-white/10 bg-navy-950 text-white">
            <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-5 py-3.5 sm:px-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    <img src="/img/logo-mark.png" alt="" width="36" height="36" class="h-9 w-9 rounded-lg ring-1 ring-white/15">
                    <span class="font-display text-lg font-extrabold tracking-tight text-white">{{ config('site.name') }}</span>
                    <span class="ml-1 rounded-md bg-teal-400/15 px-2 py-0.5 text-[0.7rem] font-bold uppercase tracking-wider text-teal-300">Admin</span>
                </a>
                <div class="flex items-center gap-3">
                    <a href="/" target="_blank" rel="noopener" class="hidden text-sm font-medium text-white/70 transition-colors hover:text-teal-300 sm:inline">View site ↗</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="rounded-full border border-white/20 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-white/10">
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-5 py-8 sm:px-8 sm:py-10">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
