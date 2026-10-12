# Lifecare Agent Guide

## Project shape

- This is a Laravel application. Route definitions live in `routes/web.php`; controllers are under `app/Http/Controllers`; Blade views are under `resources/views`.
- The active authentication pages are `resources/views/login.blade.php` and `resources/views/register.blade.php`. The root-level `login.html` and `registration.html` are static demos, not the production auth flow.
- Preserve existing route names, form field names, CSRF protection, validation output, and controller behavior when changing auth views. Check `tests/Feature/AuthPagesTest.php` after auth-page changes.
- Authentication logic is owned by `app/Http/Controllers/AuthController.php`. Do not modify the duplicate controller under `app/Http/Controllers/admin/` unless the requested behavior proves it is used.

## Auth form design

- For login and registration UI, use a professional hospital/clinical visual language: restrained navy, teal, white, and neutral surfaces; clear hierarchy; readable typography; accessible contrast; and generous but compact spacing.
- Keep all form controls visibly labeled with real `<label>` elements, provide strong keyboard focus styles, and retain inline validation messages. Do not rely on placeholders as labels.
- Keep the form immediately usable. Do not add reveal gates, touch/click medical-tool interactions, decorative overlays, or other friction before users can reach the fields.
- The auth forms must be static and non-animated: do not add `@keyframes`, `animation`, `transition`, animated pseudo-elements, pulsing/floating effects, hover transforms, or button-shine effects. Hover and focus states may change color, border, or shadow instantly.
- Avoid excessive pill-shaped controls, decorative medical imagery, low-contrast translucent panels, and gradients that reduce readability. Keep responsive behavior stable on mobile and desktop.
- Preserve existing external asset conventions unless there is a concrete reason to change them. Prefer the project’s existing CSS location and avoid introducing a new styling framework for a small auth-page change.

## Verification

- Install/setup: `composer setup`
- Laravel tests: `composer test` or `php artisan test`
- Frontend asset build: `npm run build`
- During UI work, inspect both Blade pages at narrow and wide viewport sizes and confirm fields, validation messages, focus states, and submit links do not overlap.

## Documentation references

- Project overview and Laravel conventions: [README.md](README.md)
- Auth routes: [routes/web.php](routes/web.php)
- Auth behavior: [app/Http/Controllers/AuthController.php](app/Http/Controllers/AuthController.php)
- Auth page contract tests: [tests/Feature/AuthPagesTest.php](tests/Feature/AuthPagesTest.php)
