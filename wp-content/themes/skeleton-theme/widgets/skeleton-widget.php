<?php
/**
 * WordPress Theme Widgets
 *
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @author Jess Green <jgreen@nerdery.com>
 * @version $Id$
 */

/**
 * Class skeleton
 *
 * @category Nerdery_Skeleton_Theme_Widgets
 * @package Nerdery_Skeleton_Theme
 * @subpackage Nerdery_Skeleton_Widget
 * @author Jess Green <jgreen@nerdery.com>
 */
class Nerdery_Skeleton_Widget extends WP_Widget
{
    /**
     * PHP5 Constructor
     */
    public function __construct()
    {
        parent::__construct(
            __CLASS__,
            'Skeleton Widget',
            array(
                'description' => 'Nerdery skeleton widget. Use as a skeleton to '
                                 . 'build other widgets.'
            )
        );
    }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
    public function widget($args, $instance)
    {
        extract($args);
        /*
         * $args :
         *    $before_widget
         *    $before_title
         *    $title
         *    $after_title
         *    $after_widget
         */

        // do before_widget, and title stuff here

        locate_template(array('views/widgets/skeleton.php'), true, false);

        // do after_widget stuff

    }

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
    public function update($new_instance, $old_instance)
    {
        // sanitize widget form values
        return $instance;
    }

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
    public function form ($instance)
    {
        /*
         * Widget Admin Form here.
         */
    }
}

add_action('widgets_init', 'nerdery_skeleton_widget_init');

function nerdery_skeleton_widget_init() {
     return register_widget('Nerdery_Skeleton_Widget');
};
