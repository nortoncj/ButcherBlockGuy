<?php
/**
 * Template Name: Services Page
 *
 * Block & Grain — Portfolio Gallery (Product-Focused)
 * Heirloom Contrast Design System
 *
 * Shows finished products organized by type (Countertops, Tables, etc.)
 * and wood species (Acacia, Hevea, Walnut, etc.)
 *
 * Gallery items are added via WordPress admin:
 *   Portfolio Gallery → Add New Photo
 *   - Set featured image
 *   - Enter product name/description
 *   - Select Product Type (Countertop, Table, Cutting Board, etc.)
 *   - Select Wood Type (Acacia, Hevea, Walnut, etc.)
 *   - Publish
 */

// Get all portfolio items
$all_items = function_exists( 'bg_get_portfolio_items' ) ? bg_get_portfolio_items( 'all', 'all' ) : array();

// Get unique product types for tabs
$product_types = array_unique( array_map( function( $item ) {
    return $item->bg_product_type;
}, $all_items ) );
usort( $product_types, function( $a, $b ) {
    $order = array( 'countertop', 'table', 'cutting-board', 'sink', 'shelving', 'custom' );
    return array_search( $a, $order ) - array_search( $b, $order );
} );
?>
<style>
  /* ============================================================
   BLOCK & GRAIN — Services Page Stylesheet
   Heirloom Contrast Design System
   Companion to page-services.php
   ============================================================ */

/* ── Shared tokens (mirrors main design system) ── */
:root {
  --primary: #2a0002;
  --primary-container: #4a0e0e;
  --on-primary: #ffffff;
  --surface: #fcf9f2;
  --surface-low: #f6f3ec;
  --surface-high: #ebe8e1;
  --on-bg: #1c1c18;
  --on-surface-var: #4e4a43;
  --outline: #877270;
  --outline-var: #dac1bf;
  --font-serif: "Newsreader", Georgia, serif;
  --font-sans: "Manrope", system-ui, sans-serif;
  --font-label: "Work Sans", system-ui, sans-serif;
  --ease-expo: cubic-bezier(0.16, 1, 0.3, 1);
  --ease-std: cubic-bezier(0.4, 0, 0.2, 1);
  --section-pad: clamp(5rem, 9vw, 9rem);
  --container: 1280px;
  --gutter: clamp(1.25rem, 4vw, 2.5rem);
}

/* ── Container ── */
.bg-container {
  max-width: var(--container);
  margin-left: auto;
  margin-right: auto;
  padding-left: var(--gutter);
  padding-right: var(--gutter);
}

/* ── Section eyebrow ── */
.bg-eyebrow,
.section-eyebrow {
  font-family: var(--font-label);
  font-size: 0.7rem;
  font-weight: 500;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  display: block;
  margin-bottom: 0.75rem;
}

/* ============================================================
   HERO
   ============================================================ */

.services-hero {
  background: var(--primary);
  padding: clamp(7rem, 14vw, 11rem) var(--gutter) clamp(4rem, 8vw, 7rem);
  position: relative;
  overflow: hidden;
}

.services-hero-grain {
  position: absolute;
  inset: 0;
  background-image:
    repeating-linear-gradient(
      92deg,
      transparent 0px,
      transparent 3px,
      rgba(255, 255, 255, 0.015) 3px,
      rgba(255, 255, 255, 0.015) 4px
    ),
    repeating-linear-gradient(
      180deg,
      transparent 0px,
      transparent 8px,
      rgba(0, 0, 0, 0.04) 8px,
      rgba(0, 0, 0, 0.04) 9px
    );
  pointer-events: none;
}

.services-hero-content {
  position: relative;
  z-index: 1;
}

.services-hero-grid {
  display: grid;
  grid-template-columns: 1.3fr 0.7fr;
  gap: clamp(3rem, 6vw, 6rem);
  align-items: center;
}

.bg-eyebrow {
  color: rgba(218, 193, 191, 0.65);
}

.services-hero h1 {
  color: var(--on-primary);
  margin-bottom: 1.5rem;
}
.services-hero h1 em {
  color: var(--outline-var);
}

.services-hero-desc {
  color: rgba(255, 255, 255, 0.65);
  max-width: 560px;
}

