=== WP Admin Label Renamer ===
Contributors: saivarshithavunoori
Tags: admin, labels, dashboard, rename, ui
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Rename common WordPress admin labels like Posts, Pages, Users, Media, Plugins, and Comments without touching code.

== Description ==

WP Admin Label Renamer is a lightweight admin-only plugin that allows administrators to rename common WordPress admin labels to better match their workflow or client terminology.

The plugin is intentionally simple and focused. It only changes the visible labels shown in the WordPress admin dashboard and does not modify post types, capabilities, URLs, permissions, or database structures.

This makes it suitable for client sites, internal dashboards, and teams that want clearer naming without altering WordPress core behavior.

Development repository: https://github.com/saivarshithavunoori/wp-admin-label-renamer

**What this plugin does:**
- Renames admin menu labels such as Posts, Pages, Users, Media, Plugins, and Comments
- Uses a simple settings page (no code required)
- Applies changes safely within the admin area only

**What this plugin does NOT do:**
- It does not hide menus or restrict user roles
- It does not modify post types or capabilities
- It does not change URLs or permalinks
- It does not use CSS or JavaScript hacks

== Installation ==

1. Upload the `wp-admin-label-renamer` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the Plugins menu in WordPress
3. Go to **Admin Label Renamer** in the dashboard menu
4. Enter your preferred labels and save changes

== Frequently Asked Questions ==

= Does this plugin change post types or permissions? =
No. The plugin only changes the visible admin labels. All WordPress functionality remains unchanged.

= Will this affect front-end content or URLs? =
No. The plugin works only inside the WordPress admin dashboard.

= Is this plugin safe for client websites? =
Yes. The plugin follows WordPress coding standards, uses proper sanitization, and cleans up its data on uninstall.

= Does it support multisite? =
The plugin works on individual sites. Network-wide label customization is not currently supported.

== Screenshots ==

1. Admin Label Renamer settings page
2. Renamed admin menu labels in the dashboard

== Changelog ==

= 1.0.0 =
- Initial release
- Add support for renaming core admin labels
- Clean uninstall support

== Upgrade Notice ==

= 1.0.0 =
Initial stable release.
