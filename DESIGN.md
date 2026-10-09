# Design

Visual system for the Lumeco landing page. Register: **brand**. Platform: **web**.
Strategy: **Drenched** — the surface *is* the color. Deep navy is the world; light
panels are islands within it; the teal spark is jewelry, used rarely and precisely.

## Theme

A premium, navy-drenched world. Think a considered hotel lobby at dusk, not a bright
office-supply catalog. The mood is confident and calm. Contrast comes from deep navy
against occasional bright white form/proof panels and the single teal accent — never
from a rainbow of colors. One physical-scene sentence: *a spotless glass-and-stone
lobby lit low and warm, where the only bright thing is a clean line of teal light.*

## Color

OKLCH throughout. Tokens live in `resources/css/app.css` (`@theme`).

- **Navy (the world)** — `navy-950 0.17/.042/255` (deepest, body + footer), `navy-900 0.21`,
  `navy-800 0.26`, `navy-700 0.32`, `navy-600 0.40`. Navy is the default surface for most
  folds. Gradients between 950↔900 give depth without banding.
- **Teal (the spark / jewelry)** — `teal-300 0.86`, `teal-400 0.80` (primary accent + CTA fill),
  `teal-500 0.74`, `teal-600 0.66`, `teal-700 0.54` (only accent that carries small text on white).
  Used sparingly: the CTA, the spark motif, one word in a headline, hairline accents, icons.
- **Light islands** — `paper 1/0/0` (pure white, for form + proof cards), `surface 0.984`,
  `line 0.912` hairlines. Light panels are focal points *within* the navy, not the base.
- **Ink (text on light)** — `ink 0.27` body (~15:1 on white), `ink-strong 0.20` headings,
  `muted 0.50` secondary (~6:1).
- **Text on navy** — white at 100/75/65/55% opacity (all ≥6:1 on navy-950/900). teal-300 for
  accent text on navy.
- **Text on teal fills** — always `navy-950` (dark on bright teal ≈ 10:1). Never gray on teal.

## Typography

- **Display** — Schibsted Grotesk (500–800). Confident, geometric, not on the reflex-reject list.
  Headings tracking `-0.02` to `-0.03em`, never tighter than `-0.04em`. Hero clamp max ≈ 4.5rem.
- **Body** — Hanken Grotesk (400–700). Humanist, pairs on a contrast axis with the display grotesk
  via weight/role, not two look-alike sans.
- **Scale** — fluid `clamp()`, ≥1.25 step ratio. Body 1rem–1.125rem, line-length capped 65–75ch.
  Light text on navy gets +0.05 line-height.
- **`text-wrap: balance`** on h1–h3, `pretty` on prose.

## Spacing & layout

- Fluid section rhythm: `.section-y` = `clamp(4.5rem, 9vw, 8.5rem)`. Vary it — generous around
  statement moments, tighter inside groups.
- Max content width `max-w-7xl` (80rem), gutter `clamp(1.25rem, 5vw, 2rem)`.
- Compositions are **asymmetric on purpose**: split hero (copy left / form right), offset images,
  bento service grid. Break the grid for emphasis; do not default everything to equal columns.
- Radii: cards 16–24px, inputs 12px, pills full. Never 32px+ on a card.

## Components

- **Buttons** — primary: teal-400 fill, navy-950 text, full-pill, lift `-translate-y-0.5` on hover,
  one soft teal shadow (no border+shadow ghost pairing). Secondary on navy: `white/25` hairline +
  `white/5` fill. Secondary on light: `line` border, no fill.
- **Form card** — pure white island on navy, generous radius, one deep soft shadow. Inputs on
  `surface`, focus → white bg + teal ring. Inline errors in red-600, error state on the border.
  States: default / focus / error / loading (spinner) / success (confirmation panel).
- **Service tiles** — bento: one featured large tile + standard tiles, not an identical 3×2 grid.
  Icon in a navy chip that flips to teal on hover; hairline border; lift on hover.
- **Feature list (why-us)** — editorial, on navy: large teal line-icon, title, description, separated
  by generous space and a hairline top rule — not bordered cards.
- **Icons** — one line-icon family (`resources/views/components/icon.blade.php`), 1.6 stroke, 24 grid.

## Motion

- Ease-out only (`--ease-out-quint`, `--ease-out-expo`). No bounce/elastic.
- Scroll reveals enhance already-visible content; a 2.5s failsafe guarantees nothing ships blank.
  Staggered children within a group; each reveal fits what it reveals.
- Count-up stats, hover lifts (150–250ms), teal glow accents via blur. Full
  `prefers-reduced-motion` fallbacks (instant, no transform).

## Imagery

- Real, verified photography only (Unsplash IDs checked to resolve). No colored-block placeholders,
  no sketchy SVG. Search the physical object: "pristine glass-and-stone lobby", "a cleaner
  detailing a window in gloves", not "cleaning service".
- Treat images premium: large, well-cropped, with a navy gradient scrim where text overlaps.
  Alt text is part of the voice.

## Signature elements

- **The teal spark** — the 4-point star from the logo, used rarely as a section mark / headline
  accent / divider. It is the brand's one flourish; overuse kills it.
- **Navy↔light rhythm** — most folds are navy; light islands (form, proof, services) punctuate.
  A mid-page statement moment ("we don't clean to a standard — we set one") anchored on full navy.

## Absolute bans (project-specific)

Blue→green gradient hero; corporate-blue palette; identical icon-heading-text card grids; eyebrow
kicker above every section; gradient text; side-stripe borders; 32px+ card radii; hero-metric SaaS
template; gray text on colored backgrounds; anything that reads "a template made this."
