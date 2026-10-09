<section id="top" class="relative isolate overflow-hidden">
    {{-- Background photograph --}}
    <div class="absolute inset-0 -z-10">
        <img
            src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=2000&q=80"
            alt="Professional cleaning team at work"
            class="h-full w-full object-cover object-center"
            fetchpriority="high">
        {{-- Blue → green diagonal overlay (reference look) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-blue-700/95 via-blue-600/90 to-green-600/80"></div>
    </div>

    <div class="mx-auto grid max-w-7xl items-center gap-x-12 gap-y-12 px-5 py-16 sm:px-8 lg:grid-cols-2 lg:py-24">
        {{-- Left: copy --}}
        <div class="reveal">
            <h1 class="font-display text-[clamp(2.25rem,5vw,3.75rem)] font-extrabold leading-[1.08] text-white">
                Commercial Cleaning Services in {{ config('site.region') }}
            </h1>

            <p class="mt-6 max-w-xl text-lg leading-relaxed text-white/90">
                For high-precision professional commercial cleaning, look no further than {{ config('site.name') }}.
                No matter your business, industry or property type, our trained, certified and insured personnel cover
                every corner to deliver sparkling results. <span class="font-bold">Over 30+ years of experience, trusted by
                businesses across Manchester and surrounding areas,</span> delivering high-quality, cost-effective results that exceed expectations.
            </p>

            {{-- Green-check feature badges --}}
            <ul class="reveal-stagger mt-8 grid max-w-xl grid-cols-1 gap-x-8 gap-y-3 sm:grid-cols-2">
                @foreach (config('site.badges') as $badge)
                    <li class="flex items-center gap-2.5 text-sm font-bold uppercase tracking-wide text-white">
                        <span class="flex h-6 w-6 flex-none items-center justify-center rounded-full bg-green-500 text-white">
                            <x-icon name="check" class="h-4 w-4" stroke-width="2.5" />
                        </span>
                        {{ $badge }}
                    </li>
                @endforeach
            </ul>

            <div class="mt-9 flex flex-wrap gap-3">
                <a href="#estimate" class="inline-flex items-center gap-2 rounded-lg bg-white px-6 py-3.5 text-base font-bold text-blue-600 transition-transform duration-200 ease-out hover:-translate-y-0.5">
                    Get Free Estimate
                    <x-icon name="arrow" class="h-5 w-5" />
                </a>
                <a href="#services" class="inline-flex items-center gap-2 rounded-lg border-2 border-white/70 px-6 py-3.5 text-base font-bold text-white transition-colors hover:bg-white/10">
                    Our Services
                </a>
            </div>
        </div>

        {{-- Right: estimate form --}}
        <div id="estimate" class="reveal scroll-mt-28">
            <h2 class="mb-4 font-display text-2xl font-extrabold text-white sm:text-3xl">Get A Free Estimate</h2>
            <livewire:estimate-form />
        </div>
    </div>
</section>
