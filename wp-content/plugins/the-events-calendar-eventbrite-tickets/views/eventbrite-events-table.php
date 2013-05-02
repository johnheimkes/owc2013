<?php if( $event['event']['status'] == 'Draft' && count( $event['event']['tickets'] ) > 0 && $tribe_ecp ) : ?>
	<div id='eventBriteDraft' class='update'>
		<p><?php _e('Eventbrite status is set to DRAFT. You can update this in the \'Eventbrite Information\' section further down this page.'); ?>
	</div>
<?php endif; ?>
<?php if ( ( !isset( $event['event']['tickets'] ) || !count( $event['event']['tickets'] ) ) && ( !isset( $event['event']['status'] ) || $event['event']['status'] != 'Draft' ) ) : ?>
	<div id='eventBriteDraft' class='error'>
      <p><?php _e('You did not create any tickets for your event.  You will not be able to publish this event on Eventbrite unless you first add a ticket at Eventbrite.com.'); ?></p>
	</div>
<?php endif; ?>

<tr>
	<td colspan="2" class="snp_sectionheader">
		<h4><?php _e('Eventbrite Information', 'tribe-eventbrite'); ?></h4>
	</td>
</tr>
<tr id="eventbrite-id-table">
	<td width="125">
		<?php _e('Eventbrite Event ID:','tribe-eventbrite'); ?>
	</td>
	<td>
		<a target="_blank" href="http://www.eventbrite.com/edit?eid=<?php echo $event['event']['id']; ?>&ref=etckt"><?php echo $event['event']['id']; ?></a>
	</td>
</tr>
<tr>
	<td>
		<?php _e('Eventbrite Event Status:', 'tribe-eventbrite'); ?>
	</td>
	<td>
	<?php if ( in_array( $event['event']['status'], array( 'Live', 'Canceled', 'Deleted' ) ) || count( $event['event']['tickets'] ) > 0 ) : ?>
		<?php if( $tribe_ecp ) : ?>
			<select name="EventBriteStatus" tabindex="<?php $tribe_ecp->tabIndex(); ?>">
		<?php else : ?>
			<select name="EventBriteStatus">
		<?php endif; ?>
				<option value='Draft' <?php selected($event['event']['status'], 'Draft') ?>><?php _e('Draft', 'tribe-eventbrite'); ?></option>
				<option value='Live' <?php selected($event['event']['status'], 'Live') ?>><?php _e('Live', 'tribe-eventbrite'); ?></option>
				<?php if ($event['event']['status'] != 'Draft') :  ?>
					<option value='Canceled' <?php selected($event['event']['status'], 'Canceled') ?>><?php _e('Canceled (this will cancel the event at Eventbrite)', 'tribe-eventbrite'); ?></option>
					<option value='Deleted' <?php selected($event['event']['status'], 'Deleted') ?>><?php _e('Deleted (this will delete the event from Eventbrite & unregister this event with Eventbrite)', 'tribe-eventbrite'); ?></option>
				<?php endif; ?>
			</select>
		<?php else : ?>
			<p><?php _e( 'This event was created without a ticket. You need to create a ticket before you can change this event\'s status.', 'tribe-eventbrite' ); ?> <a href="http://www.eventbrite.com/myevent?eid=<?php echo $_EventBriteId; ?>&ref=etckt"><?php _e('Manage Event', 'tribe-eventbrite'); ?> &raquo;</a></p>
		<?php endif ?>
	</td>
</tr>
<?php if ( $event['event']['status'] != 'Draft' || count( $event['event']['tickets'] ) > 0 ) : ?>
	<tr class="EBForm">
		<td></td>
		<td class="snp_message"><small><strong><?php _e('Note', 'tribe-eventbrite') ?>:</strong> <?php _e('Cancelling or deleting the event from Eventbrite cannot be undone') ?></small></td>
	</tr>
