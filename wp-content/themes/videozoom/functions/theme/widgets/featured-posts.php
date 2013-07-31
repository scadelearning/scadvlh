<?php

/*------------------------------------------*/
/* WPZOOM: Video Posts		                */
/*------------------------------------------*/

class wpzoom_widget_video_posts extends WP_Widget {

	/* Widget setup. */
	function wpzoom_widget_video_posts() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wpzoom', 'description' => __('Custom WPZOOM widget. Displays posts from a category or having a tag.', 'wpzoom') );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'wpzoom-widget-video-posts' );
		
		/* Create the widget. */
		$this->WP_Widget( 'wpzoom-widget-video-posts', __('WPZOOM: Homepage Posts', 'wpzoom'), $widget_ops, $control_ops );
	}
	
	/* How to display the widget on the screen. */
	function widget( $args, $instance ) {
	
		extract( $args );
		
		/* Our variables from the widget settings. */
 
		$columnType1 = $instance['column1_type'];
		if ($columnType1 == 'post')
		{
			$category1 = get_category($instance['category1']);
			if ($category1) {
				$categoryLink1 = get_category_link($category1);
			}
			$param = 'cat';
			$val = $category1->cat_ID;
		}
		elseif ($columnType1 == 'tag') {
			$tag1 = $instance['tag1'];
			$param = 'tag_id';
			$val = $tag1; 
		}
		
		$title = apply_filters('widget_title', $instance['title'] );
		$showDate = $instance['datetime'];
		$showPostCategory = $instance['post_category'];
		
		// $titleArray = explode(" ", $title,2);

		/* Before widget (defined by themes). */
		echo $before_widget; 
		?>

		<div id="postFuncs">
			<h2><?php if ($categoryLink1) { ?><a href="<?php echo $categoryLink1; ?>"><?php echo "$title"; ?></a><?php } else { echo "$title"; } ?></h2>
		</div><!-- /#postFuncs -->
		<?php

		/* Title of widget (before and after defined by themes). */
		?>
		<div id="archive">
		<ul class="posts posts-3 grid">
		<?php 
		$i = 0;
		$loop = new WP_Query( array( 'post__not_in' => get_option( 'sticky_posts' ), 'posts_per_page' => $instance['posts'], 'orderby' => 'date', 'order' => 'DESC', $param => $val ) );
	
		while ( $loop->have_posts() ) : $loop->the_post(); global $post;
		$i++;

		unset($image);
		?>

		<li<?php if ($i == 3 && option::get('sidebar_home') == 'on') {$i = 0; echo " class=\"last\"";} elseif ($i == 4 && option::get('sidebar_home') == 'off') {$i = 0; echo " class=\"last\""; } ?>>

			<?php get_the_image( array( 'size' => 'thumbnail', 'width' => 228, 'height' => 160, 'before' => '<div class="cover">', 'after' => '</div>' ) );  ?>
			
			<div class="postcontent">
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<p class="postmetadata"><?php if (option::get('display_date') == 'on') { ?><?php echo get_the_date(); ?><?php } ?><?php if (option::get('display_date') == 'on' && $showPostCategory == 'on') { ?> / <?php } ?><?php if ($showPostCategory == 'on') { ?><?php the_category(', '); ?><?php } ?></p>
					
					<?php the_excerpt(); ?>
					
				<p class="more"><?php if (option::get('display_readmore') == 'on') { ?><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="readmore" rel="nofollow"><?php _e('Continue reading', 'wpzoom'); ?> &raquo;</a><?php } ?> <?php edit_post_link( __('Edit this post', 'wpzoom'), ' ', ''); ?></p>
			
			</div>
		</li>
		<?php if ($i == 0) {echo'<li class="cleaner">&nbsp;</li>';} ?>
			
		<?php endwhile;	wp_reset_query(); ?>

		</ul>
		<div class="cleaner">&nbsp;</div>
		</div>

	<?php echo $after_widget; ?>

		<?php 
		}
	
		/* Update the widget settings.*/
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
	
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['column1_type'] = $new_instance['column1_type'];
			$instance['category1'] = $new_instance['category1'];
			$instance['tag1'] = $new_instance['tag1'];
			
			$instance['posts'] = $new_instance['posts'];
			$instance['datetime'] = $new_instance['datetime'];
			$instance['post_category'] = $new_instance['post_category'];
	 
			return $instance;
		}
	
		/** Displays the widget settings controls on the widget panel.
		 * Make use of the get_field_id() and get_field_name() function when creating your form elements. This handles the confusing stuff. */
		function form( $instance ) {
	
			/* Set up some default widget settings. */
			$defaults = array('title' => 'Widget Title', 'column1_type' => 'cat','category1' => '0','posts'=>'3', 'datetime' => 'on', 'post_category' => 'on');
			$instance = wp_parse_args( (array) $instance, $defaults );
	    ?>
	
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label><br />
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
			</p>

			<p><strong>Display Options:</strong></p>

			<p>
				<input name="<?php echo $this->get_field_name('column1_type'); ?>" id="<?php echo $this->get_field_id('column1_type'); ?>" <?php if ($instance['column1_type'] != 'tag') { ?>checked="checked"<?php } ?> value="post" type="radio" />
				<?php _e('Posts from a category:', 'wpzoom'); ?>
				<select id="<?php echo $this->get_field_id('category1'); ?>" name="<?php echo $this->get_field_name('category1'); ?>" style="width:90%;">
					<option value="0">Choose category:</option>
					<?php
					$cats = get_categories('hide_empty=0');
					
					foreach ($cats as $cat) {
					$option = '<option value="'.$cat->term_id;
					if ($cat->term_id == $instance['category1']) { $option .='" selected="selected';}
					$option .= '">';
					$option .= $cat->cat_name;
					$option .= ' ('.$cat->category_count.')';
					$option .= '</option>';
					echo $option;
					}
				?>
				</select>
			</p>

			<p>
				<input name="<?php echo $this->get_field_name('column1_type'); ?>" id="<?php echo $this->get_field_id('column1_type'); ?>" <?php if ($instance['column1_type'] == 'tag') { ?>checked="checked"<?php } ?>value="tag" type="radio" />
				<?php _e('Posts with a tag:', 'wpzoom'); ?>
				<select id="<?php echo $this->get_field_id('tag1'); ?>" name="<?php echo $this->get_field_name('tag1'); ?>" style="width:90%;">
					<option value="0">Choose tag:</option>
					<?php
					$cats = get_categories('taxonomy=post_tag');
					
					foreach ($cats as $cat) {
					$option = '<option value="'.$cat->term_id;
					if ($cat->term_id == $instance['tag1']) { $option .='" selected="selected';}
					$option .= '">';
					$option .= $cat->category_nicename;
					echo $option;
					}
				?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e('Posts to display:', 'wpzoom'); ?></label>
				<select id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" style="width:90%;">
				<?php
					$m = 0;
					while ($m < 20) {
						$m++;
						$option = '<option value="'.$m;
						if ($m == $instance['posts']) { $option .='" selected="selected';}
						$option .= '">';
						$option .= $m;
						$option .= '</option>';
						echo $option;
					}
				?>
				</select>
			</p>

			<hr style="height: 1px; line-height: 1px; font-size: 1px; border: none; border-top: solid 1px #aaa; margin: 10px 0;" />
			
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('post_category'); ?>" name="<?php echo $this->get_field_name('post_category'); ?>" <?php if ($instance['post_category'] == 'on') { echo ' checked="checked"';  } ?> /> 
			<label for="<?php echo $this->get_field_id('post_category'); ?>"><?php _e('Display category', 'wpzoom'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('datetime'); ?>" name="<?php echo $this->get_field_name('datetime'); ?>" <?php if ($instance['datetime'] == 'on') { echo ' checked="checked"';  } ?> /> 
			<label for="<?php echo $this->get_field_id('datetime'); ?>"><?php _e('Display date', 'wpzoom'); ?></label>
			<br/>
		</p>
		
		<hr style="height: 1px; line-height: 1px; font-size: 1px; border: none; border-top: solid 1px #aaa; margin: 10px 0;" />
		
		<?php
		}
}

function wpzoom_register_vp_widget() {
	register_widget('wpzoom_widget_video_posts');
}
add_action('widgets_init', 'wpzoom_register_vp_widget');
?>