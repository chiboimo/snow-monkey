<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

$accent_color = get_theme_mod( 'accent-color' );
if ( $accent_color ) {
	Style::register(
		'.smb-step__item__link',
		'color: ' . $accent_color
	);
}

$selectors = [ '.smb-step__item__summary' ];
Style::extend( 'entry-content', $selectors );
Style::extend( 'theme-entry-content', $selectors );
