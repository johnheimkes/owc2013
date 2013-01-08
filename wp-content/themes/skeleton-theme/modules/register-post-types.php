<?php
/**
 * Nerdery Theme
 *
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @subpackage Modules_Register_PostTypes
 * @author Jess Green <jgreen@nerdery.com>
 * @version $Id$
 */

add_action('init', 'nerdery_register_post_types');
function nerdery_register_post_types()
{
    // register your post-types here
    /*
     * @see register_post_type() http://codex.wordpress.org/Function_Reference/register_post_type
     *
     */
    register_post_type(
        'nerdery_carousel', // prefix your post-type
        array(
            'labels' => array(
                'name'          => 'Carousels', // plural name
                'singular_name' => 'Carousel'
            ),
            'public' => true,
            'supports' => array(
                'title',
                'thumbnail',
            )
        )
    );
}