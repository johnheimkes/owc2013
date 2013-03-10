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
            <a href="#" id="btn-menu" class="btn-menu"></a>
            <a href="#" class="logo offscreen">Community Mediation and Restorative Services</a>
        </div><!-- End .page-header -->
    </div>

    <div class="slideout nav-container bg-turq" id="nav">
        <div class="wrapper-nav">
            <ul class="h-list nav">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Mediation</a>
                </li>
                <li>
                    <a href="#">Training</a>
                </li>
                <li>
                    <a href="#">Volunteer</a>
                </li>
                <li>
                    <a href="#">Support</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Resources</a>
                </li>
            </ul>
        </div>
    </div>

<div class="page-content">
