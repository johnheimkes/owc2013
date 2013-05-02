<?php
/**
* The TEC template for a list of events. This includes the Past Events and Upcoming Events views 
* as well as those same views filtered to a specific category.
*
* You can customize this view by putting a replacement file of the same name (list.php) in the events/ directory of your theme.
*/

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

?>
<div id="tribe-events-content" class="upcoming">
    
	<div id="tribe-events-loop" class="tribe-events-events post-list clearfix">
	
	<?php if (have_posts()) : ?>
	<?php $hasPosts = true; $first = true; ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php global $more; $more = false; ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('tribe-events-event clearfix'); ?> itemscope itemtype="http://schema.org/Event">
			<?php the_title('<h2 class="entry-title" itemprop="name"><a href="' . tribe_get_event_link() . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">', '</a></h2>'); ?>
			<div class="entry-content tribe-events-event-entry" itemprop="description">
				<?php if (has_excerpt ()): ?>
					<?php the_excerpt(); ?>
				<?php else: ?>
					<?php the_content(); ?>
				<?php endif; ?>
			</div> <!-- End tribe-events-event-entry -->

			<div class="tribe-events-event-list-meta" itemprop="location" itemscope itemtype="http://schema.org/Place">
				<table cellspacing="0">
					<?php
						$cost = tribe_get_cost();
						if ( !empty( $cost ) ) :
					?>
					<tr>
						<td class="tribe-events-event-meta-desc"><?php _e('Cost:', 'tribe-events-calendar'); ?></td>
						<td class="tribe-events-event-meta-value" itemprop="price"><?php echo $cost; ?></td>
					 </tr>
					<?php endif; ?>
				</table>
			</div>
		</div> <!-- End post -->
	<?php endwhile;// posts ?>
	<?php else :?>
		<div class="tribe-events-no-entry">
		<?php 
			$tribe_ecp = TribeEvents::instance();
			if ( is_tax( $tribe_ecp->get_event_taxonomy() ) ) {
				$cat = get_term_by( 'slug', get_query_var('term'), $tribe_ecp->get_event_taxonomy() );
				if( tribe_is_upcoming() ) {
					$is_cat_message = sprintf(__(' listed under %s. Check out past events for this category or view the full calendar.','tribe-events-calendar'),$cat->name);
				} else if( tribe_is_past() ) {
					$is_cat_message = sprintf(__(' listed under %s. Check out upcoming events for this category or view the full calendar.','tribe-events-calendar'),$cat->name);
				}
			}
		?>
		<?php if(tribe_is_day()): ?>
			<?php printf( __('No events scheduled for <strong>%s</strong>. Please try another day.', 'tribe-events-calendar'), date_i18n('F d, Y', strtotime(get_query_var('eventDate')))); ?>
		<?php endif; ?>

		<?php if(tribe_is_upcoming()){ ?>
			<?php _e('No upcoming events', 'tribe-events-calendar');
			echo !empty($is_cat_message) ? $is_cat_message : "."; ?>

		<?php }elseif(tribe_is_past()){ ?>
			<?php _e('No previous events' , 'tribe-events-calendar');
			echo !empty($is_cat_message) ? $is_cat_message : "."; ?>
		<?php } ?>
		</div>
	<?php endif; ?>


	</div><!-- #tribe-events-loop -->
</div>