.services-hero-aside {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.services-hero-stat {
  background: rgba(252, 249, 242, 0.07);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(252, 249, 242, 0.1);
  border-radius: 0.75rem;
  padding: 1.75rem 2rem;
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
}

.services-hero-stat-num {
  font-family: var(--font-serif);
  font-size: clamp(2.5rem, 5vw, 3.5rem);
  font-weight: 700;
  color: var(--on-primary);
  line-height: 1;
}

.services-hero-stat-label {
  font-family: var(--font-label);
  font-size: 0.65rem;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: rgba(218, 193, 191, 0.6);
}

/* ============================================================
   PHILOSOPHY
   ============================================================ */

.bg-philosophy {
  background: var(--surface);
  padding: var(--section-pad) var(--gutter);
}

.bg-philosophy-inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(3rem, 6vw, 6rem);
  align-items: end;
  max-width: var(--container);
  margin: 0 auto;
}

.bg-philosophy-text .section-eyebrow {
  color: var(--primary-container);
}

.bg-philosophy-text .headline-lg {
  margin-top: 0.5rem;
  color: var(--on-bg);
}

.bg-philosophy-text .headline-lg em {
  color: var(--primary-container);
}

.bg-philosophy-body {
  padding-bottom: 0.5rem;
}

/* ============================================================
   SERVICE SECTIONS (Cutting / Sanding / Finish)
   ============================================================ */

.bg-service-section {
  background: var(--surface);
  padding: var(--section-pad) var(--gutter);
}

.bg-service-section--tonal {
  background: var(--surface-low);
}

.bg-service-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(3rem, 6vw, 6rem);
  align-items: start;
  max-width: var(--container);
  margin: 0 auto;
}

.bg-service-layout--flip .bg-service-text-col {
  order: -1;
}

/* ── Service 2×2 gallery grid ── */
.bg-service-gallery {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 0.65rem;
}

.bg-service-gallery--placeholder {
  background: var(--surface-high);
  border-radius: 0.75rem;
  min-height: 300px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.bg-service-gallery-item {
  position: relative;
  overflow: hidden;
  border-radius: 0.5rem;
  aspect-ratio: 4 / 3;
  display: block;
  background: var(--surface-high);
}

.bg-service-gallery-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.5s var(--ease-expo);
}

.bg-service-gallery-item:hover .bg-service-gallery-img {
  transform: scale(1.06);
}

.bg-service-gallery-overlay {
  position: absolute;
  inset: 0;
  background: rgba(42, 0, 2, 0.45);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s var(--ease-std);
  color: #fff;
  font-size: 1.4rem;
}

.bg-service-gallery-item:hover .bg-service-gallery-overlay,
.bg-service-gallery-item:focus-visible .bg-service-gallery-overlay {
  opacity: 1;
}

/* ── Service text column ── */
.bg-service-text-col {
  padding: 1rem 0;
}

.service-number {
  color: var(--primary-container);
  display: block;
  margin-bottom: 0.75rem;
}

.bg-service-text-col .headline-md {
  color: var(--on-bg);
  margin-bottom: 1.5rem;
}

.bg-service-text-col .headline-md em {
  color: var(--primary-container);
}

.bg-service-text-col .body-text {
  margin-bottom: 1.75rem;
}

/* ── Specs block ── */
.bg-specs-block {
  background: var(--surface-low);
  border-radius: 0.625rem;
  padding: 1.5rem 1.75rem;
  margin-top: auto;
}

.bg-service-section--tonal .bg-specs-block {
  background: var(--surface-high);
}

.bg-specs-title {
  color: var(--outline);
  display: block;
  margin-bottom: 1rem;
}

.bg-specs-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.bg-specs-list li {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  font-family: var(--font-sans);
  font-size: 0.9rem;
  line-height: 1.6;
  color: var(--on-surface-var);
}

.bg-specs-list li i {
  color: var(--primary-container);
  font-size: 0.75rem;
  margin-top: 0.25rem;
  flex-shrink: 0;
}

/* ═══════════════════════════════════════════════════════════════════
   PORTFOLIO SHOWCASE SECTION
   ═══════════════════════════════════════════════════════════════════ */

.bg-portfolio-showcase {
  background: #fcf9f2;
  padding: 120px 32px;
}

