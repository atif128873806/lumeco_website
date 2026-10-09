// Lumeco — front-end behavior. Progressive enhancement only:
// everything is visible/usable without JS; this layer adds motion.

document.documentElement.classList.add('js');

/* ---- Scroll reveal (respects reduced-motion) ---- */
function initReveal() {
    const targets = document.querySelectorAll('.reveal, .reveal-stagger');
    if (!targets.length) return;

    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce || !('IntersectionObserver' in window)) {
        targets.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const reveal = (el) => {
        el.querySelectorAll(':scope > *').forEach((child, i) => {
            child.style.transitionDelay = `${Math.min(i * 70, 560)}ms`;
        });
        el.classList.add('is-visible');
    };

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                reveal(entry.target);
                io.unobserve(entry.target);
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -8% 0px' }
    );

    targets.forEach((el) => io.observe(el));

    // Failsafe: guarantee everything is shown even if the observer never
    // fires (hidden tab, headless renderer, crawler). Content is never blank.
    window.setTimeout(() => targets.forEach(reveal), 2500);
}

/* ---- Count-up stats ---- */
function initCounters() {
    const nums = document.querySelectorAll('[data-count]');
    if (!nums.length) return;

    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const run = (el) => {
        const target = parseFloat(el.dataset.count);
        const suffix = el.dataset.suffix || '';
        const dp = (el.dataset.count.split('.')[1] || '').length;
        if (reduce) {
            el.textContent = target.toFixed(dp) + suffix;
            return;
        }
        const dur = 1600;
        const start = performance.now();
        const tick = (now) => {
            const t = Math.min((now - start) / dur, 1);
            const eased = 1 - Math.pow(1 - t, 4); // ease-out-quart
            el.textContent = (target * eased).toFixed(dp) + suffix;
            if (t < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };

    if (!('IntersectionObserver' in window)) {
        nums.forEach(run);
        return;
    }
    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((e) => {
                if (!e.isIntersecting) return;
                run(e.target);
                io.unobserve(e.target);
            });
        },
        { threshold: 0.6 }
    );
    nums.forEach((el) => io.observe(el));
}

/* ---- Sticky header state ---- */
function initHeader() {
    const header = document.querySelector('[data-header]');
    if (!header) return;
    const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 12);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

function boot() {
    initReveal();
    initCounters();
    initHeader();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}
