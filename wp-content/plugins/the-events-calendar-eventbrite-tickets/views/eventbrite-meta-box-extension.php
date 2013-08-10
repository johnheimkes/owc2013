<?php

/**
 * displays the existing Eventbrite event meta box in the editor
 *
 * @package TribeEventsEventBrite
 * @since  3.0
 * @author Modern Tribe Inc.
 */

?>
<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function($){

	// hide/show EventBrite fields
	$('.EBForm').hide();

	if ( $("#EventBriteToggleOn:checked").length ) {
		$(".EBForm").show();
	}

	$("#EventBriteToggleOn").click(function(){
		$(".EBForm").slideDown('slow');
	});
	$("#EventBriteToggleOff").click(function(){
		$(".EBForm").slideUp(200);
	});

  var paymentType = $("input[name='EventBriteIsDonation']:checked");
	if ( $('.EBForm:visible').length > 0 && paymentType.val() == 0 ) {
    $('.eb-tec-payment-options').show(0);
	} else if ( paymentType.val() == 1 ) {
		$('.eb-tec-payment-options').show(0);
	} else {
    	$('.eb-tec-payment-options').hide(0);
	}

	$("input[name='EventBriteIsDonation']").change(function(){
    var paymentType = $("input[name='EventBriteIsDonation']:checked");
		if ( paymentType.val() == 0 ) {
			$('.eb-tec-payment-options').show(0);
			$('#EventBriteEventCost').parents('tr').show(0);
		} else if (paymentType.val() == 1) {
			$('#EventBriteEventCost').parents('tr').hide(0);
			$('.eb-tec-payment-options').show(0);
		} else {
			$('#EventBriteEventCost').parents('tr').hide(0);
			$('.eb-tec-payment-options').hide(0);
		}
	});

	// hide/show additional payment option fields
	var ebTecAcceptPaymentInputs = $('#eb-tec-payment-options-checkboxes input');
	if( ebTecAcceptPaymentInputs.is(':checked') ){
		$(".tec-eb-offline-pay-options").show();
	} else {
		$(".tec-eb-offline-pay-options").hide();
	}
	function ebTecShowHideAdditionalPaymentOptions(event) {
		if ( event && $('.EBForm:visible').length > 0 ) {
			var divIndex = ebTecAcceptPaymentInputs.index(this);
			var notSelectedIndex = ebTecAcceptPaymentInputs.index( $('#eb-tec-payment-options-checkboxes input:radio:not(:checked)') );
			if(this.checked) {
				$('.eb-tec-payment-instructions:eq('+divIndex+')').slideDown(200);
				$(".tec-eb-offline-pay-options").show();
			} else {
			 $('.eb-tec-payment-instructions:eq('+divIndex+')').slideUp(200);
			}
        $('#eb-tec-payment-options-checkboxes input:radio:not(:checked)').each(function(index) {
           var notSelectedIndex = ebTecAcceptPaymentInputs.index($(this));
           if(notSelectedIndex >= 0)
             $('.eb-tec-payment-instructions:eq('+notSelectedIndex+')').slideUp(200)
        });
		} else {
			$.each('#eb-tec-payment-options-checkboxes ~ #eb-tec-payment-options div', function() {
				var thisInput = $(this).find('input');
				if(thisInput.val() != null) {
					thisInput.closest('div').slideDown(200);
					$(".tec-eb-offline-pay-options").show();
				}
			});
		}
    $('.eb-tec-payment-details td').css('display', $('#eb-tec-payment-options-checkboxes input:checked').not('#EventBritePayment_accept_online-none').size() > 0 ? 'table-cell' : 'none');
	}

	ebTecAcceptPaymentInputs.bind('focus click', ebTecShowHideAdditionalPaymentOptions);
	ebTecAcceptPaymentInputs.focus();
	$('#title').focus();

	// Define error checking routine on submit
	$("form[name='post']").submit(function() {
			var EventStartDate = $("#EventStartDate").val();

			var currentDate = new Date();
			var EventDate = new Date();
			if( $("input[name='EventRegister']:checked").val() == 'yes' &&  (typeof( EventStartDate ) == 'undefined' || !EventStartDate.length || EventDate.toDateString() < currentDate.toDateString())) {
				alert("<?php _e('Eventbrite only allows events to be saved that start in the future.', 'tribe-eventbrite') ?>");

				$('#EventStartDate').focus();
				return false;
			}

	});

	$("form[name='post']").submit(function() {
		var ticket_name = $("input[name='EventBriteTicketName']").val();
		if( $("#EventBriteToggleOn").attr('checked') == true && typeof( ticket_name ) != 'undefined' ) {
			var ticket_price = $("input[name='EventBriteEventCost']").val();
			var ticket_quantity = $("input[name='EventBriteTicketQuantity']").val();
			var is_donation = $("input[name='EventBriteIsDonation']:checked").val();
			if( typeof( ticket_name ) == 'undefined' || !ticket_name.length ) {
				alert("<?php _e("Please provide a ticket name for the Eventbrite ticket.",'tribe-eventbrite'); ?>");
				$("input[name='EventBriteTicketName']").focus();
				return false;
			}
			if( !ticket_price.length && !is_donation) {
				alert("<?php _e("You must set a price for the ticket ",'tribe-eventbrite'); ?>" + ticket_name);
				$("input[name='EventBriteEventCost']").focus();
				return false;
			}
			if( (parseInt(ticket_quantity) == 0 || isNaN(parseInt(ticket_quantity) ) ) ) {
				alert("<?php _e("Ticket quantity is not a number",'tribe-eventbrite'); ?>");
				$("input[name='EventBriteTicketQuantity']").focus();
				return false;
			}
			if( $('input[name="EventBritePayment_accept_paypal"]').is(':checked') ) {
				var emailField = $('input[name="EventBritePayment_paypal_email"]');
				if( !emailField.val().length ) {
					alert("<?php _e("A Paypal email address must be provided.",'tribe-eventbrite'); ?>");
					emailField.focus();
					return false;
				}
			}
			if( $('input[name="EventBritePayment_accept_google"]').is(':checked') ) {
				var merchantIdField = $('input[name="EventBritePayment_google_merchant_id"]');
				if( !merchantIdField.val().length ) {
					alert("<?php _e("A Google Merchant Id must be provided.",'tribe-eventbrite'); ?>");
					merchantIdField.focus();
					return false;
				}
				var merchantKeyField = $('input[name="EventBritePayment_google_merchant_key"]');
				if( !merchantKeyField.val().length ) {
					alert("<?php _e("A Google Merchant Key must be provided.",'tribe-eventbrite'); ?>");
					merchantKeyField.focus();
					return false;
				}
			}
			return true;
		}
	});

   var datepickerOpts = {
      dateFormat: 'yy-mm-dd',
      showOn: 'focus',
      showAnim: 'fadeIn',
      minDate: new Date(),
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 3,
      showButtonPanel: true,
      onSelect: function(selectedDate) {
         var option = "minDate";
         var instance = $(this).data("datepicker");
         var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
      }
   };
   var dates = $(".etp-datepicker").datepicker(datepickerOpts);
   $(".etp-datepicker").bind( 'click', function() {
   		var startDate = $('#EventStartDate').val();
		if ( startDate ) {
         	$(this).datepicker( 'option', 'maxDate', startDate );
         	$(this).datepicker( 'show' );
        }
    });
}); // end document ready
</script>

