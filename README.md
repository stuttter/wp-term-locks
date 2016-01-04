# WP Term Locks

Pretty locks for categories, tags, and other taxonomy terms

WP Term Locks allows users to assign locks to any visible category, tag, or taxonomy term using a fancy lock picker, providing a customized look for their taxonomy terms.

# Installation

* Download and install using the built in WordPress plugin installer.
* Activate in the "Plugins" area of your admin by clicking the "Activate" link.
* No further setup or configuration is necessary.

# FAQ

### Does this plugin depend on any others?

Yes. Please install the WP Term Meta plugin

### Does this create new database tables?

No. There are no new database tables with this plugin.

### Does this modify existing database tables?

No. All of WordPress's core database tables remain untouched.

### Can I query for terms by their `lock`?

Yes. Use a `meta_query` like:

```
$terms = get_terms( 'category', array(
	'depth'      => 1,
	'number'     => 100,
	'parent'     => 0,
	'hide_empty' => false,

	// Query by lock using the "wp-term-meta" plugin!
	'meta_query' => array( array(
		'key'   => 'lock',
		'value' => '#c0ffee'
	) )
) );
```

### Where can I get support?

The WordPress support forums: https://wordpress.org/support/plugin/wp-term-locks/

### Can I contribute?

Yes, please! The number of users needing more robust taxonomy visuals is growing fast. Having an easy-to-use UI and powerful set of functions is critical to managing complex WordPress installations. If this is your thing, please help us out!
