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
        'partners',
        array(
            'labels' => array(
                'name'          => 'Partners',
                'singular_name' => 'Partner',
                'add_new_item'  => 'Add New Partner',
                'edit_item'     => 'Edit Partner',
            ),
            'public'        => true,
            'description'   => 'Partners Listing',
            'supports'      => array(
                'editor',
            ),
            'has_archive'   => true,
        )
    );
}