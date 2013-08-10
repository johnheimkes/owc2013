<?php
/**
 * Nerdery Theme
 * Template name: Page - Resources
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
        <div class="grid-main">
            <div class="grid-col gridl-col-6">
                <h2 class="hdg-4">Resources</h2>
                <div class="resource">
                    <div class="resource-hd">
                        <h3 class="hdg-5">Alternative Dispute Resolution</h3>
                    </div>
                    <div class="resource-bd">
						
						<?php if(get_field('alternative_dispute_resolutions')): ?>
 
							<ul>
							<?php while(has_sub_field('alternative_dispute_resolutions')): ?>
								<li><a href="<?php the_sub_field('adr_link'); ?>"><?php the_sub_field('adr_name'); ?></a></li>
							<?php endwhile; ?>
							</ul>
 
						<?php endif; ?>
                        <!-- <ul>
                            <li><a href="#">Minnesota Association of Community Mediation Programs (MACMP)</a></li>
                            <li><a href="#">Conflict Resolution Minnesota (CRM)</a></li>
                            <li><a href="#">National Association for Community Mediation</a></li>
                            <li><a href="#">Family Clinic at Mediation Center (Hamline University)</a></li>
                            <li><a href="#">Minnesota Restorative Services Coalition</a></li>
                        </ul> -->
                    </div>
                </div><!-- End .resource -->

                <div class="resource">
                    <div class="resource-hd">
                        <h3 class="hdg-5">Courts</h3>
                    </div>
                    <div class="resource-bd">
						<?php if(get_field('courts_resources')): ?>
 
							<ul>
							<?php while(has_sub_field('courts_resources')): ?>
								<li><a href="<?php the_sub_field('rc_link'); ?>"><?php the_sub_field('rc_name'); ?></a></li>
							<?php endwhile; ?>
							</ul>
 
						<?php endif; ?>
                        <!-- <ul>
                            <li><a href="#">Hennepin County Courts</a></li>
                            <li><a href="#">Hennepin County Conciliation Court</a> (612) 348-2713</li>
                            <li><a href="#">Rule 114 Roster</a></li>
                        </ul> -->
                    </div>
                </div><!-- End .resource -->

                <div class="resource">
                    <div class="resource-hd">
                        <h3 class="hdg-5">Legal Resources</h3>
                    </div>
                    <div class="resource-bd">
						<?php if(get_field('legal_resources')): ?>
 
							<ul>
							<?php while(has_sub_field('legal_resources')): ?>
								<li><a href="<?php the_sub_field('rl_link'); ?>"><?php the_sub_field('rl_name'); ?></a></li>
							<?php endwhile; ?>
							</ul>
 
						<?php endif; ?>
                        <!-- <ul>
                            <li><a href="#">Self-Help Center (Hennepin)</a></li>
                            <li><a href="#">Homeline </a>  (612) 728-5767</li>
                            <li><a href="#">Legal Aid</a></li>
                            <li><a href="#">Volunteer Lawyers Network</a></li>
                            <li><a href="#">LawHelp.org</a></li>
                            <li><a href="#">MN Attorney General</a></li>
                            <li><a href="#">Call for Justice</a> (612) 333-4000</li>
                        </ul> -->
                    </div>
                </div><!-- End .resource -->

                <div class="resource">
                    <div class="resource-hd">
                        <h3 class="hdg-5">Nonprofit Resources</h3>
                    </div>
                    <div class="resource-bd">
						<?php if(get_field('nonprofit_resources')): ?>
 
							<ul>
							<?php while(has_sub_field('nonprofit_resources')): ?>
								<li><a href="<?php the_sub_field('rn_link'); ?>"><?php the_sub_field('rn_name'); ?></a></li>
							<?php endwhile; ?>
							</ul>
 
						<?php endif; ?>
                        <!-- <ul>
                            <li><a href="#">Home Free</a></li>
                            <li><a href="#">Resource Center for Fathers and Families</a> (763) 783-4938</li>
                            <li><a href="#">Advocates for Human Rights</a></li>
                            <li><a href="#">The Bridge</a> (612) 377-8800</li>
                            <li><a href="#">The Link</a></li>
                            <li><a href="#">PointNorthwest</a></li>
                        </ul> -->
                    </div>
                </div><!-- End .resource -->
            </div>
        </div>
    </div>
</div>

<div class="section-wrap">
    <div class="grid-site">
        <div class="grid-main ">
            <div class="grid-col grid-col-6">
                <h2 class="hdg-4">Tips To Getting Along With Neighbors</h2>
				<?php if(get_field('neighborly_tips')): ?>

					<ol class="tip-list">
					<?php while(has_sub_field('neighborly_tips')): ?>
						<li><?php the_sub_field('neighbor_tip'); ?></li>
					<?php endwhile; ?>
					</ol>

				<?php endif; ?>
                <!-- <ol class="tip-list">
                    <li>
                        Establish good rapport before any conflict arises. A little small talk goes a long way. It can lay the foundation for raising concerns in a respectful manner
                    </li>
                    <li>
                        Be understanding. If a neighbor has a difficult time, you might offer assistance or ideas for outside resources.
                    </li>
                    <li>
                        Do not be quick to judge. Your early morning lawn mowing may be as irritating to them as their late-night door slamming.
                    </li>
                    <li>
                        Don’t assume. Your neighbor might not be aware of the fact that their dog
is barking when they’re gone, or that their son is riding his bike through
your yard. Unless you have a concern for your immediate safety, take your
concerns directly to them first, without involving third parties.
                    </li>
                    <li>
                        Speak calmly and without accusation, allowing them a chance to respond in a similar fashion.
                    </li>
                    <li>
                        Clarify key phrases and preferred communication methods.
                    </li>
                    <li>
                        Be open when a neighbor approaches you instead of reacting impulsively and defensively, tell your neighbor you’ll “give it some thought and get back
to them”.
                    </li>
                    <li>
                        Try mediation. If approaching your neighbors directly isn’t a good option
or isn’t working, consider contacting Community Mediation & Restorative
Services. CMRS’ trained mediators have been helping neighbors have
constructive conversations since 1983, with excellent results. Mediation
is a voluntary process, and takes an hour or two. It is convenient and
confidential.
                    </li>
                </ol> -->
					
					
				<?php the_field('civililty_pledge'); ?>
                <!-- <div class="tips-pledge">
                    The Civility Pledge (from The Speak Your Civility Project, Duluth-Superior)
                </div>
                <div class="tips-today">
                    <h3 class="hdg-5 hdg-bold">Today, I will:</h3>
                    <ol class="tip-list tip-list_small">
                        <li>Pay Attention</li>
                        <li>Listen</li>
                        <li>Be Inclusive</li>
                        <li>Not Gossip</li>
                        <li>Show Respect</li>
                        <li>Be Agreeable</li>
                        <li>Apologize</li>
                        <li>Give Constructive Criticism</li>
                        <li>Take Responsibility</li>
                    </ol>
                </div> -->
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>