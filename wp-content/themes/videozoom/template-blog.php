<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

<div id="main">
	
 	<div class="wrapper">

	 	<div class="sep sepMenu">&nbsp;</div>

	 	<?php if (option::get('sidebar_home') == 'off') { echo "<div class=\"full\">"; } ?>

 		<div id="content">

 			<div id="postFuncs">
				 
				<h2><?php the_title(); ?></h2>
			</div><!-- /#postFuncs -->
 
 			<div id="archive">
		  
				<?php // WP 3.0 PAGED BUG FIX
				if ( get_query_var('paged') )
					$paged = get_query_var('paged');
				elseif ( get_query_var('page') ) 
					$paged = get_query_var('page');
				else 
					$paged = 1;
				//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
				 
				query_posts("paged=$paged"); if (have_posts()) : 
				?>
					   
					<?php get_template_part('loop-blog'); ?>

				<?php endif; ?>
			</div><!-- /#archive -->

			<?php get_template_part( 'pagination'); ?>

		</div><!-- /#content -->

		<?php if (option::get('sidebar_home') == 'off') { echo "</div>"; } ?>
		  
		<?php if (option::get('sidebar_home') == 'on') { ?>
			<?php get_sidebar(); ?>
		<?php } ?>
 		
		<div class="cleaner">&nbsp;</div>
	</div><!-- /.wrapper -->

</div> <!-- /#main -->

<?php get_footer(); ?>