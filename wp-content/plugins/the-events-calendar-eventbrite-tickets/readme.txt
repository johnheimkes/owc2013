=== The Events Calendar: Eventbrite Tickets ===

Contributors: ModernTribe, PaulHughes01, roblagatta, codearachnid, jonahcoyote, peterchester, reid.peifer, shane.pearlman
Tags: widget, events, simple, tooltips, grid, month, list, calendar, event, venue, eventbrite, registration, tickets, ticketing, eventbright, api, dates, date, plugin, posts, sidebar, template, theme, time, google maps, google, maps, conference, workshop, concert, meeting, seminar, summit, forum, shortcode, The Events Calendar, The Events Calendar PRO
Requires at least: 3.3
Tested up to: 3.5
Stable tag: 1.0.5

== Description ==

Looking to track attendees, sell tickets and more? Eventbrite is a free service that provides the full power of a conference ticketing system. This plugin upgrades The Events Calendar with all the basic Eventbrite controls without ever leaving the WordPress post editor. Don't have an Eventbrite account? No problem, use the following link to set one up: <a href='http://www.eventbrite.com/r/etp'>http://www.eventbrite.com/r/etp</a>.

= The Events Calendar: Eventbrite Tickets =

* Sell tickets directly from your post
* MU Compatible
* Many of the amazing features of Eventbrite - directly from WordPress
* Import Eventbrite events by id

If you make a new account with Eventbrite, please use our referral code: <a href='http://www.eventbrite.com/r/etp'>http://www.eventbrite.com/r/etp</a>.

For those who want an introduction to how Eventbrite Tickets or the core The Events Calendar works, check out our <a href="http://tri.be/new-user-primers/?ref=tec-readme">new user primers.</a>

== Installation ==

= Install =

1. Unzip the `the-events-calendar-eventbrite-tickets.zip` file.
2. Upload the `the-events-calendar-eventbrite-tickets` folder (not just the files in it!) to your `wp-contents/plugins` folder.
3. Visit your permalinks settings page so that your permalinks update to ensure that the event-specific rewrite rules take effect.

= Activate =

You will need to input your Eventbrite User API Key into your User Profile.

= Requirements =

* WordPress 3.3
* PHP 5.2
* The Events Calendar 2.0.11 or above

== Documentation ==

= Template Tags =

/**
 * @param int post id (optional if used in the loop)
 * @return int the number of tickets for an event
 */
tribe_eb_get_ticket_count( $postId = null )

/**
 * Returns the event id for the post
 *
 * @param int post id (optional if used in the loop)
 * @return int event id, false if no event is associated with post
 */
tribe_eb_get_id( $postId = null)

/**
 * Determine if an event is live
 *
 * @param int post id (optional if used in the loop)
 * @return boolean
 */
tribe_eb_is_live_event( $postId = null)

/**
 * Outputs the Eventbrite post template.  The post in question must be registered with Eventbrite
 * and must have at least one ticket type associated with the event.
 *
 * @param int post id (optional if used in the loop)
 * @uses views/eventbrite-post-template.php for the HTML display
 * @return void
 */
tribe_eb_event( $postId = null )

/**
 * Returns the Eventbrite attendee data for display
 *
 */
tribe_eb_event_list_attendees($eb_event_id, $ebuser_name, $eb_user_password)

== Screenshots ==
1. Admin interface for adding your first ticket to an Eventbrite event
2. Advanced Eventbrite admin options after saving as draft
3. Eventbrite's ticket widget on frontend

== FAQ ==

= Where do I go to file a bug or ask a question? =

Please visit the forum for questions or comments: http://tri.be/support/forums/forum/events/eventbrite-tickets/

== Contributors ==

The plugin is produced by <a href="http://tri.be/?ref=tec-readme">Modern Tribe Inc</a>.

= Current Contributors =

* <a href="http://profiles.wordpress.org/users/paulhughes01">Paul Hughes</a>
* <a href="http://profiles.wordpress.org/users/codearachnid">Timothy Wood</a>
* <a href="http://profiles.wordpress.org/users/roblagatta">Rob La Gatta</a>
* <a href="http://profiles.wordpress.org/users/jonahcoyote">Jonah West</a>
* <a href="http://profiles.wordpress.org/users/peterchester">Peter Chester</a>
* <a href="http://profiles.wordpress.org/users/reid.peifer">Reid Peifer</a>
* <a href="http://profiles.wordpress.org/users/shane.pearlman">Shane Pearlman</a>

= Past Contributors =

* <a href="http://profiles.wordpress.org/users/jkudish">Joachim Kudish</a>
* <a href="http://profiles.wordpress.org/users/jgadbois">John Gadbois</a>
* Justin Endler

= Translators =

* Spanish from Hector at Signo Creativo
* Dutch from Jurgen Michiels
* Finnish from Petri Kajander
* Italian from Marco Infussi

== Changelog ==

= 1.0.5 = 

Minor tweaks to accommodate release of & ensure smooth integration with The Events Calendar 2.0.11 / Events Calendar PRO 2.0.11.

= 1.0.4 =

*Small features, UX and Content tweaks:*

(none in this release)

*Bug fixes:*

* Fixed an ambiguous error message that appeared when the site failed to connect with Eventbrite. 

= 1.0.3 = 

*Small features, UX and Content Tweaks:*

* Ticket box is now automatically displayed on all Eventbrite events (it previously defaulted to hidden).
* Added new notification that appears upon initial activation, directing users to the new user primer. 
* Ticket-specific field for Eventbrite Tickets is no longer mandatory. 
* Incorporated new Dutch language files, courtesy of Jurgen Michiels. 
* Incorporated new Finnish language files, courtesy of Petri Kajander. 
* Incorporated new Italian language files, courtesy of Marco Infussi. 

*Bug Fixes:*

* Plugin now works with PHP 5.4 and above.
* Dual cost fields (one for Events, the other for Eventbrite) no longer conflict when both are being used on the same event.
* Fixed a bug where, for some users, editing an existing event yielded a slew of Eventbrite-generated notices.

= 1.0.2 =

*Small features, UX and Content Tweaks:*

* Integration with Presstrends (<a href="http://www.presstrends.io/">http://www.presstrends.io/</a>).

*Bug Fixes:*

* Removed unclear/confusing message warning message regarding the need for plugin consistency and added clearer warnings with appropriate links when plugins or add-ons are out date.

= 1.0.1 =

*Small features, UX and Content Tweaks:*

* Incorporated new Spanish translation files, courtesy of Hector at Signo Creativo.
* Added new "Events" admin bar menu with Eventbrite-specific options.

*Bug Fixes:*

* Removed "No Venues/Organizers Found For This User" error when not trying to send a venue/organizer to Eventbrite.
* Added warning message when attempting to begin ticket sales for an Eventbrite event anytime in the past.
* Added proper error messaging when attempting to send country- or state-less events to Eventbrite.

= 1.0 =
Initial release