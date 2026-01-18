# Admin Label Renamer

Admin Label Renamer is a small, admin-only WordPress plugin that allows administrators to rename common WordPress admin menu labels to better match their workflow or client terminology.

The plugin is intentionally simple and focused. It changes only visible labels in the WordPress dashboard and does not modify WordPress behavior.

---

## What it does

Admin Label Renamer allows you to rename the following admin labels:

- Posts
- Pages
- Users
- Media
- Plugins
- Comments

Changes are applied safely using WordPress core APIs and are visible only in the admin dashboard.

---

## What it intentionally does NOT do

This plugin does **not**:

- Modify post types or capabilities
- Hide admin menus or restrict roles
- Change URLs or permalinks
- Use CSS or JavaScript hacks
- Affect front-end output

The goal is clarity and customization without risk.

---

## Design principles

- Admin-only scope
- No role or permission manipulation
- Uses the WordPress Settings API
- Scoped gettext usage (no global overrides)
- Clean uninstall with full data removal
- Minimal UI, no unnecessary options

---

## Why this plugin exists

In client and agency environments, default WordPress terminology can sometimes be confusing or mismatched with business workflows.

Admin Label Renamer provides a safe way to customize admin labels without changing how WordPress actually works, reducing confusion while preserving stability.

---

## Status

- Version: **1.0.0**
- Stable and production-ready
- Designed for long-term use on client sites

---

## WordPress.org

This plugin is published on the WordPress.org Plugin Directory.

(WordPress.org link can be added here after approval.)

---

## License

GPL-2.0-or-later
