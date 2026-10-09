<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#12233f">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin sign in · {{ config('site.name') }}</title>
    <link rel="icon" type="image/png" href="/img/logo-mark.png">
    @vite(['resources/css/app.css'])
</head>
<body class="grid min-h-screen place-items-center bg-navy-950 px-5 text-white">
    <div class="pointer-events-none fixed -right-40 top-0 h-[30rem] w-[30rem] rounded-full bg-teal-500/12 blur-[120px]"></div>

    <div class="relative w-full max-w-sm">
        <div class="mb-8 flex flex-col items-center text-center">
            <img src="/img/logo-mark.png" alt="{{ config('site.name') }}" width="56" height="56" class="h-14 w-14 rounded-2xl ring-1 ring-white/15">
            <h1 class="mt-4 font-display text-2xl font-extrabold text-white">{{ config('site.name') }} Admin</h1>
            <p class="mt-1 text-sm text-white/60">Sign in to view estimate requests.</p>
        </div>

        <form method="POST" action="{{ route('admin.login.attempt') }}"
              class="rounded-3xl border border-white/10 bg-white p-6 text-ink shadow-[0_40px_80px_-40px_rgba(0,0,0,0.7)] sm:p-8">
            @csrf

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="space-y-5">
                <div>
                    <label for="email" class="mb-1.5 block text-sm font-semibold text-ink-strong">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="w-full rounded-xl border border-line bg-surface px-4 py-3 text-ink transition-colors focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-500/25"
                           placeholder="admin@lumeco.co.uk">
                </div>
                <div>
                    <label for="password" class="mb-1.5 block text-sm font-semibold text-ink-strong">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                           class="w-full rounded-xl border border-line bg-surface px-4 py-3 text-ink transition-colors focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-500/25"
                           placeholder="••••••••">
                </div>
                <label class="flex items-center gap-2.5 text-sm text-muted">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-line text-teal-500 focus:ring-teal-500/30">
                    Keep me signed in
                </label>
            </div>

            <button type="submit"
                    class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-full bg-teal-400 px-6 py-3.5 text-base font-bold text-navy-950 transition-transform duration-200 ease-out hover:-translate-y-0.5 hover:bg-teal-300">
                Sign in
            </button>
        </form>

        <p class="mt-6 text-center text-xs text-white/40">Authorized access only.</p>
    </div>
</body>
</html>
