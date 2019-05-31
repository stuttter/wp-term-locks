=== WP Term Locks ===
Contributors:      johnjamesjacoby, stuttter
Tags:              taxonomy, term, meta, metadata, lock, locks
Requires PHP:      5.6.20
Requires at least: 4.4
Tested up to:      5.2
Stable tag:        2.0.0
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Donate link:       https://ko-fi.com/jjj

== Description ==

Prevent categories, tags, and other taxonomy terms from being edited or deleted

WP Term Locks allows administrators to lock taxonomy terms from being edited or deleted by other capable users

= Also checkout =

* [WP Chosen](https://wordpress.org/plugins/wp-chosen/ "Make long, unwieldy select boxes much more user-friendly.")
* [WP Pretty Filters](https://wordpress.org/plugins/wp-pretty-filters/ "Makes post filters better match what's already in Media & Attachments.")
* [WP Event Calendar](https://wordpress.org/plugins/wp-event-calendar/ "The best way to manage events in WordPress.")
* [WP Media Categories](https://wordpress.org/plugins/wp-media-categories/ "Add categories to media & attachments.")
* [WP Term Order](https://wordpress.org/plugins/wp-term-order/ "Sort taxonomy terms, your way.")
* [WP Term Authors](https://wordpress.org/plugins/wp-term-authors/ "Authors for categories, tags, and other taxonomy terms.")
* [WP Term Locks](https://wordpress.org/plugins/wp-term-locks/ "Pretty locks for categories, tags, and other taxonomy terms.")
* [WP Term Icons](https://wordpress.org/plugins/wp-term-icons/ "Pretty icons for categories, tags, and other taxonomy terms.")
* [WP Term Visibility](https://wordpress.org/plugins/wp-term-visibility/ "Visibilities for categories, tags, and other taxonomy terms.")
* [WP User Activity](https://wordpress.org/plugins/wp-user-activity/ "The best way to log activity in WordPress.")
* [WP User Avatars](https://wordpress.org/plugins/wp-user-avatars/ "Allow users to upload avatars or choose them from your media library.")
* [WP User Groups](https://wordpress.org/plugins/wp-user-groups/ "Group users together with taxonomies & terms.")
* [WP User Profiles](https://wordpress.org/plugins/wp-user-profiles/ "A sophisticated way to edit users in WordPress.")

== Screenshots ==

1. Category Locks

== Installation ==

* Download and install using the built in WordPress plugin installer.
* Activate in the "Plugins" area of your admin by clicking the "Activate" link.
* No further setup or configuration is necessary.

== Frequently Asked Questions ==

= Does this create new database tables? =

No. There are no new database tables with this plugin.

= Does this modify existing database tables? =

No. All of WordPress's core database tables remain untouched.

= How do I query for terms via their locks? =

With WordPress's `get_terms()` function, the same as usual, but with an additional `meta_query` argument according the `WP_Meta_Query` specification:
http://codex.wordpress.org/Class_Reference/WP_Meta_Query

`
$terms = get_terms( 'category', array(
	'depth'      => 1,
	'number'     => 100,
	'parent'     => 0,
	'hide_empty' => false,

	// Query by lock
	'meta_query' => array( array(
		'key'   => 'locks',
		'value' => ''
	) )
) );
`

= Where can I get support? =

* Basic: https://wordpress.org/support/plugin/wp-term-locks/
* Priority: https://chat.flox.io/support/channels/wp-term-locks/

= Where can I find documentation? =

http://github.com/stuttter/wp-term-locks/

== Changelog ==

= 2.0.0 =
* Update base class

= 1.0.1 =
* Fix single-site capabilities check

= 1.0.0 =
* Remove list-table override class
* Bump minimum WordPress version to 4.7
* Restructure files for improved mu-plugins support
* Clean-up unused assets

= 0.2.0 =
* Update base class

= 0.1.4 =
* Update textdomain
* Update headers & meta

= 0.1.3 =
* Updated metadata UI class

= 0.1.1 =
* Updated form field classes

= 0.1.0 =
* Initial release
