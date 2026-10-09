<?php

use App\Models\Lead;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $filter = 'all'; // all | new | read

    public ?int $expanded = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function toggle(int $id): void
    {
        if ($this->expanded === $id) {
            $this->expanded = null;

            return;
        }

        $this->expanded = $id;

        // Opening an unread message marks it read.
        $lead = Lead::find($id);
        if ($lead && $lead->isUnread()) {
            $lead->update(['status' => 'read']);
        }
    }

    public function markRead(int $id): void
    {
        Lead::whereKey($id)->update(['status' => 'read']);
    }

    public function markUnread(int $id): void
    {
        Lead::whereKey($id)->update(['status' => 'new']);
    }

    public function delete(int $id): void
    {
        Lead::whereKey($id)->delete();
        if ($this->expanded === $id) {
            $this->expanded = null;
        }
    }

    public function with(): array
    {
        $query = Lead::query()
            ->when($this->filter === 'new', fn ($q) => $q->where('status', 'new'))
            ->when($this->filter === 'read', fn ($q) => $q->where('status', 'read'))
            ->when($this->search !== '', function ($q) {
                $term = '%' . $this->search . '%';
                $q->where(fn ($sub) => $sub
                    ->where('name', 'like', $term)
                    ->orWhere('email', 'like', $term)
                    ->orWhere('phone', 'like', $term)
                    ->orWhere('address', 'like', $term)
                    ->orWhere('message', 'like', $term));
            })
            ->latest();

        return [
            'leads' => $query->paginate(10),
            'unreadCount' => Lead::unread()->count(),
            'totalCount' => Lead::count(),
        ];
    }
}; ?>

