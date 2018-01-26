<?php
/**
 * Template Name: One column
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$controller = new Mimizuku_Controller();
$controller->layout( 'one-column' );
if ( is_front_page() ) {
	$controller->render( 'front-page' );
} else {
	$controller->render( 'content', get_post_type() );
}
