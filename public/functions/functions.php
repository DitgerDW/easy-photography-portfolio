<?php
/**
 *
 *
 * Available Global Variables: $cm_portfolio, $entry
 *
 * @var $cm_portfolio Photography_Portoflio\Frontend\Layout\Single\Single_Portfolio_Layout
 * @var $entry        Photography_Portoflio\Frontend\Layout\Entry\Entry
 */

/*
 *
 *
 *
 * @TODO: Template files should not use PHP Namespaces. Create public functions instead.
  *
 *
 *
 *
 */


use CLM\Metamod;

/*
 *
 * -- Initialize Portfolio
 *
 */
function CMP_Instance() {

	return Colormelon_Photography_Portfolio::instance();
}


/**
 *
 * -- CLM Portfolio Functions
 *
 */
function cmp_get_layout( $post_id = NULL ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	return Metamod::get_value( 'single_portfolio_layout', $post_id );
}


function cmp_get_class( $class = NULL, $post_id = NULL ) {

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$class = array_map( 'esc_attr', $class );
	}
	else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	// Add Gallery--{{type}} to class
	$class[] = 'Gallery--' . cmp_get_layout( $post_id );;

	return get_post_class( $class );
}


function cmp_class( $class = NULL, $post_id = NULL ) {

	// Separates classes with a double space, collates classes for post DIV
	echo 'class="' . join( '  ', cmp_get_class( $class, $post_id ) ) . '"';
}


if ( ! function_exists( "cmp_display_archive" ) ) {
	function cmp_display_archive() {

		Photography_Portfolio\Frontend\Layout\Archive\Archive_Portfolio_Factory::display();
	}
}


if ( ! function_exists( "cmp_display_single_portfolio" ) ) {
	function cmp_display_single_portfolio() {

		Photography_Portfolio\Frontend\Layout\Single\Single_Portfolio_Factory::display();
	}
}


if ( ! function_exists( "cmp_display_gallery" ) ) {
	function cmp_display_gallery() {

		global $cm_portfolio;

		$cm_portfolio->display_gallery();
	}
}

if ( ! function_exists( "cmp_display_entry" ) ) {
	function cmp_display_entry( $post_id ) {

		global $cm_portfolio;

		$cm_portfolio->the_entry( $post_id );
	}
}


if ( ! function_exists( "cmp_get_template" ) ) {
	function cmp_get_template( $name ) {

		global $cm_portfolio;

		$cm_portfolio->get( $name );
	}
}