<?php
/**
 * Nerdery Theme
 *
 * @category   Nerdery_Skeleton_Theme
 * @package    Nerdery_Skeleton_Theme
 * @subpackage Functions
 * @author     Jess Green <jgreen@nerdery.com>
 * @author     Alison Barrett <abarrett@nerdery.com>
 * @version    $Id$
 */

/**
 * Includes
 */
include_once 'modules/register-post-types.php';
include_once 'modules/register-taxonomies.php';

/**
 * Widget Includes
 */
include_once 'widgets/skeleton-widget.php';

/**
 * Theme Supports
 */
add_theme_support('post-thumbnails');
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('menus');

/**
 * Constants
 */
define('DISALLOW_FILE_EDIT', true); // because we don't want the client to modify files directly on server.
define('NERDERY_THEME_PATH_URL', get_template_directory_uri() . '/');

/**
 * Register sidebars
 */
register_sidebar(
    array(
        'name'        => 'Example Sidebar',
        'id'          => 'nerdery_example_sidebar',
        'description' => 'Example Sidebar. Rename and use as a skeleton for '
                         . 'other dynamic sidebars.'
    )
);

add_action('wp_enqueue_scripts', 'nerderyEnqueueScripts');
add_action('wp_enqueue_scripts', 'nerderyEnqueueStyles');

/**
 * Register & enqueue all Javascript files for the theme.
 *
 * @return void
 */
function nerderyEnqueueScripts()
{
    // Global script
    wp_register_script(
        'nerdery-global',
        NERDERY_THEME_PATH_URL . 'assets/scripts/global.js',
        array('jquery'),
        '1.0',
        true
    );

    // ExternalLinks cript
    wp_register_script(
        'nerdery-external-links',
        NERDERY_THEME_PATH_URL . 'assets/scripts/external-links.js',
        array('jquery'),
        '1.0',
        true
    );

    // AutoReplace script
    wp_register_script(
        'nerdery-auto-replace',
        NERDERY_THEME_PATH_URL . 'assets/scripts/auto-replace.js',
        array('jquery'),
        '1.0',
        true
    );

    // Carousel script
    wp_register_script(
        'nerdery-carousel',
        NERDERY_THEME_PATH_URL . 'assets/scripts/carousel.js',
        array('jquery'),
        '1.0',
        true
    );


    // Navigation script
    wp_register_script(
        'nerdery-navigation',
        NERDERY_THEME_PATH_URL . 'assets/scripts/navigation.js',
        array('jquery'),
        '1.0',
        true
    );

    // Dropdown script
    wp_register_script(
        'nerdery-dropdown',
        NERDERY_THEME_PATH_URL . 'assets/scripts/dropdown.js',
        array('jquery'),
        '1.0',
        true
    );

    // Scrolling Nav script
    wp_register_script(
        'scroll-nav',
        NERDERY_THEME_PATH_URL . 'assets/scripts/scroll-nav.js',
        array('jquery'),
        '1.0',
        true
    );

    wp_enqueue_script('nerdery-global');
    wp_enqueue_script('nerdery-external-links');
    wp_enqueue_script('nerdery-auto-replace');
    wp_enqueue_script('nerdery-carousel');
    wp_enqueue_script('nerdery-navigation');
    wp_enqueue_script('nerdery-dropdown');
    wp_enqueue_script('scroll-nav');

    // Comment reply script for threaded comments (registered in WP core)
    if (is_singular() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

/**
 * Register & enqueue all stylesheets for the theme. /style.css is not used.
 *
 * @return void
 */
function nerderyEnqueueStyles()
{
    global $wp_styles;

    // Reset Stylesheet
    wp_register_style(
        'nerdery-reset',
        NERDERY_THEME_PATH_URL . 'assets/styles/reset.css',
        false,
        '1.0',
        'screen, projection'
    );

    // Primary Screen Stylesheet
    wp_register_style(
        'nerdery-screen',
        NERDERY_THEME_PATH_URL . 'assets/styles/screen.css',
        array('nerdery-reset'),
        '1.0',
        'screen, projection'
    );

    // Mobile Screen Stylesheet
    wp_register_style(
        'nerdery-screen-small',
        NERDERY_THEME_PATH_URL . 'assets/styles/screen_small.css',
        array('nerdery-screen'),
        '1.0',
        'screen and (max-width: 767px)'
    );

    // WYSIWYG Stylesheet
    wp_register_style(
        'nerdery-wysiwyg',
        NERDERY_THEME_PATH_URL . 'assets/styles/wysiwyg.css',
        array('nerdery-reset'),
        '1.0',
        'screen, projection'
    );

    // Print Stylesheet
    wp_register_style(
        'nerdery-print',
        NERDERY_THEME_PATH_URL . 'assets/styles/print.css',
        array('nerdery-reset'),
        '1.0',
        'print'
    );

    // IE 9 Stylesheet
    wp_register_style(
        'nerdery-ie9',
        NERDERY_THEME_PATH_URL . 'assets/styles/ie9.css',
        array('nerdery-screen'),
        '1.0',
        'screen, projection'
    );

    // IE 8 Stylesheet
    wp_register_style(
        'nerdery-ie8',
        NERDERY_THEME_PATH_URL . 'assets/styles/ie8.css',
        array('nerdery-screen'),
        '1.0',
        'screen, projection'
    );

    // IE 7 Stylesheet
    wp_register_style(
        'nerdery-ie7',
        NERDERY_THEME_PATH_URL . 'assets/styles/ie7.css',
        array('nerdery-screen'),
        '1.0',
        'screen, projection'
    );

    // Conditional statements for IE stylesheets
    $wp_styles->add_data('nerdery-ie9', 'conditional', 'lte IE 9');
    $wp_styles->add_data('nerdery-ie8', 'conditional', 'lte IE 8');
    $wp_styles->add_data('nerdery-ie7', 'conditional', 'lte IE 7');

    // Queue the stylesheets. Note that because nerdery-screen was registered
    // with nerdery-reset as a dependency, it does not need to be enqueued here.
    wp_enqueue_style('nerdery-screen');
    wp_enqueue_style('nerdery-screen-small');
    wp_enqueue_style('nerdery-wysiwyg');
    wp_enqueue_style('nerdery-print');
    wp_enqueue_style('nerdery-ie9');
    wp_enqueue_style('nerdery-ie8');
    wp_enqueue_style('nerdery-ie7');
}

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'directors-full', 222, 222, true );
    add_image_size( 'homepage-quote', 242, 242, true );
}
