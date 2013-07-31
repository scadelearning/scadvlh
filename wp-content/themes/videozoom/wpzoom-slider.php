<div id="featPosts">
 	<div id="slider" class="flexslider">
		<ul class="slides">
		<?php

			global $jwPlayerIds;
			$jwPlayerIds = array();
 			$postsno = option::get('slideshow_posts');
 			$featured_posts = new WP_Query(
				array(
					'post__not_in' => get_option( 'sticky_posts' ),
					'posts_per_page' => $postsno,
					'meta_key' => 'wpzoom_is_featured',
					'meta_value' => 1
				));

			if ($featured_posts->post_count > 0) : $i = 0; while ($featured_posts->have_posts()) { $featured_posts->the_post(); global $post; $i++;
  				$videotype 		 = get_post_meta($post->ID, 'wpzoom_video_type', true);
				$videoexternal 	 = get_post_meta($post->ID, 'wpzoom_post_embed_code', true);
				$videoselfhosted = get_post_meta($post->ID, 'wpzoom_post_embed_self', true);
				$video_hd 		 = get_post_meta($post->ID, 'wpzoom_post_embed_hd', true);
				$skin 			 = strtolower(get_post_meta($post->ID, 'wpzoom_post_embed_skin', true));
 				?>
			<li>
				<?php if ($videotype == 'external') {
 					if (strlen($videoexternal) > 1) { // Embedding video from external site
						$videoexternal = embed_fix($videoexternal,option::get('slider_thumb_width'),option::get('slider_thumb_height')); // add wmode=transparent to iframe/embed
						?>
						<div class="cover" style="width:<?php echo option::get("slider_thumb_width"); ?>px; height:<?php echo option::get("slider_thumb_height"); ?>px;"><?php echo "$videoexternal"; ?></div>
						<?php 
						}
					}
 				else {
 					if (strlen($videoselfhosted) > 1) { // Embed self-hosted video using JW Player
  						$image = get_the_image( array( 'size' => 'slider', 'width' => option::get('slider_thumb_width'), 'height' => option::get('slider_thumb_height'),  'image_scan' => false, 'echo' => false, 'format' => 'array' ) );
						if (!empty ($image)) { 	$url = $image['src']; }

  					?>
 					<div class="cover_jw" style="width:<?php echo option::get("slider_thumb_width"); ?>px; height:<?php echo option::get("slider_thumb_height"); ?>px;">
						<div id='video_<?php echo the_ID() ; ?>'>Video</div>
						<script type='text/javascript'>
						  jwplayer('video_<?php echo the_ID();  ?>').setup({
							'file': '<?php echo "$videoselfhosted"; ?>',
							'skin': '<?php echo get_template_directory_uri(); ?>/js/skins/<?php echo "$skin/$skin.zip"; ?>',
							<?php if ( isset( $url ) ) : ?>
							'image' : '<?php echo $url; ?>',
							<?php endif; ?>
							'width': '100%',
							'height': '100%',
							'stretching': 'fill',
	 						<?php if (strlen($video_hd) > 1) { ?>
							'plugins': {
							   'hd-1': {
								   'file': '<?php echo $video_hd; ?>'
							   }
							},
							<?php } ?>
							'modes': [
								{type: 'flash', src: '<?php echo get_template_directory_uri(); ?>/js/player.swf'},
								{type: 'html5'}
 							],
							'events': {
								onReady: function() {
									jwPlayers.push(this)
								},
								onPlay: function() {
									if (current_flex !== undefined) {
										current_flex.flexslider('stop')
									}
								},
								onPause: function() {
								if (current_flex !== undefined) {
										if (wpzoom_flex_repeat) {
											current_flex.flexslider('play');
										}
									}
								}
							}
						  });
						</script>
						<div class="cleaner">&nbsp;</div>
					</div>
					<?php }
				}
				if ($videotype == 'external' && !$videoexternal || $videotype == 'selfhosted' && !$videoselfhosted) { // No video? Display featured image instead

 					get_the_image( array( 'size' => 'slider',  'width' => option::get('slider_thumb_width'), 'height' => option::get('slider_thumb_height') ) );

				} // if a video does not exist ?>

				<div class="postcontent">

					<p class="postmetadata">

						<?php if (option::get('slider_date') == 'on') { ?><?php printf('%s at %s', get_the_date(), get_the_time()); if (option::get('slider_category') == 'on') { echo " /"; } } ?> <?php if (option::get('slider_category') == 'on') {  the_category(','); if (option::get('slider_author') == 'on') { echo " /"; } } ?> <?php if (option::get('slider_author') == 'on') { ?><?php _e('by', 'wpzoom');?> <?php the_author_posts_link(); } ?>
					</p>

					<h2 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

					<?php the_excerpt(); ?>

					<p class="more"><?php if (option::get('slider_morebtn') == 'on') { ?><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php _e('Read more', 'wpzoom'); ?> &raquo;</a><?php } ?> <?php edit_post_link( __('Edit', 'wpzoom'), ' ', ''); ?></p>

				</div>
				<div class="cleaner">&nbsp;</div>

			</li><!-- /.slide -->
			<?php } ?>

		<?php endif; ?>

		<?php if ($featured_posts->post_count == 0) : ?>

			<div class="slnotice">
			    <p>There is no featured post to be shown in the slider. Start marking posts as featured, or disable the slider from <strong><a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=wpzoom_options">Theme Options</a></strong>. <br /></p>
			    <p>For more information please <strong><a href="http://www.wpzoom.com/documentation/videozoom/">read the documentation</a></strong>.</p>
			</div>

	    <?php endif; ?>

  	</div><!-- /#slider -->

  	<div class="cleaner">&nbsp;</div>

 	<?php if (option::get('slider_thumb') == 'on' && $featured_posts->post_count > 0) { // Display nav with thumbnails ?>

		<?php
			$postsno = option::get('slideshow_posts');
			$featured_posts = new WP_Query(
				array(
					'post__not_in' => get_option( 'sticky_posts' ),
					'posts_per_page' => $postsno,
					'meta_key' => 'wpzoom_is_featured',
					'meta_value' => 1
				));
			?>

		<div id="carousel" class="flexslider">
			<ul class="slides">

			 	<?php while ($featured_posts->have_posts()) { $featured_posts->the_post(); global $post; ?>

					<li>
 						<?php get_the_image( array( 'size' => 'slider-small',  'width' => 135, 'height' => 98, 'link_to_post' => false, 'before' => '<a href="#" rel="nofollow"><span></span>', 'after' => '</a>'  ) ); ?>

					</li>

				<?php } ?>

			</ul>

		</div><!-- /#carousel -->

	<?php } ?>

</div><!-- / #featPosts -->
<?php wp_reset_query(); ?>