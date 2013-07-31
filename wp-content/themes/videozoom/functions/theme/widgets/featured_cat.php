<?php

/*------------------------------------------*/
/* WPZOOM: Featured Category       		    */
/*------------------------------------------*/
 
 class wpzoom_widget_feat_posts extends WP_Widget {

/* Widget setup. */
function wpzoom_widget_feat_posts() {
	/* Widget settings. */
	$widget_ops = array( 'classname' => 'wpzoom', 'description' => __('Featured Category Widget', 'wpzoom') );
	
	/* Widget control settings. */
	$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'wpzoom-widget-cat' );
	
	/* Create the widget. */
	$this->WP_Widget( 'wpzoom-widget-cat', __('WPZOOM: Featured Category', 'wpzoom'), $widget_ops, $control_ops );
}

/* How to display the widget on the screen. */
function widget( $args, $instance ) {

	extract( $args );
	
	/* Our variables from the widget settings. */
	$title1 = apply_filters('widget_title', $instance['title1'] );
	$posts1 = $instance['posts1'];
	$category1 = get_category($instance['category1']);
	if ($category1) {
		$categoryLink1 = get_category_link($category1);
	}
	    
	echo $before_widget;
	echo "$before_title"."$title1"."$after_title"; ?>
	  
	<ul class="posts">
	  
		<?php 
		$args = array('showposts' => $posts1, 'orderby' => 'date', 'order' => 'DESC', 'cat' => $instance['category1']);
		query_posts($args); 
		?>
		
		<?php while (have_posts()) : the_post(); ?>
		
		<li>
			<?php global $post; ?>
			
		 	<?php get_the_image( array( 'size' => 'recent-widget', 'width' => 60, 'height' => 45, 'before' => '<div class="cover">', 'after' => '</div>' ) );  ?>
 			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> 
			<p class="postmetadata"> <a href="<?php the_permalink() ?>#commentspost" title="Jump to the comments"><?php comments_number('0 comments','1 comment','% comments'); ?></a></p>
			<div class="cleaner">&nbsp;</div>
		</li>
		          
		<?php endwhile; wp_reset_query(); ?>

	</ul><!-- end .posts -->
	
	<?php 

	echo $after_widget;

	wp_reset_query(); 

	}

	/* Update the widget settings.*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title1'] = strip_tags( $new_instance['title1'] );
 		$instance['category1'] = $new_instance['category1'];
		$instance['posts1'] = $new_instance['posts1'];
 
		return $instance;
	}

	/** Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function when creating your form elements. This handles the confusing stuff. */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title1' => __('Featured Posts', 'wpzoom'), 'category1' => '0', 'posts1' => '3' );
		$instance = wp_parse_args( (array) $instance, $defaults );
    ?>

 		<p>
			<label for="<?php echo $this->get_field_id( 'title1' ); ?>"><?php _e('Widget Title:', 'wpzoom'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title1' ); ?>" name="<?php echo $this->get_field_name( 'title1' ); ?>" value="<?php echo $instance['title1']; ?>" style="width:90%;" />
		</p>
    
		<p>
			<label for="<?php echo $this->get_field_id('category1'); ?>"><?php _e('Category:', 'wpzoom'); ?></label>
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
			<label for="<?php echo $this->get_field_id('posts1'); ?>"><?php _e('Number of posts to show:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('posts1'); ?>" name="<?php echo $this->get_field_name('posts1'); ?>" style="width:90%;">
			<?php
				$m = 0;
				while ($m < 11) {
				$m++;
				$option = '<option value="'.$m;
				if ($m == $instance['posts1']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $m;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>
		 
	<?php
	}
} 

register_widget('wpzoom_widget_feat_posts');