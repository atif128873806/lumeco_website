<section id="contact" class="section-y bg-paper">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        <div class="reveal mx-auto max-w-2xl text-center">
            <h2 class="font-display text-[clamp(2rem,4.5vw,3.25rem)] font-extrabold text-ink-strong">Contact Us Right Now</h2>
            <p class="mt-4 text-lg leading-relaxed text-muted">
                Ready for a spotless space? Reach out and we'll reply within one business day with a free, no-obligation estimate.
            </p>
        </div>

        <div class="reveal-stagger mt-12 grid gap-6 md:grid-cols-3">
            <a href="tel:{{ config('site.contact.phone_href') }}" class="group flex flex-col items-center rounded-2xl border border-line bg-white p-8 text-center shadow-sm transition-shadow hover:shadow-lg">
                <span class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-600 text-white"><x-icon name="phone" class="h-7 w-7" /></span>
                <h3 class="mt-5 font-display text-lg font-bold text-ink-strong">Call Us</h3>
                <p class="mt-1 font-semibold text-blue-600">{{ config('site.contact.phone') }}</p>
            </a>
            <a href="mailto:{{ config('site.contact.email') }}" class="group flex flex-col items-center rounded-2xl border border-line bg-white p-8 text-center shadow-sm transition-shadow hover:shadow-lg">
                <span class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-600 text-white"><x-icon name="mail" class="h-7 w-7" /></span>
                <h3 class="mt-5 font-display text-lg font-bold text-ink-strong">Email Us</h3>
                <p class="mt-1 font-semibold text-blue-600">{{ config('site.contact.email') }}</p>
            </a>
            <div class="flex flex-col items-center rounded-2xl border border-line bg-white p-8 text-center shadow-sm">
                <span class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-600 text-white"><x-icon name="pin" class="h-7 w-7" /></span>
                <h3 class="mt-5 font-display text-lg font-bold text-ink-strong">Visit Us</h3>
                <p class="mt-1 text-sm font-medium text-muted">{{ config('site.contact.address') }}</p>
            </div>
        </div>

        <div class="reveal mt-10 text-center">
            <a href="#estimate" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-7 py-3.5 text-base font-bold uppercase tracking-wide text-white transition-colors hover:bg-green-700">
                Get a Free Estimate
                <x-icon name="arrow" class="h-5 w-5" />
            </a>
        </div>
    </div>
</section>
