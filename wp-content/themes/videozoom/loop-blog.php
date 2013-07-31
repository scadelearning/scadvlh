<ul id="loop" class="posts posts-3 list">
	
	<?php $i = 0; while (have_posts()) : the_post(); $i++; ?>
	
	<li<?php if ($i == 3 && option::get('sidebar_home') == 'on') {$i = 0; echo " class=\"last\"";} elseif ($i == 4 && option::get('sidebar_home') == 'off') {$i = 0; echo " class=\"last\""; } ?>>

 		<?php get_the_image( array( 'size' => 'thumbnail', 'width' => 228, 'height' => 160, 'before' => '<div class="cover">', 'after' => '</div>' ) );  ?>
		
		<div class="postcontent">
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<p class="postmetadata"><?php if (option::get('display_date') == 'on') { ?><?php printf('%s at %s', get_the_date(), get_the_time()); ?><?php } ?><?php if (option::get('display_date') == 'on' && option::get('display_category') == 'on') { ?> / <?php } ?><?php if (option::get('display_category') == 'on') { ?><?php the_category(', '); ?><?php } ?></p>
				
				<?php the_excerpt(); ?>
				
			<p class="more"><?php if (option::get('display_readmore') == 'on') { ?><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="readmore" rel="nofollow"><?php _e('Continue reading', 'wpzoom'); ?> &raquo;</a><?php } ?> <?php edit_post_link( __('Edit this post', 'wpzoom'), ' ', ''); ?></p>
		
		</div>
	</li>
	<?php if ($i == 0) {echo'<li class="cleaner">&nbsp;</li>';} ?>
	
	<?php endwhile; ?>
</ul>
<div class="cleaner">&nbsp;</div> 