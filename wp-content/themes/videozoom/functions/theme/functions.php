<?php

/* Register Thumbnails Size
================================== */

if ( function_exists( 'add_image_size' ) ) {

    /* Slider */
    add_image_size( 'slider', option::get('slider_thumb_width'), option::get('slider_thumb_height'), true );
    add_image_size( 'slider-small', 135, 98, true );

    /* Recent Posts Widget */
    add_image_size( 'recent-widget', 60, 45, true );

}

/* Default Thubmnail */
update_option('thumbnail_size_w', 228);
update_option('thumbnail_size_h', 160);
update_option('thumbnail_crop', 1);


/* 	Register Custom Menu
==================================== */

register_nav_menu('secondary', 'Top Menu');
register_nav_menu('primary', 'Main Menu');

add_filter('widget_text', 'do_shortcode');



/* Add support for Custom Background
==================================== */

if ( ui::is_wp_version( '3.4' ) )
    add_theme_support( 'custom-background' );
else
    add_custom_background( $args );


/* Custom Excerpt Length
==================================== */

function new_excerpt_length($length) {
	return (int) option::get("excerpt_length") ? (int) option::get("excerpt_length") : 80;
}
add_filter('excerpt_length', 'new_excerpt_length');



/* Reset [gallery] shortcode styles
==================================== */

add_filter('gallery_style', create_function('$a', 'return "<div class=\'gallery\'>";'));



/* Show all thumbnails in attachment.php
=========================================== */

function show_all_thumbs() {
	global $post;

	$post = get_post($post);
	$images =& get_children( 'post_type=attachment&post_mime_type=image&output=ARRAY_N&orderby=menu_order&order=ASC&post_parent='.$post->post_parent);
	if($images){
		foreach( $images as $imageID => $imagePost ){
			if($imageID==$post->ID){

			unset($the_b_img);
			$the_b_img = wp_get_attachment_image($imageID, 'thumbnail', false);
			$thumblist .= '<a class="active" href="'.get_attachment_link($imageID).'">'.$the_b_img.'</a>';


			} else {
			unset($the_b_img);
			$the_b_img = wp_get_attachment_image($imageID, 'thumbnail', false);
			$thumblist .= '<a href="'.get_attachment_link($imageID).'">'.$the_b_img.'</a>';
			}
		}
	}
	return $thumblist;
}


/* Email validation
==================================== */

function simple_email_check($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }

    return true;
}

/* Video Embed Code Fix
==================================== */

function embed_fix($videoexternal,$width,$height) {

    if ( stripos($videoexternal, '[jwplayer') !== false ) {

        if ( class_exists('JWP6_Shortcode') && method_exists('JWP6_Shortcode', 'widget_text_filter') ) {

            return JWP6_Shortcode::widget_text_filter($videoexternal);

        } elseif ( function_exists('jwplayer_tag_widget_callback') ) {
        
            return jwplayer_tag_widget_callback($videoexternal);
        }
    }
 
	$videoexternal = preg_replace("/(width\s*=\s*[\"\'])[0-9]+([\"\'])/i", "$1 ".$width." $2", $videoexternal);
	$videoexternal = preg_replace("/(height\s*=\s*[\"\'])[0-9]+([\"\'])/i", "$1 ".$height." $2", $videoexternal);
	if (strpos($videoexternal, "<embed src=" ) !== false) {
		  $videoexternal = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $videoexternal);
	}
	else {
		if(strpos($videoexternal, "wmode=transparent") == false){
	
			$re1='.*?';	# Non-greedy match on filler
			$re2='((?:http|https)(?::\\/{2}[\\w]+)(?:[\\/|\\.]?)(?:[^\\s"]*))';	# HTTP URL 1
	
			if ($c=preg_match_all ("/".$re1.$re2."/is", $videoexternal, $matches))
			{
				$httpurl1=$matches[1][0];
			}
	
			if(strpos($httpurl1, "?") == true){
				$httpurl_new = $httpurl1 . '&wmode=transparent';
			}
			else {
				$httpurl_new = $httpurl1 . '?wmode=transparent';
			}
	
			$search = array($httpurl1);
			$replace = array($httpurl_new);
			$videoexternal = str_replace($search, $replace, $videoexternal);
	
			//print($httpurl_new);
			unset($httpurl_new);
	
		}
	}
	return $videoexternal;
}


/* Maximum width for images in posts
=========================================== */
if ( ! isset( $content_width ) ) $content_width = 600;


