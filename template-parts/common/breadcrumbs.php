<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/breadcrumbs.php
 */

use Framework\Helper;

$args = wp_parse_args(
	$args,
	[
		'_items' => Helper::get_breadcrumbs_items(),
	]
);

$args['_items'] = array_values( $args['_items'] );

if ( ! $args['_items'] ) {
	return;
}

$allowed_html = wp_kses_allowed_html( 'post' );
unset( $allowed_html['a'] );
?>

<div class="p-breadcrumbs-wrapper">
	<ol class="c-breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
		<?php foreach ( $args['_items'] as $key => $item ) : ?>
			<?php
			/**
			 * @see https://github.com/WordPress/WordPress/blob/5.4-branch/wp-includes/default-filters.php#L168-L170
			 */
			$_title = wptexturize( $item['title'] );
			$_title = convert_chars( $_title );
			$_title = trim( $_title );
			?>
			<li class="c-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo esc_url( $item['link'] ); ?>" itemid="<?php echo esc_url( $item['link'] ); ?>"><span itemprop="name"><?php echo wp_kses( $_title, $allowed_html ); ?></span></a>
				<meta itemprop="position" content="<?php echo esc_attr( $key + 1 ); ?>" />
			</li>
		<?php endforeach; ?>
	</ol>
</div>
