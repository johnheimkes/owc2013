<?php

/**
 * displays the existing Eventbrite event (admin fields)
 * expects _EventBriteId is present when editing an event
 *
 * @package TribeEventsEventBrite
 * @since  3.0
 * @author Modern Tribe Inc.
 */

global $userdata;
if( get_user_meta( $userdata->ID, 'eventbrite_user_key', true ) && !$_EventBriteId  ) : ?>
	<script type="text/javascript" charset="utf-8">
		jQuery(document).ready(function($) {
			// Register event handler for existing event toggle
			$("input[name='existingEBEvent']").click(function() {
				if ( $(this).val() == 'yes' ) {
					$("#eb-tec-existing-event-id-input").slideDown(200);
				} else {
					$("#eb-tec-existing-event-id-input").slideUp(200);
				}
			});

			// has a post title been entered?, a little hacky
			var useEventTitle = false;

			function ebTecIsPostTitleEmpty(event) {
				if( this.textLength == 0 ) useEventTitle = true;
				else useEventTitle = false;
			}

			$('#title').bind('focus', ebTecIsPostTitleEmpty);
			$('#editorcontainer textarea').bind('focus', ebTecIsDescriptionEmpty);

			// has the description been entered?
			var useEventDescription = false;
			var ebTecTinyMCEActive = false;
			function ebTecIsDescriptionEmpty(event) {
				var ed;
				var msg = '<?php _e("The content field must be empty in order to import the event description.", 'tribe-eventbrite'); ?>';
				if( typeof(tinyMCE) != 'undefined' && (ed = tinyMCE.activeEditor) && !ed.isHidden() ) {
					ebTecTinyMCEActive = true;
					var content = ed.getContent();
					if(content) {
						if( ebTecTinyMCEActive ) alert(msg);
						useEventDescription = false;
					} else useEventDescription = true;
				} else {
					ebTecTinyMCEActive = false;
					if( this.textLength == 0 ) useEventDescription = true;
					else {
						if( useEventDescription ) alert(msg);
						useEventDescription = false;
					}
				}
			}

			function spPopulateEventDetailsForm( processedEventBriteResponse ) {
// 				console.log(processedEventBriteResponse);
				$.each( processedEventBriteResponse, function( key, val ) {
					if(key == 'isPublishing') return true;
					if(key == 'post_title') {
						if( useEventTitle ) $('#title').val(val);
						else return true;
					} else if( key == 'content' ) {
						if( useEventDescription ) {
							if( ebTecTinyMCEActive ) tinyMCE.activeEditor.setContent(val);
							else $('#content').val(val);
						} else return true;
					}
					// tickets object
					if( key == 'eventbriteEventsTable' ) $('#EventBriteDetailDiv').replaceWith(val);
					else {

						var input = $("input[name='" + key.replace('[','\\[').replace(']','\\]') + "']");

						if( input.length != 0 ) input.val(val);
						else $("select[name='" + key + "']").val(val);
					}
					// commit the tags
					if( key == 'newtag[post_tag]') $("input[name='" + key + "'] + input").click();
					$('input[Name="SubmitExistingEventId"]').focus();
				});
				var publishSubmit = $('#publish');
				publishSubmit.unbind('click');
				if(processedEventBriteResponse['isPublishing']) publishSubmit.click();

				$('input[Name="SubmitExistingEventId"], #publish').attr({disabled:''}).val('Import Event');
				$('#eb-tec-existing-event-id-input').hide('slow');
			}

			$('input[Name="SubmitExistingEventId"], #publish').click(function(e) {
				var existingEventId = $('input[Name="ExistingEventId"]').val();
				var thisId = $(this).attr('id');
				if( existingEventId && !isNaN(existingEventId) ) {
					$('#title').focus();
					$('#editorcontainer textarea').focus();
					var lookForPostId = $("input[Name='temp_ID']").val();
					if( !lookForPostId ) lookForPostId = $("input[Name='post_ID']").val();
					if( lookForPostId ) {
						$.post( ajaxurl, { action: 'existingEventId', existingEventId: existingEventId, postId: lookForPostId, clickedId: thisId }, spPopulateEventDetailsForm, 'json' );
					}
					e.preventDefault();
				} else if( thisId != 'publish') event.preventDefault();
			});

	}); // end document ready
	</script>

	<table  class="eventtable">
		<tr>
			<td colspan="2" class="snp_sectionheader">
				<h4><?php _e('Import Event from Eventbrite', 'tribe-eventbrite'); ?></h4>
			</td>
		</tr>
		<tr id="eb-tec-import-event">
			<td style="width:300px;">
				<?php _e('Import an existing Eventbrite event?','tribe-eventbrite'); ?>
			</td>
			<td>
				<label><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='existingEBEvent' value='yes' />&nbsp;<b>Yes</b></label>
				<label><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='existingEBEvent' value='no' checked="checked" />&nbsp;<b>No</b></label>
			</td>
		</tr>
		<tr id="eb-tec-existing-event-id-input">
			<td>
				<label for="ExistingEventId"><?php _e('Enter your Eventbrite Event ID here:','tribe-eventbrite'); ?></label>
			</td>
			<td>
				<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="ExistingEventId" size="25"  value="<?php echo $_EventBriteId; ?>" />
				<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" style="cursor:pointer;" type="submit" name="SubmitExistingEventId" value="Import Data" />
			</td>
		</tr>
	</table>
<?php endif; ?>
