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

// TODO: Move the following to a custom theme class
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

    wp_enqueue_script('nerdery-global');
    wp_enqueue_script('nerdery-external-links');
    wp_enqueue_script('nerdery-auto-replace');
    wp_enqueue_script('nerdery-carousel');

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
        'nerdery-screen_small',
        NERDERY_THEME_PATH_URL . 'assets/styles/screen_small.css',
        array('nerdery-reset'),
        '1.0',
        'screen and (max-width: 480px)'
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
    wp_enqueue_style('nerdery-screen_small');
    wp_enqueue_style('nerdery-wysiwyg');
    wp_enqueue_style('nerdery-print');
    wp_enqueue_style('nerdery-ie9');
    wp_enqueue_style('nerdery-ie8');
    wp_enqueue_style('nerdery-ie7');
}

/**
 * Change the text of a top level admin menu item
 *
 * @access public
 * @global array $menu
 */
function change_the_menu() {
  global $menu;
 
	// Strings
	$to_match     = __( 'Products' );
	$replace_with = __( 'Events' );
 
	// Loop through the top level menu items
	foreach ( $menu as $menu_position => $menu_properties ) {
 
		// Look for a match
		if ( $to_match === $menu_properties[0] ) {
 
			// Found a match, so change the global and bail
			$menu[$menu_position][0] = $replace_with;
			break;
		}
	}
}
add_action( 'admin_menu', 'change_the_menu' );

// Merne's Shitz -- will need to be modified.
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'directors-full', 222, 222, true );
}

function my_scripts_method() {
    wp_deregister_script('jquery');

    wp_register_script(
        'jquery',
        'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'
    );

    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'custom-script',
        get_template_directory_uri() . '/js/main.js',
        array('jquery')
    );
}
add_action('wp_enqueue_scripts', 'my_scripts_method');


// Custom Write Panels
function customize_write_panels() {
    add_meta_box( 'custom-meta-box', __( 'Add Pages to each section' ), 'setup_pages_metabox', 'stoked_hero_home', 'normal', 'high' );
    add_meta_box( 'custom-meta-box', __( 'Additional Fields' ), 'extend_events_plug', 'event', 'normal', 'low');
}
// Init Custom Write Panels
add_action( 'add_meta_boxes', 'customize_write_panels' );

// Styling for the custom post type icon
function wpt_portfolio_icons() {
    ?>
    <style type="text/css" media="screen">
        .wp_themeSkin iframe {
            background: #FFF !important; /* yeah, I know...but its for the extra TinyMCE's */
        }

        .st-custom-heading {
            font-size: 16px;
            font-weight: bold;
            line-height: 1.5;
            margin: 10px 0;
        }

    </style>
<?php
}
add_action( 'admin_head', 'wpt_portfolio_icons' );

function setup_theme_admin_menus() {
    add_menu_page('Site Options', 'Social Media', 'administrator', 'site-options', 'theme_front_page_settings', null, 3);
}
add_action("admin_menu", "setup_theme_admin_menus");

function theme_front_page_settings() {
    // Check that the user is allowed to update options
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    if (isset($_POST["update_settings"])) {
        $homepage_int           = esc_attr($_POST["homepage_int"]);
        $linked_in              = esc_attr($_POST["linked_in"]);
        $flickr                 = esc_attr($_POST["flickr"]);
        $twitter                = esc_attr($_POST["twitter"]);
        $instagram              = esc_attr($_POST["instagram"]);

        update_option("theme_homepage_int", $homepage_int);
        update_option("theme_linked_in", $linked_in);
        update_option("theme_flickr", $flickr);
        update_option("theme_twitter", $twitter);
        update_option("theme_instagram", $instagram);
    }

    $get_homepage_int           = get_option("theme_homepage_int");

    $get_linked_in              = get_option("theme_linked_in");
    $get_flickr                 = get_option("theme_flickr");
    $get_twitter                = get_option("theme_twitter");
    $get_instagram              = get_option("theme_instagram");

    ?>

    <div class="form-wrap">
            <?php screen_icon('themes'); ?> <h2>Stoke.d Contact Info and Theme Options</h2>

            <form method="POST" action="">
                <fieldset>
                    <input type="hidden" name="update_settings" value="Y" />
                    <legend class="admin-legend">Social Media and Other Options</legend>
                    <p>NOTE: The RSS feed is automatically linked.</p>
                    <ul class="form-list">
                        <li>
                            <label for="linked_in">LinkedIn:</label>
                            <input type="text" name="linked_in" id="linked_in" value="<?php echo $get_linked_in; ?>" />
                        </li>
                        <li>
                            <label for="flickr">Flickr:</label>
                            <input type="text" name="flickr" id="flickr" value="<?php echo $get_flickr; ?>" />
                        </li>
                        <li>
                            <label for="twitter">Twitter:</label>
                            <input type="text" name="twitter" id="twitter" value="<?php echo $get_twitter; ?>" />
                        </li>
                        <li>
                            <label for="instagram">Instagram:</label>
                            <input type="text" name="instagram" id="instagram" value="<?php echo $get_instagram; ?>" />
                        </li>
                        <li>
                            <label for="homepage_int">Length of slides (in seconds) for homepage slideshow:</label>
                            <input type="text" name="homepage_int" id="homepage_int" value="<?php echo $get_homepage_int; ?>" />
                        </li>
                    </ul>
                </fieldset>
                <p class="btn-holder">
                    <input type="submit" value="Save settings" class="button-primary" />
                </p>
            </form>
        </div>
    <?php

}

