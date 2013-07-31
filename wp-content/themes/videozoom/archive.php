<?php get_header();
	if (is_author()) { 
		$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	}
?>

<div id="main">
  
    <div class="wrapper">
      
        <div class="sep sepMenu">&nbsp;</div>

        <?php if (option::get('sidebar_home') == 'off') { echo "<div class=\"full\">"; } ?>
		
		<div id="content">
			      
			<div id="postFuncs">
				<div id="funcStyler">
					<?php if (option::get('post_switcher') == 'on') { ?><a href="javascript: void(0);" id="mode" <?php if ($_COOKIE['mode'] == 'list') echo 'class="flip"'; if (!isset($_COOKIE['mode']) && option::get('post_layout') == 'Grid') { echo ' '; }  if (!isset($_COOKIE['mode']) && option::get('post_layout') == 'List') { echo 'class="flip"';}?>></a><?php } ?>
				</div>
			  
				<?php if (is_category()) { 
						$cat_ID = get_query_var('cat');
						echo '<h2>'; wpzoom_breadcrumbs(); echo'</h2>'; 
					} 
		            elseif (!is_category() && !is_home()) { 
			            echo '<h2>'; wpzoom_breadcrumbs(); echo'</h2>';  
		        	}
		             else { ?>
						<h2><?php _e('Recent Videos', 'wpzoom');?></h2>
		            <?php } ?>
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