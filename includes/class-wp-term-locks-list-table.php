<?php

/**
 * Term Locks List Table Class
 *
 * @since 0.1.0
 *
 * @package Plugins/Terms/Metadata/Locks/ListTable
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class used to implement displaying terms in a list table.
 *
 * @since 0.1.0
 * @access private
 *
 * @see WP_List_Table
 */
class WP_Term_Locks_List_Table extends WP_Terms_List_Table {

	/**
	 * Pass $tag into capability check
	 *
	 * @since 0.1.0
	 *
	 * @param  object  $tag
	 *
	 * @return string
	 */
	public function column_cb( $tag ) {
		$default_term = get_option( 'default_' . $this->screen->taxonomy );

		if ( current_user_can( get_taxonomy( $this->screen->taxonomy )->cap->delete_terms, $tag ) && ( $tag->term_id != $default_term ) ) {
			return '<label class="screen-reader-text" for="cb-select-' . $tag->term_id . '">' . sprintf( __( 'Select %s' ), $tag->name ) . '</label>'
				. '<input type="checkbox" name="delete_tags[]" value="' . $tag->term_id . '" id="cb-select-' . $tag->term_id . '" />';
		}

		return '&nbsp;';
	}

	/**
	 * Generates and displays row action links.
	 *
	 * @since 0.1.0
	 *
	 * @access protected
	 *
	 * @param  object $tag           Tag being acted upon.
	 * @param  string  $column_name  Current column name.
	 * @param  string  $primary      Primary column name.
	 *
	 * @return string Row actions output for terms.
	 */
	protected function handle_row_actions( $tag, $column_name, $primary ) {

		// Bail if not primary row
		if ( $primary !== $column_name ) {
			return '';
		}

		// Setup taxoonmy & default term
		$taxonomy     = $this->screen->taxonomy;
		$tax          = get_taxonomy( $taxonomy );
		$default_term = get_option( 'default_' . $taxonomy );

		$uri = ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			? wp_get_referer()
			: $_SERVER['REQUEST_URI'];

		$edit_link = add_query_arg(
			'wp_http_referer',
			urlencode( wp_unslash( $uri ) ),
			get_edit_term_link( $tag->term_id, $taxonomy, $this->screen->post_type )
		);

		$actions = array();

		// Edit
		if ( current_user_can( $tax->cap->edit_terms, $tag ) ) {
			$actions['edit'] = sprintf(
				'<a href="%s" aria-label="%s">%s</a>',
				esc_url( $edit_link ),
				/* translators: %s: taxonomy term name */
				esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $tag->name ) ),
				__( 'Edit' )
			);
			$actions['inline hide-if-no-js'] = sprintf(
				'<a href="#" class="editinline aria-button-if-js" aria-label="%s">%s</a>',
				/* translators: %s: taxonomy term name */
				esc_attr( sprintf( __( 'Quick edit &#8220;%s&#8221; inline' ), $tag->name ) ),
				__( 'Quick&nbsp;Edit' )
			);
		}

		// Delete
		if ( current_user_can( $tax->cap->delete_terms, $tag ) && ( $tag->term_id != $default_term ) ) {
			$actions['delete'] = sprintf(
				'<a href="%s" class="delete-tag aria-button-if-js" aria-label="%s">%s</a>',
				wp_nonce_url( "edit-tags.php?action=delete&amp;taxonomy={$taxonomy}&amp;tag_ID={$tag->term_id}", 'delete-tag_' . $tag->term_id ),
				/* translators: %s: taxonomy term name */
				esc_attr( sprintf( __( 'Delete &#8220;%s&#8221;' ), $tag->name ) ),
				__( 'Delete' )
			);
		}

		// View
		if ( ! empty( $tax->public ) ) {
			$actions['view'] = sprintf(
				'<a href="%s" aria-label="%s">%s</a>',
				get_term_link( $tag ),
				/* translators: %s: taxonomy term name */
				esc_attr( sprintf( __( 'View &#8220;%s&#8221; archive' ), $tag->name ) ),
				__( 'View' )
			);
		}

		/**
		 * Filter the action links displayed for each term in the Tags list table.
		 *
		 * @since 2.8.0
		 * @deprecated 3.0.0 Use {$taxonomy}_row_actions instead.
		 *
		 * @param array  $actions An array of action links to be displayed. Default
		 *                        'Edit', 'Quick Edit', 'Delete', and 'View'.
		 * @param object $tag     Term object.
		 */
		$actions = apply_filters( 'tag_row_actions', $actions, $tag );

		/**
		 * Filter the action links displayed for each term in the terms list table.
		 *
		 * The dynamic portion of the hook name, `$taxonomy`, refers to the taxonomy slug.
		 *
		 * @since 3.0.0
		 *
		 * @param array  $actions An array of action links to be displayed. Default
		 *                        'Edit', 'Quick Edit', 'Delete', and 'View'.
		 * @param object $tag     Term object.
		 */
		$actions = apply_filters( "{$taxonomy}_row_actions", $actions, $tag );

		return $this->row_actions( $actions );
	}
}