function extend_events_plug($post) {
    // TODO: ADD IN ALL FIELDS!
    $eventDetails = array();

    $eventDetails[0] = get_post_meta($post->ID, 'steventdates', TRUE);
    $eventDetails[1] = get_post_meta($post->ID, 'steventtuition', TRUE);
    $eventDetails[2] = get_post_meta($post->ID, 'steventcancellation', TRUE);

    $eventDetails[3] = get_post_meta($post->ID, 'steventoverview', TRUE);
    $eventDetails[4] = get_post_meta($post->ID, 'steventcontact', TRUE);
    $eventDetails[5] = get_post_meta($post->ID, 'steventwhoattend', TRUE);
    $eventDetails[6] = get_post_meta($post->ID, 'steventkeytake', TRUE);
    $eventDetails[7] = get_post_meta($post->ID, 'steventvenue', TRUE);

    $eventDetails[8] = get_post_meta($post->ID, 'steventexternal', TRUE);
    $eventDetails[9] = get_post_meta($post->ID, 'steventreglink', TRUE)

    ?>
    <ul class="meta-box-list">
        <li>
            <label for="steventexternal"><h4 class="st-custom-heading">External Link (optional):</h4><p>(note: if this data is supplied, the values below this field are irrelevant)</p> <input type="text" name="steventexternal" id="steventexternal" value="<?php echo $eventDetails[8]; ?>" /></label>
        </li>
        <li>
            <label for="steventreglink"><h4 class="st-custom-heading">Registration Link:</h4> <input type="text" name="steventreglink" id="steventreglink" value="<?php echo $eventDetails[9]; ?>" /></label>
        </li>
        <li>
            <label for="steventdates"><h4 class="st-custom-heading">Event Dates Section:</h4> <?php wp_editor( $eventDetails[0], 'steventdates', array( 'textarea_name' => 'steventdates', 'media_buttons' => true ) ); ?></label>
        </li>
        <li>
            <label for="steventtuition"><h4 class="st-custom-heading">Event Tuition Section:</h4> <?php wp_editor( $eventDetails[1], 'steventtuition', array( 'textarea_name' => 'steventtuition', 'media_buttons' => true ) ); ?></label>
        </li>
        <li>
            <label for="steventcancellation"><h4 class="st-custom-heading">Event Cancellation Policy:</h4> <?php wp_editor( $eventDetails[2], 'steventcancellation', array( 'textarea_name' => 'steventcancellation', 'media_buttons' => true ) ); ?></label>
        </li>
        <li>
            <label for="steventoverview"><h4 class="st-custom-heading">Event Overview Section:</h4> <?php wp_editor( $eventDetails[3], 'steventoverview', array( 'textarea_name' => 'steventoverview', 'media_buttons' => true ) ); ?></label>
        </li>
        <li>
            <label for="steventcontact"><h4 class="st-custom-heading">Event Contact Section:</h4> <?php wp_editor( $eventDetails[4], 'steventcontact', array( 'textarea_name' => 'steventcontact', 'media_buttons' => true ) ); ?></label>
        </li>
        <li>
            <label for="steventwhoattend"><h4 class="st-custom-heading">Who Should Attend?:</h4> <?php wp_editor( $eventDetails[5], 'steventwhoattend', array( 'textarea_name' => 'steventwhoattend', 'media_buttons' => true ) ); ?></label>
        </li>
        <li>
            <label for="steventkeytake"><h4 class="st-custom-heading">Event Key Takeaways:</h4> <?php wp_editor( $eventDetails[6], 'steventkeytake', array( 'textarea_name' => 'steventkeytake', 'media_buttons' => true ) ); ?></label>
        </li>
        <li>
            <label for="steventvenue"><h4 class="st-custom-heading">Event Venue Section:</h4> <?php wp_editor( $eventDetails[7], 'steventvenue', array( 'textarea_name' => 'steventvenue', 'media_buttons' => true ) ); ?></label>
        </li>
    </ul>
    <?php
}

