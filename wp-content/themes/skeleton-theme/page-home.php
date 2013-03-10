<?php
/**
 * Nerdery Theme
 * Template name: Page - Home
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @subpackage Single
 * @author
 * @version $Id$
 */
?>
<?php get_header(); ?>
 <div class="section-wrap bg-lightblue">
    <div class="grid-site hero-img hero-img-home">
        <div class="grid-main ">
            <div class="grid-row-s">
                <div class="grid-col grid-col-4">
                    <div class="feature">
                        <div class="feature-hd">
                            <?php
                            // Section 1
                            if(get_field('home_section_1')):
                            ?>
                            <?php while(has_sub_field('home_section_1')): ?>
                            <h2 class="hdg hdg-2"><?php the_sub_field('home_section_1_title'); ?></h2>
                        </div>
                        <div class="feature-bd">
                            <?php the_sub_field('home_section_1_paragraph'); ?>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="feature-ft">
                            <a href='#' class="btn">How It Works</a>
                        </div>
                    </div>
                </div>
                <div class="grid-col grid-col-6 mobile-none">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-wrap-img bg-white">
    <div class="grid-site">
        <div class="grid-main">
            <div class="grid-row-s">
                <div class="grid-col grid-col-5">
                    <div class="hennepin-county">

                    </div>
                </div>
                <div class="grid-col grid-col-5">

                    <div class="feature">
                        <div class="feature-hd">
                            <?php
                                // Section 2
                                if(get_field('home_section_2')):
                            ?>
                            <?php while(has_sub_field('home_section_2')): ?>
                            <h2 class="hdg hdg-2"><?php the_sub_field('home_section_2_title'); ?></h2>
                        </div>
                        <div class="feature-bd">
                            <?php the_sub_field('home_section_2_paragraph'); ?>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-wrap bg-turq">
    <div class="grid-site">
        <div class="grid-row">
            <div class="grid-col grid-col-1 mobile-none">
                &nbsp;
            </div>
            <div class="grid-col grid-col-7">
                <?php
                // Section 3
                if(get_field('home_section_3')):
                ?>
                    <?php while(has_sub_field('home_section_3')): ?>
                    <div class="section-quote">
                        <div class="section-quote-bd">
                            <?php the_sub_field('home_section_3_quote'); ?>
                        </div>
                        <div class="section-quote-ft">
                            <?php the_sub_field('home_section_3_author'); ?>
                        </div>
                    </div>
            </div>
            <div class="grid-col grid-col-4">
                <img src="<?php the_sub_field('home_section_3_image'); ?>" alt="" />
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="section-wrap bg-lightblue">
    <div class="grid-site">
        <div class="grid-row grid--push-l">
            <div class="participant-options">
                <?php
                // Section 4a
                if(get_field('home_section_4a')):
                ?>
                <?php while(has_sub_field('home_section_4a')): ?>
                <div class="grid-col grid-col-4">
                    <div class="feature">
                        <div class="feature-hd">
                            <h2 class="hdg hdg-4">Volunteers</h2>
                        </div>
                        <div class="feature-bd">
                            <?php the_sub_field('home_section_4a_volunteers_paragraph'); ?>
                        </div>
                        <div class="feature-ft">
                            <a href="#" class="btn">Sign Up To Volunteer</a>
                        </div>
                    </div>
                </div>

                <div class="grid-col grid-col-4">
                    <div class="feature">
                        <div class="feature-hd">
                            <h2 class="hdg hdg-4">Donations</h2>
                        </div>
                        <div class="feature-bd">
                            <?php the_sub_field('home_section_4a_donors_paragraph'); ?>
                        </div>
                        <div class="feature-ft">
                            <a href="#" class="btn">More About Donations</a>
                        </div>
                    </div>
                </div>
                <div class="grid-col grid-col-4">
                    <div class="feature">
                        <div class="feature-hd">
                            <h2 class="hdg hdg-4">Partners</h2>
                        </div>
                        <div class="feature-bd">
                            <?php the_sub_field('home_section_4a_nonprofits_paragraph'); ?>
                        </div>
                        <div class="feature-ft">
                            <a href="#" class="btn">Nonprofit Resources</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="grid-row">
            <div class="grid-col grid-col-1 mobile-none">
                &nbsp;
            </div>
            <div class="grid-col grid-col-4">
                <?php
                // Section 3
                if(get_field('home_section_4a')):
                ?>
                    <?php while(has_sub_field('home_section_4b')): ?>

                    <img src="<?php the_sub_field('home_section_4b_image'); ?>" alt="alt" />
            </div>
            <div class="grid-col grid-col-7">
                    <div class="section-quote">
                        <div class="section-quote-bd">
                            <?php the_sub_field('home_section_4b_quote'); ?>
                        </div>
                        <div class="section-quote-ft">
                            <?php the_sub_field('home_section_4b_author'); ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="section-wrap bg-white">
    <div class="grid-site">
        <div class="grid-row">
            <div class="partners">
                <div class="partners-hd">
                        <h2 class="hdg hdg-4">Partners</h2>
                    </div>
                <?php
                $partners_query = new WP_Query( "post_type=partners" );
                
                foreach($partners_query->posts as $partner) { ?>
                    <div class="partners-bd">
                        <div class="partner-name">
                            <?php echo $partner->post_content; ?>
                        </div>
                    </div>
                <?php } ?>

                    
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>