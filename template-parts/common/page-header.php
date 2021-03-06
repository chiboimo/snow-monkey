<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/page-header.php
 */

use Framework\Helper;

$args = wp_parse_args(
	$args,
	[
		'_is_output_page_header_title' => Helper::is_output_page_header_title(),
		'_page_header_title'           => Helper::get_page_title_from_breadcrumbs(),
		'_page_header_image'           => Helper::get_page_header_image(),
		'_display_entry_meta'          => false,
	]
);
?>

<div
	class="c-page-header"
	data-has-content="<?php echo esc_attr( $args['_is_output_page_header_title'] ? 'true' : 'false' ); ?>"
	data-has-image="<?php echo esc_attr( $args['_page_header_image'] ? 'true' : 'false' ); ?>"
	>

	<?php if ( $args['_page_header_image'] ) : ?>
		<div class="c-page-header__bgimage">
			<?php
			echo wp_kses(
				$args['_page_header_image'],
				[
					'img' => Helper::img_allowed_attributes(),
				]
			);
			?>
		</div>
	<?php endif; ?>

	<?php if ( $args['_is_output_page_header_title'] ) : ?>
		<div class="c-container">
			<div class="c-page-header__content">
				<h1 class="c-page-header__title">
					<?php echo wp_kses_post( apply_filters( 'snow_monkey_page_header_title', $args['_page_header_title'] ) ); ?>
				</h1>

				<?php if ( $args['_display_entry_meta'] ) : ?>
					<div class="c-page-header__meta">
						<?php Helper::get_template_part( 'template-parts/content/entry-meta' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
