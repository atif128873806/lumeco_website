<section id="about" class="section-y bg-blue-600 text-white">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
            {{-- Image --}}
            <div class="reveal">
                <div class="overflow-hidden rounded-2xl shadow-2xl">
                    <img
                        src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1100&q=80"
                        alt="A Lumeco cleaning professional detailing a window"
                        class="aspect-[5/4] w-full object-cover"
                        loading="lazy">
                </div>
            </div>

            {{-- Text --}}
            <div class="reveal">
                <h2 class="font-display text-[clamp(2rem,4.5vw,3rem)] font-extrabold leading-[1.1] text-white">
                    About {{ config('site.name') }}
                </h2>
                <p class="mt-3 font-display text-xl font-bold text-white">High-Quality, Cost Effective Results</p>

                <p class="mt-5 text-lg leading-relaxed text-white/90">
                    {{ config('site.name') }} has dazzled clients with a proud dedication to providing industry-leading,
                    cost-effective commercial cleaning services to businesses of all shapes and sizes.
                </p>
                <p class="mt-4 text-lg leading-relaxed text-white/90">
                    Our competitive pricing structure, leading-edge equipment and highly-trained personnel are what make
                    our clients choose us repeatedly. It's a level of guaranteed quality service that money simply cannot buy.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#why" class="inline-flex items-center rounded-lg bg-white px-6 py-3 text-sm font-bold uppercase tracking-wide text-blue-600 transition-transform duration-200 hover:-translate-y-0.5">
                        Learn More
                    </a>
                    <a href="#estimate" class="inline-flex items-center rounded-lg bg-green-600 px-6 py-3 text-sm font-bold uppercase tracking-wide text-white transition-colors hover:bg-green-700">
                        Request a Cleaning Plan
                    </a>
                </div>
            </div>
        </div>

        {{-- Stat cards --}}
        <dl class="reveal-stagger mt-14 grid gap-6 sm:grid-cols-3">
            @foreach (config('site.stats') as $stat)
                <div class="rounded-2xl bg-white p-8 text-center shadow-xl">
                    <dd class="font-display text-[clamp(2.5rem,5vw,3.25rem)] font-extrabold leading-none text-blue-600"
                        data-count="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0{{ $stat['suffix'] }}</dd>
                    <dt class="mt-2 text-sm font-bold uppercase tracking-wide text-ink-strong">{{ $stat['label'] }}</dt>
                </div>
            @endforeach
        </dl>
    </div>
</section>
