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
        <div class="grid-site hero-img hero-img-about">
            <div class="grid-sidebar">
                <div class="secondary-nav">
                    <ul>
                        <li class="title">About</li>
                        <li>
                            <a href="#overview" class="js-jump-link">Overview</a>
                        </li>
                        <li>
                            <a href="#staff" class="js-jump-link">Staff & Directors</a>
                        </li>                        
                        <li>
                            <a href="#accomplishments" class="js-jump-link">Accomplishments</a>
                        </li>
                        <li>
                            <a href="#financial-report" class="js-jump-link">Financial Report</a>
                        </li>
                        <li>
                            <a href="#partners" class="js-jump-link">Partners</a>
                        </li>
                        <li>
                            <a href="contact" class="js-jump-link">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="overview" class="grid-main js-jump-link-target">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-5">
                        <h2 class="hdg-5 hdg-bold section-quote-hd_about">Our Mission</h3>
                        <div class="section-quote section-quote_about">
                            <div class="section-quote-bd blue">
                                To develop the capacity of the community to respectfully resolve conflict and repair harm.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-wrap">
        <div class="grid-site">  
            <div id="staff" class="grid-main js-jump-link-target">
                <div class="grid-row-s">            
                    <div class="grid-col grid-col-10">
                        <h2 class="hdg-4 hdg-bold hdg-padded">Our Staff</h2>
                        <?php if(get_field('about__our_staff')): ?>
                            <?php while(has_sub_field('about__our_staff')): ?>
                            <p class="padded-bottom"><?php the_sub_field('about__our_staff_content'); ?></p>
                            <img class="about-staff" src="<?php the_sub_field('about__staff_image'); ?>" title="" alt="" />
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="grid-row grid-row-push-l">
                    <?php if(get_field('about__ft_staff')): ?>
                        
                        <?php while(has_sub_field('about__ft_staff')): ?>
                            <div class="grid-col grid-col-4 padded-top">
                                <div class="hdg-bold hdg-5"><?php the_sub_field('about__employee_name'); ?></div>
                                <div class="about-employee"><?php the_sub_field('about__employee_title'); ?></div>
                                <p><?php the_sub_field('about__employee_biography'); ?></p>
                            </div>
                        <?php endwhile; ?>
                        
                    <?php endif; ?>
                </div>
            </div>

            <div class="grid-main about-seperate-border ">
                <div class="grid-row-s">            
                    <div class="grid-col grid-col-10">
                        <h2 class="hdg-5 hdg-bold hdg-padded">Part-time Staff</h2>
                    </div>
                </div>  
                <?php if(get_field('about__pt_staff')): ?>
                    <div class="grid-row-s">            
                        
                    <?php while(has_sub_field('about__pt_staff')): ?>
                        <div class="grid-col grid-col-2">
                            <b><?php the_sub_field('about__pt_employee_name'); ?></b>
                        </div>
                    <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="grid-main grid-row-push-m">
                <div class="grid-row-s">            
                    <div class="grid-col grid-col-10">
                        <h2 class="hdg-4 hdg-bold grid-row-push-s">Board of Directors</h2>
                    </div>
                </div>  

                <?php if(get_field('about__board_of_directors_officers')): ?>
                    <div class="grid-row-s">
                        <div class="blocks blocks-4up blocks-large">              
                        <?php while(has_sub_field('about__board_of_directors_officers')): ?>
                            <div>
                                <div class="hdg-bold hdg-6"><?php the_sub_field('about__officer_name'); ?></div>
                                <div class="hdg-6"><?php the_sub_field('about__officer_title'); ?></div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    </div>
                <?php endif; ?>
                                                                      
            </div> 

            <div class="grid-main">
                <div class="grid-row-s hdg-5 grid-row-push-s">            
                    <div class="grid-col grid-col-10">
                        <span class="hdg-bold">Additional Board Members</span>
                    </div>
                </div>  

                <?php if(get_field('about__board_of_directors_members')): ?>
                    <div class="grid-row-s">   
                        <div class="blocks blocks-4up blocks-small">           
                        <?php while(has_sub_field('about__board_of_directors_members')): ?>
                            <div class="hdg-6">
                                <?php the_sub_field('member_name'); ?>
                            </div>
                        <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="section-wrap bg-turq">
        <div class="grid-site">
            <?php if(get_field('about__accomplishments')): ?>

                <?php while(has_sub_field('about__accomplishments')): ?>
            <div id="accomplishments" class="grid-main grid-row-push-m js-jump-link-target">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-7">
                        <h2 class="hdg-4 hdg-bold"><?php the_sub_field('about__acc_title'); ?></h2>
                    </div>
                    <div class="grid-col grid-col-3">
                        <a class="btn" href="<?php the_sub_field('about__accomplishments_pdf'); ?>">Download Annual Report</a>
                    </div>                    
                </div>
            </div>
            
            <div class="grid-main accomplishments">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-2">
                        <i class="icn icon-sprite-about icon-standing"></i>
                    </div>
                    <div class="grid-col grid-col-2">
                        <h5 class="about-accomplishments-number"><?php the_sub_field('about__community_service_num'); ?></h5>
                        <div class="hdg-4">Mediations</div>
                        <div class="about-accomplishments-divide"></div>
                    </div> 
                    <div class="grid-col grid-col-4">
                        <h5 class="hdg-4 hdg-bold">Community Services</h3>
                        <p>Giving Hennepin County residents an opportunity to respectfully move from conflict to resolution.</p>
                    </div>                                    
                </div>    

                <div class="grid-row-s">
                    <div class="grid-col grid-col-2">
                        <i class="icn icon-sprite-about about-gavel"></i>
                    </div>
                    <div class="grid-col grid-col-2">
                        <h5 class="about-accomplishments-number"><?php the_sub_field('about__court_service_num'); ?></h5>
                        <div class="hdg-4">Mediations</div>
                        <div class="about-accomplishments-divide"></div>
                    </div> 
                    <div class="grid-col grid-col-4">
                        <h3 class="hdg-4 hdg-bold">Court Services</h3>
                        <p>Facilitating the resolution of court dispute through private, efficient, respectful conversations</p>
                    </div>                                    
                </div>

                <div class="grid-row-s">
                    <div class="grid-col grid-col-2">
                        <i class="icn icon-sprite-about about-school"></i>
                    </div>
                    <div class="grid-col grid-col-2">
                        <h5 class="about-accomplishments-number"><?php the_sub_field('about__youth_restorative_num'); ?></h5>
                        <div class="hdg-4">Conferences</div>
                        <div class="about-accomplishments-divide"></div>
                    </div> 
                    <div class="grid-col grid-col-4">
                        <h3 class="hdg-4 hdg-bold">Youth and Restorative Services</h3>
                        <p>Supporting youth by holding them accountable, repairing harm and improving conflict resolution and decision making skills. 96% succeeded!</p>
                    </div>                                    
                </div> 

                <div class="grid-row-s">
                    <div class="grid-col grid-col-2">
                        <i class="icn icon-sprite-about about-tools"></i>
                    </div>
                    <div class="grid-col grid-col-2">
                        <h5 class="about-accomplishments-number"><?php the_sub_field('about__volunteer_training_num'); ?></h5>
                        <div class="hdg-4">Mediators Trained</div>
                    </div> 
                    <div class="grid-col grid-col-4">
                        <h3 class="hdg-4 hdg-bold">Volunteer and Training Opportunities</h3>
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
            <div id="financial-report" class="grid-main js-jump-link-target">
                <?php if(get_field('about__financial_reports_section')): ?>
                    <?php while(has_sub_field('about__financial_reports_section')): ?>
                        <div class="grid-row-s about-seperate-border">
                            <div class="grid-col grid-col-7">
                                <h2 class="hdg-4 hdg-bold grid-row-push-s">Financial Report</h2>
                                <div class="grid-row">
                                    <div class="grid-col grid-col-4">
                                        <h3 class="hdg-5 hdg-bold">Income</h3>
                                        <span class="hdg-1 turq hdg-bold"><?php the_sub_field('about__total_income'); ?></span>
                                    </div>
                                    <div class="grid-col grid-col-4  grid-row-push-m">
                                        <div class="about-report">
                                            <div><span class="hdg-bold"><?php the_sub_field('about__income_contracts_and_fees'); ?></span> Contracts and Fees</div>
                                            <div><span class="hdg-bold"><?php the_sub_field('about__income_foundations'); ?></span> Foundations</div>
                                            <div><span class="hdg-bold"><?php the_sub_field('about__income_state_mn'); ?></span> State of MN</div>
                                        </div>
                                    </div>
                                </div><!-- End financial report section -->

                                <div class="grid-row">
                                    <div class="grid-col grid-col-4">
                                        <h3 class="hdg-5 hdg-bold">Expenses</h3>
                                        <span class="hdg-1 turq hdg-bold"><?php the_sub_field('about__total_expenses'); ?></span>
                                    </div>
                                    <div class="grid-col grid-col-4 grid-row-push-m">
                                        <div class="about-report">
                                            <div><span class="hdg-bold"><?php the_sub_field('about__expense_program'); ?></span> Program</div>
                                            <div><span class="hdg-bold"><?php the_sub_field('about__expense_fundraising'); ?></span> Fundraising</div>
                                            <div><span class="hdg-bold"><?php the_sub_field('about__expense_admin'); ?></span> Administration</div>
                                        </div>
                                    </div>
                                </div><!-- End financial report section -->

                                <div class="grid-row">
                                    <div class="grid-col grid-col-4">
                                        <h3 class="hdg-5 hdg-bold">Expenses</h3>
                                        <span class="hdg-1 hdg-bold turq"><?php the_sub_field('about__percent_donate'); ?></span>
                                        <p class="padded-bottom">of all donations go to providing services</p>
                                    </div>
                                </div><!-- End financial report section -->
                            </div>
                            <div class="grid-col grid-col-3">
                                <?php if(get_field('about__pdf_financial_report')): ?>
                                    <?php while(has_sub_field('about__pdf_financial_report')): ?>
                                        <a class="btn" href="<?php has_sub_field('about__financial_report_pdf'); ?>"><?php has_sub_field('about__financial_report_title'); ?></a>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>           
                <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <div id="partners" class="grid-main js-jump-link-target">
                <div class="grid-row-s">
                    <div class="grid-col grid-col-10">
                        <h2 class="hdg-4 hdg-bold grid-row-push-s">Partners</h2>
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