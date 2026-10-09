@php
    // Checkerboard fill like the reference: blue when (row + col) is even in a 3-col grid.
    $isBlue = fn (int $i) => ((intdiv($i, 3) + ($i % 3)) % 2) === 0;
@endphp

<section id="services" class="section-y bg-surface-2">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        {{-- Heading --}}
        <div class="reveal mx-auto max-w-3xl text-center">
            <h2 class="font-display text-[clamp(2rem,4.5vw,3.25rem)] font-extrabold text-ink-strong">Our Services</h2>
            <p class="mt-4 text-lg leading-relaxed text-muted">
                {{ config('site.name') }} offers a full suite of commercial cleaning services designed to keep your
                business looking its best.
            </p>
        </div>

        {{-- Commercial --}}
        <h3 class="reveal mt-12 font-display text-xl font-extrabold uppercase tracking-wide text-blue-600">Commercial Cleaning Services</h3>
        <p class="reveal mt-3 max-w-3xl leading-relaxed text-muted">
            Offices, retail, industrial and more — clean, organized spaces make a real difference to your business.
            {{ config('site.name') }} provides cost-effective cleaning across {{ config('site.region') }}.
        </p>

        <div class="reveal-stagger mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (config('site.services') as $i => $service)
                @php $blue = $isBlue($i); @endphp
                <article @class([
                    'flex flex-col rounded-2xl p-7 shadow-lg transition-transform duration-300 hover:-translate-y-1',
                    'bg-blue-600 text-white' => $blue,
                    'bg-white' => ! $blue,
                ])>
                    <span @class([
                        'flex h-14 w-14 items-center justify-center rounded-full',
                        'bg-white text-blue-600' => $blue,
                        'bg-blue-50 text-blue-600' => ! $blue,
                    ])>
                        <x-icon name="{{ $service['icon'] }}" class="h-7 w-7" />
                    </span>
                    <h4 @class(['mt-5 font-display text-lg font-bold uppercase tracking-wide', 'text-white' => $blue, 'text-ink-strong' => ! $blue])>{{ $service['title'] }}</h4>
                    <p @class(['mt-3 flex-1 text-[0.95rem] leading-relaxed', 'text-white/85' => $blue, 'text-muted' => ! $blue])>{{ $service['desc'] }}</p>
                    <a href="#estimate" @class([
                        'mt-6 inline-flex w-max items-center rounded-lg px-5 py-2.5 text-xs font-bold uppercase tracking-wide transition-colors',
                        'bg-green-600 text-white hover:bg-green-700' => $blue,
                        'bg-blue-600 text-white hover:bg-blue-700' => ! $blue,
                    ])>Learn More</a>
                </article>
            @endforeach
        </div>

        <div class="reveal mt-10 text-center">
            <a href="#estimate" class="inline-flex items-center rounded-lg bg-blue-600 px-7 py-3 text-sm font-bold uppercase tracking-wide text-white transition-colors hover:bg-blue-700">View More</a>
        </div>

        {{-- Specialty --}}
        <h3 class="reveal mt-16 font-display text-xl font-extrabold uppercase tracking-wide text-blue-600">Specialty Cleaning Services</h3>
        <p class="reveal mt-3 max-w-3xl leading-relaxed text-muted">
            Beyond routine cleaning, we handle the deep, technical and one-time work most companies can't — keeping your
            workspace healthy, productive and welcoming.
        </p>

        <div class="reveal-stagger mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (config('site.specialty') as $i => $item)
                @php $blue = $isBlue($i); @endphp
                <article @class([
                    'flex flex-col rounded-2xl p-7 shadow-lg transition-transform duration-300 hover:-translate-y-1',
                    'bg-blue-600 text-white' => $blue,
                    'bg-white' => ! $blue,
                ])>
                    <span @class([
                        'flex h-14 w-14 items-center justify-center rounded-full',
                        'bg-white text-blue-600' => $blue,
                        'bg-blue-50 text-blue-600' => ! $blue,
                    ])>
                        <x-icon name="{{ $item['icon'] }}" class="h-7 w-7" />
                    </span>
                    <h4 @class(['mt-5 font-display text-lg font-bold uppercase tracking-wide', 'text-white' => $blue, 'text-ink-strong' => ! $blue])>{{ $item['title'] }}</h4>
                    <p @class(['mt-3 flex-1 text-[0.95rem] leading-relaxed', 'text-white/85' => $blue, 'text-muted' => ! $blue])>Professional {{ strtolower($item['title']) }} handled by trained, insured specialists.</p>
                    <a href="#estimate" @class([
                        'mt-6 inline-flex w-max items-center rounded-lg px-5 py-2.5 text-xs font-bold uppercase tracking-wide transition-colors',
                        'bg-green-600 text-white hover:bg-green-700' => $blue,
                        'bg-blue-600 text-white hover:bg-blue-700' => ! $blue,
                    ])>Learn More</a>
                </article>
            @endforeach
        </div>
    </div>
</section>
