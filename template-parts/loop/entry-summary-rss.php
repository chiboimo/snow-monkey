<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

use Framework\Helper;

$args = wp_parse_args(
	$args,
	[
		'_title_tag'      => 'h2',
		'_item'           => false,
		'_entries_layout' => get_theme_mod( 'post-entries-layout' ),
		'_excerpt_length' => null,
	]
);

if ( ! $args['_item'] || ! is_a( $args['_item'], 'SimplePie_Item' ) ) {
	return;
}
?>

<a href="<?php echo esc_url( $args['_item']->get_permalink() ); ?>" target="_blank" rel="noopener">
	<section class="c-entry-summary c-entry-summary--post">
		<?php
		Helper::get_template_part(
			'template-parts/loop/entry-summary/figure/figure',
			'rss',
			[
				'_item' => $args['_item'],
			]
		);
		?>

		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary/title/title',
					'rss',
					[
						'_title_tag' => $args['_title_tag'],
						'_item'      => $args['_item'],
					]
				);
				?>
			</header>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/content',
				'rss',
				[
					'_item'           => $args['_item'],
					'_entries_layout' => $args['_entries_layout'],
					'_excerpt_length' => $args['_excerpt_length'],
				]
			);
			?>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/meta/meta',
				'rss',
				[
					'_item' => $args['_item'],
				]
			);
			?>
		</div>
	</section>
</a>
