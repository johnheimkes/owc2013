<?php

/**
 * This adds fields to the user edit profile fields
 * 
 * @package TribeEventsEventBrite
 * @since  3.0
 * @author Modern Tribe Inc.
 */

?>
<h3><?php _e('Eventbrite User Account') ?></h3>

<div>
	<span class="description"><?php printf( __( "Your API Key can be found in your %s in Eventbrite. Don't have an Eventbrite account yet? It takes less than 30 seconds to set one up. ", 'tribe-eventbrite'), '<a href="http://www.eventbrite.com/userkeyapi/?ref=etckt" target="_blank">' . _x('account settings', 'API key settings link', 'tribe-eventbrite') . '</a>' ); ?><a href="http://www.eventbrite.com/r/etp" target="_blank"><?php _e( 'Click here to register.', 'tribe-eventbrite' ); ?></a></span></label>
</div>

<table class="form-table">
<tr>
	<th><label for="email"><?php _e('Eventbrite API User Key'); ?>
	</th>
	<td><input type="text" name="eventbrite_user_key" id="eventbrite_user_key" value="<?php echo esc_attr(get_user_meta( $profileuser->ID, 'eventbrite_user_key', true ) ); ?>" class="regular-text" /></td>
</tr>
</table>
<br />
