# Block & Grain — Heirloom Woodcraft Website

## Project Overview
A premium, editorial-style static website for a handcrafted butcher block & cutting board artisan brand. Built around the **Heirloom Contrast** design system — emphasizing asymmetry, tonal layering, and physical weight over generic web templates.

## Design System — Heirloom Contrast
| Token | Value | Usage |
|---|---|---|
| `primary` | `#2a0002` | Hero bg, footer, CTAs |
| `primary-container` | `#4a0e0e` | Accents, tag colors |
| `surface` | `#fcf9f2` | Page background |
| `surface-container-low` | `#f6f3ec` | Card bases, alt sections |
| `outline-variant` | `#dac1bf` | Ghost borders, quote accents |

### Typography
- **Headlines:** Newsreader (serif) — italics used for rhythm
- **Body:** Manrope (sans-serif) — clean, technical contrast
- **Labels:** Work Sans — "stamped/engraved" feel for specs & metadata

## ✅ Completed Features
- **Glassmorphism sticky nav** with scroll activation and mobile hamburger drawer
- **Grain-textured hero section** (full-bleed dark primary background) with asymmetric image + rotating hero photo effect
- **Animated stats bar** with JS counter animation on scroll
- **Craft philosophy section** — two-column asymmetric layout with accent block layering
- **Product collection grid** — 12-column asymmetric grid with featured, standard, and wide-runner card layouts
- **Process steps** — 4-step workshop walkthrough on dark `primary` background
- **Pull quote** editorial component with left border accent
- **Testimonials** — staggered 3-up asymmetric grid
- **Contact section** — phone-first design with large call CTA, SMS shortcut, and message form
- **Scroll reveal animations** — staggered fade-up on all major sections
- **Subtle hero parallax** (respects `prefers-reduced-motion`)
- **Contact inquiry form** backed by RESTful Table API (saves name, phone, project type, message)
- **Fully responsive** — mobile-first, tablet, desktop breakpoints

## 📱 Contact Philosophy
The contact section **prioritizes mobile phone contact** over email:
1. **Large "Call or Text" CTA** — prominent `tel:` link with phone number
2. **SMS shortcut button** — `sms:` link for text messaging
3. **Availability hours** displayed under call button
4. **Message form** collects phone (required) rather than email (optional/omitted)

> When the owner provides an email address, add it as a secondary option only.

## 🔗 Functional URIs

| Path | Description |
|---|---|
| `/` (`index.html`) | Main single-page site |
| `#hero` | Hero section with primary CTA |
| `#craft` | Philosophy & material story |
| `#collection` | Product grid (4 boards) |
| `#process` | 4-step workshop process |
| `#testimonials` | Customer stories |
| `#contact` | Phone CTA + contact form |

### API Endpoints
| Method | Endpoint | Purpose |
|---|---|---|
| `POST` | `tables/contact_inquiries` | Save contact form submissions |
| `GET` | `tables/contact_inquiries` | View all inquiries (admin) |

## 📦 Data Model

### `contact_inquiries`
| Field | Type | Description |
|---|---|---|
| `id` | text | UUID (auto) |
| `name` | text | Customer full name |
| `phone` | text | **Primary contact method** |
| `project` | text | Board type / project category |
| `message` | rich_text | Full message / project description |
| `created_at` | datetime | Submission timestamp (auto) |

## 🚧 Not Yet Implemented
- Real-time SMS/call notification to owner when form is submitted
- Photo gallery / lightbox for finished board portfolio
- Individual product detail pages
- Pricing display (currently inquiry-based)
- Blog / journal section ("From the Workshop")
- Owner profile photo and bio section
- Contact Form

## 🔜 Recommended Next Steps
1. **Update phone number** — Replace `(555) 123-4567` and `tel:+15551234567` with the owner's real number
2. **Add portfolio photos** — Replace stock imagery with actual photos of finished boards
3. **Add owner bio** — A short personal section builds trust for a one-person shop
4. **SEO meta tags** — Add Open Graph, Twitter Card, and local business schema
5. **Optional email** — Add as secondary contact once the owner provides one
6. **Analytics** — Add Plausible or similar privacy-first analytics

## 📁 File Structure
```
index.html              — Main single-page site
css/
  └── style.css         — Full Heirloom Contrast design system styles
js/
  └── main.js           — Nav, scroll reveal, parallax, form handler
README.md               — This file
```
