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
    register_post_type(
        'directors',
        array(
            'labels' => array(
                'name'          => 'Directors',
                'singular_name' => 'Director',
                'add_new_item'  => 'Add New Director',
                'edit_item'     => 'Edit Director',
            ),
            'public'        => true,
            'description'   => 'Directors Listing'
            'supports'      => array(
                'title',
                'editor',
                'thumbnail',
                'revisions',
            ),
            'has_archive'   => true,
        )
    );
}