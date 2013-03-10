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

<?php
// Section 1
if(get_field('home_section_1')): 
?>
    <h2>Section 1</h2>
    <div>
        <?php while(has_sub_field('home_section_1')): ?>
            <?php the_sub_field('home_section_1_title'); ?>
            <?php the_sub_field('home_section_1_paragraph'); ?>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php
// Section 2
if(get_field('home_section_2')): 
?>
    <h2>Section 2</h2>
    <div>
        <?php while(has_sub_field('home_section_2')): ?>
            <?php the_sub_field('home_section_2_title'); ?>
            <?php the_sub_field('home_section_2_paragraph'); ?>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php
// Section 3
if(get_field('home_section_3')): 
?>
    <h2>Section 3</h2>
    <div>
        <?php while(has_sub_field('home_section_3')): ?>
            <?php the_sub_field('home_section_3_quote'); ?>
            <?php the_sub_field('home_section_3_author'); ?>
            <img src="<?php the_sub_field('home_section_3_image'); ?>" alt="" />
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php
// Section 4a
if(get_field('home_section_4a')): 
?>
    <h2>Section 4a</h2>
    <div>
        <?php while(has_sub_field('home_section_4a')): ?>
            <?php the_sub_field('home_section_4a_nonprofits_paragraph'); ?>
            <?php the_sub_field('home_section_4a_volunteers_paragraph'); ?>
            <?php the_sub_field('home_section_4a_donors_paragraph'); ?>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php
// Section 4b
if(get_field('home_section_4a')): 
?>
    <h2>Section 4b</h2>
    <div>
        <?php while(has_sub_field('home_section_4b')): ?>
            <img src="<?php the_sub_field('home_section_4a_image'); ?>" alt="alt" />
            <?php the_sub_field('home_section_4a_quote'); ?>
            <?php the_sub_field('home_section_4a_author'); ?>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php get_footer(); ?>