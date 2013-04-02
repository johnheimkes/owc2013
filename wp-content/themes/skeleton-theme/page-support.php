<?php
/**
 * Nerdery Theme
 * Template name: Page - Support
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @subpackage Single
 * @author
 * @version $Id$
 */
?>
<?php get_header(); ?>

    <div id="support-us" class="section-wrap bg-lightblue js-jump-link-target">
        <div class="grid-site">
            <div class="grid-sidebar">
                <div class="secondary-nav">
                    <ul>
                        <li class="title">Donate</li>
                        <li>
                            <a href="#support-us" class="js-jump-link">Donations</a>
                        </li>
                        <li>
                            <a href="#individual-supports" class="js-jump-link">Donors</a>
                        </li>                        
                        <li>
                            <a href="#supporting-groups" class="js-jump-link">Supporting Groups</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="grid-main">
                <div class="grid-row-s">
                    <?php
                    $rows = get_field('donate__section_1');
                    if($rows)
                    {
                        foreach($rows as $row)
                        { ?>
                    <div class="grid-col grid-col-5">
                        <div class="feature">
                            <div class="feature-hd">
                                <h2 class="hdg hdg-5 hdg-bold"><?php echo $row['title'];?></h2>
                            </div>
                            <div class="feature-bd feature-bd_extended">
                                <?php echo $row['content'];?>
                            </div>
                        </div>
                    </div>
                    <div class="grid-col grid-col-5">
                        <div class="pledge">
                            <div class="pledge-hd">
                                <?php echo $row['private_contributions_title'];?>
                            </div>
                            <div class="pledge-bd">
                                <?php echo $row['total_contributions'];?> <i class="icn icn-support icn-package"></i>
                            </div>
                            <div class="pledge-ft">
                                <p>Goal: <?php echo $row['goal_contributions'];?></p>
                            </div>
                        </div>
                    </div>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="section-wrap">
        <div class="grid-site">
            <div class="grid-main">
                <div class="grid-row-s">
                    <?php
                    $rows = get_field('donate__section_2');
                    if($rows)
                    {
                        foreach($rows as $row)
                        { ?>
                    <div class="grid-col grid-col-6">
                        <div class="notice">
                            <div class="notice-hd">
                                <i class="icn icn-support icn-speaker" ></i><h2 class="hdg-inline hdg-4 hdg-bold">Notice</h2>
                            </div>
                            <div class="notice-subhd">
                                <?php echo $row['title']; ?>
                            </div>
                            <div class="notice-bd">
                                <?php echo $row['content']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="grid-col grid-col-4">
                        <?php
                        if( $row['icon_switch'] ) {
                            echo '<i class="icn icn-support icn-donations"></i>';
                        } ?>
                    </div>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div id="donate" class="section-wrap bg-turq">
        <div class="grid-site">
            <div class="grid-main">
                <?php
                $rows = get_field('donate__section_3');
                if($rows)
                {
                    foreach($rows as $row)
                    { ?>
                <div class="grid-col grid-col-4">
                    <div class="donate-online">
                        <div class="donate-online-hd">
                            <i class="icn icn-support icn-cpu" ></i><h2 class="hdg hdg-4 hdg-bold hdg-invert hdg-inline">Donate Online</h2>
                        </div>
                        <div class="donate-online-bd">
                            <?php echo $row['donate_online_content']; ?>
                        </div>
                        <div class="donate-online-ft">
                            <a href="<?php echo $row['donate_online_link']; ?>" class="btn">Donate Now</a>
                        </div>
                    </div>
                </div>
                <div class="grid-col grid-col-6">
                    <div class="donate-mail">
                        <div class="donate-mail-hd">
                            <i class="icn icn-support icn-letter" ></i><h2 class="hdg hdg-4 hdg-bold hdg-invert hdg-inline">Donate By Mail</h2>
                        </div>
                        <div class="donate-mail-bd">
                            <div>
                                Your donations are welcome by mail.
                            </div>
                            <div>
                                <a href="<?php echo $row['download_donation_form']; ?>">Download a Donation Form</a>
                            </div>
                        </div>
                        <div class="donate-mail-ft">
                            <h3 class="hdg-5 hdg-bold">Send Donations to:</h3>
                            <div class="wysiwyg">
                                <?php echo $row['send_donation_to']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php }
                }
                ?>
            </div>
        </div>
    </div>

    <div id="other-ways" class="section-wrap">
        <div class="grid-site">
            <div class="grid-main">
                <div class="grid-col grid-col-12">
                    <h2 class="hdg-4 hdg-bold">Other Ways to Help</h2>
                    <ul class="other-ways-list">
                        <?php
                        $rows = get_field('donate__section_4--content');
                        if($rows)
                        {
                            foreach($rows as $row)
                            { ?>
                        <li>
                            <?php echo $row['item']; ?>
                        </li>
                            <?php }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="individual-supports" class="section-wrap bg-white js-jump-link-target">
        <div class="grid-site">
            <div class="grid-main">
                <h2 class="hdg-4 hdg-bold">Individual Supporters</h2>
                <?php
                $rows = get_field('donate__section_5');
                if($rows)
                {
                    foreach($rows as $row)
                    { ?>


                    <div class="support-tree">
                        <div class="support-tree-hd">
                            <h3 class="hdg-5 hdg-bold"><?php echo $row['donor_level_title']; ?></h3>
                        </div>
                        <div class="support-tree-bd">
                            
                            <?php echo $row['donor_list']; ?>

                        </div>
                    </div>


                    <?php }
                }
                ?>
            </div>
        </div>
    </div>

    <div id="supporting-groups" class="section-wrap js-jump-link-target">
        <div class="grid-site">
            <div class="grid-main">
                <h2 class="hdg-4 hdg-bold">Supporting Groups</h2>
                <div class="grid-row-s">
                    <div class="grid-row-5">
                        <div class="supporting-groups-subhd">
                            Thank you to all who invest in our community through donations and contracted support.
                        </div>
                    </div>
                </div>
                
                <div class="grid-row-s">
                    <div class="grid-col grid-col-5 supporting-groups-section">
                        <h3 class="hdg-5 hdg-bold">Contracts</h3>
                        <ul class="supporting-groups-list">
                            <li>Fourth Judical District Court</li>
                            <li>Hennepin County Human Services and Public Health Dept</li>
                            <li>Youth Intervention Program (Office of Justice Programs)</li>
                            <li>Hennepin County Attorney's Office</li>
                            <li>School Districts: Hopkins, Osseo, Robbinsdale</li>
                            <li>Builders Association of the Twin Cities</li>
                            <li>
                                Municipalities
                                <ul class="supporting-groups-sublist">
                                    <li>Brooklyn Center</li>
                                    <li>Brooklyn Park</li>
                                    <li>Corcoran</li>
                                    <li>Crystal</li>
                                    <li>Golden Valley</li>
                                    <li>Hopkins</li>
                                    <li>Maple Grove</li>
                                    <li>Minnetonka</li>
                                    <li>Mound</li>
                                    <li>New Hope</li>
                                    <li>Plymouth</li>
                                    <li>Robbinsdale</li>
                                    <li>St. Louis Park</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="grid-col grid-col-5 supporting-groups-section-foundations">
                        <h3 class="hdg-5 hdg-bold">Foundations</h3>
                        <ul class="supporting-groups-list">
                            <li>American Bar Association</li>
                            <li>Golden Valley Human Services Foundation</li>
                            <li>Minneapolis Foundation (through MN Youth Intervention Program Association)</li>
                            <li>Minnesota State Bar Association- ADR Section</li>
                            <li>Youthprise Foundation</li>
                            <li>State of Minnesota</li>
                            <li>MN Supreme Court</li>
                        </ul>
                    </div>
                </div>

                <div class="donor-policy">
                    <h2 class="hdg-5 hdg-bold">Our Donor Privacy Policy</h2>
                    <div class="donor-subhead">Please Download our Donor Privacy Policy</div>
                    <a href="<?php the_field('donor_privacy_policy'); ?>" class="btn">Donor Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>



<?php get_footer(); ?>