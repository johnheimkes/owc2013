<?php
global $current_user;
$user_id = get_current_user_id();
$EventBriteUserKey = get_user_meta( $user_id, 'eventbrite_user_key', true );
?>
<?php if( !$EventBriteUserKey ) : ?>
<tr>
	<th scope="row"><?php _e('Eventbrite','tribe-eventbrite');?></th>
	<td>
		<?php printf( __('In order to enable Eventbrite for the The Events Calendar, please enter your Eventbrite User Key on %s','tribe-eventbrite'),  '<a href="'.admin_url('/profile.php').'" target="_blank">'.__('your user profile page', 'tribe-eventbrite').'</a>' ); ?>
    </td>
</tr>
<?php endif; ?>