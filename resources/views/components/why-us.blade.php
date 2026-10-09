<section id="why" class="section-y bg-paper">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        <div class="reveal max-w-3xl">
            <h2 class="font-display text-[clamp(2rem,4.5vw,3.25rem)] font-extrabold text-ink-strong">Why Choose {{ config('site.name') }}?</h2>
            <p class="mt-5 text-lg leading-relaxed text-muted">
                At {{ config('site.name') }}, we're more than just cleaners — we're your facility-care partners. We deliver
                spotless results, reliable service and peace of mind, every time. Here's what sets us apart:
            </p>
        </div>

        <div class="reveal-stagger mt-12 grid gap-x-12 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (config('site.features') as $feature)
                <div class="flex gap-4">
                    <span class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-blue-50 text-blue-600">
                        <x-icon name="{{ $feature['icon'] }}" class="h-6 w-6" />
                    </span>
                    <div>
                        <h3 class="font-display text-lg font-bold text-ink-strong">{{ $feature['title'] }}</h3>
                        <p class="mt-2 text-[0.95rem] leading-relaxed text-muted">{{ $feature['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
