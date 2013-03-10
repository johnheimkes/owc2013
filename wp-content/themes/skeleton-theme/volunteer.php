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
?>
<?php

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
    
?>
<div class="section-wrap bg-lightblue">
    <div class="grid-site">
        <div class="grid-main">
            <div class="grid-row-s">
                <div class="grid-col grid-col-7">
                    <h2 class="hdg hdg-5 hdg-bold"><?php the_title(); ?></h3>
                        <span class="hdg-4 hdg"><?php the_content(); ?></span>
                    <br>             
                    <div class="btn">
                        Sign Up
                    </div>
                </div>
                <div class="grid-col grid-col-3">
                    <img src="<?php bloginfo('template_directory'); ?>/assets/images/volunteersGraphic.png" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-wrap bg-grey">    
    <div class="grid-site">
        <div class="grid-main">        
            <div class="grid-row-s">
                <div class="grid-col grid-col-5">
                    <h2 class="hdg-bold">There are five different types of volunteers:</h2>
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