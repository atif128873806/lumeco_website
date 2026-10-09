@php
    $initials = fn ($n) => \Illuminate\Support\Str::of($n)->explode(' ')->map(fn ($p) => \Illuminate\Support\Str::substr($p, 0, 1))->take(2)->implode('');
@endphp

<section id="reviews" class="section-y bg-surface-2">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        <div class="reveal mx-auto max-w-3xl text-center">
            <h2 class="font-display text-[clamp(2rem,4.5vw,3.25rem)] font-extrabold text-ink-strong">What Our Customers Say</h2>
            <div class="mt-4 flex items-center justify-center gap-2">
                <div class="flex text-green-500" aria-hidden="true">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.5l2.9 6 6.6.9-4.8 4.6 1.2 6.5L12 18.9 6.1 20.5l1.2-6.5L2.5 9.4l6.6-.9L12 2.5Z"/></svg>
                    @endfor
                </div>
                <span class="text-sm font-bold text-ink-strong">4.9/5 · 120+ reviews</span>
            </div>
        </div>

        <div class="reveal-stagger mt-12 grid gap-6 md:grid-cols-3">
            @foreach (config('site.testimonials') as $t)
                <figure class="flex flex-col rounded-2xl bg-white p-8 shadow-lg">
                    <div class="flex text-green-500" aria-hidden="true">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.5l2.9 6 6.6.9-4.8 4.6 1.2 6.5L12 18.9 6.1 20.5l1.2-6.5L2.5 9.4l6.6-.9L12 2.5Z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="mt-4 flex-1 text-[1.02rem] leading-relaxed text-ink">"{{ $t['quote'] }}"</blockquote>
                    <figcaption class="mt-6 flex items-center gap-3 border-t border-line pt-5">
                        <span class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-blue-600 font-display text-sm font-bold text-white">{{ $initials($t['name']) }}</span>
                        <span>
                            <span class="block font-bold text-ink-strong">{{ $t['name'] }}</span>
                            <span class="block text-sm text-muted">{{ $t['role'] }}</span>
                        </span>
                    </figcaption>
                </figure>
            @endforeach
        </div>

        <div class="reveal mt-10 text-center">
            <a href="#estimate" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-7 py-3.5 text-base font-bold uppercase tracking-wide text-white transition-colors hover:bg-blue-700">
                Get Your Free Estimate
            </a>
        </div>
    </div>
</section>
