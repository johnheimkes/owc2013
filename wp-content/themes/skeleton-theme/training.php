<?php
/**
 * Nerdery Theme
 * template name: Training
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @subpackage Single
 * @author
 * @version $Id$
 */

get_header();

?>
<div>
    <div class="section-wrap bg-lightblue">
        <div class="grid-site hero-img hero-img-training">
            <div class="">
                <div class="grid-row">
                    <div class="grid-col grid-col-5">
                        <div class="feature">
                            <div class="feature-hd">
                                <h2 class="hdg-bold hdg-5">Training</h2>
                            </div>
                            <div class="feature-bd feature-bd_small">
                                Community Mediation &amp; Restorative Services, Inc believes training is an effective strategy as we seek to develop the capacity of our community to respectfully resolve conflict and repair harm. We collaborate with other mediation and restorative parties to create more opportunities for people to participate in transformative, skill-building experiences.
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
   
    <div class="section-wrap bg-turq">
        <div class="grid-site grid-site_thin">
            <div class="grid-main">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-8 white">
                        <h2 class="hdg-4 hdg-bold">Sign up to be notified for the next available classes</h2>
                    </div>
                    <div class="grid-col grid-col-2 white">
                        <a href="#" class="btn">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-wrap bg-lightblue">
        <div class="grid-site">
            <div class="grid-main">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>

    <div class="section-wrap section-wrap-about bg-white">
        <div class="grid-site">
            <div class="grid-main">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-10">
                        <h2 class="hdg hdg-4 hdg-bold">Scholarships</h2>
                    </div>
                </div>
                <div class="grid-row-s">
                    <div class="stretch">
                        <div>
                            Limited number of scholarships are available. Contact your sponsoring organization about scholarship possibilities
                        </div>
                        <div>
                            <!-- <ul class="h-list h-list_scholarships">
                                <li>
                                    Phone: 555-555-5555
                                </li>
                                <li>
                                    Email: hello@email.com
                                </li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-wrap section-wrap-about bg-turq">
        <div class="grid-site">
            <div class="grid-main">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-10">
                        <h2 class="hdg-4 hdg-bold">Upcoming Workshops and Conferences</h2>
                    </div>
                </div>
                <div class="grid-row-s">
                    <ul class="training-links">
                        <li><a href="#">Center for Multicultural Mediation and Restorative Justice (CMMRJ)</a></li>
                        <li><a href="#">Community Mediation &amp; Restorative Services, Inc. (CMS)</a></li>
                        <li><a href="#">Dispute Resolution Center (DRC)</a></li>
                        <li><a href="#">Mediation Services For Anoka County (MSAC)</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

get_footer();