<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/share-buttons.php
 */

use Framework\Helper;

$args = wp_parse_args(
	$args,
	[
		'_buttons' => explode( ',', get_option( 'mwt-share-buttons-buttons' ) ),
	]
);

if ( ! $args['_buttons'] ) {
	return;
}
?>

<div class="wp-share-buttons wp-share-buttons--<?php echo esc_attr( get_option( 'mwt-share-buttons-type' ) ); ?>">
	<ul class="wp-share-buttons__list">
		<?php foreach ( $args['_buttons'] as $button ) : ?>
			<?php
			$share_button = do_shortcode(
				sprintf(
					'[wp_share_buttons_%1$s type="%2$s" post_id="%3$d"]',
					esc_attr( $button ),
					esc_attr( get_option( 'mwt-share-buttons-type' ) ),
					get_the_ID()
				)
			);

			if ( ! $share_button ) {
				continue;
			}
			?>
			<li class="wp-share-buttons__item">
				<?php echo $share_button; // xss ok. ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
