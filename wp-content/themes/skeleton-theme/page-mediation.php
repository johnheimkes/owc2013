<?php
/**
 * Nerdery Theme
 * Template name: Page - Mediation
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @subpackage Single
 * @author
 * @version $Id$
 */
?>
<?php get_header(); ?>

<div class="page-content page-content-bright">
    <div id="overview" class="js-jump-link-target">
        <div class="section-wrap bg-lightblue">
            <div class="grid-site">
                <div class="grid-sidebar">
                    <div class="secondary-nav">
                        <ul>
                            <li class="title">Mediation</li>
                            <li><a href="#overview" class="js-jump-link">Overview</a></li>
                            <li><a href="#reasons" class="js-jump-link">Reasons</a></li>   
                            <li><a href="#first-steps" class="js-jump-link">First Steps</a></li>
                            <li><a href="#get-started" class="js-jump-link">Get Started</a></li>
                        </ul>
                    <!-- end .secondary-nav -->
                    </div>
                <!-- end .grid-sidebar -->
                </div>
                <div class="grid-main">
                    <div class="intro grid-col grid-col-10">
                        <?php
                        $rows = get_field('mediation__section_1');
                        if($rows)
                        {
                            foreach($rows as $row)
                            { ?>
                                <!-- echo $row['sub_field_1'] . $row['sub_field_2']; -->
                                <div class="intro-hd">
                                    <h2 class="heading-intro">
                                        <?php echo $row['mediation__section_1--title']; ?>
                                    </h2>
                                <!-- end .intro-hd -->
                                </div>
                                <div class="intro-bd">
                                    <p><?php echo $row['mediation__section_1--tagline']; ?></p>
                                    <a href="<?php the_field('mediation__service_request_form'); ?>" class="btn">Service Request Form</a>
                                <!-- end .intro-bd -->
                                </div>

                            <?php }
                        }
                        ?>
                        
                        
                    <!-- end .intro -->
                    </div>
                <!-- end .grid-main -->
                </div>
            <!-- end .grid-site -->
            </div>
        <!-- end .bg-lightblue -->
        </div>
        <div class="grid-site grid-site-inset">
            <div class="grid-main">
                
                <?php
                $rows = get_field('mediation__section_2');
                if($rows)
                {
                    foreach($rows as $row)
                    { ?>
                        <div class="media">
                            <div class="media-element">
                                <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon-mediation-intro1.png" alt="" />
                            <!-- end .media-element -->
                            </div>
                            <div class="media-bd">
                                <div class="summary grid-col grid-col-9">
                                    <div class="summary-hd">
                                        <h2>Mediation</h2>
                                    <!-- end .summary-hd --> 
                                    </div>
                                    <div class="summary-bd">
                                        <p><?php echo $row["mediation__section_2--mediation_content"]; ?></p>
                                    <!-- end .summary-bd --> 
                                    </div>
                                <!-- end .summary -->
                                </div>
                            <!-- end .media-bd -->
                            </div>
                        <!-- end .media -->
                        </div>
                        <div class="media">
                            <div class="media-element">
                                <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon-mediation-intro2.png" alt="" />
                            <!-- end .media-element -->
                            </div>
                            <div class="media-bd">
                                <div class="summary grid-col grid-col-9">
                                    <div class="summary-hd">
                                        <h2>Restorative Justice</h2>
                                    <!-- end .summary-hd --> 
                                    </div>
                                    <div class="summary-bd">
                                        <p><?php echo $row["mediation__section_2--restorative_justice_part_content"]; ?></p>
                                    <!-- end .summary-bd --> 
                                    </div>
                                <!-- end .summary -->
                                </div>
                            <!-- end .media-bd -->
                            </div>
                        <!-- end .media -->
                        </div>
                    <?php }
                }
                ?>
                
                
            <!-- end .grid-main -->
            </div>
        <!-- end .grid-site -->
        </div>
        <div class="section-wrap bg-lightblue">
            <div class="grid-site">
                <div class="grid-main">
                    <div class="summary">
                        <div class="summary-hd">
                            <h2>We Serve:</h2>
                        <!-- end .summary-hd -->
                        </div>
                        <div class="summary-bd">
                            <div class="grid-row">
                                
                                <?php
                                $rows = get_field('mediation__section_3');
                                if($rows)
                                {
                                    foreach($rows as $row)
                                    { ?>
                                        <div class="grid-col grid-col grid-col grid-col-4">
                                            <div class="summary-list"><?php echo wpautop( $row['mediation__section_3--column_1'], true ); ?></div>
                                        <!-- end .grid-col grid-col-4 -->
                                        </div>
                                        <div class="grid-col grid-col grid-col grid-col-4">
                                            <div class="summary-list"><?php echo wpautop( $row['mediation__section_3--column_2'], false ); ?></div>
                                        <!-- end .grid-col grid-col-4 -->
                                        </div>
                                        <div class="grid-col grid-col grid-col grid-col-4">
                                            <div class="summary-list"><?php echo wpautop( $row['mediation__section_3--column_3'] ); ?></div>
                                        <!-- end .grid-col grid-col-4 -->
                                        </div>
                                    <?php }
                                }
                                ?>
                                
                            <!-- end .grid-row -->
                            </div>
                        <!-- end .summary-bd -->
                        </div>
                    <!-- end .summary -->
                    </div>
                <!-- end .grid-main -->
                </div>
            <!-- end .grid-site -->
            </div>
        <!-- end .bg-lightblue -->
        </div>
    <!-- end .section-wrap -->
    </div>
    <div id="reasons" class="section-wrap bg-turq js-jump-link-target">
        <div class="grid-site">
            <div class="grid-main">
                <div class="summary grid-col grid-col-6">
                    <div class="summary-hd summary-hd-invert">
                        <h2>Reasons to Consider Mediation or Restorative Practices</h2>
                    <!-- end .summary-hd --> 
                    </div>
                    <div class="summary-bd">
                        <ul class="check-list">
                            <li>
                                <div class="check-item">
                                    <div class="check-item-hd">
                                        <h3>Confidentiality</h3>
                                    <!-- end .check-item-hd -->
                                    </div>
                                    <div class="check-item-bd">
                                        <p>
                                            Staff and Mediators are bound by law to maintain confidentiality.
                                        </p>
                                    <!-- end .check-item-bd -->
                                    </div>
                                <!-- end .check-item -->
                                </div>
                            </li>
                            <li>
                                <div class="check-item">
                                    <div class="check-item-hd">
                                        <h3>Control over the solution</h3>
                                    <!-- end .check-item-hd -->
                                    </div>
                                    <div class="check-item-bd">
                                        <p>
                                            You decide what is best for you.
                                        </p>
                                    <!-- end .check-item-bd -->
                                    </div>
                                <!-- end .check-item -->
                                </div>
                            </li>
                            <li>
                                <div class="check-item">
                                    <div class="check-item-hd">
                                        <h3>Closure</h3>
                                    <!-- end .check-item-hd -->
                                    </div>
                                    <div class="check-item-bd">
                                        <p>
                                            Decisively resolve issues that have been persistent.
                                        </p>
                                    <!-- end .check-item-bd -->
                                    </div>
                                <!-- end .check-item -->
                                </div>
                            </li>
                            <li>
                                <div class="check-item">
                                    <div class="check-item-hd">
                                        <h3>Cost</h3>
                                    <!-- end .check-item-hd -->
                                    </div>
                                <!-- end .check-item -->
                                </div>
                            </li>
                            <li>
                                <div class="check-item">
                                    <div class="check-item-hd">
                                        <h3>Convenience</h3>
                                    <!-- end .check-item-hd -->
                                    </div>
                                    <div class="check-item-bd">
                                        <p>
                                            Mediation sessions are scheduled at the participants’ earliest convenience.
                                        </p>
                                    <!-- end .check-item-bd -->
                                    </div>
                                <!-- end .check-item -->
                                </div>
                            </li>
                            <li>
                                <div class="check-item">
                                    <div class="check-item-hd">
                                        <h3>Follow-up</h3>
                                    <!-- end .check-item-hd -->
                                    </div>
                                <!-- end .check-item -->
                                </div>
                            </li>
                            <li>
                                <div class="check-item">
                                    <div class="check-item-hd">
                                        <h3>Successful, quick results</h3>
                                    <!-- end .check-item-hd -->
                                    </div>
                                <!-- end .check-item -->
                                </div>
                            </li>
                        <!-- end .check-list -->
                        </ul>
                    <!-- end .summary-bd --> 
                    </div>
                <!-- end .summary -->
                </div>
            <!-- end .grid-main -->
            </div>
        <!-- end .grid-site -->
        </div>
    <!-- end .bg-turq -->
    </div>
    <?php
    $rows = get_field('mediation__section_5');
    if($rows)
    {
        foreach($rows as $row)
        { ?>
    <div id="first-steps" class="js-jump-link-target">
        <div class="grid-site grid-site-inset">
            <div class="grid-main">
                <div class="section-steps grid-col grid-col-7">
                    <div class="section-steps-hd">
                        <h2 class="heading-steps">Taking the First Steps</h2>
                    <!-- end .section-steps-hd -->
                    </div>
                    <div class="section-steps-icon">
                        <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon-steps-intro.png" alt="" />
                    <!-- end .section-steps-icon -->
                    </div>
                    <div class="section-steps-bd">
                        <div class="media media-pull-left">
                            <div class="media-element">
                                <h3 class="section-steps-counter">1</h3>
                            <!-- end .media-element -->
                            </div>
                            <div class="media-bd">
                                <div class="step">
                                    <div class="step-hd">
                                        <h3><?php echo $row['mediation__section_5--step_1-title'];?></h3>
                                    <!-- end .step-hd -->
                                    </div>
                                    <div class="step-bd">
                                        <?php echo $row['mediation__section_5--step_1'];?>
                                    <!-- end .step-bd -->
                                    </div>
                                <!-- end .step -->
                                </div>
                            <!-- end .media-bd -->
                            </div>
                        <!-- end .media -->
                        </div>
                    <!-- end .section-steps-bd -->
                    </div>
                <!-- end .section-steps -->
                </div>
            <!-- end .grid-main -->
            </div>
        <!-- end .grid-site -->
        </div>
        <div class="section-wrap bg-lightblue">
            <div class="grid-site">
                <div class="grid-main">
                    <div class="section-steps grid-col grid-col-5 grid-col grid-col-right grid-col grid-col-right-single">
                        <div class="section-steps-bd">
                            <div class="media media-pull-left media-pull-left-wide">
                                <div class="media-element">
                                    <div class="tether">
                                        <div class="tether-line"></div>
                                    </div>
                                    <h3 class="section-steps-counter">
                                        <img class="media-element-abs" src="<?php bloginfo('template_directory'); ?>/assets/images/icon-notepad.png" alt="" />
                                        2
                                    </h3>
                                <!-- end .media-element -->
                                </div>
                                <div class="media-bd">
                                    <div class="step">
                                        <div class="step-hd">
                                            <h3><?php echo $row['mediation__section_5--step_2-title'];?></h3>
                                        <!-- end .step-hd -->
                                        </div>
                                        <div class="step-bd">
                                            <?php echo $row['mediation__section_5--step_2'];?>
                                        <!-- end .step-bd -->
                                        </div>
                                        <div class="step-bd">
                                            <a href="<?php the_field('mediation__service_request_form'); ?>" class="btn">Service Request Form</a>
                                        <!-- end .step-bd -->
                                        </div>
                                    <!-- end .step -->
                                    </div>
                                <!-- end .media-bd -->
                                </div>
                            <!-- end .media -->
                            </div>
                        <!-- end .section-steps-bd -->
                        </div>
                    <!-- end .section-steps -->
                    </div>
                <!-- end .grid-main -->
                </div>
            <!-- end .grid-site -->
            </div>
        <!-- end .bg-turq -->
        </div>
        <div class="grid-site">
            <div class="grid-main">
                <div class="section-steps grid-col grid-col-5">
                    <div class="section-steps-bd">
                        <div class="media media-invert media-pull-left">
                            <div class="media-element">
                                <div class="tether">
                                    <div class="tether-line tether-line-long"></div>
                                </div>
                                <ul class="icon-list">
                                    <li>
                                        <h3 class="section-steps-counter">3</h3>
                                    </li>
                                    <li>
                                        <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon-envelope.png" alt="" />
                                    </li>
                                    <li>
                                        <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon-envelope.png" alt="" />
                                    </li>
                                <!-- end .icon-list -->
                                </ul>
                            <!-- end .media-element -->
                            </div>
                            <div class="media-bd">
                                <div class="step">
                                    <div class="step-hd">
                                        <h3><?php echo $row['mediation__section_5--step_3-title'];?></h3>
                                    <!-- end .step-hd -->
                                    </div>
                                    <div class="step-bd">
                                        <?php echo $row['mediation__section_5--step_3'];?>
                                        <!-- <p><a href="<?php //echo home_url();?>/case-managers">Learn More about my Case manager</a></p> -->
                                    <!-- end .step-bd -->
                                    </div>
                                <!-- end .step -->
                                </div>
                            <!-- end .media-bd -->
                            </div>
                        <!-- end .media -->
                        </div>
                    <!-- end .section-steps-bd -->
                    </div>
                <!-- end .section-steps -->
                </div>
            <!-- end .grid-main -->
            </div>
        <!-- end .grid-site -->
        </div>
        <div class="section-wrap bg-lightblue">
            <div class="grid-site">
                <div class="grid-main">
                    <div class="section-steps section-steps-push-left grid-col grid-col-8">
                        <div class="section-steps-icon">
                            <div class="tether">
                                <div class="tether-line tether-line-medium"></div>
                            </div>
                            <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon-talk-bubbles.png" alt="">
                        <!-- end .section-steps-icon -->
                        </div>
                        <div class="section-steps-hd">
                            <div class="media media-pull-left">
                                <div class="media-element">
                                    <ul class="icon-list">
                                        <h3 class="section-steps-counter">4</h3>
                                    <!-- end .icon-list -->
                                    </ul>
                                <!-- end .media-element -->
                                </div>
                                <div class="media-bd">
                                    <div class="step">
                                        <div class="step-hd">
                                            <h3><?php echo $row['mediation__section_5--step_4-title'];?></h3>
                                        <!-- end .step-hd -->
                                        </div>
                                    <!-- end .step -->
                                    </div>
                                <!-- end .media-bd -->
                                </div>
                            <!-- end .media -->
                            </div>
                        <!-- end .section-steps-hd -->
                        </div>
                    <!-- end .section-steps -->
                    </div>
                <!-- end .grid-main -->
                </div>
            <!-- end .grid-site -->
            </div>
        <!-- end .bg-turq -->
        </div>
        <div class="grid-site">
            <div class="grid-main">
                <div class="section-steps section-steps-push-left grid-col grid-col-8">
                    <div class="section-steps-hd">
                        <div class="tether">
                            <div class="tether-line"></div>
                        </div>
                        <div class="media media-pull-left">
                            <div class="media-element">
                                <ul class="icon-list">
                                    <h3 class="section-steps-counter">5</h3>
                                <!-- end .icon-list -->
                                </ul>
                            <!-- end .media-element -->
                            </div>
                            <div class="media-bd">
                                <div class="step">
                                    <div class="step-hd">
                                        <h3><?php echo $row['mediation__section_5--step_5-title'];?></h3>
                                    <!-- end .step-hd -->
                                    </div>
                                <!-- end .step -->
                                </div>
                            <!-- end .media-bd -->
                            </div>
                        <!-- end .media -->
                        </div>
                    <!-- end .section-steps-hd -->
                    </div>
                    <div class="section-steps-bd">
                        <div class="step">
                            <div class="step-bd">
                                <div class="grid-row">
                                    <div class="grid-col grid-col grid-col grid-col-6">
                                        <div class="step-callout">
                                            <div class="step-icon">
                                                <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon-mediation-intro1.png" alt="" />
                                                <div class="tether tether-pulled tether-intersect">
                                                    <div class="tether-line tether-line-small"></div>
                                                </div>
                                            <!-- end .step-icon -->
                                            </div>
                                            <div class="step-hd">
                                                <h3><?php echo $row['mediation__section_5--step_5a-title'];?></h3>
                                            <!-- end .step-hd -->
                                            </div>
                                            <div class="step-bd">
                                                <?php echo $row['mediation__section_5--step_5a'];?>
                                                <div class="tether tether-pushed tether-intersect tether-intersect-wide">
                                                    <div class="tether-line tether-line-reverse"></div>
                                                </div>
                                            <!-- end .step-bd -->
                                            </div>
                                        <!-- end .step -->
                                        </div>
                                    <!-- end .grid-col grid-col-6 -->
                                    </div>
                                    <div class="grid-col grid-col grid-col grid-col-6">
                                        <div class="step-callout">
                                            <div class="step-icon">
                                                <img src="<?php bloginfo('template_directory'); ?>/assets/images/icon-mediation-intro2.png" alt="" />
                                            <!-- end .step-icon -->
                                            </div>
                                            <div class="step-hd">
                                                <h3><?php echo $row['mediation__section_5--step_5b-title'];?></h3>
                                            <!-- end .step-hd -->
                                            </div>
                                            <div class="step-bd">
                                                <?php echo $row['mediation__section_5--step_5b'];?>
                                            <!-- end .step-bd -->
                                            </div>
                                            <div class="step-bd">
                                                
                                            <!-- end .step-bd -->
                                            </div>
                                        <!-- end .step -->
                                        </div>
                                    <!-- end .grid-col grid-col-6 -->
                                    </div>
                                <!-- end .grid-row -->
                                </div>
                            <!-- end .step-bd -->
                            </div>
                        <!-- end .step -->
                        </div>
                    <!-- end .section-steps-bd -->
                    </div>
                <!-- end .section-steps -->
                </div>
            <!-- end .grid-main -->
            </div>
        <!-- end .grid-site -->
        </div>
        <div class="section-wrap bg-lightblue">
            <div class="grid-site">
                <div class="grid-main">
                    <div class="section-steps grid-col grid-col-5 grid-col grid-col-right grid-col grid-col-right-single">
                        <div class="section-steps-bd">
                            <div class="media media-pull-left media-pull-left-wide">
                                <div class="media-element">
                                    <h3 class="section-steps-counter">
                                        <img class="media-element-abs" src="<?php bloginfo('template_directory'); ?>/assets/images/icon-notepad-group.png" alt="" />
                                        6
                                    </h3>
                                    <div class="tether">
                                        <div class="tether-line tether-line-medium tether-line-medium-reverse"></div>
                                    </div>
                                <!-- end .media-element -->
                                </div>
                                <div class="media-bd">
                                    <div class="step">
                                        <div class="step-hd">
                                            <h3><?php echo $row['mediation__section_5--step_6-title'];?></h3>
                                        <!-- end .step-hd -->
                                        </div>
                                    <!-- end .step -->
                                    </div>
                                <!-- end .media-bd -->
                                </div>
                            <!-- end .media -->
                            </div>
                        <!-- end .section-steps-bd -->
                        </div>
                    <!-- end .section-steps -->
                    </div>
                <!-- end .grid-main -->
                </div>
            <!-- end .grid-site -->
            </div>
        <!-- end .bg-turq -->
        </div>
        <div class="grid-site">
            <div class="grid-main">
                <div class="section-steps grid-col grid-col-8">
                    <div class="section-steps-hd">
                        <div class="media media-pull-left">
                            <div class="media-element">
                                <ul class="icon-list">
                                    <h3 class="section-steps-counter">7</h3>
                                <!-- end .icon-list -->
                                </ul>
                            <!-- end .media-element -->
                            </div>
                            <div class="media-bd">
                                <div class="step">
                                    <div class="step-hd">
                                        <h3><?php echo $row['mediation__section_5--step_7-title'];?></h3>
                                    <!-- end .step-hd -->
                                    </div>
                                <!-- end .step -->
                                </div>
                            <!-- end .media-bd -->
                            </div>
                        <!-- end .media -->
                        </div>
                    <!-- end .section-steps-hd -->
                    </div>
                <!-- end .section-steps -->
                </div>
            <!-- end .grid-main -->
            </div>
        <!-- end .grid-site -->
        </div>
    <!-- end #first-steps -->
    </div>
        <?php }
    }
    ?>
    <div id="get-started" class="section-wrap bg-turq js-jump-link-target">
        <div class="grid-site">
            <div class="grid-main">
                <div class="section-steps">
                    <div class="section-steps-hd section-steps-hd-invert">
                        <h3>Get Started</h3>
                    <!-- end .section-steps-hd -->
                    </div>
                    <div class="grid-row">
                        <div class="grid-col grid-col-7">
                            <div class="section-steps-bd section-steps-bd-dark section-steps-bd-spaced-loose">
                                <p>
                                    Our staff will send an invitation to mediate and a brochure to all parties. A case developer will answer any questions or concerns over the phone, and then gather scheduling information. Mediations can be held days, evenings, or weekend.
                                </p>
                            </div>
                            <div class="section-steps-bd section-steps-bd-dark section-steps-bd-spaced">
                                <a href="<?php echo home_url(); ?>/about/#contact" class="btn">Contact Us</a>
                            </div>
                        <!-- end .grid-col -->
                        </div>
                        <div class="grid-col grid-col-4">
                            <div class="section-steps-bd section-steps-bd-spaced">
                                <h4>Community Mediation &amp; Restoration Services, Inc. </h4>
                            </div>
                            <div class="section-steps-bd section-steps-bd-dark section-steps-bd-spaced-loose">
                                <span>9220 Bass Lake Road, Suite 270 New Hope, MN 55428</span>
                            </div>
                            <div class="section-steps-bd section-steps-bd-dark section-steps-bd-spaced-loose">
                                <ul>
                                    <li>
                                        <span class="section-steps-content-bold">Phone: </span>763-561-0033
                                    </li>
                                    <li>
                                        <span class="section-steps-content-bold">Fax: </span>763-561-0266
                                    </li>
                                </ul>
                            </div>
                            <div class="section-steps-bd section-steps-bd-dark section-steps-bd-spaced">
                                <span>Para servicios en español, por favor llámenos al 612-629-6058</span>
                            </div>
                        <!-- end .grid-col -->
                        </div>
                    <!-- end .grid -->
                    </div>
                    <div class="section-steps-divider"></div>
                    <div class="grid-row">
                        <div class="grid-col grid-col-7">
                            <div class="section-steps-bd section-steps-bd-spaced-loose">
                                <h4>Forms</h4>
                            </div>
                            <div class="section-steps-bd section-steps-bd-spaced-loose">
                                <ul class="section-steps-v-list">
                                    <!-- <li><a href="#">City Referral Form</a></li>
                                    <li><a href="#">Community Agency Referral Form</a></li>
                                    <li><a href="#">Housing Referral Form</a></li>
                                    <li><a href="#">Juvenile Referral Form</a></li>
                                    <li><a href="#">School Referral Form</a></li>
                                    <li><a href="#">Mediation Request</a></li>
                                    <li><a href="#">Small Claims Mediation</a></li>
                                    <li><a href="#">Request Form</a></li> -->
                                    <?php
                                    
                                    $rows = get_field('mediation__forms_list');
                                    if($rows)
                                    {

                                        foreach($rows as $row)
                                        {
                                            echo '<li><a href="' . $row["mediation__pdf_file"] . '">' . $row["mediation__anchor_title"] .'</a></li>';
                                        }

                                    }
                                    
                                    ?>
                                </ul>
                            </div>
                            <div class="section-steps-bd section-steps-bd-dark section-steps-bd-spaced">
                                <a href="<?php the_field('mediation__small_claims_fee_link'); ?>" class="btn" rel="external">Small Claims Administrative Fee</a>
                            </div>
                        <!-- end .grid-col -->
                        </div>
                        <div class="grid-col grid-col-4">
                            <div class="section-steps-bd section-steps-bd-spaced">
                                <h4>CMRS works in partnership with the following 15 cities:</h4>
                            </div>
                            <div class="section-steps-bd section-steps-bd-dark section-steps-bd-spaced-loose">
                                <p>
                                    Brooklyn Center, Brooklyn Park, Champlin, Corcoran, Crystal, Golden Valley, Hopkins, Maple Grove, Minnetonka, Mound, New Hope, Orono, Plymouth, Robbinsdale, and St. Louis Park
                                </p>
                            </div>
                        <!-- end .grid-col -->
                        </div>
                    <!-- end .grid -->
                    </div>
                <!-- end .section-steps -->
                </div>
            <!-- end .grid-main -->
            </div>
        <!-- end .grid-site -->
        </div>
    <!-- end .bg-turq -->
    </div>
</div>
<?php get_footer(); ?>