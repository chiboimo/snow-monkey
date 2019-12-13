<?php
/**
 * Name: Two rows
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
 */

use Framework\Helper;

$classes = Helper::get_header_classes();
?>
<header class="<?php echo esc_attr( join( ' ', $classes ) ); ?>" role="banner">
	<?php Helper::get_template_part( 'template-parts/header/2row' ); ?>

	<?php if ( has_nav_menu( 'global-nav' ) ) : ?>
		<div class="l-header__drop-nav" aria-hidden="true">
			<div class="c-container">
				<?php Helper::get_template_part( 'template-parts/nav/global' ); ?>
			</div>
		</div>
	<?php endif; ?>
</header>
