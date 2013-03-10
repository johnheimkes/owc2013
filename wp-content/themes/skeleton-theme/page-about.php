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


<?php

    // At a Glance
    // At a Glance Title
    the_field('about__glance_title');
    // Num Community Services Med.
    the_field('about__community_service_num');
    // Num Court Services Med.
    the_field('about__court_service_num');
    // Num Youth and Restorative Med.
    the_field('about__youth_restorative_num');
    // Num Volunteer Training Med.
    the_field('about__volunteer_training_num');
 
    // Financial Reports
    // Income
    // Total Income 
    the_field('about__total_income');
    // Income: Contracts and Fees 
    the_field('about__income_contracts_and_fees');
    // Income: Foundations
    the_field('about__income_foundations');
    // Income: State of MN
    the_field('about__income_state_mn');
    // Expenses
    // Total Expenses
    the_field('about__total_expenses');
    // Expense: Program
    the_field('about__expense_program');
    // Expense: Fundraising
    the_field('about__expense_fundraising');
    // Expense: Administration
    the_field('about__expense_admin');
    
    $rows = get_field('about__pdf_financial_report');
    if($rows) {
        echo '<ul>';
        foreach($rows as $row) { ?>
            <li>sub_field_1 =  <?php echo $row['about__finanical_report_title'] ?> | sub_field_2 = <?php echo $row['about__financial_report_pdf'] ?></li>';
  <?php }
        echo '</ul>';
    }
 ?>

<?php get_footer(); ?>