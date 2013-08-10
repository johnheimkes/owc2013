<?php
/**
 * Ticket Form Module Template
 * Render the EventBrite ticket form.
 *
 * This view contains the filters required to create an effective ticket form module view.
 *
 * You can recreate an ENTIRELY new ticket form module by doing a template override, and placing
 * a ticket-form.php file in a tribe-events/eventbrite/modules/ directory within your theme directory, which
 * will override the /views/eventbrite/modules/ticket-form.php. 
 *
 * You can use any or all filters included in this file or create your own filters in 
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters (TO-DO)
 *
 * @package TribeEventsEventBrite
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

// Start ticket form template
echo apply_filters( 'tribe_events_eventbrite_before_the_tickets', '', get_the_ID() );

echo apply_filters( 'tribe_events_eventbrite_the_tickets', '', get_the_ID() );

// End ticket form template
echo apply_filters( 'tribe_events_eventbrite_after_the_tickets', '', get_the_ID() );