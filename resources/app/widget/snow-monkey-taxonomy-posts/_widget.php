<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

if ( empty( $instance['taxonomy'] ) ) {
	return;
}

$_taxonomy = explode( '@', $instance['taxonomy'] );
if ( 2 !== count( $_taxonomy ) ) {
	return;
}

$taxonomy_id = $_taxonomy[0];
$term_id     = $_taxonomy[1];
$_taxonomy   = get_taxonomy( $taxonomy_id );
$post_types  = empty( $_taxonomy->object_type ) ? 'post' : $_taxonomy->object_type;

$widget_number = explode( '-', $args['widget_id'] );
$widget_number = end( $widget_number );

$has_sticky   = get_option( 'sticky_posts' ) && ! $instance['ignore-sticky-posts'];
$sticky_count = 0;
if ( $has_sticky ) {
	foreach ( get_option( 'sticky_posts' ) as $post_id ) {
		if ( 'publish' === get_post_status( $post_id ) ) {
			$sticky_count ++;
		}
	}
}

$query_args = [
	'post_type'           => $post_types,
	'posts_per_page'      => $instance['posts-per-page'] - $sticky_count,
	'ignore_sticky_posts' => $instance['ignore-sticky-posts'],
	'tax_query'      => [
		[
			'taxonomy' => $taxonomy_id,
			'terms'    => $term_id,
		],
	],
];
$query_args = apply_filters( 'snow_monkey_taxonomy_posts_widget_args', $query_args );
$query_args = apply_filters( 'snow_monkey_taxonomy_posts_widget_args_' . $widget_number, $query_args );

$taxonomy_posts_query = new WP_Query(
	array_merge(
		$query_args,
		[
			'no_found_rows'    => true,
			'suppress_filters' => true,
		]
	)
);

if ( ! $taxonomy_posts_query->have_posts() ) {
	return;
}

echo wp_kses_post( $args['before_widget'] );
	Helper::get_template_part(
		'template-parts/widget/snow-monkey-posts',
		'recent',
		[
			'_posts_query'    => $taxonomy_posts_query,
			'_widget_area_id' => $args['id'],
			'_classname'      => 'snow-monkey-taxonomy-posts',
			'_id'             => $args['widget_id'],
			'_entries_layout' => $instance['layout'],
			'_title'          => $instance['title'],
			'_link_url'       => $instance['link-url'],
			'_link_text'      => $instance['link-text'],
		]
	);
echo wp_kses_post( $args['after_widget'] );