/*  Limit Posts
/*
/*  Plugin URI: http://labitacora.net/comunBlog/limit-post.phps
/*	Usage: the_content_limit($max_charaters, $more_link)
=============================================================== */

function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '', $echo = true) {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0 && $thisshouldnotapply) {
      echo $content;
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        if ($echo == true) { echo $content . "..."; } else {return $content; }
   }
   else {
      if ($echo == true) { echo $content . "..."; } else {return $content; }
   }
}

/* Video auto-thumbnail
==================================== */

if (is_admin()) {
	WPZOOM_Video_Thumb::init();
}


/* Breadcrumbs
==================================== */

function wpzoom_breadcrumbs() {

  $delimiter = '&raquo;';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';

  if ( !is_home() && !is_front_page() || is_paged() ) {

     global $post;
    $home = home_url();
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . '';
      single_cat_title();
      echo '' . $currentAfter;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;

    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;

    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;

    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;

    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page', 'wpzoom') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

  }
}

function videozoom_featured_slider_assets() {
  if (!is_home() || option::get('featured_enable') != 'on') {
    return;
  }

  ui::js("slides", "froogaloop");
  ?>

  <script src="http://www.youtube.com/player_api"></script>
  <script type="text/javascript">

  var wpzoom_flex_repeat = false;
  var current_flex;
  jQuery(document).ready(function($) {
      jQuery('#carousel').flexslider({
          animation: "slide",
          controlNav: true,
          directionNav: true,
          animationLoop: true,
          slideshow: false,
          pauseOnAction: true,
          pauseOnHover: true,
          itemWidth: 146,
          asNavFor: '#slider'
      });

      wpzoom_flex_repeat = <?php if (option::is_on('featured_rotate')) { echo "true"; } else { echo "false"; } ?>;

      current_flex = jQuery("#slider").flexslider({
          controlNav: false,
          directionNav:true,
          animationLoop: true,
          sync: "#carousel",
          video:true,
          animation: "<?php if (option::get('slideshow_effect') == 'Slide') { ?>slide<?php } else { ?>fade<?php } ?>",
          useCSS: false,
          smoothHeight: true,
          slideshow: wpzoom_flex_repeat,
          <?php if (option::get('featured_rotate') == 'on') { ?>slideshowSpeed:<?php echo option::get('featured_interval'); ?>,<?php } ?>
          pauseOnAction: true,
          pauseOnHover: <?php echo option::is_on('featured_pause_hover') ? 'true' : 'false'; ?>,
          animationSpeed: 600,
          before: jQuery.fn.stopDontMove
      });

      // Vimeo API magic
      var players = $('#slider iframe');

      players.each(function() {
          var src = $(this).prop('src');

          if (src.indexOf('vimeo') !== -1) {
              // enable Vimeo API
              $(this).prop('src', src + '&api=1&player_id=' + $(this).prop('id'));

              $f(this).addEvent('ready', videozoom_vimeoReady);

              vimeoPlayers.push($(this).get(0));
          }

          if (src.indexOf('youtube') !== -1) {
              // enable YouTube API
              $(this).prop('src', src + '&enablejsapi=1');
              youtubeIDs.push($(this).prop('id'));
          }
      });
  });

    // YouTube API...
  function onYouTubePlayerAPIReady() {
      var c = youtubeIDs.length;

      for (var i = 0; i < c; i++) {
          youtubePlayers.push(
              new YT.Player(youtubeIDs[i], {
                  events: {
                      'onStateChange' : youtubeStateChange
                  }
              })
          );
      }
  }

  function youtubeStateChange(event) {
      youtube_loaded = true;

      if (current_flex === undefined) return;

      if (event.data === 1) {
          current_flex.flexslider('stop');
      }
  }

  // events workaround for IE
  function addEvent(element, eventName, callback) {
      if (element.addEventListener) {
          element.addEventListener(eventName, callback, false)
      } else {
          element.attachEvent(eventName, callback, false);
      }
  }

  function videozoom_vimeoReady(playerID) {
      if (current_flex === undefined) return;

      var fl = $f(playerID);

      fl.addEvent('play', function() {
          current_flex.flexslider('stop');
      });

      fl.addEvent('pause', function() {
          if (wpzoom_flex_repeat) {
              current_flex.flexslider('play');
          }
      });
  }
  </script>
  <?php
}

add_action('wp_footer', 'videozoom_featured_slider_assets');