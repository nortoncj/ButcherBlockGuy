# Design System Strategy: Heirloom Contrast

### Woodworker?

## 1. Overview & Creative North Star

**Creative North Star: The Master’s Atelier**

This design system moves away from the generic "template" look of modern web design and into the world of bespoke, editorial craftsmanship. We are designing for the "Butcher Block Group"—a persona that blends the rugged, physical labor of woodshop mastery with the sophisticated precision of high-end culinary art.

To achieve this, we reject the "Sun-Baked" safety of flat, centered layouts. Instead, we embrace **Heirloom Contrast**. This means heavy visual anchors, intentional asymmetry, and a sense of physical weight. Every page should feel like a page from a high-production coffee table or Luxury Kitchen catalog: tactile, expensive, and deeply intentional. We break the grid to create "moments" of tension and release, using overlapping elements to suggest the way wood grains layer and intersect.

## 2. Colors & Tonal Depth

The palette is rooted in the workshop. We use deep, "heavy" colors to anchor the user's eye, contrasted against warm, breathable creams that mimic the tone of raw maple or parchment.

- **Primary Anchors:** Use **Charred Walnut** (`primary`: #2a0002) and **Oxblood Maroon** (`primary_container`: #4a0e0e) for high-impact areas like hero headers, footers, and primary CTA sections. These provide the "rugged" soul of the brand.
- **The Foundation:** The background remains a warm, readable **Cream** (`surface`: #fcf9f2).

### The "No-Line" Rule

Explicitly prohibit the use of 1px solid borders to define sections. In this system, boundaries are created through **Background Shifts**. To separate content, transition from the `surface` background to a `surface-container-low` (#f6f3ec) or `surface-container-high` (#ebe8e1). This creates a sophisticated "block-carved" feel rather than a "wired" feel.

### Surface Hierarchy & Nesting

Treat the UI as a series of physical layers.

- **Depth through Stacking:** Instead of shadows, nest a `surface_container_lowest` (#ffffff) card inside a `surface_container_low` (#f6f3ec) section. The subtle shift in tone provides all the hierarchy needed.
- **Glass & Texture:** For floating navigation or overlays, utilize **Glassmorphism**. Apply a semi-transparent `surface_bright` with a heavy `backdrop-filter: blur(20px)`. This allows the rich wood tones of the background to bleed through, softening the interface.
- **Signature Gradients:** For primary CTAs, use a subtle radial gradient from `primary` (#2a0002) to `primary_container` (#4a0e0e). This mimics the way light hits a polished wood finish.

## 3. Typography

Our typography is the "Editorial Voice" of the craftsman. It balances the timeless authority of a serif with the modern utility of a clean sans-serif.

- **Headlines (Newsreader):** Use `display-lg` and `headline-lg` for high-impact statements. Do not fear **Italics**. Use italicized Newsreader for sub-headings or "pull quotes" within the text to create a dynamic, rhythmic visual flow.
- **Body (Manrope):** All functional text and long-form copy use Manrope. It provides a technical, clean contrast to the romantic serif headings.
- **Technical Labels (Work Sans):** Use Work Sans for `label-md` and `label-sm`. This font’s slightly wider stance feels "stamped" or "engraved," perfect for specs, dimensions, or wood-type details.

## 4. Elevation & Depth

We eschew "Material" standard shadows in favor of **Tonal Layering**.

- **The Layering Principle:** Depth is achieved by "stacking" surface tiers. A `surface_container_highest` element resting on a `surface` background creates a natural "inlaid" look.
- **Ambient Shadows:** If an element must float (e.g., a modal), use a shadow tinted with the `on_surface` color (#1c1c18) at 4-6% opacity with a blur radius of at least 40px. This mimics soft, natural studio lighting rather than a digital drop-shadow.
- **The Ghost Border:** If a container requires a border for accessibility, use the `outline_variant` (#dac1bf) at **15% opacity**. It should be felt, not seen.

## 5. Components

### Buttons

- **Primary:** Solid `primary` (#2a0002) background with `on_primary` (#ffffff) text. Use `md` (0.375rem) roundedness. No border.
- **Secondary:** `outline` (#877270) at 20% opacity with `primary` text.
- **Tertiary:** All-caps `label-md` (Work Sans) with a subtle underline that expands on hover.

### Cards & Lists

- **Card Architecture:** Forbid divider lines. Use `surface_container_low` as the card base. Separate the header from the body using vertical whitespace (24px–32px) or a 1-step tonal shift.
- **Asymmetrical Layouts:** Encourage "Image Overlap" cards where a product photo (e.g., a cutting board) breaks the top boundary of the container, creating a 3D effect.

### Input Fields

- **Styling:** Use a "Minimalist Tray" approach. No four-sided box. Use a 2px bottom-border of `outline_variant` that transitions to `primary` on focus.
- **Labels:** Use `label-md` (Work Sans) in all-caps, positioned above the input to maintain a technical, "blueprinted" look.

### Editorial Components (New)

- **The "Grain" Header:** A full-bleed section using `primary` background with an asymmetrical layout—heading (`display-lg`) flush-left, and a detailed "macro" wood texture image floating flush-right, partially overlapping the text.

## 6. Do's and Don'ts

### Do:

- **Embrace the White Space:** Use large gaps between sections to let the "Heirloom" quality breathe.
- **Mix Weights:** Use `display-md` in Bold and `title-sm` in Regular Italic together.
- **Use Tonal Transitions:** Transition from a dark `primary` section to a `surface_container_low` section to signal a change in topic.

### Don't:

- **Don't use 1px Borders:** Never use a solid line to separate two pieces of content.
- **Don't Center Everything:** Avoid the "Standard Web" look. If a heading is left-aligned, try right-aligning the body text below it for a sophisticated, asymmetrical tension.
- **Don't use Pure Black:** Always use `on_background` (#1c1c18) or `primary` (#2a0002) for dark text to maintain the warmth of the wood-inspired palette.
