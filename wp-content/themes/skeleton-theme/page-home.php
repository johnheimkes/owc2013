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
                <div class="grid-col grid-col-5">
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
                            <a href='<?php echo home_url(); ?>/services' class="btn">How It Works</a>
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

<!-- <div class="section-wrap bg-turq">
    <div class="grid-site">
        <div class="grid-row">
            <div class="grid-col grid-col-2 mobile-none">
                &nbsp;
            </div>
            <div class="grid-col grid-col-6">
                <?php
                // Section 3
                //if(get_field('home_section_3')):
                ?>
                    <?php //while(has_sub_field('home_section_3')): ?>
                    <div class="section-quote">
                        <div class="section-quote-bd white">
                            <?php //the_sub_field('home_section_3_quote'); ?>
                        </div>
                        <div class="section-quote-ft">
                            <?php //the_sub_field('home_section_3_author'); ?>
                        </div>
                    </div>
            </div>
            <div class="grid-col grid-col-4">
                <img src="<?php //the_sub_field('home_section_3_image'); ?>" alt="" />
                    <?php //endwhile; ?>
                <?php //endif; ?>
            </div>
        </div>
    </div>
</div> -->

<div class="section-wrap bg-lightblue">
    <div class="grid-site">
        <div class="grid-row grid-row-push-l">
            <div class="participant-options">
                <?php
                // Section 4a
                if(get_field('home_section_4a')):
                ?>
                <?php while(has_sub_field('home_section_4a')): ?>
                <div class="grid-col grid-col-4">
                    <div class="feature">
                        <div class="feature-hd">
                            <h2 class="hdg hdg-4"><i class="icn icon-sprite-about home-people"></i>Volunteers</h2>
                        </div>
                        <div class="feature-bd feature-bd--flex-box">
                            <?php the_sub_field('home_section_4a_volunteers_paragraph'); ?>
                        </div>
                        <div class="feature-ft">
                            <a href="<?php echo home_url(); ?>/volunteer" class="btn">Volunteer Opportunities</a>
                        </div>
                    </div>
                </div>

                <div class="grid-col grid-col-4">
                    <div class="feature">
                        <div class="feature-hd">
                            <h2 class="hdg hdg-4"><i class="icn icon-sprite-about home-presents"></i>Donations</h2>
                        </div>
                        <div class="feature-bd feature-bd--flex-box">
                            <?php the_sub_field('home_section_4a_donors_paragraph'); ?>
                            <a href="http://www.smartgivers.org/meets_standards_seal" rel="external"><img style="margin-top: 10px" src="<?php echo bloginfo('template_url'); ?>/assets/images/standards_cmyk02_2.png" width="100" height="75" alt="" /></a>
                        </div>
                        <div class="feature-ft">
                            <a href="<?php echo home_url(); ?>/donate" class="btn">More About Donations</a>
                        </div>
                    </div>
                </div>
                <div class="grid-col grid-col-4">
                    <div class="feature">
                        <div class="feature-hd">
                            <h2 class="hdg hdg-4"><i class="icn icon-sprite-about home-home"></i>Partners</h2>
                        </div>
                        <div class="feature-bd feature-bd--flex-box">
                            <?php the_sub_field('home_section_4a_nonprofits_paragraph'); ?>
                        </div>
                        <div class="feature-ft">
                            <a href="<?php echo home_url(); ?>/resources" class="btn">Nonprofit Resources</a>
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
                        <div class="section-quote-bd blue">
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



                    <div class="partners-bd">
                        <?php
                    $partners_query = new WP_Query( "post_type=partners" );

                    foreach($partners_query->posts as $partner) { ?>
                        <div class="partner-name">
                            <?php echo $partner->post_content; ?>
                       </div>
                       <?php } ?>
                    </div>


            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>