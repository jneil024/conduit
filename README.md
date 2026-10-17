# The Conduit - Publication and Multimedia Organization

A production-grade, editorial-focused web application built on **Laravel 11**, designed for modern publications combining investigative health journalism, multimedia documentary reporting, and public discourse.

---

## 🎨 Brand Identity

- **Title**: The Conduit - Publication and Multimedia Organization
- **Tagline**: *"Publication and Multimedia Organization"*
- **Emblem Concept**: Circular emblem featuring the flame of truth, camera shutter of documentary media, rod of Asclepius honoring clinical healing, heartbeat vital line, and quill pen of historical testimony.
- **Palette**:
  - `deep`: `#0B3D2E` (Primary dark background)
  - `emerald`: `#1B6B4A` (Card accents, navigation hover)
  - `gold`: `#F5A623` (Buttons, call-to-actions, highlights)
  - `light-gold`: `#FFC857` (Hover states, badges)
  - `cream`: `#FDFBF7` (Canvas background, card fills)
  - `dark`: `#1A1A1A` (Body text)
- **Typography**: `Poppins` (Headings) and `Inter` (Body) loaded via Google Fonts CDN.

---

## 🚀 Key Features

1. **Public Front Page (`/`)**:
   - Hero banner with brand gradient, logo, and call-to-action.
   - Core tenets showcasing scientific accuracy, visual storytelling, and ethical autonomy.
   - Latest 6 published dispatches grid.
   - Dedicated "About Our Identity" and "Editorial Desk" contact sections.

2. **Publications Catalog (`/articles`)**:
   - Real-time search by keyword (searches title, excerpt, and content body).
   - Category filter dropdown.
   - Responsive grid (3 columns desktop, 2 tablet, 1 mobile).
   - Paginated at 9 articles per page. Only `status = 'published'` articles are visible.

3. **Article Detail (`/articles/{slug}`)**:
   - SEO-friendly URL slugs.
   - TinyMCE HTML formatted content rendering.
   - Author profile card.
   - Up to 3 related publications in the same category.

4. **Secured Administrative CRUD (`/admin`)**:
   - Accessible strictly to users where `is_admin = true`. Non-admins receive an HTTP 403.
   - Overview Dashboard with article metrics (Total, Published, Drafts, Categories) and recent dispatches.
   - Full article management (Index, Create, Edit, Soft-delete).
   - Dynamic live slug generation from article title.
   - TinyMCE 6 rich text editor via CDN.
   - Image upload pipeline with automated file removal upon replacement.

---

## ⚙️ Quickstart Installation

### 1. Prerequisites
- PHP 8.2 or higher
- Composer 2.x
- SQLite (default) or MySQL

### 2. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

### 3. Launch the Server
```bash
php artisan serve
```
Open [http://localhost:8000](http://localhost:8000) in your web browser.

---

## 🔐 Default Credentials

| Role | Email | Password | Access Level |
|---|---|---|---|
| **Administrator** | `admin@conduit.test` | `password` | Full CRUD & Admin Dashboard (`/admin`) |
| **Staff Contributor** | `editor@conduit.test` | `password` | Public Reader / Non-Admin |
