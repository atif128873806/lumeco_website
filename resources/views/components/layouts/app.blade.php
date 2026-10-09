<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1b52a8">

    <title>{{ $title ?? config('site.name') . ' — ' . config('site.kicker') }}</title>
    <meta name="description" content="{{ config('site.name') }} delivers premium commercial cleaning across {{ config('site.region') }}. {{ config('site.tagline') }} Book a free estimate today.">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ config('site.name') }} — {{ config('site.kicker') }}">
    <meta property="og:description" content="{{ config('site.tagline') }} Premium commercial cleaning across {{ config('site.region') }}.">

    <link rel="icon" type="image/png" href="/img/logo-mark.png">
    <link rel="preconnect" href="https://images.unsplash.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-paper text-ink antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[70] focus:rounded-full focus:bg-blue-700 focus:px-5 focus:py-2 focus:text-sm focus:font-semibold focus:text-white">
        Skip to content
    </a>

    <x-top-bar />
    <x-site.header />

    <main id="main">
        {{ $slot }}
    </main>

    <x-site.footer />
</body>
</html>
