<?php get_header(); ?>

<div id="main">
    <div class="wrapper">
      
        <div class="sep sepMenu">&nbsp;</div>
  
		<div id="content">
 
			<div class="singlepost single-page">
			 
				<h1><?php _e('Error 404 - Nothing Found', 'wpzoom'); ?></h1>
				<div class="entry">
					<h3><?php _e('The page you are looking for could not be found. Maybe try one of the links below?', 'wpzoom');?> </h3>

						<div class="col_arch">
							<div class="left"><?php _e('Popular Categories:', 'wpzoom'); ?></div>
						
							<div class="right"> 
								<ul>											  
	 								<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'hierarchical' => 0, 'number' => 10 ) ); ?>
								</ul>	
							</div>
						</div>
 
						<div class="col_arch">
							<div class="left"><?php _e('Archives:', 'wpzoom'); ?></div>
							
							<div class="right"> 
								<ul>											  
									<?php wp_get_archives('type=monthly&show_post_count=1') ?>	
								</ul>	
							</div>
						</div>

						<div class="col_arch">
							<div class="left"><?php _e('Tags:', 'wpzoom'); ?></div>
							
							<div class="right"> 
								<?php the_widget( 'WP_Widget_Tag_Cloud', 'title= ' ); ?>
							</div>
						</div>
				</div>
 				<p class="more"><?php edit_post_link( __('Edit &raquo;', 'wpzoom'), '', ''); ?></p>
			  
			</div><!-- /.single -->
			
			<div class="cleaner">&nbsp;</div>
 
	 
		</div><!-- /#content -->
      
        <?php get_sidebar(); ?>
  
		<div class="cleaner">&nbsp;</div>
 
    </div><!-- /.wrapper -->

</div><!-- /#main -->

<?php get_footer(); ?>