<?php do_action( 'tribe_eventbrite_meta_box_top' ); ?>
<tr>
	<td colspan="2" class="snp_sectionheader">
		<?php do_action( 'tribe_eventbrite_before_integration_header' ); ?>
		<h4><?php _e('Tickets','tribe-eventbrite');?>
	</td>
</tr>

<?php if ( isset( $event_deleted ) && $event_deleted ) : ?>
	<div id='eventBriteDraft' class='error'>
    <p><?php _e('This event has been deleted from Eventbrite. It is now unregistered from Eventbrite.'); ?></p>
	</div>
<?php endif; ?>

  <?php if( $EventBriteUserKey ) : ?>
		<tr>
			<td>
				<?php if ( !$_EventBriteId ){?>
					<?php _e('Register this event with eventbrite.com?', 'tribe-eventbrite');?>
            <?php }else{ ?>
					<?php _e('Leave this event associated with eventbrite.com?', 'tribe-eventbrite');?>
				<?php } ?>
			</td>
			<td>
					<input id='EventBriteToggleOn' tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='EventRegister' value='yes' <?php checked($isRegisterChecked, true); ?> />&nbsp;<b><?php _e('Yes', 'tribe-eventbrite'); ?></b>
					<input id='EventBriteToggleOff' tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='EventRegister' value='no'  <?php checked($isRegisterChecked, false); ?>/>&nbsp;<b><?php _e('No', 'tribe-eventbrite'); ?></b>

			<?php // if an EventBrite event has been created by a different user, give a warning
				$thisAuthorId = get_post( $postId )->post_author;
				if ( get_post_meta( $postId, '_EventBriteId', true ) && $EventBriteUserKey != get_user_meta( $thisAuthorId, 'eventbrite_user_key', true ) ) {
				echo '<em class="eventsWarning">'.sprintf( __('This event was created by another user. Please consider contacting %s about editing these Eventbrite details.', 'tribe-eventbrite'), '<a href="mailto:' . get_userdata($thisAuthorId)->user_email . '">' . get_userdata($thisAuthorId)->display_name . '</a>').'</em>';
				} ?>
			</td>
		</tr>
		<?php if ( $_EventBriteId ){?>
		<tr>
			<td><?php _e('Display tickets on event page?','tribe-eventbrite');?></td>
			<td>
					<input id='EventBriteShowOn' tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='EventShowTickets' value='yes' <?php checked($displayTickets, true); ?> />&nbsp;<b><?php _e('Yes', 'tribe-eventbrite'); ?></b>
					<input id='EventBriteShowOff' tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='EventShowTickets' value='no'  <?php checked($displayTickets, false); ?>/>&nbsp;<b><?php _e('No', 'tribe-eventbrite'); ?></b>
			</td>
		</tr>
     <?php } ?>
        <?php if ( !$_EventBriteId ) :?>
        <?php if( function_exists('tribe_is_recurring_event') ): ?>
           <tr><td colspan='2'><?php _e('Note: The Eventbrite API does not yet support recurring events, so all instances of recurring events will be associated with a single Eventbrite event.', 'tribe-eventbrite') ?></td></tr>
         <?php endif; ?>
        <?php if( function_exists('tribe_is_recurring_event') ): ?>
           <tr><td colspan='2'><?php _e('Note: Eventbrite requires you enter an organizer. If you neglect to enter an organizer, your display name will be passed as the organizer name to Eventbrite', 'tribe-eventbrite') ?></td></tr>
         <?php endif; ?>

    <tr class="EBForm">
			<td colspan="2" class="snp_sectionheader">
				<h4><?php _e('Set up your first ticket','tribe-eventbrite');?>
				<small style="text-transform:none; display:block; margin-top:8px; font-weight:normal;"><?php _e('To create multiple tickets per event, submit this form, then follow the link to Eventbrite.', 'tribe-eventbrite'); ?></small></h4>
			</td>
		</tr>
		<tr class="EBForm">
			<td>
				<?php _e('Name','tribe-eventbrite'); ?>:<span class="tec-required">✳</span>
			</td>
			<td>
				<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="EventBriteTicketName" size="14" value="<?php echo $_EventBriteTicketName; ?>" />
			</td>
		</tr>
		<tr class="EBForm">
			<td></td>
			<td class="snp_message"><small><?php _e('Examples: Member, Non-member, Student, Early Bird','tribe-eventbrite'); ?></small></td>
		</tr>
		<tr class="EBForm">
			<td>
				<?php _e('Description','tribe-eventbrite'); ?>:
			</td>
			<td>
				<textarea class="description_input" tabindex="<?php $tribe_ecp->tabIndex(); ?>" name="EventBriteTicketDescription" 	rows="2" cols="55"><?php echo $_EventBriteTicketDescription; ?></textarea>
			</td>
		</tr>
		<tr class="EBForm">
			<td>
				<?php _e('Date to Start Ticket Sales','tribe-eventbrite'); ?>:<span class="tec-required">✳</span>
			</td>
			<td>
				<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="EventBriteTicketStartDate" value='<?php echo $_EventBriteTicketStartDate; ?>' class='etp-datepicker'/>
        @
        <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketStartHours'>
          <?php echo TribeEventsViewHelpers::getHourOptions("00:00:00") ?>
        </select>
        <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketStartMinutes'>
          <?php echo TribeEventsViewHelpers::getMinuteOptions("00:00:00") ?>
        </select>
				<?php if ( !strstr( get_option( 'time_format', TribeDateUtils::TIMEFORMAT ), 'H' ) ) : ?>
	        <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketStartMeridian'>
	          <?php echo TribeEventsViewHelpers::getMeridianOptions("00:00:00") ?>
	        </select>
				<?php endif; ?>
			</td>
		</tr>
		<tr class="EBForm">
			<td>
				<?php _e('Date to End Ticket Sales','tribe-eventbrite'); ?>:<span class="tec-required">✳</span>
			</td>
			<td>
				<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="EventBriteTicketEndDate" value='<?php echo $_EventBriteTicketEndDate; ?>' class='etp-datepicker'/>
        @
        <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketEndHours'>
          <?php echo TribeEventsViewHelpers::getHourOptions("00:00:00") ?>
        </select>
        <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketEndMinutes'>
          <?php echo TribeEventsViewHelpers::getMinuteOptions("00:00:00") ?>
        </select>
				<?php if ( !strstr( get_option( 'time_format', TribeDateUtils::TIMEFORMAT ), 'H' ) ) : ?>
	    		<select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketEndMeridian'>
  	        <?php echo TribeEventsViewHelpers::getMeridianOptions("00:00:00") ?>
    	    </select>
				<?php endif; ?>
			</td>
		</tr>

		<tr class="EBForm">
			<td>
				<?php _e('Type','tribe-eventbrite'); ?>:<span class="tec-required">✳</span>
			</td>
			<td>
				<span class="tec-radio-option" ><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" name="EventBriteIsDonation" value="0" <?php checked( !isset( $_EventBriteIsDonation ) || $_EventBriteIsDonation == 0 ) ?> /><?php _e(' Set Price', 'tribe-eventbrite'); ?></span>
				<br/>
				<span class="tec-radio-option" ><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" name="EventBriteIsDonation" value="1" <?php checked( $_EventBriteIsDonation ==  1 ) ?> /><?php _e(' Donation Based', 'tribe-eventbrite'); ?></span>
				<br/>
				<span class="tec-radio-option" ><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" name="EventBriteIsDonation" value="2" <?php checked( $_EventBriteIsDonation == 2 ) ?> /><?php _e(' Free', 'tribe-eventbrite'); ?></span>
			</td>
		</tr>
		<tr class="EBForm" style="display:none">
			<td><?php _e('Cost','tribe-eventbrite'); ?>:<span class="tec-required">✳</span></td>
			<td><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='text' id='EventBriteEventCost' name='EventBriteEventCost' size='6' value='<?php echo ( !empty( $_EventBriteEventCost ) ) ? $_EventBriteEventCost : ''; ?>' /></td>
		</tr>
		<tr class="EBForm">
			<td>
				<?php _e('Quantity','tribe-eventbrite'); ?>:<span class="tec-required">✳</span>
			</td>
			<td>
				<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='text' name='EventBriteTicketQuantity' size='14' value='<?php echo $_EventBriteTicketQuantity; ?>' />
			</td>
		<tr  class="EBForm  eb-tec-payment-options">
			<td>
				<?php _e('Include Fee in Price','tribe-eventbrite'); ?>:<span class="tec-required">✳</span>
			</td>
			<td>
				<span class="tec-radio-option" ><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" class="radio" name="EventBriteIncludeFee" value="0" <?php checked( empty( $_EventBriteIncludeFee ) || 0 == $_EventBriteIncludeFee ) ?> /> <?php _e('Add Service Fee on top of price', 'tribe-eventbrite'); ?></span>
				<br/>
				<span class="tec-radio-option"><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" class="radio" name="EventBriteIncludeFee" value="1" <?php checked( 1 == $_EventBriteIncludeFee ) ?> /><?php _e(' Include Service fee in price', 'tribe-eventbrite'); ?></span>
			</td>
		</tr>
		<tr id="eb-tec-payment-options" class="EBForm eb-tec-payment-options">
			<td>
				<?php _e('Accepted Payment Methods','tribe-eventbrite'); ?>:<span class="tec-required">✳</span>
			</td>
			<td>
				<div id="eb-tec-payment-options-checkboxes">
               <div class='label'><strong>Online</strong></div>
               <div class='online'>
               		<?php
               		/*


					// EVENTBRITE changed their API to require a payment option

                  <span><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" class="checkbox" name="EventBritePayment_accept_online" id="EventBritePayment_accept_online-none" value="none" <?php checked( 'none' == $_EventBritePayment_accept_online ) ?> /><label for="EventBritePayment_accept_online"><?php _e('None', 'tribe-eventbrite'); ?></label></span>

                  */ ?>
                  <span><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" class="checkbox" name="EventBritePayment_accept_online" value="paypal" <?php checked( !empty( $_EventBritePayment_accept_online ) && 'paypal' == $_EventBritePayment_accept_online ) ?>/><label for="EventBritePayment_accept_online"><?php _e('Paypal', 'tribe-eventbrite'); ?></label></span>
                  <span><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" class="checkbox" name="EventBritePayment_accept_online" value="google" <?php checked( !empty( $_EventBritePayment_accept_online ) && 'google' == $_EventBritePayment_accept_online ) ?>/><label for="EventBritePayment_accept_online"><?php _e('Google Checkout', 'tribe-eventbrite'); ?></label></span>
               </div>
               <div class='label tec-eb-offline-pay-options'><strong>Offline</strong></div>
               <div class='offline tec-eb-offline-pay-options'>
                  <span><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="checkbox" class="checkbox" name="EventBritePayment_accept_check" value="1" <?php checked( !empty( $_EventBritePayment_accept_check ) && 1 == $_EventBritePayment_accept_check ) ?>/><label for="EventBritePayment_accept_check"><?php _e('Check', 'tribe-eventbrite'); ?></label></span>
                  <span><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="checkbox" class="checkbox" name="EventBritePayment_accept_cash" value="1" <?php checked( !empty( $_EventBritePayment_accept_cash ) && 1 == $_EventBritePayment_accept_cash ) ?>/><label for="EventBritePayment_accept_cash"><?php _e('Cash', 'tribe-eventbrite'); ?></label></span>
                  <span><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="checkbox" class="checkbox" name="EventBritePayment_accept_invoice" value="1" <?php checked( !empty( $_EventBritePayment_accept_invoice ) && 1 == $_EventBritePayment_accept_invoice ) ?>/><label for="EventBritePayment_accept_invoice"><?php _e('Send an Invoice', 'tribe-eventbrite'); ?></label></span>
               </div>
				</div>
			</td>
		</tr>
		<tr id="eb-tec-payment-options"  class="EBForm eb-tec-payment-options eb-tec-payment-details">
			<td class="eb-tec-payment-details-heading">
				<?php _e('Payment Details','tribe-eventbrite'); ?>:<span class="tec-required">✳</span>
			</td>
			<td>
				<div class="eb-tec-payment-instructions">
					<table>
					<tr>
						<td><label for="EventBritePayment_paypal_email"><?php _e('Paypal Account Email Address', 'tribe-eventbrite'); ?><span>&#10035;</span></label></td>
						<td><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="EventBritePayment_paypal_email" size="20" value="<?php echo $_EventBritePayment_paypal_email ?>" /></td>
					</tr>
					</table>
				</div>

				<div class="eb-tec-payment-instructions">
					<table>
					<tr>
						<td><label for="EventBritePayment_google_merchant_id"><?php _e('Google Merchant Id', 'tribe-eventbrite'); ?><span>&#10035;</span></label></td>
						<td><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="EventBritePayment_google_merchant_id" size="20" value="<?php echo $_EventBritePayment_google_merchant_id ?>" /></td>
					</tr>
					<tr>
						<td><label for="EventBritePayment_google_merchant_key"><?php _e('Google Merchant Key', 'tribe-eventbrite'); ?><span>&#10035;</span></label></td>
						<td><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="EventBritePayment_google_merchant_key" size="20" value="<?php echo $_EventBritePayment_google_merchant_key ?>" /></td>
					</tr>
					</table>
				</div>
				<div class="eb-tec-payment-instructions">
					<label for="EventBritePayment_instructions_check"><?php _e('Instructions for Payment by Check', 'tribe-eventbrite'); ?></label>
					<textarea tabindex="<?php $tribe_ecp->tabIndex(); ?>" name="EventBritePayment_instructions_check" rows="2" cols="55"><?php echo $_EventBritePayment_instructions_check ?></textarea>
				</div>
				<div class="eb-tec-payment-instructions">
					<label for="EventBritePayment_instructions_cash"><?php _e('Instructions for Payment by Cash', 'tribe-eventbrite'); ?></label>
					<textarea tabindex="<?php $tribe_ecp->tabIndex(); ?>" name="EventBritePayment_instructions_cash" rows="2" cols="55"><?php echo $_EventBritePayment_instructions_cash ?></textarea>
				</div>
				<div class="eb-tec-payment-instructions">
					<label for="EventBritePayment_instructions_invoice"><?php _e('Instructions for Payment by Invoice', 'tribe-eventbrite'); ?></label>
					<textarea tabindex="<?php $tribe_ecp->tabIndex(); ?>" name="EventBritePayment_instructions_invoice" rows="2" cols="55"><?php echo $_EventBritePayment_instructions_invoice ?></textarea>
				</div>
			</td>
		</tr>
		<tr  class="EBForm">
			<td colspan="2" class="snp_sectionheader">
			<h4><?php _e('Save this post to create the Event with Eventbrite.com','tribe-eventbrite');?></h4>
			<div><p><?php _e('When you save this post, an event will be created for you within Eventbrite. You can choose whether this event will save as a draft or live event in Eventbrite below (regardless of whether the event here in WordPress is a draft or not). You will be able to further configure your event here after saving. For more advanced controls visit the Eventbrite administration here:','tribe-eventbrite') ?> <a href="http://eventbrite.com?ref=etckt" target="_blank">http://eventbrite.com</a></p></div>
			</td>
		</tr>

		<tr class="EBForm">
			<td>
				<?php _e('Eventbrite Event Status', 'tribe-eventbrite'); ?>:
			</td>
			<td>
			<?php if( $tribe_ecp ) : ?>
				<select name="EventBriteStatus" tabindex="<?php $tribe_ecp->tabIndex(); ?>">
			<?php else : ?>
				<select name="EventBriteStatus">
			<?php endif; ?>
					<option value='Draft'><?php _e('Draft', 'tribe-eventbrite'); ?></option>
					<option value='Live'><?php _e('Live', 'tribe-eventbrite'); ?></option>
				</select>
			</td>
		</tr>

        <?php else : // have eventbrite id ?>
			<?php include( 'eventbrite-events-table.php' ); ?>
        <?php endif; // !$EventBriteId ?>

    <?php else : // no login or password ?>
    <tr><td colspan=2> <div class="tec-event-configure-warning">
        <?php _e('You must configure your Eventbrite API User Key in your', 'tribe-eventbrite' ); ?>
        <a href='<?php echo admin_url('profile.php'); ?>'><?php _e('profile page', 'tribe-eventbrite'); ?></a>
        <?php _e('before you can use the Eventbrite features of this plugin.', 'tribe-eventbrite' ); ?>
	</td>
	</tr>


    <?php endif; // no login or password ?>
<!-- </div><!--//eventBriteTicketing-->
