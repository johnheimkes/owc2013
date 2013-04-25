<?php
/**
 * Nerdery Theme
 * template name: Volunteer
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @subpackage Single
 * @author
 * @version $Id$
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
    
?>
<div class="section-wrap bg-lightblue">
    <div class="grid-site">
        <div class="grid-main">
            <div class="grid-row-s">
                <div class="grid-col grid-col-7">
                    <div class="feature">
                        <div class="feature-hd">
                            <h2 class="hdg hdg-5 hdg-bold"><?php the_title(); ?></h2>
                        </div>
                        <div class="feature-bd feature-bd_extended">
                            <span class=""><?php the_content(); ?></span>
                        </div>
                        <div class="featured-ft">
                            <a href="#" class="btn">Sign Up</a>
                        </div>
                    </div>
                </div>
                <div class="grid-col grid-col-3">
                    <div class="volunteer-img">
                        <img src="<?php bloginfo('template_directory'); ?>/assets/images/volunteersGraphic.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-wrap bg-grey">    
    <div class="grid-site">
        <div class="grid-main">
            <div class="grid-row-s grid-row-push-s">
                <div class="grid-col grid-col-10">
                    <h2 class="hdg-bold hdg-5">There are five different types of volunteers:</h2>
                </div>
            </div>        
            <div class="grid-row-s">
                <div class="grid-col grid-col-5">
                    <?php if (get_field('volunteer_types')) : ?>
                        <ul>
                            <?php while(has_sub_field('volunteer_types')) : ?>
                                <li><?php the_sub_field('volunteer_type'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="grid-col grid-col-5">
                    <p class="padded-bottom">How would YOU like to be involved?  When you’re ready (or even close to being ready) we’d love to hear from you. </p>
                    <div class="btn">
                        Sign Up
                    </div>                        
                </div>                    
            </div>
        </div>
    </div>
</div>
    

<?php

endwhile; endif;

get_footer();

?>