.bg-portfolio-header {
  max-width: 900px;
  margin: 0 auto 80px;
  text-align: center;
}

.bg-portfolio-header h2 {
  color: #2a0002;
  margin-bottom: 24px;
}

.bg-portfolio-header h2 em {
  font-style: italic;
  font-weight: 300;
}

.bg-portfolio-header p {
  color: #1c1c18;
  font-size: 1.0625rem;
  line-height: 1.7;
}

/* ═══════════════════════════════════════════════════════════════════
   PRODUCT FILTER TABS
   ═══════════════════════════════════════════════════════════════════ */

.bg-portfolio-tabs {
  display: flex;
  gap: 12px;
  justify-content: center;
  flex-wrap: wrap;
  margin-bottom: 60px;
}

.bg-portfolio-tab {
  background: transparent;
  border: 0.5px solid #877270;
  color: #2a0002;
  padding: 10px 20px;
  border-radius: 24px;
  cursor: pointer;
  font-family: "Work Sans", sans-serif;
  font-size: 0.9375rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  transition: all 0.3s ease;
}

.bg-portfolio-tab:hover {
  background: #f6f3ec;
  border-color: #2a0002;
}

.bg-portfolio-tab.active {
  background: #2a0002;
  color: #ffffff;
  border-color: #2a0002;
}

/* ═══════════════════════════════════════════════════════════════════
   PORTFOLIO MASONRY GRID
   ═══════════════════════════════════════════════════════════════════ */

.bg-portfolio-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
  grid-auto-rows: 280px;
}

.bg-portfolio-item {
  position: relative;
  overflow: hidden;
  border-radius: 8px;
  cursor: pointer;
  display: block;
  background: #ebe8e1;
  transition: all 0.3s ease;
}

.bg-portfolio-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.3s ease;
}

.bg-portfolio-item:hover img {
  transform: scale(1.08);
}

/* Size variants */
.bg-portfolio-item--tall {
  grid-row: span 2;
}

.bg-portfolio-item--wide {
  grid-column: span 2;
}

/* Overlay with wood badge + icon + title */
.bg-portfolio-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    135deg,
    rgba(42, 0, 2, 0.6) 0%,
    rgba(42, 0, 2, 0.3) 100%
  );
  opacity: 0;
  transition: opacity 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px;
  z-index: 2;
}

.bg-portfolio-item:hover .bg-portfolio-overlay {
  opacity: 1;
}

.bg-portfolio-overlay-content {
  text-align: center;
  width: 100%;
}

/* Wood type badge */
.bg-portfolio-wood-badge {
  display: inline-block;
  background: rgba(252, 249, 242, 0.95);
  color: #2a0002;
  padding: 6px 14px;
  border-radius: 4px;
  font-family: "Work Sans", sans-serif;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 16px;
  opacity: 0;
  transform: scale(0.9);
  transition: all 0.3s ease;
}

.bg-portfolio-item:hover .bg-portfolio-wood-badge {
  opacity: 1;
  transform: scale(1);
}

/* Expand icon */
.bg-portfolio-overlay i {
  color: #fcf9f2;
  font-size: 2.5rem;
  margin-bottom: 12px;
  opacity: 0;
  transform: translateY(-12px);
  transition: all 0.3s ease;
}

.bg-portfolio-item:hover .bg-portfolio-overlay i {
  opacity: 1;
  transform: translateY(0);
}

/* Product title */
.bg-portfolio-title {
  color: #fcf9f2;
  font-family: "Newsreader", serif;
  font-size: 1rem;
  font-weight: 500;
  margin: 0;
  opacity: 0;
  transform: translateY(12px);
  transition: all 0.3s ease;
}

.bg-portfolio-item:hover .bg-portfolio-title {
  opacity: 1;
  transform: translateY(0);
}

/* Responsive portfolio grid */
@media (max-width: 1024px) {
  .bg-portfolio-grid {
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 16px;
    grid-auto-rows: 220px;
  }

  .bg-portfolio-item--tall {
    grid-row: span 1;
  }

  .bg-portfolio-item--wide {
    grid-column: span 1;
  }
}

