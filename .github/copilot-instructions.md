# AI Coding Guidelines for Luksplace.com

## Architecture Overview
This is a minimal PHP personal website using HTMX for dynamic content without frameworks. The app follows a front controller pattern with conditional layout rendering based on HTMX requests.

### Core Request Flow
- All requests route through `app/index.php` (see `.htaccess` and nginx config in README)
- Routes are handled by a simple `switch` statement on `$_SERVER['REQUEST_URI']`
- HTMX detection via `$_SERVER['HTTP_HX_REQUEST']` determines response format
- `register_shutdown_function()` renders either partial HTML (HTMX) or full layout (regular requests)

### Directory Structure
- `app/views/` - Full page templates (home.php, art.php, dev.php, etc.)
- `app/views/partials/` - HTMX fragment endpoints (/facts, /jokes, /quotes)
- `app/views/_layout.php` - Main HTML wrapper with navigation and HTMX script
- `public/` - Static assets (images, compiled CSS)
- `app/logs/` - Error logging (gitignored)

## Key Patterns

### HTMX Integration
- HTMX 2.0.4 loaded globally in `_layout.php`
- Partial routes (`/facts`, `/jokes`, `/quotes`) return raw HTML fragments
- API calls in partials use direct `file_get_contents()` with API-Ninjas service
- No JavaScript framework - pure HTMX + minimal vanilla JS for scroll behavior

### Error Handling
- Global exception handler logs to `app/logs/error_log.txt`
- Production-friendly error messages hide implementation details
- SQLite connection helper with built-in error handling in `get_sqlite_connection()`

### Content Management
- Static pages are simple PHP includes with embedded HTML
- Dynamic images in `/art` page use `scandir()` with exclusion array
- Commented-out SQLite blog functionality in `home.php` (ready to enable)

## Development Workflow

### CSS Development
```bash
npm run dev  # Watches Tailwind source, outputs to public/css/style.css
```
- Source: `app/source.css` (Tailwind + custom styles)
- Output: `public/css/style.css` (compiled, versioned in layout)
- Custom styles for image galleries, navigation, and jump-to-top button

### Local Server
- Uses MAMP/nginx or Apache with rewrite rules
- Document root points to project root, not `public/`
- Static assets served directly from `public/` directory

### API Integration
- API-Ninjas endpoints for facts/jokes/quotes with shared API key pattern
- Direct HTTP requests using `stream_context_create()` and `file_get_contents()`
- HTML escaping with `htmlspecialchars()` for XSS protection

## Code Conventions

### PHP Style
- Short echo tags: `<?= $variable ?>`
- Global variables in `index.php`: `$content`, `$hxRequest`, `$viewDir`
- Output buffering pattern: `ob_start()` → process → `ob_get_clean()`

### HTML/CSS
- Simple.css framework for base styles + custom Tailwind extensions
- Semantic HTML5 structure (header/nav/main/footer)
- CSS Grid for image galleries with responsive column counts
- No build tools beyond Tailwind CLI

### File Organization
- Views are included directly (not classes/objects)
- Partials return pure HTML without layout wrapper
- Static content mixed with dynamic PHP in view files

## Adding New Features

### New Pages
1. Add route case in `app/index.php` switch statement
2. Create view file in `app/views/[name].php`
3. Add navigation link in `_layout.php` if needed

### New HTMX Endpoints
1. Add route case in "htmx" section of switch statement
2. Create partial in `app/views/partials/[name].php`
3. Return raw HTML (no layout wrapper)

### Database Features
- Uncomment SQLite code in `home.php` for blog functionality
- Use `get_sqlite_connection()` helper for consistent error handling
- Database file: `app/database.sqlite` (create as needed)