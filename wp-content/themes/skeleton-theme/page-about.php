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

    <div class="section-wrap bg-lightblue">
        <div class="grid-site">
            <div class="grid-sidebar">
                <div class="secondary-nav">
                    <ul>
                        <li class="title">About</li>
                        <li>
                            <a href="#overview">Overview</a>
                        </li>
                        <li>
                            <a href="#staff">Staff & Directors</a>
                        </li>                        
                        <li>
                            <a href="#accomplishments">Accomplishments</a>
                        </li>
                        <li>
                            <a href="#financial-report">Financial Report</a>
                        </li>
                        <li>
                            <a href="#partners">Partners</a>
                        </li>
                        <li>
                            <a href="contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="grid-main">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-5">
                        <h2 class="hdg-5 hdg-bold">Our Mission</h3>
                        <p>To develop the capacity of the community to respectfully resolve conflict and repair harm.</p>
                    </div>
                    <div class="grid-col grid-col-5">
                        <img src="http://192.168.1.101/owc2013/wp-content/uploads/2013/03/about-hero.jpg" title="" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid-site">  
        <div class="grid-main">
            <div class="grid-row-s">            
                <div class="grid-col grid-col-10">
                    <h2 class="hdg-5 hdg-bold hdg-padded">Our Staff</h2>
                    <?php if(get_field('about__our_staff')): ?>
                        <?php while(has_sub_field('about__our_staff')): ?>
                        <p class="padded-bottom"><?php the_sub_field('about__our_staff_content'); ?></p>
                        <img src="<?php the_sub_field('about__staff_image'); ?>" title="" alt="" />
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="grid-row grid-row-push-s">
                <?php if(get_field('about__ft_staff')): ?>
                    <div class="grid-col grid-col-4 padded-top">
                    <?php while(has_sub_field('about__ft_staff')): ?>
                        <span class="hdg-bold"><?php the_sub_field('about__employee_name'); ?></span>
                        <br /><?php the_sub_field('about__employee_title'); ?>
                        <p><?php the_sub_field('about__employee_biography'); ?></p>
                    <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid-main padded-bottom">
            <div class="grid-row-s">            
                <div class="grid-col grid-col-10">
                    <h2 class="hdg-5 hdg-bold hdg-padded">Part-time Staff</h2>
                </div>
            </div>  
            <?php if(get_field('about__pt_staff')): ?>
                <div class="grid-row-s">            
                    <div class="grid-col grid-col-2">
                <?php while(has_sub_field('about__pt_staff')): ?>
                    <b><?php the_sub_field('about__pt_employee_name'); ?></b>
                <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <hr>


        <div class="grid-main">
            <div class="grid-row-s">            
                <div class="grid-col grid-col-10">
                    <h2 class="hdg-5 hdg-bold hdg-padded">Board of Directors</h2>
                </div>
            </div>  

            <?php if(get_field('about__board_of_directors_officers')): ?>
                <div class="grid-row-s">            
                    <div class="grid-col grid-col-2">
                <?php while(has_sub_field('about__board_of_directors_officers')): ?>
                    <span class="hdg-bold"><?php the_sub_field('about__officer_name'); ?></span>
                    <br /><?php the_sub_field('about__officer_title'); ?>
                <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
                                                                  
        </div> 

        <div class="grid-main">
            <div class="grid-row-s">            
                <div class="grid-col grid-col-10">
                    <span class="hdg-bold">Additional Board Members</span>
                </div>
            </div>  

            <?php if(get_field('about__board_of_directors_members')): ?>
                <div class="grid-row-s">            
                    <div class="grid-col grid-col-2">
                <?php while(has_sub_field('about__board_of_directors_members')): ?>
                    <?php the_sub_field('member_name'); ?>
                <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="section-wrap bg-turq">
        <div class="grid-site">
            <?php if(get_field('about__accomplishments')): ?>

                <?php while(has_sub_field('about__accomplishments')): ?>
            <div class="grid-main">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-8">
                        <h2 class="hdg-5 hdg-bold hdg-padded"><?php the_sub_field('about__acc_title'); ?></h2>
                    </div>
                    <div class="grid-col grid-col-2">
                        <a class="btn" href="<?php the_sub_field('about__accomplishments_pdf'); ?>">Download Annual Report</a>
                    </div>                    
                </div>
            </div>
            
            <div class="grid-main">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-1">
                        People Standing Icon
                    </div>
                    <div class="grid-col grid-col-3">
                        <h5 class="hdg-1"><?php the_sub_field('about__community_service_num'); ?></h5>
                        <span class="hdg-5">Mediations</span>
                    </div> 
                    <div class="grid-col grid-col-4">
                        <h5 class="hdg-5 hdg-bold">Community Services</h3>
                        <p>Giving Hennepin County residents an opportunity to respectfully move from conflict to resolution.</p>
                    </div>                                    
                </div>    

                <div class="grid-row-s">
                    <div class="grid-col grid-col-3">
                        Gavel Icon
                    </div>
                    <div class="grid-col grid-col-3">
                        <h5 class="hdg-1"><?php the_sub_field('about__court_service_num'); ?></h5>
                        Conferences
                    </div> 
                    <div class="grid-col grid-col-3">
                        <h3 class="hdg-bold"><?php the_sub_field('about__youth_restorative_num'); ?></h3>
                        <p>Supporting youth by holding them accountable, repairing harm and improving conflict resolution and decision making skills. 96% succeeded!</p>
                    </div>                                    
                </div> 

                <div class="grid-row-s">
                    <div class="grid-col grid-col-2">
                        Tools Icon
                    </div>
                    <div class="grid-col grid-col-2">
                        <span class="hdg-1"><?php the_sub_field('about__volunteer_training_num'); ?></span>
                        Mediators Trained
                    </div> 
                    <div class="grid-col grid-col-5">
                        <h3 class="hdg-3">Volunteer and Training Opportunities</h3>
                        <p>Investing in our community through Volunteer Development and Mediation & Restorative Practices trainings</p>
                    </div>                                    
                </div>                 
            </div>
            <?php endwhile; ?>

        <?php endif; ?>
        </div>
    </div>  

            
                    <?php the_sub_field('about__finanical_report_title'); ?><?php the_sub_field('about__financial_report_pdf'); ?>

    
     
    <div class="section-wrap bg-white">
        <div class="grid-site">
            <div class="grid-main">
                <?php if(get_field('about__financial_reports_section')): ?>
                    <?php while(has_sub_field('about__financial_reports_section')): ?>
                <div class="grid-row-s">
                    <div class="grid-col grid-col-12">
                        <h2 class="hdg-5 hdg-bold padded-bottom">Financial Report</h2>
                    </div>
                </div>
                <div class="grid-row-s">
                    <div class="grid-col grid-col-3">
                        <h3 class="hdg-bold">Income</h3>
                        <span class="hdg-2 turq hdg-bold"><?php the_sub_field('about__total_income'); ?></span>
                    </div>                    

                    <div class="grid-col grid-col-3">
                        <span class="hdg-bold"><?php the_sub_field('about__income_contracts_and_fees'); ?></span> Contracts and Fees
                        <br><span class="hdg-bold"><?php the_sub_field('about__income_foundations'); ?></span> Foundations
                        <br><span class="hdg-bold"><?php the_sub_field('about__income_state_mn'); ?></span> State of MN
                    </div>
                    <div class="grid-col grid-col-2">
                        <?php if(get_field('about__pdf_financial_report')): ?>
                            <?php while(has_sub_field('about__pdf_financial_report')): ?>
                                <a class="btn" href="<?php has_sub_field('about__finanical_report_title'); ?>"><?php has_sub_field('about__financial_report_pdf'); ?></a><br />
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>             
                </div>    
                <div class="grid-row-s">
                    <div class="grid-col grid-col-3">
                        <h3 class="hdg-bold">Expenses</h3>
                        <span class="hdg-2 turq hdg-bold"><?php the_sub_field('about__total_expenses'); ?></span>
                    </div>                    

                    <div class="grid-col grid-col-3">
                        <span class="hdg-bold"><?php the_sub_field('about__expense_program'); ?></span> Program
                        <span class="hdg-bold"><?php the_sub_field('about__expense_fundraising'); ?></span> Fundraising
                        <span class="hdg-bold"><?php the_sub_field('about__expense_admin'); ?></span> Administration
                    </div>
                    <div class="grid-col grid-col-4">
                        MEETS STANDARDS IMAGE
                    </div>             
                </div> 
                <div class="grid-row-s">
                    <div class="grid-col grid-col-10">
                        <h3 class="hdg-bold">Expenses</h3>
                        <span class="hdg-2 hdg-bold turq"><?php the_sub_field('about__percent_donate'); ?></span>
                        <p class="padded-bottom">of all donations go to 
                        <br />providing services</p>
                    </div>                              
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <hr>

            <div class="grid-main">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-10">
                        <h2 class="hdg-5 hdg-bold">Partners</h2>
                    </div>
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

<?php get_footer(); ?>