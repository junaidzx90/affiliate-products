<?php
/**
 * Template Name: Full-width model
 *
 * @package SEO Mag
 */

defined( 'ABSPATH' ) || die( 'Cheating?' );

use Timber\Timber;

// ────────────────────────────────────────────────────────────────────────────────────────────────────────────────

__( 'Full-width model', 'seomag' );

// ────────────────────────────────────────────────────────────────────────────────────────────────────────────────

$context  = Timber::context();
$the_post = Timber::query_post();

$context['post'] = $the_post;

// ────────────────────────────────────────────────────────────────────────────────────────────────────────────────
Timber::render( 'tpl-product.twig', $context );