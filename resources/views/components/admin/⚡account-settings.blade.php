<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|current_password')]
    public string $current_password = '';

    public string $password = '';
    public string $password_confirmation = '';

    public bool $saved = false;

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);
        $this->saved = true;
    }
}; ?>

<form wire:submit="updatePassword" class="rounded-2xl border border-line bg-paper p-6">
    <h2 class="font-display text-lg font-bold text-ink-strong">Change password</h2>
    <p class="mt-1 text-sm text-muted">Signed in as {{ auth()->user()->email }}.</p>

    @if ($saved)
        <div class="mt-4 rounded-xl border border-teal-500/30 bg-teal-400/10 px-4 py-3 text-sm font-medium text-teal-700">
            Password updated.
        </div>
    @endif

    <div class="mt-5 space-y-4">
        <div>
            <label for="cur" class="mb-1.5 block text-sm font-semibold text-ink-strong">Current password</label>
            <input id="cur" type="password" wire:model="current_password" autocomplete="current-password"
                   class="w-full rounded-xl border border-line bg-surface px-4 py-2.5 text-ink focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-500/25">
            @error('current_password') <p class="mt-1.5 text-sm font-medium text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="new" class="mb-1.5 block text-sm font-semibold text-ink-strong">New password</label>
            <input id="new" type="password" wire:model="password" autocomplete="new-password"
                   class="w-full rounded-xl border border-line bg-surface px-4 py-2.5 text-ink focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-500/25">
            @error('password') <p class="mt-1.5 text-sm font-medium text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="conf" class="mb-1.5 block text-sm font-semibold text-ink-strong">Confirm new password</label>
            <input id="conf" type="password" wire:model="password_confirmation" autocomplete="new-password"
                   class="w-full rounded-xl border border-line bg-surface px-4 py-2.5 text-ink focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-500/25">
        </div>
    </div>

    <button type="submit" class="mt-6 inline-flex items-center justify-center rounded-full bg-navy-900 px-5 py-2.5 text-sm font-bold text-white transition-colors hover:bg-navy-800">
        Update password
    </button>
</form>
