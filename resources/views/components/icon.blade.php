@props(['name' => 'sparkle'])

@php
    // 1.5px stroke, 24 grid, rounded — a consistent line-icon system.
    $paths = [
        'building' => '<path d="M3 21h18M6 21V5a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v16M14 9h3a1 1 0 0 1 1 1v11M9 8h2M9 12h2M9 16h2"/>',
        'factory'  => '<path d="M3 21h18M4 21V10l5 3V10l5 3V6l5 2v13M8 17h1M13 17h1M18 17h1"/>',
        'cart'     => '<path d="M3 4h2l2.4 12.3a1 1 0 0 0 1 .7h8.7a1 1 0 0 0 1-.8L21 8H6"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/>',
        'cross'    => '<rect x="4" y="4" width="16" height="16" rx="3"/><path d="M12 8v8M8 12h8"/>',
        'utensils' => '<path d="M6 3v7a2 2 0 0 0 4 0V3M8 10v11M18 3c-1.7 0-3 2-3 5s1 4 3 4v9"/>',
        'cap'      => '<path d="M12 4 2 9l10 5 10-5-10-5ZM6 11v5c0 1.1 2.7 2.5 6 2.5s6-1.4 6-2.5v-5"/>',
        'sparkle'  => '<path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8L12 3ZM19 15l.7 2 2 .7-2 .7-.7 2-.7-2-2-.7 2-.7.7-2Z"/>',
        'window'   => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M12 3v18M4 12h16"/>',
        'droplet'  => '<path d="M12 3c3.5 4 6 6.8 6 10a6 6 0 0 1-12 0c0-3.2 2.5-6 6-10Z"/>',
        'rug'      => '<rect x="3" y="6" width="18" height="12" rx="1"/><path d="M3 9h18M3 15h18M7 6v12M17 6v12"/>',
        'shine'    => '<path d="M4 20h16M6 20l2-9h8l2 9M9 7l1-3M15 7l-1-3M12 6V3"/>',
        'shield'   => '<path d="M12 3l7 3v5c0 5-3.4 8-7 10-3.6-2-7-5-7-10V6l7-3Z"/><path d="M9 12l2 2 4-4"/>',
        'badge'    => '<circle cx="12" cy="10" r="6"/><path d="M9 15l-1 6 4-2 4 2-1-6M9.5 10l1.7 1.7L15 8.5"/>',
        'users'    => '<circle cx="9" cy="8" r="3"/><path d="M3 20c0-3.3 2.7-5 6-5s6 1.7 6 5"/><path d="M16 5.5a3 3 0 0 1 0 5.8M17 15c2.5.4 4 2.2 4 5"/>',
        'sliders'  => '<path d="M4 6h10M18 6h2M4 12h2M10 12h10M4 18h8M16 18h4"/><circle cx="16" cy="6" r="2"/><circle cx="8" cy="12" r="2"/><circle cx="14" cy="18" r="2"/>',
        'leaf'     => '<path d="M5 19C4 12 8 5 20 4c0 12-6 16-13 15M5 19c2-4 5-6 9-7"/>',
        'chat'     => '<path d="M4 5h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H9l-4 4v-4H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/><path d="M8 10h8M8 13h5"/>',
        'check'    => '<circle cx="12" cy="12" r="9"/><path d="M8 12.5l2.5 2.5L16 9"/>',
        'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L20 13l2 5v2a1 1 0 0 1-1 1c-9 0-16-7-16-16a1 1 0 0 1 1-1Z"/>',
        'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'pin'      => '<path d="M12 21c-4-4-7-7.5-7-11a7 7 0 0 1 14 0c0 3.5-3 7-7 11Z"/><circle cx="12" cy="10" r="2.5"/>',
        'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'quote'    => '<path d="M9 7c-2.5 1-4 3.2-4 6.5V17h5v-5H7c0-1.8.8-3 2-3.5L9 7ZM19 7c-2.5 1-4 3.2-4 6.5V17h5v-5h-3c0-1.8.8-3 2-3.5L19 7Z"/>',
    ];
    $d = $paths[$name] ?? $paths['sparkle'];
@endphp

<svg {{ $attributes->merge(['class' => 'w-6 h-6', 'aria-hidden' => 'true']) }}
     viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
    {!! $d !!}
</svg>
