<?php
/**
 * Nerdery Theme
 * Template name: Page - About
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @subpackage Single
 * @author
 * @version $Id$
 */
?>
<?php get_header(); ?>

 <!-- Our Staff -->
<?php if(get_field('about__our_staff')): ?>
    <ul>
    <?php while(has_sub_field('about__our_staff')): ?>
        <li>sub_field_1 = <?php the_sub_field('about__our_staff_content'); ?>, sub_field_2 = <?php the_sub_field('about__staff_image'); ?></li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>


<?php if(get_field('about__ft_staff')): ?>
    <ul>
    <?php while(has_sub_field('about__ft_staff')): ?>
        <li>sub_field_1 = <?php the_sub_field('about__employee_title'); ?>, sub_field_2 = <?php the_sub_field('about__employee_name'); ?>, sub_field_1 = <?php the_sub_field('about__employee_biography'); ?></li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>


<?php if(get_field('about__pt_staff')): ?>
    <ul>
    <?php while(has_sub_field('about__pt_staff')): ?>
        <li>sub_field_1 = <?php the_sub_field('about__pt_employee_name'); ?></li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>


<?php if(get_field('about__board_of_directors_officers')): ?>
    <ul>
    <?php while(has_sub_field('about__board_of_directors_officers')): ?>
        <li>sub_field_1 = <?php the_sub_field('about__officer_name'); ?>, sub_field_2 = <?php the_sub_field('about__officer_title'); ?></li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>


<?php if(get_field('about__board_of_directors_members')): ?>
    <ul>
    <?php while(has_sub_field('about__board_of_directors_members')): ?>
        <li>sub_field_1 = <?php the_sub_field('member_name'); ?></li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>

<?php if(get_field('about__accomplishments')): ?>
    <ul>
    <?php while(has_sub_field('about__accomplishments')): ?>
        <li>sub_field_1 = <?php the_sub_field('about__acc_title'); ?>, sub_field_2 = <?php the_sub_field('about__community_service_num'); ?>, sub_field_3 = <?php the_sub_field('about__court_service_num'); ?>, sub_field_4 = <?php the_sub_field('about__youth_restorative_num'); ?>, sub_field_5 = <?php the_sub_field('about__volunteer_training_num'); ?>, sub_field_5 = <?php the_sub_field('about__accomplishments_pdf'); ?></li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>

<?php if(get_field('about__financial_reports_section')): ?>
    <ul>
    <?php while(has_sub_field('about__financial_reports_section')): ?>
        <li>sub_field_1 = <?php the_sub_field('about__total_income'); ?>, sub_field_2 = <?php the_sub_field('about__income_contracts_and_fees'); ?>, sub_field_3 = <?php the_sub_field('about__income_foundations'); ?>, sub_field_4 = <?php the_sub_field('about__income_state_mn'); ?>, sub_field_5 = <?php the_sub_field('about__total_expenses'); ?>, sub_field_5 = <?php the_sub_field('about__expense_program'); ?>, sub_field_5 = <?php the_sub_field('about__expense_fundraising'); ?>, sub_field_5 = <?php the_sub_field('about__expense_admin'); ?>, sub_field_5 = <?php the_sub_field('about__percent_donate'); ?>, sub_field_5 = <?php the_sub_field('about__pdf_financial_report'); ?></li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>


<?php if(get_field('about__pdf_financial_report')): ?>
    <ul>
    <?php while(has_sub_field('about__pdf_financial_report')): ?>
        <li>sub_field_1 = <?php the_sub_field('about__finanical_report_title'); ?>, sub_field_2 = <?php the_sub_field('about__financial_report_pdf'); ?></li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>about__pdf_financial_report


<?php get_footer(); ?>