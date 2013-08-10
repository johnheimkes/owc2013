<?php

/**
 * These are for backwards compatibility with the free Event Tickets Pro plugin.
 * Don't use them.
 */

/**
 * get an event's ticket count
 * @deprecated
 * @param  int $postId
 * @return int
 */
function the_event_ticket_count( $postId = null ) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_get_ticket_count()' );
	return tribe_eb_get_ticket_count( $postId );
}

/**
 * get an EventBrite event id
 * @deprecated
 * @param  int $postId
 * @return int
 */
function get_event_id( $postId = null ) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_get_id()' );
	return tribe_eb_get_id( $postId );
}

/**
 * checks to see if event is live
 * @deprecated
 * @param  int $postId
 * @return boolean
 */
function is_live_event( $postId = null) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_is_live_event()' );
	return tribe_eb_is_live_event( $postId );
}

/**
 * display the EventBrite ticket form html
 * @deprecated
 * @param  boolean $eventId
 * @param  boolean $width
 * @param  boolean $height
 * @return void
 */
function the_eventbrite_ticket_form( $eventId = false, $width = false, $height = false ) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_ticket()' );
	tribe_eb_ticket( $eventId, $width, $height );
}

/**
 * display the EventBrite registration form html
 * @param  boolean $eventId
 * @param  boolean $width
 * @param  boolean $height
 * @return void
 * @deprecated
 */
function the_eventbrite_registration_form( $eventId = false, $width = false, $height = false ) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_registration()' );
	tribe_eb_registration( $eventId, $width, $height );
}

/**
 * display the EventBrite event html
 * @param  [type] $postId
 * @return void
 * @deprecated
 */
function eventbrite_event_get( $postId = null ) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_event()' );
	tribe_eb_event( $postId );
}

/**
 * display the EventBrite attendees list html
 * @param  [type] $id
 * @param  [type] $user
 * @param  [type] $password
 * @return void
 * @deprecated
 */
function eventbrite_event_list_attendees($id, $user, $password) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_event_list_attendees()' );
	tribe_eb_event_list_attendees( $id, $user, $password );
}

/**
 * convert the EventBrite response XML to a php Array
 * @param  string $contents
 * @param  integer $get_attributes
 * @param  string  $priority
 * @return array
 * @deprecated
 */
function spEBxml2Array($contents, $get_attributes=1, $priority = 'tag') {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_xml_to_array()' );
	return tribe_xml_to_array( $contents, $get_attributes, $priority );
}
?>