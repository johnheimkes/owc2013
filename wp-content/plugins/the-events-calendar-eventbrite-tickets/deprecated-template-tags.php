<?php

/**
 * These are for backwards compatibility with the free Event Tickets Pro plugin.
 * Don't use them.
 */

function the_event_ticket_count( $postId = null ) {
  _deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_get_ticket_count()' );
	return tribe_eb_get_ticket_count( $postId );
}

function get_event_id( $postId = null ) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_get_id()' );
	return tribe_eb_get_id( $postId );
}

function is_live_event( $postId = null) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_is_live_event()' );
	return tribe_eb_is_live_event( $postId );
}

function the_eventbrite_ticket_form( $eventId = false, $width = false, $height = false ) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_ticket()' );
	tribe_eb_ticket( $eventId, $width, $height );
}

function the_eventbrite_registration_form( $eventId = false, $width = false, $height = false ) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_registration()' );
	tribe_eb_registration( $eventId, $width, $height );
}

function eventbrite_event_get( $postId = null ) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_event()' );
	tribe_eb_event( $postId );
}

function eventbrite_event_list_attendees($id, $user, $password) {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_eb_event_list_attendees()' );
	tribe_eb_event_list_attendees( $id, $user, $password );
}

function spEBxml2Array($contents, $get_attributes=1, $priority = 'tag') {
	_deprecated_function( __FUNCTION__, '1.0', 'tribe_xml_to_array()' );
	return tribe_xml_to_array( $contents, $get_attributes, $priority );
}