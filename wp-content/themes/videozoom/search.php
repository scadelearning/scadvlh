<?php get_header(); ?>

<div id="main">
  
    <div class="wrapper">
      
        <div class="sep sepMenu">&nbsp;</div>

        <?php if (option::get('sidebar_home') == 'off') { echo "<div class=\"full\">"; } ?>
		
		<div id="content">
			      
			<div id="postFuncs">
				<div id="funcStyler">
					<?php if (option::get('post_switcher') == 'on') { ?><a href="javascript: void(0);" id="mode" <?php if ($_COOKIE['mode'] == 'list') echo 'class="flip"'; if (!isset($_COOKIE['mode']) && option::get('post_layout') == 'Grid') { echo ' '; }  if (!isset($_COOKIE['mode']) && option::get('post_layout') == 'List') { echo 'class="flip"';}?>></a><?php } ?>
				</div>
			  
				<?php echo '<h2>'; wpzoom_breadcrumbs(); echo'</h2>';  ?>
			</div><!-- /#postFuncs -->
		        
			<div id="archive">
		        
		       <?php get_template_part('loop'); ?>
			         
			</div><!-- /#archive -->

			<?php get_template_part( 'pagination'); ?>
			      
		</div><!-- /#content -->
		<?php if (option::get('sidebar_home') == 'off') { echo "</div>"; } ?>
		  
		<?php if (option::get('sidebar_home') == 'on') { ?>
				<?php get_sidebar(); ?>
			<?php } ?>

		<div class="cleaner">&nbsp;</div>
	</div><!-- /.wrapper -->

</div><!-- /#main -->

<?php get_footer(); ?>