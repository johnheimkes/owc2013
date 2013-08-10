<?php


/**
 * Get ticket count for event
 *
 * @since 1.0
 * @author jgabois & Justin Endler
 * @param int $postId the event ID (optional if used in the loop)
 * @return int the number of tickets for an event
 */
function tribe_eb_get_ticket_count( $postId = null ) {
	$postId = TribeEvents::postIdHelper( $postId );
	$retval = 0;
	if ( $EventBriteId = get_post_meta( $postId, '_EventBriteId', true ) ) {
		$event = Event_Tickets_PRO::sendEventBriteRequest( 'event_get', 'id=' . $EventBriteId, $postId );
		$retval = count( $event['event']['tickets'] );
	}
	return apply_filters( 'tribe_eb_get_ticket_count', $retval );
}

/**
 * Returns the Eventbrite id for the post/event
 *
 * @since 1.0
 * @author jgabois & Justin Endler
 * @param int $postId the event ID (optional if used in the loop)
 * @return int event id, false if no event is associated with post
 */
function tribe_eb_get_id( $postId = null) {
	return Event_Tickets_PRO::getEventId($postId);
}

/**
 * Determine if an event is live at Eventbrite
 *
 * @since 1.0
 * @author jgabois & Justin Endler
 * @param int $postId the event ID (optional if used in the loop)
 * @return bool true if live
 */
function tribe_eb_is_live_event( $postId = null) {
	return Event_Tickets_PRO::isLive($postId);
}

/**
 * Determine an event's Eventbrite status
 *
 * @since 1.0
 * @author jkudish
 * @param int $postId the event ID (optional if used in the loop)
 * @return string the event status
 */
function tribe_eb_event_status( $postId = null) {
	return Event_Tickets_PRO::getEventStatus($postId);
}


/**
 * Outputs the Eventbrite ticket iFrame. The post in question must be registered with Eventbrite
 * and must have at least one ticket type associated with the event.
 *
 * @since 1.0
 * @author jkudish
 * @param int $postId the event ID (optional if used in the loop)
 * @return void
 */
function tribe_eb_event( $postId = null ) {
	echo Event_Tickets_PRO::eventBriteTicket( $postId );
}

/**
 * Determine whether to show tickets
 *
 * @since 1.0
 * @author jgabois & Justin Endler
 * @param int $postId the event ID (optional if used in the loop)
 * @return bool
 */
function tribe_event_show_tickets( $postId = null ) {
	$postId = TribeEvents::postIdHelper( $postId );
	return apply_filters( 'tribe_event_show_tickets', ( get_post_meta($postId, '_EventShowTickets', true) == 'yes' ) );
}

/**
 * Display the Eventbrite attendee data
 *
 * @todo refactor this function?
 * @since 1.0
 * @author jgabois & Justin Endler
 * @param int $id the Event ID
 * @param object $user the user object
 * @param string $password the password
 * @return void
 */
function tribe_eb_event_list_attendees( $id, $user, $password ) {
	$base_url = "https://www.eventbrite.com/xml/event_list_attendees?" . $this->eventsGetThisEvent() . "&user=".$user."&password=".$password."&id=".$id;
	// Load the XML with a cURL request
	$xml = load_xml($base_url);
	if ($xml->error_message != '') {
		echo $xml->error_message;
	} else {
		$cnt = count($xml->attendee);

		echo '<p>For a detailed list of attendees, visit Eventbrite.</p><table class="EB-table" border="0"><tr><td width="120px">Attendee</td><td width="95px">Paid</td><td width="40px">Qty</td><td width="80px">Purchase Date</td></tr>';

		for($i=0; $i<$cnt; $i++) {
			$firstname 	= $xml->attendee[$i]->first_name;
			$lastname 	= $xml->attendee[$i]->last_name;
			$email 	= $xml->attendee[$i]->email;
			$quantity 	= $xml->attendee[$i]->quantity;
			$created 	= date_create($xml->attendee[$i]->created);
			$currency 	= $xml->attendee[$i]->currency;
			$amount_paid 	= $xml->attendee[$i]->amount_paid;

			echo '<tr><td><a href="mailto:'.$email.'">'.$firstname.'&nbsp;'.$lastname.'</a></td><td>'.$currency.' '.$amount_paid.'</td><td>'.$quantity.'</td><td>'.date_format($created,__("m.d.Y", Event_Tickets_PRO::$pluginDomain)).'</td></tr>';
		}
		echo "</table>";
	}
}
?>