<?php endif; ?>
<?php if ( isset($event['event']['tickets']) && count( $event['event']['tickets'] )) : ?>
	<?php
	$ebTecMultipleCosts = false;
	$ebTecLastPrice = isset($event['event']['tickets'][0]['price']) ? $event['event']['tickets'][0]['price'] : null;
	?>
	<tr>
		<td colspan="2" class="snp_sectionheader">
			<h4><?php _e('Associated Tickets:', 'tribe-eventbrite'); ?></h4>
			<p><?php _e('The following Eventbrite tickets are associated to this event', 'tribe-eventbrite') ?></p>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="snp_sectionheader">
			<table class="EB-table" border=0><tr><td width="120px"><?php _e('Ticket', 'tribe-eventbrite'); ?></td><td width="85px">Cost</td><td width="40px"><?php _e('Sold', 'tribe-eventbrite'); ?></td><td width="40px"><?php _e('Available', 'tribe-eventbrite'); ?></td><td width="100px"><?php _e('End Sales', 'tribe-eventbrite'); ?></td></tr>
			<?php foreach( (array)$event['event']['tickets'] as $ticket ) : ?>
				<?php
				if( !$ebTecMultipleCosts ) {
					$ebTecMultipleCosts = ( $ticket['price'] == $ebTecLastPrice ) ? false : true;
					$ebTecLastPrice = $ticket['price'];
				}
				?>
				<tr>
					<td><a href="<?php echo esc_url($event['event']['url']); ?>" target="_blank"><?php echo stripslashes($ticket['name']); ?></a></td>
					<td><?php echo $ticket['currency']; ?> <?php echo $ticket['price']; ?></td>
					<td><?php echo $ticket['quantity_sold']; ?></td>
					<td><?php echo $ticket['quantity_available']; ?></td>
					<td><?php echo date('Y-m-d', strtotime($ticket['end_date'])); ?></td>
				</tr>
			<?php endforeach; ?>
				<tr>
					<td>
						<a id="edit-ticket" href="<?php echo esc_url('http://www.eventbrite.com/myevent?eid='.$event['event']['id'].'/#viewtickets') ?>"><?php _e('Edit existing tickets', 'tribe-eventbrite') ?></a><br>
						<a id="new-ticket" href="<?php echo esc_url('http://www.eventbrite.com/edit?eid='.$event['event']['id'].'/#ticket_link') ?>">+ <?php _e('Create a new ticket', 'tribe-eventbrite') ?></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<?php elseif ( !isset( $event['event']['status'] ) || $event['event']['status'] != 'Draft' ) : ?>
	<tr>
		<td colspan="2" class="snp_sectionheader">
			<h4><?php _e('There are no tickets associated with this event!','tribe-eventbrite'); ?></h4>
         <div style='color:red'><?php _e('You cannot publish this event in Eventbrite unless you first add a ticket on Eventbrite.com.','tribe-eventbrite'); ?></div>
		</td>
	</tr>
<?php endif; ?>
<tr>
	<td colspan="2" class="snp_sectionheader">
		<h4><?php _e('Eventbrite Shortcuts:','tribe-eventbrite'); ?></h4>
	</td>
</tr>
<tr>
	<td colspan="2">
		<ul class='event_links'>
			<li><a href="http://www.eventbrite.com/myevent?eid=<?php echo $_EventBriteId; ?>&ref=etckt"><?php _e('Manage my Event', 'tribe-eventbrite'); ?></a></li>
			<li><a href="http://www.eventbrite.com/discounts?eid=<?php echo $_EventBriteId; ?>&ref=etckt"><?php _e('Manage Discounts', 'tribe-eventbrite'); ?></a></li>
			<li><a href="http://www.eventbrite.com/attendees?eid=<?php echo $_EventBriteId; ?>&ref=etckt"><?php _e('Manage Attendees', 'tribe-eventbrite'); ?></a></li>
			<li><a href="http://www.eventbrite.com/attendees-email?eid=<?php echo $_EventBriteId; ?>&ref=etckt"><?php _e('Email Attendees', 'tribe-eventbrite'); ?></a></li>
			<li><a href="http://www.eventbrite.com/attendees-badges?eid=<?php echo $_EventBriteId; ?>&ref=etckt"><?php _e('Print Badges', 'tribe-eventbrite'); ?></a></li>
			<li><a href="http://www.eventbrite.com/attendees-list?eid=<?php echo $_EventBriteId; ?>&ref=etckt"><?php _e('Print Check-In List', 'tribe-eventbrite'); ?></a></li>
		</ul>
	</td>
</tr>
