# 📚 Cursusbeheer — Mini Course Management System

> A clean, modern Laravel application for managing courses. Add, edit, toggle active status and delete courses through a dashboard-style interface.

---

## 🧠 Concept

A small but complete course management app:

- 📋 One overview of all courses with live status badges
- ✏️ Edit titles, descriptions and active state in seconds
- 🟢 Toggle a course active or inactive with one click
- 📊 Dashboard view with totals (total / active / inactive)
- 🗑️ Safely delete with confirmation dialog

### Who is it for?

| Role | What they do |
|---|---|
| **Admin / coordinator** | Adds new courses, edits descriptions, activates/deactivates |
| **Trainer / teacher** | Browses the catalog to see what's currently offered |
| **Course catalog owner** | Keeps the list clean by archiving old courses |

---

## ⚙️ Installation

### Requirements

- PHP 8.2+
- Composer
- Node.js 18+ & npm
- MySQL 8+ (or MariaDB 10.6+)

### Step 1: Clone the repository

```bash
git clone https://github.com/guiume123/cursusbeheer.git
cd cursusbeheer
```

### Step 2: Install dependencies

```bash
composer install
npm install
```

### Step 3: Configure the environment

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and adjust:

```env
APP_NAME=Cursusbeheer
APP_TIMEZONE=UTC
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cursusbeheer
DB_USERNAME=root
DB_PASSWORD=
```

| Variable | Description |
|---|---|
| `APP_NAME` | Name displayed in the browser tab |
| `APP_TIMEZONE` | UTC for storage; UI displays local time via Carbon |
| `DB_DATABASE` | MySQL database name (must be created manually) |
| `DB_USERNAME` / `DB_PASSWORD` | MySQL credentials |

### Step 4: Create the database

```bash
mysql -u root -p -e "CREATE DATABASE cursusbeheer CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Step 5: Run migrations

```bash
php artisan migrate
```

This creates the `courses` table with the following columns:

| Column | Type | Description |
|---|---|---|
| `id` | bigint, autoincrement | Primary key |
| `title` | string | Course title |
| `description` | text | Course description |
| `active` | boolean | Whether the course is currently active |
| `created_at` | timestamp | Auto-managed by Laravel |
| `updated_at` | timestamp | Auto-managed by Laravel |

### Step 6: Build assets + start the dev server

```bash
composer run dev
```

This starts the PHP server, Vite (hot reload) and the queue worker concurrently. Visit `http://localhost:8000`.

---

## 🧪 Usage

### Main functionality

**Course overview (`/courses`)**
- Dashboard with KPI cards (Total / Active / Inactive)
- All courses listed alphabetically by title
- Status badge (Active / Inactive) on each course
- Per-course actions: Toggle status, Edit, Delete
- Auto-display of relative creation date ("3 days ago")

**Create new course (`/courses/create`)**
- Form with title, description, active checkbox
- Validation: title required + min 3 characters, description required
- Helper text under fields communicates validation rules upfront
- Inline error display with old input preservation

**Edit course (`/courses/{course}/edit`)**
- Pre-filled form with current values
- Same validation rules as create
- Cancel button returns to overview without saving

**Toggle status**
- One-click activation/deactivation
- Visual feedback via flash message after each action

**Delete course**
- Browser-native confirmation dialog before deletion
- Cascade-safe (no related records, since this is a single-model app)

### Example scenarios

**Scenario 1 — Adding a new course**

Admin clicks "+ Nieuwe cursus" in the navbar, fills in "Laravel Fundamentals" with a description, checks "Cursus actief", and clicks save. Returns to overview with a green flash message confirming success. The new course appears alphabetically in the list with an "Actief" badge.

**Scenario 2 — Archiving an outdated course**

Admin finds an outdated course "PHP 5 Basics" in the list. Clicks "Op inactief" → the course gets a grey "Inactief" badge but remains in the overview. The KPI card updates: Active count drops by 1, Inactive count rises by 1.

**Scenario 3 — Fixing a typo**

Admin notices a typo in a course description. Clicks "Bewerken" next to the course, edits the description, clicks "Wijzigingen opslaan". Flash message confirms the update.

---

## 🏗️ Conventions followed

**Clean separation of concerns (MVC).**
The `Course` model handles data, the `CourseController` handles requests, the Blade views handle presentation. Each piece has one responsibility.

**RESTful routing by convention.**
- `GET /courses` → index (list all)
- `GET /courses/create` → form to create
- `POST /courses` → store
- `GET /courses/{course}/edit` → form to edit
- `PUT /courses/{course}` → update
- `DELETE /courses/{course}` → destroy
- `PATCH /courses/{course}/toggle` → toggle active status (custom action)

**Laravel conventions throughout.**
- Singular PascalCase model name (`Course`), plural snake_case table (`courses`)
- `$fillable` for mass assignment protection
- `$casts` to convert `active` to a real PHP boolean
- Route model binding (`Course $course`) for automatic Eloquent lookups
- `@csrf` on every form (CSRF protection)
- `@method('PUT')` and `@method('DELETE')` for HTTP method spoofing
- Blade layout inheritance with `@extends`, `@yield`, `@section`, `@include`
- Post/Redirect/Get pattern after every mutation
- Flash messages via `->with('status', ...)` for user feedback
- Validation via `$request->validate([...])` with automatic error redirection

**Modern UI with Tailwind CSS v4.**
- Clean SaaS-style aesthetic (slate + indigo accent)
- Hover effects, focus rings, smooth transitions
- Mobile theme color and SVG favicon for that polished feel
- Responsive layout with `max-w-4xl mx-auto`

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 13 (PHP 8.2+) |
| Frontend | Blade templates + Tailwind CSS v4 |
| Database | MySQL 8 |
| Date handling | Carbon (UTC storage, local display via `diffForHumans()`) |
| Asset bundling | Vite |
| Templating | Blade with layout inheritance (`@yield` / `@section` / `@include`) |

---

## 📐 Data model

```
courses
─────────
id          (PK, bigint)
title       (string, required, min 3 chars)
description (text, required)
active      (boolean, default true)
created_at  (timestamp)
updated_at  (timestamp)
```

Single-model app by design — keeps the scope tight and the codebase easy to read.

---

## 👤 Author

Guillaume Huysmans · Laravel exam 2026
