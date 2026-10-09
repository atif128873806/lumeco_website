<x-layouts.admin title="Estimate requests">
    <div class="mb-8 flex flex-col gap-1">
        <h1 class="font-display text-2xl font-extrabold text-ink-strong sm:text-3xl">Estimate requests</h1>
        <p class="text-sm text-muted">Every message submitted through the site's estimate form.</p>
    </div>

    <livewire:admin.leads-table />

    <div class="mt-12" x-data="{ open: false }">
        <button type="button" @click="open = !open"
                class="flex items-center gap-2 text-sm font-semibold text-muted transition-colors hover:text-ink-strong">
            <svg class="h-4 w-4 transition-transform" :class="open && 'rotate-90'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 6l6 6-6 6"/></svg>
            Account settings
        </button>
        <div x-show="open" x-cloak x-transition.opacity.duration.200ms class="mt-4 max-w-md">
            <livewire:admin.account-settings />
        </div>
    </div>
</x-layouts.admin>
