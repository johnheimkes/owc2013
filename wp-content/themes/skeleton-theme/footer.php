<?php
/**
 * Nerdery Theme
 *
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @subpackage Footer
 * @author
 * @version $Id$
 */
?>
        <div class="page-footer">
            <div class="wrapper-footer">
                <div class="wrapper-nav-footer">
                	<ul class="nav-footer">
                	    <li>
                            <a <?php if(is_front_page()) { echo "class='current'"; } ?> href="<?php echo home_url(); ?>">Home</a>
                        </li>
                        <li>
                            <a <?php if(is_page('mediation')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/mediation">Mediation</a>
                        </li>
                        <li>
                            <a <?php if(is_page('training')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/training">Training</a>
                        </li>
                        <li>
                            <a <?php if(is_page('volunteer')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/volunteer">Volunteer</a>
                        </li>
                        <li>
                            <a <?php if(is_page('support')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/support">Support</a>
                        </li>
                        <li>
                            <a <?php if(is_page('about')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/about">About</a>
                        </li>
                        <li>
                            <a <?php if(is_page('resources')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/resources">Resources</a>
                        </li>
                        <li>
                            <a href="#">Volunteer Login</a>
                        </li>
                	</ul>
                </div>
                <div class="footer-copy">
                    <ul class="h-list">
                        <li>
                            &copy; 2013 Community Mediation &amp; Restorative Services Inc., all rights reserved
                        </li>
                        <li>
                            <a href="#">Legal</a>
                        </li>
                        <li>
                            <a href="#">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <ul class="h-list">
                        <li>
                            Phone: 763-561-0033
                        </li>
                        <li>
                            Espanol: 612-629-6058
                        </li>
                        <li>
                            Fax: 763-561-0266
                        </li>
                        <li>
                           <a href="mailto:staff@mediationprogram.com">staff@mediationprogram.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- /.page-content -->
<?php wp_footer(); ?>
</body>
</html>