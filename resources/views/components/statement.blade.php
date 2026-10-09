<section class="section-y bg-blue-600 text-white">
    <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 sm:px-8 lg:grid-cols-2 lg:gap-16">
        <div class="reveal">
            <h2 class="font-display text-[clamp(2rem,4.5vw,3rem)] font-extrabold leading-[1.1] text-white">
                Commercial Cleaning Services in {{ \Illuminate\Support\Str::before(config('site.region'), ' &') }}
            </h2>
            <p class="mt-5 text-lg font-semibold text-white/95">
                {{ \Illuminate\Support\Str::before(config('site.region'), ' &') }}'s experienced commercial cleaning for offices,
                businesses, restaurants and more.
            </p>
            <p class="mt-4 text-lg leading-relaxed text-white/85">
                Making sure your property is presentable and spotless is our #1 priority — no matter what industry you're in.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="tel:{{ config('site.contact.phone_href') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-6 py-3.5 text-base font-bold text-blue-600 transition-transform duration-200 hover:-translate-y-0.5">
                    <x-icon name="phone" class="h-5 w-5" /> Call Now
                </a>
                <a href="#estimate" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-6 py-3.5 text-base font-bold text-white transition-colors hover:bg-green-700">
                    Get a Free Estimate
                </a>
            </div>
        </div>

        <div class="reveal">
            <div class="overflow-hidden rounded-2xl shadow-2xl">
                <img
                    src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1100&q=80"
                    alt="A clean, bright commercial office interior"
                    class="aspect-[3/2] w-full object-cover"
                    loading="lazy">
            </div>
        </div>
    </div>
</section>
