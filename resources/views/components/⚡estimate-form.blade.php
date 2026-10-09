<?php

use App\Models\Lead;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|string|min:2|max:120')]
    public string $name = '';

    #[Validate('required|email|max:190')]
    public string $email = '';

    #[Validate('nullable|string|max:40')]
    public string $phone = '';

    #[Validate('nullable|string|max:190')]
    public string $address = '';

    #[Validate('nullable|string|max:1000')]
    public string $message = '';

    public bool $sent = false;

    public function submit(): void
    {
        $data = $this->validate();

        Lead::create($data);

        $this->reset(['name', 'email', 'phone', 'address', 'message']);
        $this->sent = true;
    }

    public function sendAnother(): void
    {
        $this->sent = false;
    }
}; ?>

<div class="rounded-3xl border border-white/10 bg-white p-6 text-ink shadow-[0_40px_80px_-40px_rgba(0,0,0,0.6)] sm:p-8">
    @if ($sent)
        {{-- Success state --}}
        <div class="flex flex-col items-center py-10 text-center" role="status">
            <span class="flex h-16 w-16 items-center justify-center rounded-full bg-green-500/12 text-green-600">
                <x-icon name="check" class="h-9 w-9" stroke-width="2" />
            </span>
            <h3 class="mt-6 font-display text-2xl font-extrabold text-ink-strong">Request received</h3>
            <p class="mt-2 max-w-sm text-muted">
                Thanks — a member of the {{ config('site.name') }} team will reach out within one business day with your
                tailored estimate.
            </p>
            <button type="button" wire:click="sendAnother"
                    class="mt-7 inline-flex items-center gap-2 rounded-full border border-line px-5 py-2.5 text-sm font-semibold text-ink-strong transition-colors hover:bg-surface-2">
                Send another request
            </button>
        </div>
    @else
        <form wire:submit="submit" class="space-y-5" novalidate>
            <div>
                <h3 class="font-display text-xl font-extrabold text-ink-strong">Request your free estimate</h3>
                <p class="mt-1 text-sm text-muted">No obligation — we reply within one business day.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                {{-- Name --}}
                <div class="sm:col-span-2">
                    <label for="ef-name" class="mb-1.5 block text-sm font-semibold text-ink-strong">Full name <span class="text-blue-600">*</span></label>
                    <input id="ef-name" type="text" wire:model.blur="name" autocomplete="name"
                           @class([
                               'w-full rounded-xl border bg-surface px-4 py-3 text-ink placeholder:text-muted/70 transition-colors focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25',
                               'border-line' => ! $errors->has('name'),
                               'border-red-500 ring-2 ring-red-500/20' => $errors->has('name'),
                           ])
                           placeholder="Jane Doe">
                    @error('name') <p class="mt-1.5 text-sm font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="ef-email" class="mb-1.5 block text-sm font-semibold text-ink-strong">Email <span class="text-blue-600">*</span></label>
                    <input id="ef-email" type="email" wire:model.blur="email" autocomplete="email"
                           @class([
                               'w-full rounded-xl border bg-surface px-4 py-3 text-ink placeholder:text-muted/70 transition-colors focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25',
                               'border-line' => ! $errors->has('email'),
                               'border-red-500 ring-2 ring-red-500/20' => $errors->has('email'),
                           ])
                           placeholder="jane@company.com">
                    @error('email') <p class="mt-1.5 text-sm font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label for="ef-phone" class="mb-1.5 block text-sm font-semibold text-ink-strong">Phone</label>
                    <input id="ef-phone" type="tel" wire:model.blur="phone" autocomplete="tel"
                           @class([
                               'w-full rounded-xl border bg-surface px-4 py-3 text-ink placeholder:text-muted/70 transition-colors focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25',
                               'border-line' => ! $errors->has('phone'),
                               'border-red-500 ring-2 ring-red-500/20' => $errors->has('phone'),
                           ])
                           placeholder="+44 7XXX XXXXXX">
                    @error('phone') <p class="mt-1.5 text-sm font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Address --}}
                <div class="sm:col-span-2">
                    <label for="ef-address" class="mb-1.5 block text-sm font-semibold text-ink-strong">Property address</label>
                    <input id="ef-address" type="text" wire:model.blur="address" autocomplete="street-address"
                           @class([
                               'w-full rounded-xl border bg-surface px-4 py-3 text-ink placeholder:text-muted/70 transition-colors focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25',
                               'border-line' => ! $errors->has('address'),
                               'border-red-500 ring-2 ring-red-500/20' => $errors->has('address'),
                           ])
                           placeholder="Street, city, postcode">
                    @error('address') <p class="mt-1.5 text-sm font-medium text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Message --}}
                <div class="sm:col-span-2">
                    <label for="ef-message" class="mb-1.5 block text-sm font-semibold text-ink-strong">How can we help?</label>
                    <textarea id="ef-message" rows="4" wire:model.blur="message" maxlength="1000"
                              @class([
                                  'w-full resize-none rounded-xl border bg-surface px-4 py-3 text-ink placeholder:text-muted/70 transition-colors focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25',
                                  'border-line' => ! $errors->has('message'),
                                  'border-red-500 ring-2 ring-red-500/20' => $errors->has('message'),
                              ])
                              placeholder="Tell us about your space, square footage and how often you need cleaning."></textarea>
                    @error('message') <p class="mt-1.5 text-sm font-medium text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit"
                    class="group inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-6 py-3.5 text-base font-bold text-white transition-all duration-200 ease-out hover:-translate-y-0.5 hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-70">
                <span wire:loading.remove wire:target="submit" class="inline-flex items-center gap-2">
                    Send my request
                    <x-icon name="arrow" class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-0.5" />
                </span>
                <span wire:loading wire:target="submit" class="inline-flex items-center gap-2">
                    <svg class="h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" />
                        <path class="opacity-90" d="M22 12a10 10 0 0 1-10 10" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                    </svg>
                    Sending…
                </span>
            </button>

            <p class="text-center text-xs text-muted">
                By submitting, you agree to be contacted about your estimate. We never share your details.
            </p>
        </form>
    @endif
</div>
