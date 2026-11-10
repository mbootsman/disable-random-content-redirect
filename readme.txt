=== Disable Random Content Redirect ===
Contributors: mbootsman
Tags: random, redirect, rewrite rules, permalinks
Requires at least: 7.2
Tested up to: 7.2
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Turns off the /random/ content redirect introduced in WordPress 7.2.

== Description ==

WordPress 7.2 adds a /random/ URL that redirects visitors to a random piece of content. This plugin turns that feature off by filtering `wp_enable_random_content_redirect` to false.

While the plugin is active:

* WordPress registers no /random/ rewrite rules.
* The random base field on Settings > Permalinks is hidden.
* The random query variable is ignored.

The plugin also filters `enable_random_content_redirect`, the name used in early WordPress 7.2 development builds.

There are no settings. Activate the plugin to disable the redirect; deactivate it to restore the default behaviour.

Development happens on [GitHub](https://github.com/mbootsman/disable-random-content-redirect).

== Installation ==

1. Install the plugin through the Plugins screen in WordPress, or upload the `disable-random-content-redirect` folder to `/wp-content/plugins/`.
2. Activate the plugin through the Plugins screen.

The rewrite rules are rebuilt automatically on activation and deactivation, so you don't need to re-save your permalinks.

== Frequently Asked Questions ==

= Does this plugin have any settings? =

No. Activating it disables the /random/ redirect; deactivating it brings the redirect back.

= Do I need to flush my permalinks? =

No. The plugin clears the stored rewrite rules when it is activated or deactivated, and WordPress rebuilds them on the next request.

== Changelog ==

= 1.0.0 =
* Initial release.