@media (max-width: 768px) {
  .bg-portfolio-showcase {
    padding: 80px 24px;
  }

  .bg-portfolio-header {
    margin-bottom: 60px;
  }

  .bg-portfolio-tabs {
    margin-bottom: 40px;
    gap: 8px;
  }

  .bg-portfolio-tab {
    padding: 8px 16px;
    font-size: 0.8125rem;
  }

  .bg-portfolio-grid {
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 12px;
    grid-auto-rows: 150px;
  }

  .bg-portfolio-wood-badge {
    font-size: 0.65rem;
    padding: 4px 10px;
    margin-bottom: 8px;
  }

  .bg-portfolio-overlay i {
    font-size: 1.5rem;
    margin-bottom: 8px;
  }

  .bg-portfolio-title {
    font-size: 0.875rem;
  }
}

/* ═══════════════════════════════════════════════════════════════════
   PROCESS SECTION — The Three Stages
   ═══════════════════════════════════════════════════════════════════ */

.bg-process-section {
  background: #f6f3ec;
  padding: 120px 32px;
}

.bg-process-header {
  max-width: 900px;
  margin: 0 auto 80px;
  text-align: center;
}

.bg-process-header h2 {
  color: #2a0002;
  margin-bottom: 24px;
}

.bg-process-header h2 em {
  font-style: italic;
  font-weight: 300;
}

.bg-process-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 40px;
  max-width: 1200px;
  margin: 0 auto;
}

.bg-process-card {
  background: #ffffff;
  padding: 40px 32px;
  border-radius: 8px;
  position: relative;
}

.bg-process-num {
  font-family: "Newsreader", serif;
  font-size: 3.5rem;
  font-weight: 700;
  color: #2a0002;
  opacity: 0.15;
  position: absolute;
  top: -20px;
  right: 20px;
  line-height: 1;
}

.bg-process-card h3 {
  font-family: "Newsreader", serif;
  font-size: 1.75rem;
  font-weight: 600;
  color: #2a0002;
  margin: 0 0 16px 0;
  position: relative;
  z-index: 1;
}

.bg-process-card p {
  color: #1c1c18;
  line-height: 1.7;
  margin: 0;
}

@media (max-width: 768px) {
  .bg-process-section {
    padding: 80px 24px;
  }

  .bg-process-header {
    margin-bottom: 60px;
  }

  .bg-process-grid {
    gap: 24px;
  }

  .bg-process-card {
    padding: 32px 24px;
  }

  .bg-process-num {
    font-size: 2.5rem;
    top: -10px;
  }

  .bg-process-card h3 {
    font-size: 1.5rem;
  }
}

/* ═══════════════════════════════════════════════════════════════════
   GLIGHTBOX OVERRIDES
   ═══════════════════════════════════════════════════════════════════ */

.glightbox-container {
  background: rgba(42, 0, 2, 0.98) !important;
}

.glightbox-container .gslide-title {
  color: #fcf9f2;
  font-family: "Newsreader", serif;
  font-size: 1.25rem;
  font-weight: 500;
}

.glightbox-container .gclose {
  color: #fcf9f2;
  font-size: 2rem;
  opacity: 0.8;
  transition: opacity 0.3s ease;
}

.glightbox-container .gclose:hover {
  opacity: 1;
}

.glightbox-container .gbtn {
  color: #fcf9f2;
}
/* ============================================================
   WOOD SPECIES
   ============================================================ */

.bg-wood-section {
  background: var(--primary-container);
  padding: var(--section-pad) var(--gutter);
}

.bg-wood-header {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: end;
  margin-bottom: clamp(3rem, 6vw, 5rem);
}

.bg-wood-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
}

.bg-wood-card {
  background: rgba(252, 249, 242, 0.06);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(252, 249, 242, 0.1);
  border-radius: 0.75rem;
  padding: 2rem;
  transition:
    background 0.3s,
    transform 0.3s var(--ease-expo);
}

.bg-wood-card:hover {
  background: rgba(252, 249, 242, 0.11);
  transform: translateY(-4px);
}

.bg-wood-name {
  font-family: var(--font-serif);
  font-size: 1.4rem;
  font-weight: 600;
  color: var(--on-primary);
  margin-bottom: 0.3rem;
}

