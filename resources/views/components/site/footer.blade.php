<footer class="bg-blue-700 text-white/85">
    <div class="mx-auto max-w-7xl px-5 py-16 sm:px-8">
        <div class="grid gap-10 lg:grid-cols-12">
            {{-- Brand --}}
            <div class="lg:col-span-4">
                <div class="flex items-center gap-2.5">
                    <img src="/img/logo-mark.png" alt="" width="44" height="44" class="h-11 w-11 rounded-xl ring-1 ring-white/15">
                    <span class="font-display text-2xl font-extrabold tracking-tight text-white">{{ config('site.name') }}</span>
                </div>
                <p class="mt-4 max-w-sm leading-relaxed text-white/75">
                    {{ config('site.name') }} proudly serves companies across {{ config('site.region') }} with reliable,
                    cost-effective commercial cleaning. Contact us today to schedule your next cleaning.
                </p>
                <a href="tel:{{ config('site.contact.phone_href') }}" class="mt-6 inline-flex items-center gap-2 rounded-lg bg-green-600 px-5 py-3 text-sm font-bold uppercase tracking-wide text-white transition-colors hover:bg-green-700">
                    <x-icon name="phone" class="h-4 w-4" /> Call for a Free Estimate
                </a>
            </div>

            {{-- Services --}}
            <div class="lg:col-span-3">
                <h3 class="font-display text-sm font-bold uppercase tracking-wide text-white">Cleaning Services</h3>
                <ul class="mt-4 space-y-2.5 text-[0.95rem]">
                    @foreach (config('site.services') as $service)
                        <li><a href="#services" class="transition-colors hover:text-white">{{ $service['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Specialty --}}
            <div class="lg:col-span-2">
                <h3 class="font-display text-sm font-bold uppercase tracking-wide text-white">Specialty</h3>
                <ul class="mt-4 space-y-2.5 text-[0.95rem]">
                    @foreach (config('site.specialty') as $item)
                        <li><a href="#services" class="transition-colors hover:text-white">{{ $item['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div class="lg:col-span-3">
                <h3 class="font-display text-sm font-bold uppercase tracking-wide text-white">Get In Touch</h3>
                <ul class="mt-4 space-y-3.5 text-[0.95rem]">
                    <li class="flex items-start gap-3">
                        <x-icon name="phone" class="mt-0.5 h-4.5 w-4.5 flex-none text-green-500" />
                        <a href="tel:{{ config('site.contact.phone_href') }}" class="transition-colors hover:text-white">{{ config('site.contact.phone') }}</a>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-icon name="mail" class="mt-0.5 h-4.5 w-4.5 flex-none text-green-500" />
                        <a href="mailto:{{ config('site.contact.email') }}" class="transition-colors hover:text-white">{{ config('site.contact.email') }}</a>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-icon name="pin" class="mt-0.5 h-4.5 w-4.5 flex-none text-green-500" />
                        <span>{{ config('site.contact.address') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-icon name="clock" class="mt-0.5 h-4.5 w-4.5 flex-none text-green-500" />
                        <span>Service {{ config('site.contact.hours_service') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-14 flex flex-col gap-4 border-t border-white/15 pt-6 text-sm text-white/70 sm:flex-row sm:items-center sm:justify-between">
            <p>© {{ date('Y') }} {{ config('site.name') }}. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="transition-colors hover:text-white">Privacy Policy</a>
                <a href="#" class="transition-colors hover:text-white">Terms</a>
            </div>
        </div>
    </div>
</footer>
