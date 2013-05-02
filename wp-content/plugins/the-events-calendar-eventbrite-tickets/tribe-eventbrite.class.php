<?php

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }


if ( !class_exists( 'Event_Tickets_PRO' ) ) {

	/**
	 * Event_Tickets_PRO main class
	 *
	 * @package Event_Tickets_PRO
	 * @since  1.0
	 * @author Modern Tribe Inc.
	 */
	class Event_Tickets_PRO {

		/**************************************************************
		 * EventBrite Configuration
		 **************************************************************/
		const REQUIRED_TEC_VERSION = '2.0.11';
		protected static $instance;
		public static $errors;
		public static $eventBritePrivacy	= 0;
		public static $eventBriteTimezone;
		public static $eventBriteTransport; // https if supported, otherwise http
		public static $pluginDir;
		public static $pluginVersion = '1.0.5';
		public $pluginPath;
		public $pluginUrl;
		public $pluginSlug;
		public $slug; //PUE uses slug vs. pluginSlug
		public $licenseKey;
		public static $updateUrl = 'http://tri.be/';
	//	private static $appKey 			= 'Y2IxNTIzN2ZmNmQw';

		public static $metaTags = array(
			'_EventBriteId',			// ID in Eventbrite of this event
			'_EventBriteTicketName',
			'_EventBriteTicketDescription',
			'_EventBriteTicketStartDate',
			'_EventBriteTicketStartHours',
			'_EventBriteTicketStartMinutes',
			'_EventBriteTicketStartMeridian',
			'_EventBriteTicketEndDate',
			'_EventBriteTicketEndHours',
			'_EventBriteTicketEndMinutes',
			'_EventBriteTicketEndMeridian',
			'_EventBriteIsDonation',
			'_EventBriteTicketQuantity',
			'_EventBriteIncludeFee',
			'_EventBriteStatus',
			'_EventBriteEventCost',
			'_EventRegister',
			'_EventShowTickets',
			'_EventBritePayment_accept_online',
			'_EventBritePayment_accept_paypal',
			'_EventBritePayment_paypal_email',
			'_EventBritePayment_accept_google',
			'_EventBritePayment_google_merchant_id',
			'_EventBritePayment_google_merchant_key',
			'_EventBritePayment_accept_check',
			'_EventBritePayment_instructions_check',
			'_EventBritePayment_accept_cash',
			'_EventBritePayment_instructions_cash',
			'_EventBritePayment_accept_invoice',
			'_EventBritePayment_instructions_invoice'
		);


		/**
		 * inforce singleton factory method
		 *
		 * @since 1.0
		 * @author jkudish
		 * @return void
		 */
		public static function instance() {
			if (!isset(self::$instance)) {
				$className = __CLASS__;
				self::$instance = new $className;
			}
			return self::$instance;
		}

		/**
		 * checks whether the The Events Calendar 2.0 or higher is active
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @return bool
		 */
		public static function tecActive() {
			return class_exists( 'TribeEvents' ) && defined('TribeEvents::VERSION') && version_compare( TribeEvents::VERSION, '2.0', '>=');
		}

		/**
		 * class constructer
		 * init necessary functions
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		function __construct() {
			// set internal variables
			$this->pluginDir = apply_filters('tribe_eb_plugindir', basename( dirname(__FILE__) ));
			$this->pluginFile = apply_filters('tribe_eb_pluginfile', trailingslashit( $this->pluginDir ) . 'tribe-eventbrite.php' );
			$this->pluginPath =  apply_filters('tribe_eb_pluginpath', trailingslashit( dirname(__FILE__) ));
			$this->pluginUrl =  apply_filters('tribe_eb_pluginurl', plugins_url( '', __FILE__ ));
			$this->pluginSlug =  'tribe-eventbrite'; // we don't want anyone to filter this as it's used for PUE
			$this->slug = $this->pluginSlug;
			$this->install_key = apply_filters('tribe_eb_install_key', get_option( 'pue_install_key_tribe-eventbrite' ));

			// Tribe common resources
			require_once( 'vendor/tribe-common-libraries/tribe-common-libraries.class.php' );
			TribeCommonLibraries::register( 'pue-client', '1.2', $this->pluginPath . 'vendor/pue-client/pue-client.php' );

			// bootstrap plugin
			self::loadDomain();
			add_action( 'plugins_loaded', array( $this, 'addActions' ) );
			add_action( 'plugins_loaded', array( $this, 'addFilters' ) );

		}

		/**
		 * echo admin error if/when TEC is not active
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function noECPError() {
			$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';
			$title = __( 'The Events Calendar', 'tribe-events-community' );
			echo '<div class="error"><p>' . sprintf( __( 'To begin using The Events Calendar: Eventbrite Tickets, please install the latest version of <a href="%s" class="thickbox" title="%s">The Events Calendar</a>.', 'tribe-events-community' ), $url, $title ) . '</p></div>';
		}
		
		/**
		 * Add Eventbrite Tickets to the list of add-ons to check required version.
		 *
		 * @author PaulHughes01
		 * @since 1.0.1
		 * @return array $plugins the existing plugins
		 * @return array the pluggins
		 */
		public function init_addon( $plugins ) {
			$plugins['TribeEB'] = array( 'plugin_name' => 'The Events Calendar: Eventbrite Tickets', 'required_version' => Event_Tickets_PRO::REQUIRED_TEC_VERSION, 'current_version' => self::$pluginVersion, 'plugin_dir_file' => basename( dirname( __FILE__ ) ) . '/tribe-eventbrite.php'  );
			return $plugins;
		}

		/**
		 * run all WordPress action hooks
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function addActions() {

			if ( !$this->tecActive() ) {
				add_action( 'admin_notices', array( $this, 'noECPError' ) );
			} else {
				add_action( 'admin_enqueue_scripts' , array( $this, 'adminEnqueue' ));
				add_action( 'admin_menu', array( $this, 'addOptionsPage' ) );
				add_action( 'tribe_events_options_bottom', array( $this, 'eventBriteOptions' ) );
				add_action( 'tribe_events_update_meta', array( $this, 'eventbrite_details' ), 20 );
				add_action( 'tribe_events_update_meta', array( $this, 'addEventMeta' ), 10, 2 );
				add_action( 'tribe_events_event_clear', array( $this, 'clear_details' ) );
				add_action( 'show_user_profile',array( $this, 'userProfilePage' ) );
				add_action( 'edit_user_profile',array( $this, 'userProfilePage' ) );
				add_action( 'edit_user_profile_update', array( $this, 'userProfileUpdate' ) );
				add_action( 'personal_options_update', array( $this, 'userProfileUpdate' ) );
				add_action( 'tribe_events_cost_table', array( $this, 'eventBriteMetaBox'), 1 );
				add_action( 'admin_init', array( $this, 'prepopulateEventBrite') );
				add_action( 'admin_notices', array( $this, 'activationMessage') );
				add_action( 'tribe_helper_activation_complete', array($this, 'helpersLoaded') );
				add_action( 'wp_before_admin_bar_render', array( $this, 'addEventbriteToolbarItems' ), 20 );
				add_filter( 'tribe_tec_addons', array( $this, 'init_addon' ) );
				add_action( 'plugin_action_links_' . trailingslashit( $this->pluginDir ) . 'tribe-eventbrite.php', array( $this, 'addLinksToPluginActions' ) );
				add_action( 'tribe_eventbrite_before_integration_header', array( $this, 'addEventbriteLogo' ) );
				if ( tribe_get_option( 'sendPressTrendsData', false ) ) {
					add_action('admin_init', 'presstrends_plugin_tribe_eventbrite');
				}
			}
		}

		/**
		 * pre-populates an event with Eventbrite info
		 * shows an error on failure
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function prepopulateEventBrite() {

			if ( current_user_can( 'publish_tribe_events' ) && !empty( $_GET['import_eventbrite'] ) && wp_verify_nonce( $_GET['import_eventbrite'], 'import_eventbrite') && !empty( $_GET['eventbrite_id'] ) ) {
				try {
					$event_id = self::importExistingEvent();
					wp_redirect(admin_url('post.php?post=' . $event_id . '&action=edit'));
					exit();
				} catch ( TribeEventsPostException $e ) {
					wp_redirect( admin_url('edit.php?post_type=tribe_events&page=import-eventbrite-events&error=' . urlencode( $e->getMessage() ) ) );
					exit();
				}
			}
		}

		/**
		 * run all WordPress filter hooks
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function addFilters() {
			add_filter( 'tribe_get_ticket_form', array( $this, 'displayEventBriteTicketForm' ) );
			add_filter( 'tribe_general_settings_tab_fields', array( $this, 'addEventbriteSettings' ) );
			add_filter( 'tribe_help_tab_forums_url', array( $this, 'helpTabForumsLink' ), 100 );
		}

		/**
		 * load plugin text domain
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function loadDomain() {
			load_plugin_textdomain( 'tribe-eventbrite', false, basename( dirname(__FILE__) ) . '/lang/');
		}

		/**
		 * enqueue scripts & styles in the admin
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function adminEnqueue() {
			wp_enqueue_style( 'tribe-eventbrite-admin', plugins_url('/resources/eb-tec-admin.css', __FILE__), array(), self::$pluginVersion );
		}

		/**
		 * add view for profile fields
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @param stdClass $profileuser the user object being modified
		 * @return void
		 */
		public function userProfilePage( $profileuser ) {
			if ( !defined('EventBriteProfileDone') ) {
				define('EventBriteProfileDone', 1);
				include_once('views/user-profile.php');
			}
		}

		/**
		 * save function for profile updates
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @param int $user_id the user ID to save
		 * @return void
		 */
		public function userProfileUpdate( $user_id ) {
			if ( !defined('EventBriteProfileUpdated') ) {
				define('EventBriteProfileUpdated', 1);
				if ( isset( $_POST['eventbrite_user_key'] ) ) {
					update_user_meta( $user_id, 'eventbrite_user_key', $_POST['eventbrite_user_key'] );
					update_option('tribe_eb_activated', true);
				}
			}
		}

		/**
		 * displays the existing Eventbrite event (admin fields)
		 * when editing an event if an _EventBriteId is present
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function displayExistingEventToggle() {
			global $post;
			$tribe_ecp = TribeEvents::instance();
			$_EventBriteId = get_post_meta( $post->ID, '_EventBriteId', true );
			include_once('views/add-existing-event.php');
		}


		/**
		 * saves the meta when creating an Eventbrite event
		 *
		 * @since  1.0
		 * @author jgabois & Justin Endler
		 * @param int $postId the ID of the event being edited
		 * @uses $_POST
		 * @return void
		 */
		public function addEventMeta( $postId, $data = array() ) {

			$data = array_merge( $_REQUEST, $data );

			if ( ( isset($data['EventRegister']) && $data['EventRegister'] == 'yes' && !get_post_meta( $postId, '_EventRegister', true) ) || ( isset($data['existingEBEvent']) && $data['existingEBEvent'] == 'yes' && isset($data['ExistingEventId']) && $data['ExistingEventId'] ) ) {
				if ( isset( $data['existingEBEvent'] ) && $data['existingEBEvent'] == 'yes' && isset( $data['ExistingEventId'] ) && $data['ExistingEventId'] ) update_post_meta( $postId, '_EventBriteId', $data['ExistingEventId'] );
				// ignore these keys
				$notFromEventBriteForm = array(
											'_EventBriteId',
											'_EventBriteStatus'
										 );
				foreach( self::$metaTags as $key ) {
					// the added test here should prevent overwriting of post meta fields on event update
					if ( in_array( $key, $notFromEventBriteForm ) ) continue;
					if ( isset( $data['key'] ) ) {
						$postVarKey = substr_replace( $key, '', 0, 1);
						update_post_meta( $postId, $key, $data[$postVarKey] );
					}
				}

			}

			if ( isset( $data['EventShowTickets'] ) ) {
				update_post_meta( $postId, '_EventShowTickets', $data['EventShowTickets'] );
			} elseif ( !isset( $data['EventShowTickets'] ) && tribe_get_option( 'eventbrite_display_tickets', false ) ) {
				update_post_meta( $postId, '_EventShowTickets', 'yes' );
			}

			if ( !isset( $data['EventRegister'] ) || empty( $data['EventRegister'] ) ) {
				delete_post_meta( $postId, '_EventRegister' );
			}

		}

		/**
		 * Updates the Eventbrite information in WordPress and makes the
		 * API calls to EventBrite to update the listing on their side
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @link http://www.eventbrite.com/api/doc/
		 * @param int $postId the ID of the event being edited
		 * @uses $_POST
		 * @return void
		 */
		public function eventbrite_details( $postId ) {

 	    // clear out event brite if no longer stored together
			if ( !isset( $_POST['EventRegister'] ) || $_POST['EventRegister'] != 'yes' ) {
				self::clear_details( $postId );
				return;
			}

	    // if already saved, return
			if ( isset($_POST['existingEBEvent']) && $_POST['existingEBEvent'] == 'yes' && isset($_POST['ExistingEventId']) && $_POST['ExistingEventId'] )
				return;

			// save the sent fields (flushed on page reload)
			delete_post_meta( $postId, 'tribe-eventbrite-saved-data' ); // precaution
			$sent_fields = array();
			foreach (self::$metaTags as $tag) {
				$post_tag = substr( $tag, 1 );
				$sent_fields[$tag] = isset( $_POST[$post_tag] ) ? $_POST[$post_tag] : null;
			}
			add_post_meta( $postId, 'tribe-eventbrite-saved-data', $sent_fields );

			// create new EB event
			if ( (!isset($EventBriteId) || !$EventBriteId) && $_POST['EventRegister'] ) {

				// check state + country
				$country = self::get_country_code( $postId );
				$venue_id = tribe_get_venue_id( $postId );
				if ( empty( $country ) ) {
					$message = __( 'Eventbrite requires that the venue have a country.', 'tribe-eventbrite' );
					$message .= '<br><strong>' . __( 'Please adjust the venue and try saving again.', 'tribe-eventbrite' );
					$message .= ( class_exists('TribeEventsPro') && !empty( $venue_id ) ) ? ' <a target="_blank" href="' . get_edit_post_link( $venue_id ) . '">' . __('Edit the venue', 'tribe-eventbrite') . ' &raquo;</a></strong>' : '</strong>';
					throw new TribeEventsPostException( $message );
					return;
				}
				if ( $country == 'US' ) {
					$region = self::get_region( $postId );
					if ( !$region ) {
						$message = __( 'Eventbrite requires that United States addresses include the state.', 'tribe-eventbrite' );
						$message .= '<br><strong>' . __( 'Please adjust the venue and try saving again.', 'tribe-eventbrite' ) . '</strong>';
						throw new TribeEventsPostException( $message );
						return;
					}
				}

				// make sure all required fields are present
				$required_fields = array(
					'EventBriteTicketName' => __('Ticket Name', 'tribe-eventbrite'),
					'EventBriteTicketStartDate' => __('Date to Start Ticket Sales', 'tribe-eventbrite'),
					'EventBriteTicketEndDate' => __('Date to End Ticket Sales', 'tribe-eventbrite'),
					'EventBriteIsDonation' => __('Ticket Type', 'tribe-eventbrite'),
					'EventBriteEventCost' => __('Ticket Cost', 'tribe-eventbrite'),
					'EventBriteTicketQuantity' => __('Ticket Quantity', 'tribe-eventbrite'),
					'EventBriteIncludeFee' => __('Ticket - Include Fee in Price', 'tribe-eventbrite'),
				);

				$missing_fields = array();
				$sent_fields = array();

				foreach ($required_fields as $required_field_key => $required_field_name) {
					if ( !isset( $_POST[$required_field_key] ) || '' == $_POST[$required_field_key] || null == $_POST[$required_field_key] ) {
						$missing_fields[$required_field_key] = $required_field_name;
					}
				}

				// if all fields are missing, assume the fields weren't meant to be filled out
				if ( count($missing_fields) != count($required_fields) ) {


					// if ticket type is set to Donation or Free, allow cost to be set to null
					if ( isset( $_POST['EventBriteIsDonation'] ) && 0 != $_POST['EventBriteIsDonation'] ) {
						if ( isset( $missing_fields['EventBriteEventCost'] ) ) unset( $missing_fields['EventBriteEventCost'] );
					} elseif ( isset( $_POST['EventBriteEventCost'] ) && !is_numeric( $_POST['EventBriteEventCost'] ) ) {
						$missing_fields['EventBriteEventCost'] = __('Ticket Cost (must be numeric)', 'tribe-eventbrite');
					}

					// if ticket type is set to free, fee inclusion to be set to null
					if ( isset( $_POST['EventBriteIsDonation'] ) && 2 == $_POST['EventBriteIsDonation'] ) {
						if ( isset( $missing_fields['EventBriteIncludeFee'] ) ) unset( $missing_fields['EventBriteIncludeFee'] );
					}

					// assuming a non-free ticket make sure at least one payment method is set
					if ( isset( $_POST['EventBriteIsDonation'] ) ) {
						if ( 2 != $_POST['EventBriteIsDonation'] ) {
							if ( !isset( $_POST['EventBritePayment_accept_online'] ) || !in_array( $_POST['EventBritePayment_accept_online'], array( 'paypal', 'google' ) ) &&
									( !isset( $_POST['EventBritePayment_accept_check'] ) || 1 != $_POST['EventBritePayment_accept_check'] ) &&
									( !isset( $_POST['EventBritePayment_accept_cash'] ) || 1 != $_POST['EventBritePayment_accept_cash'] ) &&
									( !isset( $_POST['EventBritePayment_accept_invoice'] ) || 1 != $_POST['EventBritePayment_accept_invoice'] )
							 ) {
								$missing_fields['payment_method'] = __( 'Ticket Payment Methods (at least one should be selected)', 'tribe-eventbrite' );
							}
						}
					}

					// if paypal is set to true and event is not free, make sure the email came along
					if ( isset( $_POST['EventBritePayment_accept_online'] ) && 'paypal' == $_POST['EventBritePayment_accept_online'] && 2 != $_POST['EventBriteIsDonation'] ) {
						if ( empty( $_POST['EventBritePayment_paypal_email'] ) ) {
							$missing_fields['_EventBritePayment_paypal_email'] = __('Ticket - Paypal Account Email Address', 'tribe-eventbrite');
						} elseif ( !is_email( $_POST['EventBritePayment_paypal_email'] ) ) {
							$missing_fields['_EventBritePayment_paypal_email'] = __('Ticket - Paypal Account Email Address (must be a valid email address)', 'tribe-eventbrite');
						}
					}

					// if google payments is set to true and event is not free, make sure the google API info came along
					if ( isset( $_POST['EventBritePayment_accept_online'] ) && 'google' == $_POST['EventBritePayment_accept_online'] && 2 != $_POST['EventBriteIsDonation'] ) {
						if ( empty( $_POST['_EventBritePayment_google_merchant_id'] ) ) {
							$missing_fields['EventBritePayment_google_merchant_id'] = __('Ticket - Google Merchant ID', 'tribe-eventbrite');
						}
						if ( empty( $_POST['EventBritePayment_google_merchant_key"'] ) ) {
							$missing_fields['EventBritePayment_google_merchant_key"'] = __('Ticket - Google Merchant Key', 'tribe-eventbrite');
						}
					}

					if ( !empty($missing_fields) ) {
						$message = __('All required fields must be filled out correctly in order for this event to be associated to Eventbrite. The following required fields were not filled out (or not correctly):', 'tribe-eventbrite').'<br>';
						foreach ($missing_fields as $missing_field_key => $missing_field_name) {
							$message .= '<span class="admin-indent">'.$missing_field_name.'</span><br>';
						}
						$message .= '<strong>'.__('Please fill in the missing fields and try saving again.', 'tribe-eventbrite').'</strong>';
						throw new TribeEventsPostException( $message );
						return;
					}

				}

				// check the dates of the ticket
				if ( isset( $_POST['EventBriteTicketStartDate'] ) ) {
					$date_errors = array();
					$event_start_date = strtotime( get_post_meta( $postId, '_EventStartDate', true ) );
					$event_end_date = strtotime( get_post_meta( $postId, '_EventEndDate', true ) );
					$ticket_start = $_POST['EventBriteTicketStartDate'] . ' ' . $_POST['EventBriteTicketStartHours'] . ':' . $_POST['EventBriteTicketStartMinutes'];
					$ticket_start .= ( isset( $_POST['EventBriteTicketStartMeridian'] ) ) ? $_POST['EventBriteTicketStartMeridian'] : null;
					$ticket_start_timestamp = strtotime( $ticket_start );
					$ticket_end = $_POST['EventBriteTicketEndDate'] . ' ' . $_POST['EventBriteTicketEndHours'] . ':' . $_POST['EventBriteTicketEndMinutes'];
					$ticket_end .= ( isset( $_POST['EventBriteTicketEndMeridian'] ) ) ? $_POST['EventBriteTicketEndMeridian'] : null;
					$ticket_end_timestamp = strtotime( $ticket_end );

					if ( $ticket_start_timestamp > $event_end_date ) {
						$date_errors[] = __( 'Ticket sales start date cannot be after the event ends', 'tribe-eventbrite' );
					}

					if ( $ticket_end_timestamp > $event_end_date ) {
						$date_errors[] = __( 'Ticket sales end date cannot be after the event ends', 'tribe-eventbrite' );
					}

					if ( $ticket_start_timestamp > $ticket_end_timestamp ) {
						$date_errors[] = __( 'Ticket sales start date cannot be after ticket sales end date', 'tribe-eventbrite' );
					}

					if ( !empty( $date_errors ) ) {
						$message = __( 'The dates you have chosen for your ticket sales are inconsistent', 'tribe-eventbrite' ).':<br>';
							foreach ( $date_errors as $error_messsage ) {
								$message .= '<span class="admin-indent">' . $error_messsage . '</span><br>';
							}
							$message .= '<strong>' . __( 'Please adjust the dates and try saving again.', 'tribe-eventbrite' ) . '</strong>';
							throw new TribeEventsPostException( $message );
							return;
					}
				}

	     	// get event brite id
				$EventBriteId = get_post_meta( $postId, '_EventBriteId', true );
				// update existing EB event
				if ( $EventBriteId ) {
					self::event_update( $postId, $EventBriteId, $_POST );
					return;
				}

				$tribe_ecp = TribeEvents::instance();
				$eventId = self::event_new( $postId, $_POST );

				if ( $eventId ) {
					do_action('tribe_eb_after_event_creation', $eventId, $venue_id, $organizer_id, $postId, $_POST); // allow other plugins to hook in here
					self::ticket_new( $postId, $eventId, $_POST ); // create tickets
					self::payment_update( $postId, $eventId, $_POST ); // payment updates
					self::eventLiveAfterSubmission( $postId, $eventId, $_POST ); // if the status was set to live, let's send an update request here

				}

				if ( !empty( self::$errors ) ) update_post_meta( $postId, TribeEvents::EVENTSERROROPT, trim( self::$errors) );
			}
		}

		/**
		 * Clears/deletes all Eventbrite meta from an event
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param int $postId the ID of the event being edited
		 * @uses self::metaTags
		 * @return void
		 */
		public function clear_details( $postId ) {
			foreach( self::$metaTags as $meta ) {
				delete_post_meta( $postId, $meta );
			}
		}

		/**
		 * Handles Eventbrite ticket creation
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param int $postId the ID of the event being edited
		 * @param int $eventID the Eventbrite ID of the event being edited
		 * @param array $_POST
		 * @return mixed false on failure / request object on success
		 */
		private function ticket_new( $postId, $eventId, $raw_post ) {
			try {
				if ( !is_numeric($eventId) ) {
					return false;
				}
				$request = 'event_id=' . $eventId;
				if ( empty( $raw_post['EventBriteTicketName'] ) ) {
					throw new TribeEventsPostException(__('Tickets must have a name', 'tribe-eventbrite'));
				}
				$request .= '&name=' . urlencode( stripslashes($raw_post['EventBriteTicketName']) );
				if ( $raw_post['EventBriteIsDonation'] == 2 ) {
					$request .= '&price=0.00';
					$request .= '&is_donation=0';
				} elseif ( $raw_post['EventBriteIsDonation'] == 1 ) {
					$request .= '&price=';
					$request .= '&is_donation=1';
				} elseif ( $raw_post['EventBriteIsDonation'] == 0 && !is_numeric( $raw_post['EventBriteEventCost'] ) ) {
					throw new TribeEventsPostException(__('Paid tickets must have a numeric cost.', 'tribe-eventbrite'));
				} else {
					$request .= '&price=' . (float)$raw_post['EventBriteEventCost'];
					$request .= '&is_donation=0';
				}
				if ( !is_numeric( $raw_post['EventBriteTicketQuantity'] ) ) {
					throw new TribeEventsPostException(__('Ticket quantity must be numeric', 'tribe-eventbrite'));
				} else {
					$request .= '&quantity=' . (int)$raw_post['EventBriteTicketQuantity'];
				}
				if ( !empty( $raw_post['EventBriteTicketDescription'] ) ) {
					$request .= '&description=' . urlencode( stripslashes($raw_post['EventBriteTicketDescription']) );
				}

				$start_date = ( isset($raw_post['EventAllDay']) && $raw_post['EventAllDay'] == 'yes' ) ? $raw_post['EventStartDate'] : $raw_post['EventStartDate'] .' '. $raw_post['EventStartHour'].':'. $raw_post['EventStartMinute'].':00';
				$start_date .= ( isset( $raw_post['EventStartMeridian'] ) ) ? $raw_post['EventStartMeridian'] : null;

				$end_date = ( isset($raw_post['EventAllDay']) && $raw_post['EventAllDay'] == 'yes' ) ? $raw_post['EventEndDate'].' +1 day' : $raw_post['EventEndDate'] .' '. $raw_post['EventEndHour'].':'. $raw_post['EventEndMinute'].':00';
				$end_date .= ( isset( $raw_post['EventEndMeridian'] ) ) ? $raw_post['EventEndMeridian'] : null;

				$start_date =  date('Y-m-d H:i:s', strtotime($start_date));
				$end_date =  date('Y-m-d H:i:s', strtotime($end_date));

				if ( !empty( $raw_post['EventBriteTicketStartDate'] ) ) {
					$startDate = $raw_post['EventBriteTicketStartDate'] . ' ' . $raw_post['EventBriteTicketStartHours'] . ":" . $raw_post['EventBriteTicketStartMinutes'] . ':00';
					$startDate .= ( isset( $raw_post['EventBriteTicketStartMeridian'] ) ) ? $raw_post['EventBriteTicketStartMeridian'] : null;
					$startDate = date('Y-m-d H:i:s', strtotime( $startDate ) );
					$request .= '&start_sales=' . urlencode( $startDate );
				}

				if ( !empty( $raw_post['EventBriteTicketEndDate'] ) ) {
					$endDate = $raw_post['EventBriteTicketEndDate'] . ' ' . $raw_post['EventBriteTicketEndHours'] . ':' . $raw_post['EventBriteTicketEndMinutes'] . ':00';
					$endDate .= ( isset( $raw_post['EventBriteTicketEndMeridian'] ) ) ? $raw_post['EventBriteTicketEndMeridian'] : null;
					$endDate = date('Y-m-d H:i:s', strtotime( $endDate ) );
					$request .= '&end_sales=' . urlencode( $endDate );
				}

				$request .= '&include_fee=' . (int)$raw_post['EventBriteIncludeFee'];


				// save ticket - if error, show to user
				$api = new EventbriteAPI( self::getUserKey( $postId ) );
				if (!get_option('tribe_eb_activated')) update_option('tribe_eb_activated', true);
				return $api->sendEventbriteRequest( 'ticket_new' , $request );
			} catch (TribeEventsPostException $e) {
				$tribe_ecp = TribeEvents::instance();
				$tribe_ecp->setPostExceptionThrown(true);
				update_post_meta( $postId, TribeEvents::EVENTSERROROPT, "Your Eventbrite Ticket was not saved due to the following error: " . $e->getMessage());
			}
		}

		/**
		 * Handles Eventbrite event update
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param int $postId the ID of the event being edited
		 * @param int $eventBriteId the Eventbrite ID of the event being edited
		 * @param array $_POST
		 * @return $response_arr the response array
		 */
		private function event_update( $postId, $eventBriteId, $raw_post ) {
			$post = get_post( $postId );
			if ( wp_is_post_revision($postId) ) throw new TribeEventsPostException(__('This post is a revision and cannot update an Evenbrite event.', 'tribe-eventbrite'));
			else delete_post_meta( $postId, TribeEvents::EVENTSERROROPT );

			if ( empty( $raw_post['post_title'] ) ) {
				$tribe_ecp = TribeEvents::instance();
				self::$errors .= 'Event must have a title';
				throw new TribeEventsPostException(__('Please supply a post title. This will become the Eventbrite event title.', 'tribe-eventbrite'));
			}

			$organizer_id = self::do_event_organizer($postId);
			if ($organizer_id)
				$venue_id = self::do_event_venue($postId,false,$organizer_id);

			$venue_id = (isset($venue_id)) ? $venue_id : null;

			$request = self::build_event_data($eventBriteId, $venue_id, $organizer_id);

			$response_arr = self::sendEventBriteRequest( 'event_update', $request, $postId );

			if ( isset( $response_arr['process']['id'] ) ) {
				update_post_meta( $postId, '_EventBriteId', $response_arr['process']['id'], true );
			}

			// event is deleted/unregistered
			if ( !empty( $raw_post['EventBriteStatus'] ) && $raw_post['EventBriteStatus'] == 'Deleted' ) {
				$this->clear_details( $postId );
				update_post_meta( $postId, 'eventbrite_deleted', true);
				delete_post_meta( $postId, 'tribe-eventbrite-saved-data' );
				delete_post_meta( $postId, '_EventBriteId' );
				$raw_post = array();
			}

			return $response_arr;

		}

		/**
		 * Handles Eventbrite event creation
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param int $postId the ID of the event being edited
		 * @param array $_POST
		 * @return mixed false on failure / Eventbrite ID on success
		 */
		private function event_new( $postId, $raw_post ) {

			$post = get_post( $postId );

			if ( wp_is_post_revision($postId) ) {
				throw new TribeEventsPostException( __('This post is a revision and cannot create an evenbrite event.', 'tribe-eventbrite') );
			} else {
				delete_post_meta( $postId, TribeEvents::EVENTSERROROPT );
			}

			$requestParams = '';

			if ( empty( $raw_post['post_title'] ) ) {
				$tribe_ecp = TribeEvents::instance();
				self::$errors .= __('Event must have a title', 'tribe-eventbrite');
				if ( WP_DEBUG ) error_log( self::$errors );
				throw new TribeEventsPostException( __( 'Please supply a post title. This will become the Eventbrite event title.', 'tribe-eventbrite') );
			}

			$organizer_id = self::do_event_organizer($postId);
			$venue_id = self::do_event_venue($postId, false, $organizer_id);
			$requestParams = self::build_event_data(false, $venue_id, $organizer_id, true);
			$response_arr = self::sendEventBriteRequest( 'event_new', $requestParams, $postId );

			if ( isset( $response_arr['process']['id'] ) ) { // success

				$eventBriteId = $response_arr['process']['id'];
				update_post_meta( $postId, '_EventBriteId', $eventBriteId, true );
				return $eventBriteId;

			} else { // failure
				return false;
			}
		}

		/**
		 * marks an Eventbrite event as live after it's created
		 * only if the live status was requested by the user
		 *
		 * @since 1.0
		 * @author jkudish
		 * @param $postId the post ID in WordPress
		 * @param $eventBriteId the Eventbrite ID
		 * @param $postArr the $_POST array from the event_new() function
		 * @see event_new()
		 * @see event_update()
		 * @return bool success or no
		 */
		private function eventLiveAfterSubmission($postId, $eventBriteId, $postArr) {
			if ($postArr['EventBriteStatus'] == 'Live') {
				$response_arr = self::event_update( $postId, $eventBriteId, $postArr );
				if ( isset($response_arr['process']['id']) ) {
					return true;
				} else {
					throw new TribeEventsPostException( __('Your event could not be marked as live in Eventbrite. It was still created as a draft though. Please review the information below and proceed accordingly.', 'tribe-eventbrite'));
				}
			}
			return false;
		}

		/**
		 * prepares query/request (for events) to run for the Eventbrite API
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $event_id the event ID / defaults to false
		 * @param  int $venue_id the venue ID / defaults to false
		 * @param  int $organizer_id the organizer ID / defaults to false
		 * @param  bool $new are we creating a new event / defaults to false
		 * @return string $requestParams the query/request
		 */
		public function build_event_data( $event_id = false, $venue_id = false, $organizer_id = false, $new = false ) {
			$requestParams = '';

			if ($event_id)
				$requestParams = '&event_id=' . $event_id;

			if ($venue_id) //optional
				$requestParams .= '&venue_id=' . $venue_id;

			if ($organizer_id) //optional
				$requestParams .= '&organizer_id=' . $organizer_id;

			$requestParams .='&title=' . urlencode( stripslashes( $_POST['post_title'] ) );
			if ( !empty( $_POST['content'] ) ) {
				$requestParams .= '&description=' . urlencode( stripslashes( $_POST['content'] ) );
			}

			$start_date = ( isset($_POST['EventAllDay']) && $_POST['EventAllDay'] == 'yes' ) ? $_POST['EventStartDate'] : $_POST['EventStartDate'] .' '. $_POST['EventStartHour'].':'. $_POST['EventStartMinute'].':00';
			$start_date .= ( isset( $_POST['EventStartMeridian'] ) && !( isset($_POST['EventAllDay']) && $_POST['EventAllDay'] == 'yes' ) ) ? $_POST['EventStartMeridian'] : null;

			$end_date = ( isset($_POST['EventAllDay']) && $_POST['EventAllDay'] == 'yes' ) ? $_POST['EventEndDate'].' +1 day' : $_POST['EventEndDate'] .' '. $_POST['EventEndHour'].':'. $_POST['EventEndMinute'].':00';
			$end_date .= ( isset( $_POST['EventEndMeridian'] ) && !( isset($_POST['EventAllDay']) && $_POST['EventAllDay'] == 'yes' ) ) ? $_POST['EventEndMeridian'] : null;


			$start_date =  date('Y-m-d H:i:s', strtotime($start_date));
			$end_date =  date('Y-m-d H:i:s', strtotime($end_date));

			$requestParams .= '&start_date=' . urlencode( $start_date );
			$requestParams .= '&end_date=' . urlencode( $end_date );

			if ( isset( $_POST['EventBriteStatus'] ) && !$new ) // optional
				$requestParams .= '&status=' . urlencode( $_POST['EventBriteStatus'] );

			if ( false !== wp_timezone_override_offset() ) {
				$timezone = wp_timezone_override_offset();
			} elseif ( false !== get_option( 'gmt_offset' ) ) {
				$timezone = (int) abs( round( (int) get_option( 'gmt_offset' ) ) );
				$timezone = ( $timezone > 0 && $timezone < 10 ) ? '0' . $timezone : $timezone;
				if ( (int) get_option( 'gmt_offset' ) > 0) {
					$timezone = '+' . $timezone;
				} else {
					$timezone = '-' . $timezone;
				}
			} else {
				$timezone = '';
			}
			$requestParams .= '&timezone=GMT' . urlencode( $timezone );
			return $requestParams;
		}

		/**
		 * prepares query/request (for venues) to run for the Eventbrite API
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $event_id the event ID
		 * @param  int $venue_id the venue ID / defaults to false
		 * @param  int $organizer_id the organizer ID / defaults to false
		 * @return string $requestParams the query/request
		 */
		public function build_venue_data( $event_id, $venue_id = false, $organizer_id = false ) {
			$requestParams = '';

			if ($venue_id)
				$requestParams = 'id=' . urlencode( esc_attr($venue_id) );

			$requestParams .= '&organizer_id=' . urlencode( esc_attr($organizer_id) );
			$requestParams .= '&venue=' . urlencode( esc_attr( remove_accents( tribe_get_venue( $event_id ) ) ) );
			$requestParams .= '&adress=' . urlencode( esc_attr( remove_accents( tribe_get_address( $event_id ) ) ) );
			$requestParams .= '&city=' . urlencode( esc_attr( remove_accents( tribe_get_city( $event_id ) ) ) );
			$requestParams .= '&postal_code=' . urlencode( esc_attr( tribe_get_zip( $event_id ) )  );

			$region = self::get_region( $event_id );
			if ( $region ) {
				$requestParams .= '&region=' . urlencode( $region );
			}

			$country_code = self::get_country_code( $event_id );
			if ( $country_code ) {
				$requestParams .= '&country_code=' . urlencode( $country_code );
			}
			return $requestParams;
		}

		/**
		 * get a country code from an event id
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $event_id the event id
		 * @return string $code the country code
		 */
		private function get_country_code( $event_id = null ) {
			$country = tribe_get_country( $event_id );

			if ( empty( $country ) )
				return;

			$tribe_ecp = TribeEvents::instance();
			$countries = TribeEventsViewHelpers::constructCountries();
			$code = array_search($country, $countries);
			return $code;
		}

		/**
		 * get a region from an event id
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $event_id the event id
		 * @return string $region the region name
		 */
		private function get_region( $event_id = null ) {
			$region = tribe_get_region( $event_id );

			if ( empty( $region ) )
				return;

			return esc_attr( remove_accents( $region ) );
		}

		/**
		 * sends the venue data to Eventbrite API
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $event_id the event ID
		 * @param  int $venue_id the venue ID / defaults to false
		 * @param  int $organizer_id the organizer ID / defaults to false
		 * @return mixed the response string or an error on failure
		 */
		private function do_event_venue( $event_id, $venue_id = false, $organizer_id = false ) {

			$venueID = get_post_meta( $event_id, '_EventVenueID',true);

			if (!$venueID)
				return false;

			if (!$venue_id)
				$venue_id = get_post_meta( $venueID, '_VenueEventBriteID'.$organizer_id, true );

			// if no stored EB Venue ID, let's search it just to be safe
			if ( !isset( $venue_id ) || !$venue_id ) {
				$_venues = self::sendEventBriteRequest( 'user_list_venues', null, null, false, true, false );
				if ( is_array($_venues) && !empty($_venues) ) {
					$venues = wp_list_pluck( $_venues['venues']['venue'], 'name' );
					$venue_index = array_search( tribe_get_venue($venueID), $venues );
					if ( false !== $venue_index ) {
						$venue_id = $_venues['venues']['venue'][$venue_index]['id'];
					}
				}
			}

			$requestParams = self::build_venue_data($event_id, $venue_id, $organizer_id);

			$mode = ($venue_id) ? 'venue_update' : 'venue_new';
			if ( $mode == 'venue_update' ) {
				$response_arr = self::sendEventBriteRequest( $mode, $requestParams, $event_id, false, true, false );
				if ( !isset( $response_arr['process']['id'] ) ) {
					// if update fails, let's send another request with new
					$response_arr = self::sendEventBriteRequest( 'venue_new', $requestParams, $event_id );
				}
			} else {
				$response_arr = self::sendEventBriteRequest( $mode, $requestParams, $event_id );
			}

			if ( isset( $response_arr['process']['id'] ) ) {
				update_post_meta( $venueID, '_VenueEventBriteID'.$organizer_id, $response_arr['process']['id'], true );
				return $response_arr['process']['id'];
			} else {
				//The API returned the correct Venue ID for us.
				if (preg_match('/The venue id is \[([0-9]*)\]/', $response_arr['error']['error_message'], $matches)) {
					update_post_meta( $venueID, '_VenueEventBriteID'.$organizer_id, $matches[1] );
					return self::do_event_venue($event_id, $matches[1], $organizer_id);
				} else {
					update_post_meta( $postId, TribeEvents::EVENTSERROROPT, __('There was an error sending the venue to Eventbrite. Please try again.', 'tribe-eventbrite') );
				}
			}
		}


		/**
		 * sends the organizer data to Eventbrite API
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $event_id the event ID
		 * @return mixed the response string or an error on failure
		 */
		private function do_event_organizer( $event_id ){

			$eventOrgID = get_post_meta( $event_id, '_EventOrganizerID', true );

			if ( $eventOrgID ) {
				$storedEBOrgID = get_post_meta( $eventOrgID, '_OrganizerEventBriteID', true );
				$organizer_name = get_the_title( $eventOrgID );
				$email = tribe_get_organizer_email( $event_id );
				$website = tribe_get_organizer_link( $event_id, false, false );
				$phone = tribe_get_organizer_phone( $event_id );
			} else {
				// if there's no organizer associated to this event, let's make the author the organizer
				$event = get_post( $event_id );
				if ( !empty( $event->post_author ) ) {
					$user = get_userdata( $event->post_author );
					if ( !is_wp_error( $user ) ) {
						$storedEBOrgID = get_user_meta( $user->ID, '_OrganizerEventBriteID', true );
						$organizer_name = $user->display_name;
					}
				}
			}


			if ( empty( $organizer_name ) || !$organizer_name ) {
				$organizer_name = __( 'Unamed Organizer', 'tribe-eventbrite' );
			}

			// if no stored EB Organizer ID, let's search it just to be safe
			if ( !isset( $storedEBOrgID ) || !$storedEBOrgID ) {
				$_organizers = self::sendEventBriteRequest( 'user_list_organizers', null, null, false, true, false );
				if ( is_array($_organizers) && !empty($_organizers) ) {
					$organizers = wp_list_pluck( $_organizers['organizers']['organizer'], 'name' );
					$organizer_index = array_search( $organizer_name, $organizers );
					if ( false !== $organizer_index ) {
						$storedEBOrgID = $_organizers['organizers']['organizer'][$organizer_index]['id'];
					}
				}
			}

			$mode = ( isset( $storedEBOrgID ) && $storedEBOrgID ) ? 'organizer_update' : 'organizer_new';

			$requestParams = 'name=' . urlencode( $organizer_name );

			if ( !empty( $email ) || !empty( $website ) || !empty( $phone ) ) {
				$emailLink = !empty( $email ) ? "<a href='mailto:$email'>$email</a>" : '';
				$websiteLink = !empty( $website ) ? "<a href='$website'>$website</a>" : '';
				$requestParams .= '&description=' .  urlencode( "Email: $emailLink\n<br/>Website: $websiteLink\n<br/>Phone: $phone" );
			}

			if ($storedEBOrgID)
				$requestParams .= '&id=' . $storedEBOrgID;

			if ( $mode == 'organizer_update' ) {
				$response_arr = self::sendEventBriteRequest( $mode, $requestParams, $event_id, false, true, false );
				if ( !isset( $response_arr['process']['id'] ) ) {
					// if update fails, let's send another request with new
					$response_arr = self::sendEventBriteRequest( 'organizer_new', $requestParams, $event_id );
				}
			} else {
				$response_arr = self::sendEventBriteRequest( $mode, $requestParams, $event_id );
			}

			if ( isset( $response_arr['process']['id'] ) ) {
				if ( $eventOrgID ) {
					update_post_meta( $eventOrgID, '_OrganizerEventBriteID', $response_arr['process']['id'] );
				} elseif ( !is_wp_error( $user ) ) {
					update_user_meta( $user->ID, '_OrganizerEventBriteID', $response_arr['process']['id'] );
				}
				return $response_arr['process']['id'];
			} else {
				update_post_meta( $postId, TribeEvents::EVENTSERROROPT, __( 'An error occurred while updating Eventbrite\'s Organizer. Please review your information and try again.<br />Error:<br />', 'tribe-eventbrite' ) );
			}
		}

		/**
		 * retrieves data from an existing Eventbrite event
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $event_id the event ID
		 * @return mixed error on failure / json string of the event on success
		 */
		public function importExistingEvent() {
			add_filter( 'tribe-post-origin', array( $this, 'addImportedEventOrigin' ) );
			
			$requestParams = 'id=' . $_REQUEST['eventbrite_id'];
			$event = self::sendEventBriteRequest( 'event_get', $requestParams, null, true );

			if ( isset( $event['event']['id'] ) ) {
				if (!self::isEventImported( $event['event']['id'] )) {
					$theevent = $event['event'];
					$venue = $theevent['venue'];
					$organizer = $theevent['organizer'];

					// insert new ECP event
					$postdata = array(
						'post_title' => $theevent['title'],
						'post_type' => TribeEvents::POSTTYPE,
						'post_content' => html_entity_decode($theevent['description']),
						'post_status' => 'draft',
						'_EventBriteId' => $theevent['id'],
						'_EventRegister' => 'yes',
					);

					// save a new organizer
					if ( $organizer['id'] ) {
						$postdata['_OrganizerEventBriteID'] = $organizer['id'];

						// don't create a new organizer if this one is already imported
						$ecp_org_id = self::isOrganizerImported( $organizer['id'] );
						$organizerData = array();

						if (!$ecp_org_id) {
							$organizerData['Organizer'] = $organizer['name'];
						} else {
							$organizerData['OrganizerID'] = $ecp_org_id;
						}

						$postdata['Organizer'] = $organizerData;
					}

					if ( $venue['id'] ) {
						$postdata['_VenueEventBriteID'] = $venue['id'];
						// don't create a new venue if this one is already imported
						$ecp_venue_id = self::isVenueImported( $venue['id'], $organizer['id'] );
						$venueData = array();

						if (!$ecp_venue_id) {
							$venueData['Address'] = ( is_string( $venue['address'] ) ) ? $venue['address'] : null;
							$venueData['Address'] .= ( is_string( $venue['address2'] ) ) ? $venue['address2'] : null;
							$venueData['Venue'] = ( is_string( $venue['name'] ) ) ? $venue['name'] : null;
							$venueData['Country'] = ( is_string( $venue['country'] ) ) ? $venue['country'] : null;
							$venueData['Zip'] = ( is_string( $venue['postal_code'] ) ) ? $venue['postal_code'] : null;
							$venueData['State'] = ( is_string( $venue['region'] ) ) ? $venue['region'] : null;
							$venueData['Province'] = ( is_string( $venue['region'] ) ) ? $venue['region'] : null;
							$venueData['City'] = ( is_string( $venue['city'] ) ) ? $venue['city'] : null;
						} else {
							$venueData['VenueID'] = $ecp_venue_id;
						}

						$postdata['Venue'] = $venueData;
					}

					$postdata = array_merge($postdata, self::setupEventMeta($event));

					remove_action( 'tribe_events_update_meta', array( $this, 'eventbrite_details' ), 20 );
					add_action( 'tribe_events_update_meta', array( $this, 'link_imported_event_data' ), 10, 2 );
					$event_id = tribe_create_event( $postdata );

					if ( !is_wp_error( $event_id ) ) {
						return $event_id;
					} else {
						throw new TribeEventsPostException(__('We were unable to import your Eventbrite event. Please try again.', 'tribe-eventbrite'));
					}
				} else {
					throw new TribeEventsPostException(__('Event already imported.', 'tribe-eventbrite'));
				}
			} else {
				throw new TribeEventsPostException(__('We were unable to import your Eventbrite event. Please verify the event id and try again.', 'tribe-eventbrite'));
			}
			remove_filter( 'tribe-post-origin', array( $this, 'addImportedEventOrigin' ) );
		}

		/**
		 * links existing data with an imported event from Eventbrite
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $event_id the event ID
		 * @param  mixed $data the event's data
		 * @return void
		 */
		public function link_imported_event_data( $event_id, $data ) {

			$eb_event_id = $data['_EventBriteId'];
			$eb_organizer_id = $data['_OrganizerEventBriteID'];
			$eb_venue_id = $data['_VenueEventBriteID'];

			$ecp_venue = get_post_meta( $event_id, '_EventVenueID', true);
			$ecp_organizer = get_post_meta( $event_id, '_EventOrganizerID', true);

			update_post_meta( $event_id, '_EventBriteId', $eb_event_id );
			update_post_meta( $event_id, '_EventRegister', 'yes' );

			if ( $ecp_organizer && $eb_organizer_id ) {
				update_post_meta( $ecp_organizer, '_OrganizerEventBriteID', $eb_organizer_id);

				if ( $ecp_venue && $eb_venue_id ) {
					update_post_meta( $ecp_venue, '_VenueEventBriteId' . $eb_organizer_id, $eb_venue_id);
				}
			}
		}

		/**
		 * see if an ECP event is already linked to this event
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $ebEventId the Eventbrite event ID
		 * @param  mixed $data the event's data
		 * @return bool
		 */
		private function isEventImported( $ebEventId ) {
			$events = new WP_Query( array( 'meta_key' => '_EventBriteId', 'meta_value' => $ebEventId, 'post_type'=> TribeEvents::POSTTYPE ) );
			return $events->have_posts();
		}

		/**
		 * see if an Eventbrite venue exists in ECP
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $ebVenueId the Eventbrite venue ID
		 * @param  int $ebOrganizerId the Eventbrite organizer ID
		 * @return mixed false on failure / the venue ID on success
		 */
		private function isVenueImported( $ebVenueId, $ebOrganizerId ) {
			// venue is unique per organizer -- weird
			$venues = new WP_Query( array( 'meta_key' => '_VenueEventBriteID'.$ebOrganizerId, 'meta_value' => $ebVenueId, 'post_type'=> TribeEvents::VENUE_POST_TYPE ) );

			if ( $venues->have_posts() ) {
				$venues->the_post();
				return get_the_ID();
			}

			return false;
		}

		/**
		 * see if an Eventbrite organizer exists in ECP
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $ebOrganizerId the Eventbrite organizer ID
		 * @return mixed false on failure / the organizer ID on success
		 */
		private function isOrganizerImported( $ebOrganizerId ) {
			$organizers = new WP_Query( array( 'meta_key' => '_OrganizerEventBriteID', 'meta_value' => $ebOrganizerId, 'post_type'=> TribeEvents::ORGANIZER_POST_TYPE ) );

			if ( $organizers->have_posts() ) {
				$organizers->the_post();
				return get_the_ID();
			}

			return false;
		}
		
		/**
		 * returns filter value for tribe-post-origin.
		 * @since 1.0
		 * @author PaulHughes01
		 * @return string $origin
		 */
		public function addImportedEventOrigin() {
			$origin = 'eventbrite-tickets';
			return $origin;
		}

		/**
		 * set's up the dates for an imported event
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  array $ebEvent the event
		 * @return array $eventMeta the meta
		 */
		private function setupEventMeta( $ebEvent ) {
			$eventMeta = array();

			// match EB api keys with input names
			$matchedKeysNames = array(
				'start_date' 			=> 'EventStartDate',
				'end_date' 				=> 'EventEndDate'
			);
			// construct output array from EB response

			foreach ( $matchedKeysNames as $ebKey => $name ) {
				$responseValue = $ebEvent['event'][$ebKey];
				// format time output
				$startEnd = str_replace( array('Event','Date'), '', $name );

				$date = explode(' ',$responseValue);
				$eventMeta[$name] = $date[0];

				$time = explode( ':', $date[1] );
				$eventMeta['Event'.$startEnd.'Minute'] = $time[1];
				if ( strstr( get_option( 'time_format', TribeDateUtils::TIMEFORMAT ), 'H' ) ) {
					$eventMeta['Event'.$startEnd.'Hour'] = $time[0];
				} else {
					if ( $time[0] > 12 ) {
						$time[0] -= 12;
						if ( $time[0] < 10 ) $time[0] = '0' . $time[0];
						$amPm = ( strstr( $timeFormat, 'a' ) ) ? 'pm' : 'PM' ;
					} else {
						$amPm = ( strstr( $timeFormat, 'a' ) ) ? 'am' : 'AM' ;
					}
					$eventMeta['Event'.$startEnd.'Hour'] = ( $time[0] == '00' ) ? '12' : $time[0];
					$eventMeta['Event'.$startEnd.'Meridian'] = $amPm;
				}
			}


			// check if the event is an all day event
			if (
					( $eventMeta['EventStartHour'] == '12' && $eventMeta['EventStartMinute'] == '00' && $eventMeta['EventStartMeridian'] == 'am' ) // start should always be midnight
					&& ( // check the end date, 2 possibilities
						( ( $eventMeta['EventEndHour'] == '12' && $eventMeta['EventEndMinute'] == '00' && $eventMeta['EventEndMeridian'] == 'am' ) && ( $eventMeta['EventStartDate'] != $event['EventEndDate'] ) ) // end can be midnight as long as start/end dates don't match
						|| ( $eventMeta['EventEndHour'] == '11' && $eventMeta['EventEndMinute'] == '59' && $eventMeta['EventEndMeridian'] == 'pm' ) // end can also be 11:59p
						)
				) {
					$eventMeta['EventAllDay'] = 'yes';
				}

			return $eventMeta;
		}


		/**
		 * handles Eventbrite payment_update api call
		 *
		 * @link http://www.eventbrite.com/api/doc/payment_update
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  int $postId the post ID
		 * @param  int $eventId the event ID
		 * @param  array $_POST
		 * @return void
		 */
		public function payment_update( $postId, $eventId, $_POST ) {
			$paymentTypes = array('check' => '', 'cash' => '', 'invoice' => '');
			$requestParams = 'event_id=' . $eventId;

			// make it accept cash if free & assign a message
			if ( 2 == $_POST['EventBriteIsDonation'] ) {
				$requestParams .= '&accept_cash=1';
				$requestParams .= '&instructions_cash=' . urlencode( __( 'This event is free to attend', 'tribe-eventbrite' ) );
			} else {
				// otherwise loop through the payment methods as it's supposed to
				foreach( $paymentTypes as $key => $val ) {
					$onOff = $_POST['EventBritePayment_accept_' . $key];
					if ( $onOff ) $requestParams .= '&accept_' . $key . '=' . $onOff;
					$paymentTypes[$key] = $onOff;
				}
				foreach( $paymentTypes as $key => $val ) {
					if ( $val ) {
	               $instructions = $_POST['EventBritePayment_instructions_'.$key];
	               if ( $instructions ) $requestParams .= '&instructions_' . $key . '=' . urlencode( stripslashes( $instructions ) );
					}
				}

		    // Online payment method is either/or (not both)
		    $onlineMethod = $_POST['EventBritePayment_accept_online'];
		    if ( !empty( $_POST['EventBritePayment_accept_online'] ) ) {
			    switch( $onlineMethod ) {
		  	    case 'paypal':
			      	$requestParams .= '&accept_paypal=1&paypal_email=' . $_POST['EventBritePayment_paypal_email'];
							break;
			      case 'google':
		        	$requestParams .= '&accept_google=1&google_merchant_id=' . $_POST['EventBritePayment_google_merchant_id'] . '&google_merchant_key=' . $_POST['EventBritePayment_google_merchant_key'];
		           break;
		     	}
	    	}
	    }

			$response_arr = self::sendEventBriteRequest( 'payment_update', $requestParams, $postId );
   		if (WP_DEBUG) error_log("PAYMENT OPTIONS" . print_r($response_arr, true));
		}

		/**
		 * returns options for printable payment options
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  string $arrayMember the payment method
		 * @return mixed false on failure / payment option string on success
		 */
		public function printablePaymentOption( $arrayMember ) {
			switch( $arrayMember ) {
				case '_EventBritePayment_accept_paypal':
					return __('PayPal Payments', 'tribe-eventbrite');
					break;
				case '_EventBritePayment_accept_google':
					return __('Google Checkout Payments', 'tribe-eventbrite');
					break;
				case '_EventBritePayment_accept_check':
					return __('Pay by check', 'tribe-eventbrite');
					break;
				case '_EventBritePayment_accept_cash':
					return __('Pay at the door', 'tribe-eventbrite');
					break;
				case '_EventBritePayment_accept_invoice':
					return __('Send an invoice', 'tribe-eventbrite');
					break;
				default:
					return false;
			}
		}

		/**
		 * returns the Eventbrite API key for the current author or the current user
		 *
		 * @since 1.0
		 * @author jgabois, Justin Endler & jkudish
		 * @param  int $postId the event ID
		 * @param  bool $isEbImport are we importing?
		 * @return mixed false on failure / the API key on success
		 */
		public function getUserKey( $postId = null, $isEbImport = false ) {
			if ( (int) $postId > 0 ) {
				$post = get_post( $postId );
				$key = ( is_object($post) && isset($post->post_author) ) ? get_user_meta( $post->post_author, 'eventbrite_user_key', true ): false;
			} else {
				$user_id = get_current_user_id();
				$key = ($user_id) ? get_user_meta( $user_id, 'eventbrite_user_key', true ) : false;
			}

			$key = ( isset($key) && is_string($key) && $key != '' ) ? $key : false;

			// got here? no key exists
			return apply_filters('tribe_eb_user_key', $key );
		}

		/**
		 * wrapper for the Eventbrite API
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param  string $action the API action being taken
		 * @param  array $params the paramaters for the API action
		 * @param  int $postId the event ID
		 * @param  bool $isEbImport are we importing?
		 * @param  bool $ignore_errors ignore returned errors
		 * @param  string $default default value to return if ignore errors
		 * @return mixed null on failure / the API key on success
		 */
		public function sendEventBriteRequest( $action, $params = null, $postId = null, $isEbImport = false, $ignore_errors = false, $default = '' ) {
				$api = new EventbriteAPI( self::getUserKey( $postId, $isEbImport ) );
				return $api->sendEventbriteRequest( $action, $params, $ignore_errors, $default );
		}

		/**
		 * Human Error Messages
		 * Maps EB errors to human readable & translated messages
		 *
		 * @since  1.0
		 * @author jkudish
		 * @return void
		 */
		public function humanErrorMessages() {
			return array(
				'Invalid user_key1' => __('Your user API Key is invalid. Please go to your profile and adjust it.', 'tribe-eventbrite'),
				'The specified user was not found or the login credentials didn’t match.' => __('The specified user was not found or the login credentials didn’t match. Please go to your profile and verify your API Key.', 'tribe-eventbrite'),
				'The event id is missing.' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'No such event.' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'The total number of tickets exceeds the maximum allowed (50).' => __('The total number of tickets exceeds the maximum allowed (50)', 'tribe-eventbrite'),
				'The ticket name is missing.' => __('The ticket name is missing. Please enter a ticket name and try again.', 'tribe-eventbrite'),
				'End sales less than Start Sales.' => __('The date you selected for ticket sales to end is before the date you selected for ticket sales to start, please adjust your dates accordingly.', 'tribe-eventbrite'),
				'End sales date greater than Event\'s Ending date.' => __('The date you selected for ticket sales to end is after the date you selected for the event to end, please adjust your dates accordingly.', 'tribe-eventbrite'),
				'Please specify the quantity of tickets available.' => __('Please specify the quantity of tickets available.', 'tribe-eventbrite'),
				'The quantity is invalid, a numeric field is expected.' => __('Please specify a valid number for quantity of tickets available.', 'tribe-eventbrite'),
				'Quantity provided is greater than event capacity [Nnnn].' => __('The quantity of tickets you provided is greater than event capacity. Please adjust your numbers accordingly', 'tribe-eventbrite'),
				'The price of the ticket is missing or invalid (non-numeric).' => __('Please enter a valid price for the ticket', 'tribe-eventbrite'),
				'The minimum number of tickets per order is invalid (non-numeric) or inconsistent.' => __('Please enter a valid minimum number of tickets per order', 'tribe-eventbrite'),
				'The maximum number of tickets per order is invalid (non-numeric) or inconsistent.' => __('Please enter a valid maximum number of tickets per order', 'tribe-eventbrite'),
				'Donation flag must be 0 or 1.' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'Service fee must be 0 or 1.' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'Invalid value for accept_PayPal method (0 or 1).' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'Invalid value for accept_Google method (0 or 1).' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'Invalid value for Cash method (0 or 1).' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'Invalid value for "Pay by Check" method (0 or 1).' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'The ticket id is missing.' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'The ticket id is unknown.' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'hide must be y or n.' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'Please provide a valid Google merchant ID and Key.' => __('Please provide a valid Google merchant ID and Key', 'tribe-eventbrite'),
				'To use Google Checkout you need to enter a 10 or 15 digit Google Checkout Merchant ID.' => __('To use Google Checkout you need to enter a 10 or 15 digit Google Checkout Merchant ID', 'tribe-eventbrite'),
				'To use Google Checkout you need to enter a 22 character Google Checkout Merchant Key.' => __('To use Google Checkout you need to enter a 22 character Google Checkout Merchant Key', 'tribe-eventbrite'),
				'Please select at least one method of payment (PayPal,Google or Alternative).' => __('Please select at least one method of payment (PayPal, Google or Alternative)', 'tribe-eventbrite'),
				'Please provide a valid Paypal email.' => __('The Paypal email address you provided is invalid. Please go to Eventbrite to adjust it.', 'tribe-eventbrite'),
				'No such organizer. [123456]' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'Event deleted or cancelled. [123456]' => __('This event has been deleted from Eventbrite.', 'tribe-eventbrite'),
				'The organizer ID is missing.' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'This organizer does not belong to current User.' => __('An API error occurred. Please double check the information you\'ve entered and try again', 'tribe-eventbrite'),
				'This organizer name already exists.' => __('The organizer name already exists. Please enter a different organizer name and try again. Note that your event was not registered with Eventbrite as a result.', 'tribe-eventbrite'),
				'This venue name already exists.' => __('The venue name already exists. Please enter a different venue name and try again. Note that your event was not registered with Eventbrite as a result.', 'tribe-eventbrite'),
			);
		}

		/**
		 * returns a properly formatted error message based on the error code returned from the EB API
		 *
		 * @since  1.0
		 * @author jkudish
		 * @param  string $error the error string returned from the EB API
		 * @return string $message, the filtered error message string
		 */
		public function get_error_message( $error = 'unknown' ) {
			$humanErrorMessages = self::humanErrorMessages();
			$default_text = '<strong>' . __( 'The following Eventbrite error has occurred', 'tribe-eventbrite' ) . ': </strong> ';
			$default = apply_filters( 'tribe_eb_default_error_message_text', $default_text );
			$error_message = ( array_key_exists( $error, $humanErrorMessages ) ) ? $humanErrorMessages[$error] : $error;
			$message = $default . $error_message;
			if ( isset( $_POST['EventBriteStatus'] ) && $_POST['EventBriteStatus'] == 'Live' ) {
				$message .= '<br>' . __( 'The event could not be made live as a result of this error.', 'tribe-eventbrite' );
			}
			return apply_filters( 'tribe_eb_error_message', $message, $error_message, $error );
		}

		/**
		 * include the options page view
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function eventBriteOptions() {
			include_once('views/eventbrite-options.php');
		}

		/**
		 * add the options page for this plugin
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function addOptionsPage() {
			add_submenu_page( '/edit.php?post_type='.TribeEvents::POSTTYPE, __('Import Events','tribe-eventbrite'), __('Import Events','tribe-eventbrite'), 'edit_posts', 'import-eventbrite-events', array( $this, 'importEventsPage' ));
		}

		/**
		 * include the import page view
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @return void
		 */
		public function importEventsPage() {
			include_once('views/import-eventbrite-events.php' );
		}

		/**
		 * the event brite meta box
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @global userdata - the current user data
		 * @param int $postId the ID of the current event
		 * @return void
		 */
		public function eventBriteMetaBox( $postId ) {
			global $userdata;
			if (!isset($userdata)) $userdata = get_userdata( get_current_user_id() ); // just in case the global isn't set
			if ( WP_DEBUG ) error_log( "eventBriteMetaBox: " . print_r( $postId, true ) );
			$EventBriteUserKey = get_user_meta( $userdata->ID, 'eventbrite_user_key', true );
			$postData = get_post_meta( $postId, 'tribe-eventbrite-saved-data', true ); // get sent data
			delete_post_meta( $postId, 'tribe-eventbrite-saved-data' ); // delete sent data
			$EventBriteSavedPaymentOptions = array();
			foreach ( self::$metaTags as $tag ) {
				if ( !empty($postData[$tag]) ) {
					$$tag = $postData[$tag];
					if ( substr( $tag, 0, 18) == '_EventBritePayment' && $$tag == 1 ) array_push( $EventBriteSavedPaymentOptions, $tag );
					$show_tickets = true;
				} elseif ( $postId ) {
					$val = get_post_meta( $postId, $tag, true );
					$$tag = $val;
					if ( substr( $tag, 0, 18) == '_EventBritePayment' && $val == 1 ) array_push( $EventBriteSavedPaymentOptions, $tag );
				} else {
					$$tag = '';
				}
				if ( WP_DEBUG ) error_log( "$tag: " . print_r( $$tag, true ) );
			}
			if ( WP_DEBUG ) error_log( "Eventbrite id in wp meta: " . print_r( $_EventBriteId, true ) ) ;
			if ( $_EventBriteId ) {
				$event = self::sendEventBriteRequest( 'event_get', 'id=' . $_EventBriteId, $postId );
				if ( WP_DEBUG ) error_log( "event: " . print_r( $event, true ) );
			}

			// if the event was marked as deleted, let's wipe all local info
			if ( ( !empty( $event['event']['status'] ) && $event['event']['status'] == 'Deleted' ) || get_post_meta( $postId, 'eventbrite_deleted', true ) ) {
				$event_deleted = true;
				$this->clear_details( $postId );
				delete_post_meta( $postId, 'eventbrite_deleted' );
				delete_post_meta( $postId, 'tribe-eventbrite-saved-data' );
				delete_post_meta( $postId, '_EventBriteId' );
				$event = array();
				foreach ( self::$metaTags as $tag ) {
					$$tag = null;
				}
			}

     		$isRegisterChecked = ( ( isset( $event['event']['status'] ) && ( $event['event']['status'] == 'Draft' || $event['event']['status'] == 'Live' ) ) || isset( $show_tickets ) ) ? true : false;
			
			$displayTickets = ( $_EventShowTickets == 'yes' ) ? true : false;

			$tribe_ecp = TribeEvents::instance();

			include_once( 'views/eventbrite-meta-box-extension.php' );
		}

		/**
		 * is the event live?
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param int $postId the ID of the current event / defaults to false
		 * @return bool
		 */
		public function isLive( $postId = false ) {
			if (!$postId) {
				global $post;
				$postId = $post->ID;
			}
			if ($eventId = self::getEventId($postId)) {
				$event = self::sendEventBriteRequest( 'event_get', 'id=' . $eventId, $postId );
				if (WP_DEBUG) error_log( "event\r" . __FILE__ . " Line:" . __LINE__ . "\r" . print_r( $event, true ) . "\r" );
				// has tickets and is live
				if ( count( $event['event']['tickets'] ) && ('Live' == $event['event']['status']) ) {
					// is scheduled in the future
					if ( strtotime( get_post_meta( $postId, '_EventEndDate', true ) ) > strtotime('now') ) {
						return true;
					}
				}
			}
			return false;
		}

		/**
		 * determines an event's status
		 *
		 * @since 1.0
		 * @author jkudish
		 * @param int $postId the ID of the current event / defaults to false
		 * @return string the status of the event
		 */
		public function getEventStatus( $postId = false ) {
			if (!$postId) {
				global $post;
				$postId = $post->ID;
			}
			if ($eventId = self::getEventId($postId)) {
				$event = self::sendEventBriteRequest( 'event_get', 'id=' . $eventId, $postId );
				if (WP_DEBUG) error_log( "event\r" . __FILE__ . " Line:" . __LINE__ . "\r" . print_r( $event, true ) . "\r" );
				if ( isset($event['event']['status']) )
					return (string) $event['event']['status'];
			}
			return false;
		}

		/**
		 * get Eventbrite ID from event ID
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param int $postId the ID of the current event / defaults to false
		 * @return mixed false on failure / the Eventbrite ID on success
		 */
		public function getEventId( $postId = false ) {
			if (!$postId) {
				global $post;
				$postId = $post->ID;
			}
			if ( WP_DEBUG ) error_log( "postId\r" . __FILE__ . " Line:" . __LINE__ . "\r" . print_r( 'live:'.$postId, true ) . "\r" );
			if ( $EventBriteId = get_post_meta( $postId, '_EventBriteId', true ) ) {
				if ( WP_DEBUG ) error_log( "EventBriteId\r" . __FILE__ . " Line:" . __LINE__ . "\r" . print_r( $EventBriteId, true ) . "\r" );
				return $EventBriteId;
			}
			return false;
		}

		/**
		 * displays the Eventbrite ticket form
		 *
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param string $content the current html content
		 * @return string filtered $content
		 */
		public function displayEventBriteTicketForm( $content ) {
			global $post;
			if (self::isLive($post->ID) && tribe_event_show_tickets($post->ID)) {
				$eventId = self::getEventId($post->ID);
				return $content."\r".self::eventBriteTicket();
			} else {
				return $content;
			}
		}

		/**
		 * loads the Eventbrite ticket into an iframe
		 *
		 * @todo do this with the API instead?
		 * @since 1.0
		 * @author jgabois & Justin Endler
		 * @param int $post_id the post for which to display the iFrame
		 * @return string the iframe wrapped in adiv
		 */
		public function eventBriteTicket( $post_id = null ) {
			$post_id = TribeEvents::postIdHelper( $post_id );
			$eventID = self::getEventId( $post_id );
			if ( $eventID ) {
				return '<div class="eventbrite-ticket-embed" style="width:100%;text-align:left">' .
						'<iframe id="eventbrite-tickets-'.$eventID.'" src="http://www.eventbrite.com/tickets-external?eid='.$eventID.'&amp;ref=etckt" height="350px" style="width:100%;overflow:auto;"></iframe>' .
						'<div style="font-family:Helvetica, Arial;font-size:10px;padding:5px 0 5px;margin:2px;width:100%;text-align:left">' .
							'<a target="_blank" href="http://www.eventbrite.com/features?ref=etckt" style="color:#ddd;text-decoration:none">Event registration</a>' .
							'<span style="color:#ddd"> powered by </span>' .
							'<a target="_blank" href="http://www.eventbrite.com?ref=etckt" style="color:#ddd;text-decoration:none">Eventbrite</a>' .
						'</div>' .
					'</div>';
			}
		}


		public function helpersLoaded() {
			new PluginUpdateEngineChecker(self::$updateUrl, $this->pluginSlug, array(), $this->pluginFile );
		}

		public function activationMessage() {
			if (isset($_GET['tribe_eb_activate'])) update_option('tribe_eb_activated', true);
			if ( !get_option('tribe_eb_activated') && !self::getUserKey() ) {
				echo '<div class="updated tribe-notice"><p>'.sprintf( __('Welcome to The Events Calendar: Eventbrite Tickets! We appreciate your support and hope you enjoy the functionality this add-on has to offer. Before jumping into it, make sure you\'ve reviewed our %sEventbrite Tickets new user primer%s so you\'re familiar with the basics.', 'tribe-eventbrite' ), '<a href="http://tri.be/support/documentation/eventbrite-tickets-new-user-primer/">', '</a>' ) . '</p><p>'.sprintf( __('Add your %s to your %s (Don\'t have one? %s). Then simply create a new event or modify an existing one and enable Eventbrite to add and sell tickets. %s', 'tribe-eventbrite'), '<a href="http://www.eventbrite.com/userkeyapi/?ref=etckt" target="_blank">'.__('Eventbrite User API Key', 'tribe-eventbrite').'</a>', '<a href="'.admin_url('profile.php').'">'.__('profile', 'tribe-eventbrite').'</a>', '<a href="http://www.eventbrite.com/r/etp" target="_blank">'.__('Sign up now', 'tribe-eventbrite').'</a>', '<a class="tribe-dismiss-notice" title="Dismiss this message" href="'.add_query_arg('tribe_eb_activate', 'true').'"><sup>x</sup></a>' ).'</p></div>';
			}
		}
		
		/**
		 * Add the eventbrite importer toolbar item.
		 *
		 * @since 1.0.1
		 * @author PaulHughes01
		 * @return void
		 */
		public function addEventbriteToolbarItems() {
			global $wp_admin_bar;
			
			if ( current_user_can( 'publish_tribe_events' ) ) {
				$import_node = $wp_admin_bar->get_node( 'tribe-events-import' );
				if ( !is_object( $import_node ) ) {
					$wp_admin_bar->add_menu( array(
						'id' => 'tribe-events-import',
						'title' => __( 'Import', 'tribe-events-calendar' ),
						'parent' => 'tribe-events-import-group'
					) );
				}
			}
			
			if ( current_user_can( 'publish_tribe_events' ) ) {
				$wp_admin_bar->add_menu( array(
					'id' => 'tribe-eventbrite-import',
					'title' => __( 'Eventbrite', 'tribe-events-calendar' ),
					'href' => trailingslashit( get_admin_url() ) . 'edit.php?post_type=tribe_events&page=import-eventbrite-events',
					'parent' => 'tribe-events-import'
				) );
			}
		}
		
		/**
		 * Return additional action for the plugin on the plugins page.
		 *
		 * @since 2.0.8
		 *
		 * @return array
		 */
		public function addLinksToPluginActions( $actions ) {
			if( class_exists( 'TribeEvents' ) ) {
				$actions['settings'] = '<a href="' . add_query_arg( array( 'post_type' => TribeEvents::POSTTYPE, 'page' => 'import-eventbrite-events' ), admin_url( 'edit.php' ) ) .'">' . __('Import Events', 'tribe-eventbrite') . '</a>';
			}
			return $actions;
		}
		
		/**
		 * Add a setting or two to the TEC general settings tab.
		 *
		 * @since 1.0.3
		 * @author PaulHughes01
		 *
		 * @return array
		 */
		public function addEventbriteSettings( $content ) {
			$content['eventbrite_header'] = array(
				'type' => 'heading',
				'label' => __( 'Eventbrite Settings', 'tribe-eventbrite' ),
			);
			$content['eventbrite_display_tickets'] = array(
				'type' => 'checkbox_bool',
				'label' => __( 'Display Eventbrite Tickets by Default', 'tribe-eventbrite' ),
				'default' => false,
				'validation_type' => 'boolean',
				'tooltip' => __( 'Enable this to have events with Eventbrite tickets default their display of the tickets to ON.', 'tribe-eventbrite' ),
			);
			return $content;
		}
		
		/**
		 * Adds the Eventbrite logo to the editing events form.
		 *
		 * @since 1.0.3
		 * @author PaulHughes01
		 * @return void
		 */
		public function addEventbriteLogo() {
			$image_url = trailingslashit( $this->pluginUrl ) . 'resources/images/eventbritelogo.png';
			echo '<img class="tribe-eb-logo" src="' . $image_url . '" />';
		}
		
		/**
		 * Return the forums link as it should appear in the help tab.
		 *
		 * @since 1.0.3
		 *
		 * @return string
		 */
		public function helpTabForumsLink( $content ) {
			$promo_suffix = '?utm_source=helptab&utm_medium=promolink&utm_campaign=plugin';
			return 'http://tri.be/support/forums/' . $promo_suffix;
		}
		
	} // end Event_Tickets_PRO class
} // end if !class_exists Event_Tickets_PRO