.bg-wood-latin {
  font-family: var(--font-label);
  font-size: 0.72rem;
  font-style: italic;
  color: rgba(218, 193, 191, 0.55);
  display: block;
  margin-bottom: 1rem;
}

.bg-wood-traits {
  display: flex;
  flex-wrap: wrap;
  gap: 0.4rem;
  margin-bottom: 1rem;
}

.bg-wood-trait {
  font-family: var(--font-label);
  font-size: 0.6rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  padding: 0.35rem 0.75rem;
  background: rgba(252, 249, 242, 0.1);
  border-radius: 2rem;
  color: rgba(252, 249, 242, 0.85);
}

.bg-wood-desc {
  color: rgba(252, 249, 242, 0.65);
  font-size: 0.88rem;
  line-height: 1.65;
}

/* ============================================================
   SPECIALIZATIONS
   ============================================================ */

.bg-spec-section {
  background: var(--surface-low);
  padding: var(--section-pad) var(--gutter);
}

.bg-spec-header {
  max-width: var(--container);
  margin: 0 auto clamp(3rem, 5vw, 4.5rem);
}

.bg-spec-header .section-eyebrow {
  color: var(--primary-container);
}
.bg-spec-header .headline-lg {
  color: var(--on-bg);
  margin: 0.5rem 0 1rem;
}
.bg-spec-header .headline-lg em {
  color: var(--primary-container);
}

.bg-spec-sub {
  max-width: 600px;
}

.bg-spec-grid {
  max-width: var(--container);
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
}

.bg-spec-card {
  background: var(--surface);
  border-radius: 0.75rem;
  padding: clamp(1.5rem, 3vw, 2.5rem);
  transition:
    transform 0.3s var(--ease-expo),
    box-shadow 0.3s;
}

.bg-spec-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 60px rgba(42, 0, 2, 0.08);
}

.bg-spec-icon {
  width: 52px;
  height: 52px;
  background: var(--surface-high);
  border-radius: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.25rem;
}

.bg-spec-icon i {
  font-size: 1.3rem;
  color: var(--primary);
}

.bg-spec-title {
  font-family: var(--font-serif);
  font-size: 1.2rem;
  font-weight: 600;
  color: var(--primary);
  margin-bottom: 0.75rem;
}

.bg-spec-desc {
  font-size: 0.9rem;
  line-height: 1.7;
  margin-bottom: 1.25rem;
}

.bg-spec-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.4rem;
}

.bg-spec-tag {
  font-family: var(--font-label);
  font-size: 0.6rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  padding: 0.35rem 0.75rem;
  background: var(--surface-low);
  border-radius: 2rem;
  color: var(--outline);
}

/* ============================================================
   CTA
   ============================================================ */

.bg-services-cta {
  background: var(--primary);
  padding: var(--section-pad) var(--gutter);
}

.bg-cta-inner {
  max-width: var(--container);
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr auto;
  gap: clamp(2rem, 5vw, 5rem);
  align-items: center;
}

.bg-cta-text .headline-lg em {
  color: var(--outline-var);
}

.bg-cta-actions {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  flex-shrink: 0;
}

.bg-cta-btn {
  font-size: 1rem;
  padding: 1rem 2rem;
  white-space: nowrap;
}

.bg-cta-btn-sec {
  display: inline-flex;
  align-items: center;
  gap: 0.6rem;
  padding: 0.85rem 1.75rem;
  background: transparent;
  color: rgba(252, 249, 242, 0.85);
  font-family: var(--font-sans);
  font-size: 0.9rem;
  font-weight: 600;
  border-radius: 0.375rem;
  border: 1.5px solid rgba(252, 249, 242, 0.25);
  cursor: pointer;
  text-align: center;
  justify-content: center;
  transition:
    background 0.2s,
    border-color 0.2s;
  text-decoration: none;
}

.bg-cta-btn-sec:hover {
  background: rgba(252, 249, 242, 0.1);
  border-color: rgba(252, 249, 242, 0.45);
}

/* ============================================================
   RESPONSIVE — TABLET (≤ 1024px)
   ============================================================ */