function setup_pages_metabox($post) {
    // Pull previus saved modules
    $section1 = get_post_meta($post->ID, 'section1', TRUE);
    $section2 = get_post_meta($post->ID, 'section2', TRUE);
    $section3 = get_post_meta($post->ID, 'section3', TRUE);
    $section4 = get_post_meta($post->ID, 'section4', TRUE);
    $section5 = get_post_meta($post->ID, 'section5', TRUE);

    $sectionArray = array($section1, $section2, $section3, $section4, $section5);

    // Query Sections
    $sectionQuery = new WP_Query( 'post_type=page' );
    ?>
    <ul class="meta-box-list">
        <?php
        $numSections = 5;

        for($i=1;$i <= $numSections; $i++){
            echo "<li>Section ".$i.": <select name='section".$i."' id='section".$i."'><option value='null'>Select One</option>";
            foreach($sectionQuery->posts as $section) {

                if($sectionArray[$i-1] == $section->ID){
                    echo "<option value='".$section->ID."' selected='selected'>".$section->post_title."</option>";
                } else {
                    echo "<option value='".$section->ID."'>".$section->post_title."</option>";
                }
            }
            echo "</select></li>";
        }
        ?>
    </ul>
<?php
}

// Init Save Panels
add_action('save_post', 'write_panel_save');
// Save Functions
function write_panel_save($post_id) {
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if(isset($_REQUEST['section1'])) {
        update_post_meta($post_id, 'section1', $_REQUEST['section1']);
    }

    if(isset($_REQUEST['section2'])) {
        update_post_meta($post_id, 'section2', $_REQUEST['section2']);
    }

    if(isset($_REQUEST['section3'])) {
        update_post_meta($post_id, 'section3', $_REQUEST['section3']);
    }

    if(isset($_REQUEST['section4'])) {
        update_post_meta($post_id, 'section4', $_REQUEST['section4']);
    }

    if(isset($_REQUEST['section5'])) {
        update_post_meta($post_id, 'section5', $_REQUEST['section5']);
    }

    if(isset($_REQUEST['steventdates'])) {
        update_post_meta($post_id, 'steventdates', $_REQUEST['steventdates']);
    }

    if(isset($_REQUEST['steventtuition'])) {
        update_post_meta($post_id, 'steventtuition', $_REQUEST['steventtuition']);
    }

    if(isset($_REQUEST['steventcancellation'])) {
        update_post_meta($post_id, 'steventcancellation', $_REQUEST['steventcancellation']);
    }

    if(isset($_REQUEST['steventoverview'])) {
        update_post_meta($post_id, 'steventoverview', $_REQUEST['steventoverview']);
    }

    if(isset($_REQUEST['steventcontact'])) {
        update_post_meta($post_id, 'steventcontact', $_REQUEST['steventcontact']);
    }

    if(isset($_REQUEST['steventwhoattend'])) {
        update_post_meta($post_id, 'steventwhoattend', $_REQUEST['steventwhoattend']);
    }

    if(isset($_REQUEST['steventkeytake'])) {
        update_post_meta($post_id, 'steventkeytake', $_REQUEST['steventkeytake']);
    }

    if(isset($_REQUEST['steventvenue'])) {
        update_post_meta($post_id, 'steventvenue', $_REQUEST['steventvenue']);
    }

    if(isset($_REQUEST['steventexternal'])) {
        update_post_meta($post_id, 'steventexternal', $_REQUEST['steventexternal']);
    }

    if(isset($_REQUEST['steventreglink'])) {
        update_post_meta($post_id, 'steventreglink', $_REQUEST['steventreglink']);
    }

}
