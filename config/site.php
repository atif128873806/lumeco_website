<?php

/**
 * Lumeco site content — single source of truth for the landing page.
 * Edit copy, contact details, services, and social proof here.
 */
return [
    'name'    => 'Lumeco',
    'tagline' => 'Spaces refined. Standards unmatched.',
    'kicker'  => 'Premium Cleaning Services',
    'region'  => 'Manchester and its surroundings',

    'contact' => [
        'phone'         => '+447448037620',
        'phone_href'    => '+447448037620',
        'email'         => 'lumeco101@gmail.com',
        'address'       => '130a Withington Road, M16 8FB',
        'hours_service' => '24 / 7 / 365',
        'hours_office'  => 'Mon–Sat · 8am – 11pm',
    ],

    // Hero feature badges
    'badges' => [
        'Full-service cleaning',
        'Daily, regular & one-time',
        'Eco-friendly products',
        'Specialty & restoration',
    ],

    // About stats (count-up)
    'stats' => [
        ['value' => 30,  'suffix' => '+',  'label' => 'Years of experience'],
        ['value' => 500, 'suffix' => '+',  'label' => 'Facilities served'],
        ['value' => 98,  'suffix' => '%',  'label' => 'Client retention'],
    ],

    // Commercial cleaning services (icon keys map to <x-icon>)
    'services' => [
        ['icon' => 'building',   'title' => 'Office Cleaning',        'desc' => 'Daily and scheduled care for workplaces of every size — desks, floors, glass and shared spaces kept immaculate.'],
        ['icon' => 'factory',    'title' => 'Industrial Cleaning',    'desc' => 'Heavy-duty programs for warehouses, plants and facilities, built around your safety and production schedule.'],
        ['icon' => 'cart',       'title' => 'Retail Cleaning',        'desc' => 'High-traffic stores, malls and showrooms that stay spotless and welcoming through every shift.'],
        ['icon' => 'cross',      'title' => 'Medical & Clinics',      'desc' => 'Clinical-grade disinfection and detailing for medical offices, labs and healthcare environments.'],
        ['icon' => 'utensils',   'title' => 'Restaurant Cleaning',    'desc' => 'Front-of-house shine and back-of-house hygiene that meets health-code standards every day.'],
        ['icon' => 'cap',        'title' => 'School Cleaning',        'desc' => 'Safe, thorough cleaning for classrooms, gyms and campuses — trusted around students and staff.'],
    ],

    // Specialty services (compact list)
    'specialty' => [
        ['icon' => 'sparkle',  'title' => 'Deep Cleaning'],
        ['icon' => 'window',   'title' => 'Window Cleaning'],
        ['icon' => 'droplet',  'title' => 'Power Washing'],
        ['icon' => 'rug',      'title' => 'Carpet & Upholstery'],
        ['icon' => 'shine',    'title' => 'Floor Restoration'],
        ['icon' => 'shield',   'title' => 'Fogging Disinfection'],
    ],

    // Why choose us
    'features' => [
        ['icon' => 'badge',    'title' => 'Proven Experience',        'desc' => '30+ years and 500+ satisfied clients across Manchester and surrounding areas. We have seen every facility type and cleaned it well.'],
        ['icon' => 'users',    'title' => 'Vetted, Trained Team',     'desc' => 'Fully insured, background-checked and continuously trained cleaning professionals you can trust on-site.'],
        ['icon' => 'sliders',  'title' => 'Tailored Cleaning Plans',  'desc' => 'Cost-effective programs designed around your space, schedule and budget — never one-size-fits-all.'],
        ['icon' => 'leaf',     'title' => 'Eco-Friendly Approach',    'desc' => 'Advanced, environmentally safe products and modern equipment that protect people and surfaces.'],
        ['icon' => 'chat',     'title' => 'Responsive Communication', 'desc' => 'A dedicated point of contact and clear reporting — requests handled quickly, every time.'],
        ['icon' => 'check',    'title' => 'Guaranteed Quality',       'desc' => 'Insured, bonded and inspected regularly. If it is not right, we make it right — guaranteed.'],
    ],

    // Testimonials
    'testimonials' => [
        ['quote' => 'Lumeco transformed our head office. The team is meticulous, reliable and completely invisible during work hours — exactly what we needed.', 'name' => 'Sarah Whitfield', 'role' => 'Facilities Manager, Meridian Group'],
        ['quote' => 'We switched to Lumeco after years of inconsistent service. Six months in, the difference is night and day. Spotless, every single visit.', 'name' => 'David Chen', 'role' => 'Operations Director, Northline Retail'],
        ['quote' => 'Their medical-grade disinfection gives our clinic and our patients real peace of mind. Professional, discreet and thorough.', 'name' => 'Dr. Amara Osei', 'role' => 'Clinic Owner, Bayview Health'],
    ],
];