@media (max-width: 1024px) {
  .services-hero-grid {
    grid-template-columns: 1fr;
    gap: 2.5rem;
  }
  .services-hero-aside {
    flex-direction: row;
  }
  .services-hero-stat {
    flex: 1;
  }

  .bg-philosophy-inner {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .bg-service-layout {
    grid-template-columns: 1fr;
    gap: 2.5rem;
  }
  .bg-service-layout--flip .bg-service-text-col {
    order: 0;
  }

  .bg-portfolio-header {
    grid-template-columns: 1fr;
    gap: 1rem;
  }

  .bg-portfolio-grid {
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: 200px;
  }

  .bg-wood-header {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  .bg-wood-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .bg-spec-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .bg-cta-inner {
    grid-template-columns: 1fr;
    gap: 2.5rem;
  }
  .bg-cta-actions {
    flex-direction: row;
    flex-wrap: wrap;
  }
}

/* ============================================================
   RESPONSIVE — MOBILE (≤ 768px)
   ============================================================ */

@media (max-width: 768px) {
  .services-hero-aside {
    flex-direction: column;
  }

  .bg-service-gallery {
    grid-template-columns: 1fr;
  }
  .bg-service-gallery-item {
    aspect-ratio: 16/9;
  }

  .bg-portfolio-grid {
    grid-template-columns: repeat(2, 1fr);
    grid-auto-rows: 170px;
  }
  .bg-gallery-item--wide {
    grid-column: span 2;
  }

  .bg-wood-grid {
    grid-template-columns: 1fr;
  }
  .bg-spec-grid {
    grid-template-columns: 1fr;
  }

  .bg-cta-actions {
    flex-direction: column;
  }
  .bg-cta-btn-sec {
    text-align: center;
  }
}

@media (max-width: 480px) {
  .bg-portfolio-grid {
    grid-template-columns: repeat(2, 1fr);
    grid-auto-rows: 130px;
    gap: 0.5rem;
  }
  .bg-gallery-tabs {
    gap: 0.4rem;
  }
  .bg-gallery-tab {
    padding: 0.5rem 1rem;
  }
}

  </style>

<main id="services-main">

  <!-- ============================================================
       HERO
  ============================================================ -->
  <section class="services-hero">
    <div class="services-hero-grain" aria-hidden="true"></div>
    <div class="services-hero-content">
      <div class="services-hero-grid">

        <div class="services-hero-text">
          <p class="bg-eyebrow label-md">The Portfolio</p>
          <h1 class="display-lg">
            Finished Works<br>
            <em>In Acacia & Beyond.</em>
          </h1>
          <p class="body-text services-hero-desc">
            From kitchen islands to custom desks, these are pieces built to last. Mostly acacia and hevea — materials we know inside and out. Browse the gallery below to see what's possible.
          </p>
        </div>

        <div class="services-hero-aside">
          <div class="services-hero-stat">
            <span class="services-hero-stat-num"><?php echo count( $all_items ); ?>+</span>
            <span class="services-hero-stat-label label-sm">Portfolio Pieces</span>
          </div>
          <div class="services-hero-stat">
            <span class="services-hero-stat-num">6</span>
            <span class="services-hero-stat-label label-sm">Wood Species</span>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ============================================================
       PHILOSOPHY
  ============================================================ -->
  <section class="bg-philosophy">
    <div class="bg-container">
      <div class="bg-philosophy-inner">
        <div class="bg-philosophy-text">
          <p class="section-eyebrow label-md">What You're Looking At</p>
          <h2 class="headline-lg">
            Each Piece Is<br><em>a Conversation.</em>
          </h2>
        </div>
        <p class="body-text bg-philosophy-body">
          The pieces below aren't catalog items. They're custom commissions built to fit your space, your wood preference, and your vision. Some are acacia — our bread-and-butter, warm and durable. Others are hevea, walnut, or mixed species. Every one went through our three-stage process: precision cuts, hand-sanding through six grits, and finish that protects without hiding the grain.
        </p>
      </div>
    </div>
  </section>


  <!-- ============================================================
       PORTFOLIO GALLERY — Tabbed by Product Type
  ============================================================ -->
  <section class="bg-portfolio-showcase">
    <div class="bg-container">

      <div class="bg-portfolio-header">
        <h2 class="headline-lg">
          What We<br><em>Actually Build.</em>
        </h2>
        <p class="body-text">
          Browse finished pieces by category. Click any image to see it in detail.
        </p>
      </div>

      <!-- Product Filter Tabs -->
      <div class="bg-portfolio-tabs">
        <button class="bg-portfolio-tab active" data-filter="all">All Work</button>
        <?php foreach ( $product_types as $type ) : ?>
          <button class="bg-portfolio-tab" data-filter="<?php echo esc_attr( $type ); ?>">
            <?php echo esc_html( bg_get_product_label( $type ) ); ?>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- Masonry Grid -->
      <div class="bg-portfolio-grid">
        <?php
        if ( ! empty( $all_items ) ) {
            foreach ( $all_items as $item ) {
                if ( empty( $item->bg_img_url ) ) continue;

                $size_class = '';
                switch ( $item->bg_size ) {
                    case 'tall':
                        $size_class = 'bg-portfolio-item--tall';
                        break;
                    case 'wide':
                        $size_class = 'bg-portfolio-item--wide';
                        break;
                }
                ?>
                <a
                  href="<?php echo esc_url( $item->bg_img_url ); ?>"
                  class="bg-portfolio-item <?php echo $size_class; ?> bg-glightbox"
                  data-product="<?php echo esc_attr( $item->bg_product_type ); ?>"
                  data-gallery="portfolio"
                  data-title="<?php echo esc_attr( get_the_title( $item->ID ) ); ?>"
                >
                  <img
                    src="<?php echo esc_url( $item->bg_img_url ); ?>"
                    alt="<?php echo esc_attr( $item->bg_img_alt ); ?>"
                    loading="lazy"
                  />
                  <div class="bg-portfolio-overlay">
                    <div class="bg-portfolio-overlay-content">
                      <span class="bg-portfolio-wood-badge">
                        <?php echo esc_html( $item->bg_wood_label ); ?>
                      </span>
                      <i class="fas fa-expand"></i>
                      <p class="bg-portfolio-title"><?php echo esc_html( get_the_title( $item->ID ) ); ?></p>
                    </div>
                  </div>
                </a>
                <?php
            }
        } else {
            echo '<div style="grid-column: 1 / -1; padding: 3rem 2rem; text-align: center; color: #877270;">';
            echo '<p class="body-text">Portfolio gallery coming soon. Add photos via <strong>Portfolio Gallery</strong> in the WordPress admin.</p>';
            echo '</div>';
        }
        ?>
      </div>

    </div>
  </section>


  <!-- ============================================================
       WOOD SPECIES REFERENCE
  ============================================================ -->
  <section class="bg-wood-section">
    <div class="bg-container">

      <div class="bg-wood-header">
        <div>
          <p class="section-eyebrow label-md" style="color:rgba(218,193,191,.6);">Materials</p>
          <h2 class="headline-lg" style="color:#fcf9f2;">
            The Wood<br><em>We Work With.</em>
          </h2>
        </div>
        <p class="body-text" style="color:rgba(252,249,242,.7);">
          Material choice matters as much as craft. Here's what we typically source and why.
        </p>
      </div>

      <div class="bg-wood-grid">

        <?php
        $woods = array(
            array(
                'name'   => 'Acacia',
                'latin'  => 'Acacia melanoxylon',
                'traits' => array( 'Dense', 'Durable', 'Rich Tone' ),
                'desc'   => 'Our workhorse. Deep warm tones, exceptional hardness, tight grain that resists warping. Perfect for countertops and cutting blocks that see daily abuse.'
            ),
            array(
                'name'   => 'Hevea (Rubberwood)',
                'latin'  => 'Hevea brasiliensis',
                'traits' => array( 'Sustainable', 'Light Blonde', 'Workable' ),
                'desc'   => 'Plantation-grown from retired rubber trees. Clean blonde grain, machines beautifully, takes finish exceptionally well. Great for contemporary aesthetics.'
            ),
            array(
                'name'   => 'Hard Maple',
                'latin'  => 'Acer saccharum',
                'traits' => array( 'Classic', 'Rock-Hard', 'Light Color' ),
                'desc'   => 'Cream-colored, nearly indestructible. The commercial kitchen standard for end-grain butcher blocks. Takes abuse without complaint.'
            ),
            array(
                'name'   => 'Walnut',
                'latin'  => 'Juglans nigra',
                'traits' => array( 'Premium', 'Dark Grain', 'Refined' ),
                'desc'   => 'The luxury option. Deep chocolate tones, dramatic grain variation. Machines and finishes like glass. Reserved for high-end custom work.'
            ),
            array(
                'name'   => 'Shortleaf Acacia',
                'latin'  => 'Acacia holosericea',
                'traits' => array( 'Fine Grain', 'Smooth', 'Stable' ),
                'desc'   => 'Lighter acacia variant with tighter grain and excellent dimensional stability. Perfect for edge-grain boards where you want consistency.'
            ),
            array(
                'name'   => 'Chevron Mix',
                'latin'  => 'Multi-species parquetry',
                'traits' => array( 'Geometric', 'Contrasting', 'Custom' ),
                'desc'   => 'Not a single species — a pattern. Combines contrasting woods in angled herringbone layouts. High labor, high visual impact.'
            ),
        );
        foreach ( $woods as $wood ) :
        ?>
        <div class="bg-wood-card">
          <h3 class="bg-wood-name"><?php echo esc_html( $wood['name'] ); ?></h3>
          <span class="bg-wood-latin"><?php echo esc_html( $wood['latin'] ); ?></span>
          <div class="bg-wood-traits">
            <?php foreach ( $wood['traits'] as $trait ) : ?>
            <span class="bg-wood-trait label-sm"><?php echo esc_html( $trait ); ?></span>
            <?php endforeach; ?>
          </div>
          <p class="bg-wood-desc body-text"><?php echo esc_html( $wood['desc'] ); ?></p>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
  </section>


  <!-- ============================================================
       HOW IT WORKS (The Process)
  ============================================================ -->
  <section class="bg-process-section">
    <div class="bg-container">
      
      <div class="bg-process-header">
        <p class="section-eyebrow label-md">From Concept to Home</p>
        <h2 class="headline-lg">
          The Three Stages<br><em>of Craft.</em>
        </h2>
      </div>

      <div class="bg-process-grid">

        <div class="bg-process-card">
          <div class="bg-process-num">01</div>
          <h3>Cutting</h3>
          <p class="body-text">Every joint starts with a clean, square cut. Stock is dimensioned using table saws, planers, and jointers — removing warp and twist before glue ever touches the grain. The cut pattern dictates how that board will perform for decades.</p>
        </div>

        <div class="bg-process-card">
          <div class="bg-process-num">02</div>
          <h3>Sanding</h3>
          <p class="body-text">Machine sanders are for production lines. We hand-sand through six progressive grits — 80, 120, 150, 180, 220, 320 — following the grain on every pass. The goal isn't just smoothness, it's revealing the wood's natural depth without destroying its character.</p>
        </div>

        <div class="bg-process-card">
          <div class="bg-process-num">03</div>
          <h3>Finish</h3>
          <p class="body-text">Finish is the final conversation with the grain. Clearcoat for high-traffic countertops that need hard protection. Oil for cutting boards and serving pieces where you want the wood to breathe and age. Either way, we apply it in thin, controlled coats.</p>
        </div>

      </div>

    </div>
  </section>


  <!-- ============================================================
       CTA
  ============================================================ -->
  <section class="bg-services-cta">
    <div class="bg-container">
      <div class="bg-cta-inner">
        <div class="bg-cta-text">
          <h2 class="headline-lg" style="color:#fcf9f2;">
            Ready to Commission<br><em>Your Piece?</em>
          </h2>
          <p class="body-text" style="color:rgba(252,249,242,.75);">
            Call directly. We'll talk dimensions, wood species, finish options, and timeline. Every project starts with a real conversation — not a quote form.
          </p>
        </div>
        <div class="bg-cta-actions">
          <a href="tel:+13215433132" class="btn-primary bg-cta-btn">
            <i class="fas fa-phone" aria-hidden="true"></i>
            Call — (321) 543-3132
          </a>
          <a href="<?php echo esc_url( home_url( 'sms:+13215433132' ) ); ?>" class="btn-primary bg-cta-btn-sec">
            <i class="fas fa-comment-dots" aria-hidden="true"></i>
            Send a Message
          </a>
        </div>
      </div>
    </div>
  </section>

</main>