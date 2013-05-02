<?php
/*
 Plugin Name: The Events Calendar: Eventbrite Tickets
 Description: Looking to track attendees, sell tickets and more? Eventbrite is a free service that provides the full power of a conference ticketing system. This plugin extends Events Calendar with all the basic Eventbrite controls without ever leaving WordPress. In the absence of Events Calendar, this plugin provides interfaces to easily insert Eventbrite widgets into posts, the sidebar, or anywhere in your template files. Don't have an Eventbrite account? No problem, use the following link to set one up: <a href='http://www.eventbrite.com/r/etp'>http://www.eventbrite.com/r/etp</a>
 Version: 1.0.5
 Author: Modern Tribe, Inc.
 Author URI: http://www.tri.be
 Text Domain: 'tribe-eventbrite'
 License: GPLv2 or later
*/

/*
Copyright 2009-2012 by Modern Tribe Inc and the contributors

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/**
 * bootstrap
 */
define('EVENTBRITE_PLUGIN_FILE', __FILE__);
include_once('tribe-eventbrite.class.php');
include_once('template-tags.php');
include_once('eventbrite-api.class.php');
include_once('tribe-presstrends-eventbrite.php');
Event_Tickets_PRO::instance();


/**
 * activation hook
 */
register_activation_hook(__FILE__, 'event_tickets_pro_activate');
function event_tickets_pro_activate() {
	include_once('tribe-eventbrite.class.php');
	include_once('template-tags.php');
	include_once('eventbrite-api.class.php');
	Event_Tickets_PRO::instance();
}