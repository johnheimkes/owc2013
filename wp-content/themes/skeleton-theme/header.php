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
    <div class="page-wrapper">
        <div class="page-header">
            <?php if(get_header_image()): ?>
            <img src="<?php header_image() ?>" />
            <?php endif; ?>
        </div>
        <?php get_search_form(); ?>
