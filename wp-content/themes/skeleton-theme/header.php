<?php
/**
 * Nerdery Theme
 *
 * @category Nerdery_Skeleton_Theme
 * @package Nerdery_Skeleton_Theme
 * @subpackage Header
 * @author
 * @version $Id$
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title><?php bloginfo('name'); ?><?php wp_title(' - '); ?></title>

    <!-- META DATA -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta http-equiv="imagetoolbar" content="no" />
    <!--[if IE]><meta http-equiv="cleartype" content="on" /><![endif]-->
    <!--[if lt IE 9]><meta http-equiv="X-UA-Compatible" content="IE=8" /><![endif]-->

    <link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

    <!-- ICONS -->
    <link rel="shortcut icon" type="image/ico" href="<?php echo NERDERY_THEME_PATH_URL; ?>assets/images/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php echo NERDERY_THEME_PATH_URL; ?>assets/images/apple-touch-icon.png" />

    <?php wp_head(); // Always have wp_head() just before the closing </head> ?>
</head>
<body <?php body_class(); ?>>
    <div class="wrapper-header">
        <div class="page-header">
            <a href="#" id="btn-menu" class="btn btn-menu"><i class="icn icon-sprite-about nav-toggle"></i></a>
            <h1><a href="<?php echo home_url(); ?>" class="logo offscreen">Community Mediation and Restorative Services</a></h1>
            <div class="header-contact">
                <ul>
                    <li>
                        Phone: 763-561-0033
                    </li>
                    <li>
                        Espanol: 612-629-6058
                    </li>
                    <li>
                        <a href="mailto:staff@mediationprogram.com">staff@mediationprogram.com</a>
                    </li>
                </ul>
            </div>
        </div><!-- End .page-header -->
    </div>

    <div class="slideout nav-container bg-turq" id="nav">
        <div class="wrapper-nav">
            <ul class="nav">
                <li>
                    <a <?php if(is_front_page()) { echo "class='current'"; } ?> href="<?php echo home_url(); ?>">Home</a>
                </li>
                <li>
                    <a <?php if(is_page('mediation')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/mediation">Mediation</a>
                </li>
                <li>
                    <a <?php if(is_page('training')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/training">Training</a>
                </li>
                <li>
                    <a <?php if(is_page('volunteer')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/volunteer">Volunteer</a>
                </li>
                <li>
                    <a <?php if(is_page('donate')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/donate">Donate</a>
                </li>
                <li>
                    <a <?php if(is_page('about')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/about">About</a>
                </li>
                <li>
                    <a <?php if(is_page('resources')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/resources">Resources</a>
                </li>
                <li>
                    <a <?php if(is_page('volunteer-login')) { echo " class='current'"; } ?> href="<?php echo home_url(); ?>/volunteer-login">Volunteer Login</a>
                </li>
            </ul>
        </div>
    </div>

<div class="page-content">
