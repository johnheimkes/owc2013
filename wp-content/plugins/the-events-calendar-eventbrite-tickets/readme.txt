=== The Events Calendar: Eventbrite Tickets ===

Contributors: ModernTribe, PaulHughes01, roblagatta, codearachnid, jonahcoyote, peterchester, reid.peifer, shane.pearlman
Tags: widget, events, simple, tooltips, grid, month, list, calendar, event, venue, eventbrite, registration, tickets, ticketing, eventbright, api, dates, date, plugin, posts, sidebar, template, theme, time, google maps, google, maps, conference, workshop, concert, meeting, seminar, summit, forum, shortcode, The Events Calendar, The Events Calendar PRO
Donate link: http://m.tri.be/29
Requires at least: 3.5
Tested up to: 3.6
Stable tag: 3.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Extends The Events Calendar with all the basic Eventbrite controls without ever leaving WordPress.

== Description ==

Looking to track attendees, sell tickets and more? Eventbrite is a free service that provides the full power of a conference ticketing system. This plugin adds the ticket-selling abilities of Eventbrite to your Events Calendar events. You can import Eventbrite events into your calendar, or make events in WordPress and link them to their Eventbrite counterparts. Your users can see tickets right on your event page, and easily buy them through Eventbrite. Don't have an Eventbrite account? No problem, use the following link to set one up: <a href='http://www.eventbrite.com/r/etp'>http://www.eventbrite.com/r/etp</a>.

= The Events Calendar: Eventbrite Tickets =

* Sell tickets from your event's page via Eventbrite
* Create tickets in your WordPress dashboard
* Import Eventbrite events by ID

If you make a new account with Eventbrite, please use our referral code: <a href='http://www.eventbrite.com/r/etp'>http://www.eventbrite.com/r/etp</a>.

For those who want an introduction to how Eventbrite Tickets or the core The Events Calendar works, check out our <a href="http://m.tri.be/39">new user primers.</a>

== Installation ==

= Install =

Just follow these steps:

1. From the dashboard of your site, navigate to Plugins --> Add New.
2. Select the Upload option and hit "Choose File."
3. When the popup appears select the the-events-calendar-eventbrite-tickets.x.x.zip file from your desktop. (The 'x.x' will change depending on the current version number).
4. Follow the on-screen instructions and wait as the upload completes.
5. When it's finished, activate the plugin via the prompt. A message will show confirming activation was successful.
6. For access to new updates, make sure you have added your valid License Key under Events --> Settings --> Licenses.

= Activate =

After downloading and installing the plugin, you'll need to add you Eventbrite User API Key to activate all of the great Eventbrite Tickets features. This is how the system knows to link your WordPress site with your Eventbrite account.

1. Log into <a href="http://www.eventbrite.com/">Eventbrite</a> and navigate to Account –> API User Key.
2. Copy the key to your clipboard and return to the backend of your site.
3. In the WordPress dashboard admin menu, go to Users --> Your Profile
4. Towards the bottom of the profile screen, you’ll see there is a field for your Eventbrite API key that appeared up
activating the add-on. Plug the key in and save.
5. Have every user who will be able to create & edit tickets enter the proper Eventbrite API User key into their account settings (or have an admin do it).

= Requirements =

* WordPress 3.5
* PHP 5.2
* The Events Calendar 3.0 or above

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

== Frequently Asked Questions ==

= Where do I go to file a bug or ask a question? =

Please visit the forum for questions or comments: http://m.tri.be/3a

== Contributors ==

The plugin is produced by <a href="http://m.tri.be/3b">Modern Tribe Inc</a>.

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

* Spanish from Patricio Campos
* German from Jan
* Swedish from Andreas Bodin

* Previous translators include Héctor Gil Rizo, Jurgen Michiels, Petri Kajander and Marco Infussi

== Add-Ons ==

But wait: there's more! We've got a whole stable of plugins available to help you kick ass at what you do. Check out a full list of the products below, and over at the <a href="http://m.tri.be/3c">Modern Tribe website.</a>

Our Free Plugins:

* <a href="http://wordpress.org/extend/plugins/advanced-post-manager/?ref=tec-readme" target="_blank">Advanced Post Manager</a>
* <a href="http://wordpress.org/plugins/blog-copier/?ref=tec-readme" target="_blank">Blog Copier</a>
* <a href="http://wordpress.org/plugins/image-rotation-repair/?ref=tec-readme" target="_blank">Image Rotation Widget</a>
* <a href="http://wordpress.org/plugins/widget-builder/?ref=tec-readme" target="_blank">Widget Builder</a>

Our Premium Plugins:

* <a href="http://m.tri.be/3d">The Events Calendar PRO</a>
* <a href="http://m.tri.be/3f">The Events Calendar: Community Events</a>
* <a href="http://m.tri.be/3e">The Events Calendar: Facebook Events</a>
* <a href="http://m.tri.be/3g">The Events Calendar: WooCommerce Tickets</a>
* The Events Calendar: Filter Bar (coming summer 2013)

== Upgrade Notice ==

This upgrade requires The Events Calendar 3.0+

== Changelog ==


= IMPORTANT NOTICE =

3.0 is a complete overhaul of the plugin, and as a result we're starting the changelog fresh. For release notes from the 2.x lifecycle, see <a href="http://m.tri.be/k">our 2.x release notes.</a>

= 3.0.1 =

* Performance improvements to the plugin update engine

= 3.0 =

Updated version number to 3.0.x for plugin version consistency

= 1.0.7 =

* Fix plugin update system on multisite installations

= 1.0.6 =

*Small features, UX and Content tweaks:*

* Total plugin audit/code review for bugs & incomplete functionality.
* Code modifications to ensure compatibility with The Events Calendar/Events Calendar PRO 3.0.
* Due to a change in the Eventbrite API, Eventbrite events can no longer be deleted on the WordPress side; you can now cancel them on WordPress and must go to Eventbrite.com to truly delete.
* Better handling of cross-time zone imports.
* Ticket sale date range is now limited to times before the event takes place.
* Clarified a couple error/warning messages.
* Incorporated new French translation files, courtesy of Frederic-Xavier DuBois.
* Incorporated new Polish translation files, courtesy of Marek Kosina.
* Incorporated new Swedish translation files, courtesy of Andreas Bodin.

*Bug fixes:*

* Plugin now activates when installed on a site running PHP 5.4 or newer.
* Addressed unstylized text indicating events are in draft format, which impacted certain users.
* PayPal email field now triggers as expected.
* Imported events no longer hide tickets on the WP frontend for certain users.
* Tickets no longer appear listed under Related Events when running on the Events 3.0 codebase.
* Offline payment methods no longer show until an online payment method is selected.
* Removed a dead link from eventbrite-events-table.php.
* Addressed an issue where the admin CSS file wasn't loading properly on certain installations.

= 1.0.5 =

*Small features, UX and Content tweaks:*

(none in this release)

*Bug fixes:*

* Various minor bug fixes.

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