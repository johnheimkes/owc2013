<?php

/**
 * add Eventbrite options fields
 * 
 * @package TribeEventsEventBrite
 * @since  3.0
 * @author Modern Tribe Inc.
 */

?>
<?php $tribeEvents = TribeEvents::instance(); ?>
<h3><?php _e('Eventbrite Options', 'tribe-eventbrite'); ?></h3>
<p><?php _e('These settings change the default event form. For example, if you set a default venue, this field will be automatically filled in on a new event.', 'tribe-eventbrite') ?></p>
<table class="form-table">
<tr>
<th scope="row"><?php _e('Automatically replace empty fields with default values','tribe-eventbrite'); ?></th>
<td>
<fieldset>
<legend class="screen-reader-text">
<span><?php _e('Automatically replace empty fields with default values','tribe-eventbrite'); ?></span>
</legend>
<label title='Replace empty fields'>
<input type="checkbox" name="defaultValueReplace" value="1" <?php checked( tribe_get_option('defaultValueReplace') ); ?> /> 
<?php _e('Enabled','tribe-eventbrite'); ?>
</label>
</fieldset>
</td>
</tr>