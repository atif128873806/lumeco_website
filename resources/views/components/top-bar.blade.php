<div class="bg-blue-600 text-white">
    <div class="mx-auto flex max-w-7xl items-center justify-center gap-6 px-5 py-2.5 text-sm font-semibold sm:justify-end sm:px-8">
        <a href="tel:{{ config('site.contact.phone_href') }}" class="inline-flex items-center gap-2 transition-colors hover:text-green-500">
            <x-icon name="phone" class="h-4 w-4 text-green-500" />
            {{ config('site.contact.phone') }}
        </a>
        <span class="hidden h-4 w-px bg-white/25 sm:block"></span>
        <a href="mailto:{{ config('site.contact.email') }}" class="inline-flex items-center gap-2 transition-colors hover:text-green-500">
            <x-icon name="mail" class="h-4 w-4 text-green-500" />
            <span class="hidden xs:inline sm:inline">{{ config('site.contact.email') }}</span>
        </a>
    </div>
</div>
