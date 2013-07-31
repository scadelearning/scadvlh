<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
   	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php ui::title(); ?></title>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php wp_head(); ?>
    <?php ui::js("jwplayer"); ?>
    <?php ui::js("jquery.fitvid"); ?>

</head>

<body <?php body_class(); ?>>

<div id="container">

	<div id="topNav">

		<?php if (option::get("social_icons") == 'on') {?>
			<ul id="menuSocial">

				<?php if (option::get('social_rss') == 'on') { ?>
					<li>
						<a href="<?php if (strlen(option::get('misc_feedburner')) < 10) { bloginfo('rss2_url');} else { echo option::get('misc_feedburner'); } ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/rss.png" width="16" height="16" alt="<?php echo option::get('social_rss_title'); ?>" /><?php echo option::get('social_rss_title'); ?></a>
					</li>
				<?php } ?>

				<?php if (option::get('social_twitter_show') == 'on') { ?>
					<li>
						<a href="http://twitter.com/<?php echo option::get('social_twitter'); ?>" rel="external,nofollow"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter.png" width="16" height="16" alt="<?php echo option::get('social_twitter_title'); ?>" ><?php echo option::get('social_twitter_title'); ?></a>
					</li>
				<?php } ?>

				<?php if (option::get('social_facebook_show') == 'on') { ?>
					<li>
						<a href="<?php echo option::get('social_facebook'); ?>" rel="external,nofollow"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/facebook.png" width="16" height="16" alt="<?php echo option::get('social_facebook_title'); ?>" ><?php echo option::get('social_facebook_title'); ?></a>
					</li>
				<?php } ?>

 			</ul>
		<?php } ?>

		<?php if (has_nav_menu( 'secondary' )) {
			wp_nav_menu(array(
				'container' => '',
				'container_class' => '',
				'menu_class' => 'dropdown',
				'menu_id' => 'topMenu',
				'sort_column' => 'menu_order',
				'theme_location' => 'secondary'
				));
		} ?>

 	</div><!-- /#topNav -->

	<div id="header">

		<div class="wrapper">
 
 	    	<div id="logo">
				<?php if (!option::get('misc_logo_path')) { echo "<h1>"; } ?>
				
				<a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>">
					<?php if (!option::get('misc_logo_path')) { bloginfo('name'); } else { ?>
						<img src="<?php echo ui::logo(); ?>" alt="<?php bloginfo('name'); ?>" />
					<?php } ?>
				</a><div class="clear"></div>
				
				<?php if (!option::get('misc_logo_path')) { echo "</h1>"; } ?>

 			</div><!-- / #logo -->



			<?php if (option::get('ad_head_select') == 'on') { ?>
				<div id="bannerHead">

					<?php if ( option::get('ad_head_code') <> "") {
						echo stripslashes(option::get('ad_head_code'));
					} else { ?>
						<a href="<?php echo option::get('banner_top_url'); ?>"><img src="<?php echo option::get('banner_top'); ?>" alt="<?php echo option::get('banner_top_alt'); ?>" /></a>
					<?php } ?>

				</div><!-- /#topad -->
			<?php } ?>

			<div class="cleaner">&nbsp;</div>

		</div><!-- /.wrapper -->

	</div><!-- /#header -->

	<div id="menu">
 		<?php
 			wp_nav_menu(array(
	 			'container' => '',
	 			'container_class' => '',
	 			'menu_class' => 'dropdown',
	 			'menu_id' => 'nav',
	 			'sort_column' => 'menu_order',
	 			'theme_location' => 'primary'
	 			));
	 		?>
 		<div class="cleaner">&nbsp;</div>
 	</div><!-- /#nav -->