<div>
    {{-- Toolbar --}}
    <div class="flex flex-col gap-4 rounded-t-2xl border border-line bg-paper p-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-wrap items-center gap-2" role="tablist">
            @php
                $tabs = [
                    'all'  => ['label' => 'All', 'count' => $totalCount],
                    'new'  => ['label' => 'Unread', 'count' => $unreadCount],
                    'read' => ['label' => 'Read', 'count' => $totalCount - $unreadCount],
                ];
            @endphp
            @foreach ($tabs as $key => $tab)
                <button type="button" wire:click="setFilter('{{ $key }}')"
                        @class([
                            'inline-flex items-center gap-2 rounded-full px-3.5 py-1.5 text-sm font-semibold transition-colors',
                            'bg-navy-900 text-white' => $filter === $key,
                            'bg-surface-2 text-muted hover:text-ink-strong' => $filter !== $key,
                        ])>
                    {{ $tab['label'] }}
                    <span @class([
                        'rounded-full px-1.5 text-xs',
                        'bg-teal-400 text-navy-950' => $key === 'new' && $tab['count'] > 0,
                        'bg-white/15 text-white' => $filter === $key && ! ($key === 'new' && $tab['count'] > 0),
                        'bg-line text-muted' => $filter !== $key && ! ($key === 'new' && $tab['count'] > 0),
                    ])>{{ $tab['count'] }}</span>
                </button>
            @endforeach
        </div>

        <div class="relative w-full sm:w-64">
            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            <input type="search" wire:model.live.debounce.300ms="search" placeholder="Search messages…"
                   class="w-full rounded-full border border-line bg-surface py-2 pl-9 pr-4 text-sm text-ink transition-colors focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-500/20">
        </div>
    </div>

    {{-- List --}}
    <div class="divide-y divide-line rounded-b-2xl border border-t-0 border-line bg-paper">
        @forelse ($leads as $lead)
            <div wire:key="lead-{{ $lead->id }}" class="transition-colors {{ $lead->isUnread() ? 'bg-teal-400/[0.04]' : '' }}">
                {{-- Row --}}
                <button type="button" wire:click="toggle({{ $lead->id }})"
                        class="flex w-full items-center gap-4 px-4 py-4 text-left hover:bg-surface-2 sm:px-5">
                    <span @class([
                        'h-2.5 w-2.5 flex-none rounded-full',
                        'bg-teal-400' => $lead->isUnread(),
                        'bg-line' => ! $lead->isUnread(),
                    ])></span>

                    <span class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-navy-900 font-display text-xs font-bold text-teal-300">
                        {{ \Illuminate\Support\Str::of($lead->name)->explode(' ')->map(fn ($p) => \Illuminate\Support\Str::substr($p, 0, 1))->take(2)->implode('') }}
                    </span>

                    <span class="min-w-0 flex-1">
                        <span class="truncate font-semibold text-ink-strong {{ $lead->isUnread() ? 'font-bold' : '' }}">{{ $lead->name }}</span>
                        <span class="mt-0.5 block truncate text-sm text-muted">{{ $lead->email }}{{ $lead->phone ? ' · ' . $lead->phone : '' }}</span>
                    </span>

                    <span class="hidden flex-none text-right text-xs text-muted sm:block">
                        {{ $lead->created_at->diffForHumans() }}
                    </span>

                    <svg class="h-5 w-5 flex-none text-muted transition-transform {{ $expanded === $lead->id ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="m6 9 6 6 6-6"/></svg>
                </button>

                {{-- Expanded detail --}}
                @if ($expanded === $lead->id)
                    <div class="border-t border-line bg-surface/60 px-4 py-5 sm:px-5">
                        <dl class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wide text-muted">Email</dt>
                                <dd class="mt-1"><a href="mailto:{{ $lead->email }}" class="font-medium text-teal-700 hover:underline">{{ $lead->email }}</a></dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wide text-muted">Phone</dt>
                                <dd class="mt-1 font-medium text-ink">{{ $lead->phone ?: '—' }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-muted">Property address</dt>
                                <dd class="mt-1 font-medium text-ink">{{ $lead->address ?: '—' }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-muted">Message</dt>
                                <dd class="mt-1 whitespace-pre-line rounded-xl border border-line bg-paper p-4 text-ink">{{ $lead->message ?: 'No message provided.' }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-xs font-semibold uppercase tracking-wide text-muted">Received</dt>
                                <dd class="mt-1 text-sm text-muted">{{ $lead->created_at->format('D, M j, Y · g:i A') }}</dd>
                            </div>
                        </dl>

                        <div class="mt-5 flex flex-wrap items-center gap-2">
                            <a href="mailto:{{ $lead->email }}?subject=Your Lumeco estimate"
                               class="inline-flex items-center gap-2 rounded-full bg-teal-400 px-4 py-2 text-sm font-bold text-navy-950 transition-colors hover:bg-teal-300">
                                Reply by email
                            </a>
                            @if ($lead->isUnread())
                                <button type="button" wire:click="markRead({{ $lead->id }})" class="rounded-full border border-line px-4 py-2 text-sm font-semibold text-ink-strong transition-colors hover:bg-surface-2">Mark as read</button>
                            @else
                                <button type="button" wire:click="markUnread({{ $lead->id }})" class="rounded-full border border-line px-4 py-2 text-sm font-semibold text-ink-strong transition-colors hover:bg-surface-2">Mark as unread</button>
                            @endif
                            <button type="button" wire:click="delete({{ $lead->id }})"
                                    wire:confirm="Delete this request permanently? This cannot be undone."
                                    class="ml-auto rounded-full px-4 py-2 text-sm font-semibold text-red-600 transition-colors hover:bg-red-50">
                                Delete
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="flex flex-col items-center px-6 py-16 text-center">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-surface-2 text-muted">
                    <x-icon name="mail" class="h-7 w-7" />
                </span>
                <p class="mt-4 font-display text-lg font-bold text-ink-strong">
                    {{ $search !== '' || $filter !== 'all' ? 'No matching requests' : 'No requests yet' }}
                </p>
                <p class="mt-1 max-w-xs text-sm text-muted">
                    {{ $search !== '' || $filter !== 'all' ? 'Try a different search or filter.' : 'New estimate requests from the site will appear here.' }}
                </p>
            </div>
        @endforelse
    </div>

    @if ($leads->hasPages())
        <div class="mt-5">
            {{ $leads->links() }}
        </div>
    @endif
</div>
