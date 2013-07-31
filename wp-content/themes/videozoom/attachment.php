<?php get_header(); ?>

<div id="main" class="full">

    <div class="wrapper">

		<div id="content">

			<div class="post">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="meta">
					<span><?php edit_post_link( __('Edit this image', 'wpzoom'), ' ', ''); ?></span>
				</div>

				<h1><a href="<?php echo get_permalink( $post->post_parent ); ?>" ><?php echo get_the_title( $post->post_parent ); ?></a></h1>

				<div class="entry">
					<?php if ( wp_attachment_is_image() ) : ?>

					<p class="attachment" style="padding-top:20px; text-align:center; "><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo wp_get_attachment_image( $post->ID, $size='fullsize' ); // max $content_width wide or high.
					?></a></p>

					<center><strong><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"> <?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?> [<?php _e('View full size', 'wpzoom'); ?>]</a></strong></center>

					<?php else : ?>
						<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
					<?php endif; ?>
				</div>

				<div class="navigation">
					<div class="floatleft"><?php previous_image_link( false, __('&larr; Previous picture', 'wpzoom')); ?></div>
					<div class="floatright"><?php next_image_link( false, __('Next picture &rarr;', 'wpzoom')); ?></div>
				</div>

				<div class="thumbnails">
					<?php echo show_all_thumbs(); ?>
				</div>

			</div> <!-- /.post -->
		</div> <!-- /#content -->
 	</div> <!-- /.wrapper -->
</div> <!-- /#main -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>