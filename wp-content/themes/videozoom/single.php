<?php get_header(); ?>

<?php
	// Custom Post Options
	$template 		 = get_post_meta($post->ID, 'wpzoom_post_template', true);
	$videolocation 	 = get_post_meta($post->ID, 'wpzoom_post_embed_location', true);
	$videotype 		 = get_post_meta($post->ID, 'wpzoom_video_type', true);
	$videoexternal 	 = get_post_meta($post->ID, 'wpzoom_post_embed_code', true);
	$videoselfhosted = get_post_meta($post->ID, 'wpzoom_post_embed_self', true);
	$video_hd 		 = get_post_meta($post->ID, 'wpzoom_post_embed_hd', true);
  	$skin			 = strtolower(get_post_meta($post->ID, 'wpzoom_post_embed_skin', true));
 ?>

<div id="main"<?php if ($template == 'full') {echo' class="full"';} elseif ($template == 'side-left') {echo' class="invert"';} ?>>

    <div class="wrapper">

		<?php while (have_posts()) : the_post();

			$image = get_the_image( array( 'size' => 'large',  'image_scan' => false, 'echo' => false, 'format' => 'array' ) );
			if (!empty ($image)) { 	$url = $image['src']; }

		?>
 		<?php if ($videolocation == 'Before everything else') { ?>


 			<?php if ($videotype == 'external') {
 					if (strlen($videoexternal) > 1) { // Embedding video from external site
						$videoexternal = embed_fix($videoexternal,930,563); // add wmode=transparent to iframe/embed
						?>
						<div class="zoomvideo_big"><?php echo "$videoexternal"; ?></div>
						<?php
						}
					}
			else {
				if (strlen($videoselfhosted) > 1 && $videotype == 'selfhosted') { // Embed self-hosted video using JW Player
   				?>
				<div class="zoomvideo_big_jw">

					<div class="zoomvideo_big_jw_wrapper">
 
						<div id='jw_video'>Video</div>
						<script type='text/javascript'>
						  jwplayer('jw_video').setup({
							'file': '<?php echo "$videoselfhosted"; ?>',
							'skin': '<?php echo get_template_directory_uri(); ?>/js/skins/<?php echo "$skin/$skin.zip"; ?>',
							<?php if (!empty ($image)) { ?>'image' : '<?php echo "$url"; ?>', <?php } ?>
							'width': '100%',
							'height': '100%',
							'stretching': 'fill',
	 						<?php if (strlen($video_hd) > 1) { ?>'plugins': {
							   'hd-1': {
								   'file': '<?php echo "$video_hd"; ?>'
							   }
							}, <?php } ?>
							'modes': [
								{type: 'flash', src: '<?php echo get_template_directory_uri(); ?>/js/player.swf'},
	 							{type: 'html5'}				 
							]
						  });
						</script>
					</div>
				</div>
				<?php }
			} ?>

      	<?php } else { ?>
       	  <div class="sep sepMenu">&nbsp;</div>
       	<?php } ?>

		<div id="content">

			<?php if (option::get('meta_sidebar') == 'on') { // Show Meta Sidebar? ?>
	 			<div class="postmetadata">

					<?php if (option::get('post_category') == 'on') {  // Show Category? ?>
						<div class="section">
							<h3><?php _e('Categories', 'wpzoom') ?></h3>
							<?php the_category(', '); ?>
						</div>
	 				<?php } ?>

	 				<?php if (option::get('post_tags') == 'on') { // Show Tags??>
						<?php the_tags( '<div class="section tags"><h3>'.__('Tags', 'wpzoom').'</h3>', ' ', '<div class="cleaner">&nbsp;</div></div>'); ?>
	 				<?php } ?>

					<?php if (option::get('post_share') == 'on') { // Show Social Icons? ?>
						<div class="section">
						<h3><?php _e('Share this post', 'wpzoom') ?></h3>

						  	<ul class="wpzoomSocial">
								<li><a href="http://twitter.com/share" data-url="<?php the_permalink() ?>" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>

								<li><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=1000&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe></li>

								<li><g:plusone size="medium"></g:plusone></li>
 						 	</ul>
							<div class="cleaner">&nbsp;</div>
						</div>
	 				<?php } // if social icons should be shown ?>

				</div><!-- /.postmetadata -->
			<?php } // if meta sidebar is shown ?>

			<?php if (option::get('meta_sidebar') == 'off') { echo "<div class=\"no_meta\">"; } ?>

 			<div id="post-<?php the_ID(); ?>" <?php post_class('singlepost'); ?>>

				<?php if ($videolocation == 'In the middle column' && $template != 'full') {
 					if ($videotype == 'external') {
 						if (strlen($videoexternal) > 1) { // Embedding video from external site

						$videoexternal = embed_fix($videoexternal,570,320); // add wmode=transparent to iframe/embed
						echo "<div class=\"zoomvideo\">$videoexternal</div>"; }
					}
					else {
						if (strlen($videoselfhosted) > 1) { // Embed self-hosted video using JW Player
  						?>
							<div class="zoomvideo_jw">
								<div id='jw_video'>Video</div>
								<script type='text/javascript'>
								  jwplayer('jw_video').setup({
									'file': '<?php echo "$videoselfhosted"; ?>',
									'skin': '<?php echo get_template_directory_uri(); ?>/js/skins/<?php echo "$skin/$skin.zip"; ?>',
									<?php if (!empty ($image)) { ?>'image' : '<?php echo "$url"; ?>', <?php } ?>
									'width': '100%',
									'height': '100%',
									'stretching': 'fill',
									<?php if (strlen($video_hd) > 1) { ?>'plugins': {
									   'hd-1': {
										   'file': '<?php echo "$video_hd"; ?>'
									   }
									}, <?php } ?>
									'modes': [
										{type: 'flash', src: '<?php echo get_template_directory_uri(); ?>/js/player.swf'},
										{type: 'html5'}
 									]
								  });
								</script>
							</div>
						<?php }
					}
	            } ?>

					<?php if ($videolocation == 'In the middle column' && $template == 'full') {
	 					if ($videotype == 'external') {
	 						if (strlen($videoexternal) > 1) { // Embedding video from external site
							$videoexternal = embed_fix($videoexternal,960,541); // add wmode=transparent to iframe/embed
							echo "<div class=\"zoomvideo_full\">$videoexternal</div>"; }
						}
					else {
					  	if (strlen($videoselfhosted) > 1) { // Embed self-hosted video using JW Player
 						?>
						<div class="zoomvideo_full_jw">
							<div id='jw_video'>Video</div>
							<script type='text/javascript'>
							  jwplayer('jw_video').setup({
								'file': '<?php echo "$videoselfhosted"; ?>',
								'skin': '<?php echo get_template_directory_uri(); ?>/js/skins/<?php echo "$skin/$skin.zip"; ?>',
								<?php if (!empty ($image)) { ?>'image' : '<?php echo "$url"; ?>', <?php } ?>
								'width': '100%',
								'height': '100%',
								'stretching': 'fill',
								<?php if (strlen($video_hd) > 1) { ?>'plugins': {
								   'hd-1': {
									   'file': '<?php echo "$video_hd"; ?>'
								   }
								}, <?php } ?>
								'modes': [
									{type: 'flash', src: '<?php echo get_template_directory_uri(); ?>/js/player.swf'},
									{type: 'html5'}
 								]
							  });
							</script>
						</div>
						<?php }
					}
	             } ?>

	          	<p class="postmetadata"><?php if (option::get('post_author') == 'on') { ?><?php _e('Posted by', 'wpzoom') ?> <?php the_author_posts_link(); } ?><?php if (option::get('post_author') == 'on' && option::get('post_date') == 'on') { ?> <?php _e('on', 'wpzoom') ?> <?php } ?><?php if (option::get('post_date') == 'on') { ?> <?php printf('%s at %s', get_the_date(), get_the_time()); } ?></p>

	         	<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

	         	<div class="entry">
	 				<?php the_content(); ?>
				</div>

	         	<?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	         	<p class="more"><?php edit_post_link( __('Edit this post &raquo;', 'wpzoom'), '', ''); ?></p>

       		</div><!-- /.singlepost -->

   			<?php if (option::get('meta_sidebar') == 'off') { echo "</div>"; } ?>
       		<div class="cleaner">&nbsp;</div>

	        <?php if (option::get('post_comments') == 'on') {
		        comments_template();
		        } ?>

      	</div><!-- /#content -->

     	<?php if ($template != 'full') { get_sidebar(); } ?>
  		<div class="cleaner">&nbsp;</div>

	<?php endwhile; ?>
	</div><!-- /.wrapper -->
</div><!-- /#main -->

<?php get_footer(); ?>