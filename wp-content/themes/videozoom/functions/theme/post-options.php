<?php

/* Custom Post Layouts
==================================== */

function wpzoom_post_layout_options() {
	global $post;
	$postLayouts = array('side-right' => 'Sidebar on the right', 'side-left' => 'Sidebar on the left', 'full' => 'Full Width');
	?>

	<style>
	.RadioClass { display: none; }
	.RadioLabelClass { margin-right: 10px; }
	img.layout-select { border: solid 4px #c0cdd6; border-radius: 5px; }
	.RadioSelected img.layout-select { border: solid 4px #3173b2; }

	#wpzoom_post_embed_code { color: #444444; font-size: 11px; margin: 3px 0 10px; padding: 5px; font-family: Consolas,Monaco,Courier,monospace; }

	.wpz_video { background: url(images/media-button-video.gif) no-repeat; padding: 0 0 0 18px; }
	.wpz_list { font-size: 11px; }
	.wpz_self_input { border: 1px solid #DFDFDF; border-radius: 4px 4px 4px 4px; width: 230px; color: #444444; }
	.wpz_border { border-bottom: 1px solid #EEEEEE; padding: 0 0 10px; }
 
 	</style>

	<script type="text/javascript">  
		jQuery(document).ready( function($) {
			$(".RadioClass").change(function(){  
			    if($(this).is(":checked")){  
			        $(".RadioSelected:not(:checked)").removeClass("RadioSelected");  
			        $(this).next("label").addClass("RadioSelected");  
			    }  
			}); 
 		});  
  	</script>
  
	<fieldset>
		<div>
 			<p>
 			<?php
			foreach ($postLayouts as $key => $value)
			{
				?>
				<input id="<?php echo $key; ?>" type="radio" class="RadioClass" name="wpzoom_post_template" value="<?php echo $key; ?>"<?php if (get_post_meta($post->ID, 'wpzoom_post_template', true) == $key) { echo' checked="checked"'; } ?> />
				<label for="<?php echo $key; ?>" class="RadioLabelClass<?php if (get_post_meta($post->ID, 'wpzoom_post_template', true) == $key) { echo' RadioSelected"'; } ?>">
				<img src="<?php echo wpzoom::$wpzoomPath; ?>/assets/images/layout-<?php echo $key; ?>.png" alt="<?php echo $value; ?>" title="<?php echo $value; ?>" class="layout-select" /></label>
			<?php
			} 
			?>
 			</p>
   		</div>
	</fieldset>
	<?php
}
 
 
/* Custom Posts Options	
==================================== */

add_action('admin_menu', 'wpzoom_options_box');

function wpzoom_options_box() {
	add_meta_box('wpzoom_post_layout', 'Post Layout', 'wpzoom_post_layout_options', 'post', 'normal', 'high');
	add_meta_box('wpzoom_post_embed', 'Post Options', 'wpzoom_post_embed_info', 'post', 'side', 'high');
}


function wpzoom_post_embed_info() {
	global $post;

	?>
	<fieldset>
		<div>
  			
			<p class="wpz_border">
 				<?php $isChecked = ( get_post_meta($post->ID, 'wpzoom_is_featured', true) == 1 ? 'checked="checked"' : '' ); // we store checked checkboxes as 1 ?>
				<input type="checkbox" name="wpzoom_is_featured" id="wpzoom_is_featured" value="1" <?php echo $isChecked; ?> /> <label for="wpzoom_is_featured">Feature on Homepage</label> 
			</p>

			<p class="wpz_border">
				<label for="wpzoom_post_embed_location" ><strong>Video location in the post:</strong></label><br />
				<select name="wpzoom_post_embed_location" id="wpzoom_post_embed_location">
					<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_location', true), 'In the middle column' ); ?>>In the middle column</option>
					<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_location', true), 'Before everything else' ); ?>>Before everything else</option>
					<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_location', true), 'Hide video in post' ); ?>>Hide video in post</option>
				</select>
				<br />
			</p>

			<p class="wpz_border" style="border-bottom:none; padding:0;">
				<strong>Embed Video:</strong><br />
  		 
				<?php $videoType = get_post_meta($post->ID, 'wpzoom_video_type', true); ?>

				<label for="video_external">
					<input name="wpzoom_video_type" id="video_external" <?php if ($videoType == 'external' || !$videoType) { ?>checked="checked" <?php } ?>value="external" type="radio" onclick="document.getElementById('layout_select2').style.display = 'none'; document.getElementById('layout_select1').style.display = 'block'; " /> External Video
				</label>
				<label for="video_selfhosted">
					<input name="wpzoom_video_type" id="video_selfhosted" <?php if ($videoType == 'selfhosted') { ?>checked="checked" <?php } ?>value="selfhosted" type="radio" onclick="document.getElementById('layout_select1').style.display = 'none'; document.getElementById('layout_select2').style.display = 'block'; " /> Self-hosted Video
				</label>

				<div id="layout_select1" class="external"<?php if ($videoType == 'selfhosted') { ?> style="display:none"<?php } ?>>
					<p>
						<label for="wpzoom_post_embed_code" >Insert Embed Code (<em>YouTube, Vimeo, JW Player etc.</em>):</label><br />
						<textarea style="height: 110px; width: 255px;" name="wpzoom_post_embed_code" id="wpzoom_post_embed_code"><?php echo get_post_meta($post->ID, 'wpzoom_post_embed_code', true); ?></textarea>						 
					</p>
				</div>  
				    
				<div id="layout_select2" class="selfhosted"<?php if ($videoType == 'external' || !$videoType) { ?> style="display:none"<?php } ?>>    
				    <div class="wpz_border">
					<p>
 					<ol class="wpz_list ">
 						<?php if ( ui::is_wp_version( '3.6' ) ) { ?>
							<li><a class="insert-media add_media wpz_video" data-editor="content" href="#">Upload video</a> to your website</li>
						<?php } else { ?>
							<li><a class="thickbox wpz_video" href="media-upload.php?post_id=9&type=video&TB_iframe=1">Upload video</a> to your website</li>
						<?php } ?>
	 					<li>Insert video URL here:<br/>
						
							<input class="form-input-tip wpz_self_input" name="wpzoom_post_embed_self" id="wpzoom_post_embed_self" value="<?php echo get_post_meta($post->ID, 'wpzoom_post_embed_self', true); ?>" />
						</li>
						<li><strong>HD</strong> video URL (optional):<br/>
						
							<input class="form-input-tip wpz_self_input" name="wpzoom_post_embed_hd" id="wpzoom_post_embed_hd" value="<?php echo get_post_meta($post->ID, 'wpzoom_post_embed_hd', true); ?>" />
						</li>
						<li>Select a skin for player:
							<select name="wpzoom_post_embed_skin" id="wpzoom_post_embed_skin">
								<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_skin', true), 'Five' ); ?>>Five</option>
								<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_skin', true), 'Beelden' ); ?>>Beelden</option>
								<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_skin', true), 'Bekle' ); ?>>Bekle</option>
	 							<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_skin', true), 'Glow' ); ?>>Glow</option>
								<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_skin', true), 'Modieus' ); ?>>Modieus</option>
								<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_skin', true), 'Nacht' ); ?>>Nacht</option>
								<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_skin', true), 'Simple' ); ?>>Simple</option>
								<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_skin', true), 'Stijl' ); ?>>Stijl</option>
								<option<?php selected( get_post_meta($post->ID, 'wpzoom_post_embed_skin', true), 'Stormtrooper' ); ?>>Stormtrooper</option>
	 						</select>
						</li>
					</ol>
					</p>
 				</div>
			</p>
 			
			<p>
				<em><strong>Tips:</strong></em><br/>
				<ol class="wpz_list">
 					<li>Recommended video formats: <em>.flv, .mp4</em>. Read more about <a href="http://www.longtailvideo.com/support/jw-player/jw-player-for-flash-v5/12539/supported-video-and-audio-formats" target="_blank">supported formats</a>.</li>
 					<li><strong>HTML5</strong> videos (supported by iPhone/iPad) should be in <em>MP4</em> format, with <em>H.264</em> enconding. You can convert your videos with <a href="http://handbrake.fr/downloads.php" target="_blank">HandBrake</a> video converter.</li>
					
				</ol>
			</p>  
			</div>  
 		</div>
	</fieldset>
	<?php
}
  
add_action('save_post', 'custom_add_save');

function custom_add_save($postID){
   
	// called after a post or page is saved
	if($parent_id = wp_is_post_revision($postID))
	{
	  $postID = $parent_id;
	}

	if ($_POST['save'] || $_POST['publish']) {
		update_custom_meta($postID, $_POST['wpzoom_is_featured'], 'wpzoom_is_featured');
		update_custom_meta($postID, $_POST['wpzoom_post_template'], 'wpzoom_post_template');
		update_custom_meta($postID, $_POST['wpzoom_post_embed_location'], 'wpzoom_post_embed_location');
		update_custom_meta($postID, $_POST['wpzoom_video_type'], 'wpzoom_video_type');
		update_custom_meta($postID, $_POST['wpzoom_post_embed_code'], 'wpzoom_post_embed_code');
		update_custom_meta($postID, $_POST['wpzoom_post_embed_self'], 'wpzoom_post_embed_self');
		update_custom_meta($postID, $_POST['wpzoom_post_embed_hd'], 'wpzoom_post_embed_hd');
		update_custom_meta($postID, $_POST['wpzoom_post_embed_skin'], 'wpzoom_post_embed_skin');
 	}
}

function update_custom_meta($postID, $newvalue, $field_name) {
	// To create new meta
	if(!get_post_meta($postID, $field_name)){
	add_post_meta($postID, $field_name, $newvalue);
	}else{
	// or to update existing meta
	update_post_meta($postID, $field_name, $newvalue);
	}
}


if (function_exists('jwplayer_init')) {
	add_action('admin_head-post.php', 'videozoom_jwplayer_post_js', 10, 1);
	add_action('admin_head-post-new.php', 'videozoom_jwplayer_post_js', 10, 1);

	add_filter("media_send_to_editor", "videozoom_jwplayer_tag_to_editor", 11, 3);

	add_filter("attachment_fields_to_edit", "videozoom_jwplayer_attachment_fields", 11, 2);
}

function videozoom_jwplayer_post_js() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$.noConflict();

			window.original_send_to_editor = window.send_to_editor;
	        window.send_to_editor = function(html) {
	        	if (html.indexOf('[featured]') == -1) {
	        		return window.original_send_to_editor(html);
	        	}

	        	$('#wpzoom_post_embed_code').val(html.replace('[featured]', ''));

	        	try {
	        		tb_remove();
	        	} catch(d) {}
	        }
		});
	</script>
	<?php
}

function videozoom_jwplayer_tag_to_editor($html, $send_id, $attachment) {
	if ($_POST["send"][$send_id] == 'Use JW Player as Featured') {
		// change this value so jwplayer_tag_to_editor could do it's job
		$_POST["send"][$send_id] = 'Insert JW Player';

		return '[featured]' . jwplayer_tag_to_editor($html, $send_id, $attachment);

		// revert back
		$_POST["send"][$send_id] == 'Use JW Player as Featured';
	}
	
	return $html;
}

function videozoom_jwplayer_attachment_fields($form_fields, $post) {
	// don't do anything if jwplayer for wp didn't modified form fields
	if (!$form_fields['jwplayer']) return $form_fields;

	$insert = "<input type='submit' class='button-primary' name='send[$post->ID]' value='" . esc_attr__( 'Use JW Player as Featured' ) . "' />";
    $form_fields["jwplayer_featured"] = array("tr" => "\t\t<tr class='submit'><td></td><td class='savesend'>$insert</td></tr>\n");

	return $form_fields;
}

if ( class_exists('JWP6_Plugin') ) {
	add_filter("attachment_fields_to_edit", "videozoom_jwplayer6_attachment_fields", 100, 2);

	function videozoom_jwplayer6_attachment_fields($form_fields, $post) {
		// don't do anything if jwplayer for wp didn't modified form fields
		if ( !defined('JWP6') || !$form_fields[ JWP6 . 'insert_with_player' ] ) return $form_fields;

		$form_fields['jwplayer_featured'] = array(
			'input' => 'html',
			'html' => '<input type="submit" id="jwplayer-as-featured" class="button-primary" name="send[' . $post->ID . ']" value="' . esc_attr__( 'Use JW Player as Featured', 'wpzoom' ) . '" />
			<script type="text/javascript">
				jQuery(document).on("click", "#jwplayer-as-featured", function(e){
					e.preventDefault();
					var selected_player = jQuery("#jwp6_insert_with_player").val();
					wp.media.post("send-attachment-to-editor", {
						nonce: wp.media.view.settings.nonce.sendToEditor,
						attachment: {
							"id": ' . $post->ID . ',
							"player_name": selected_player,
							"' . JWP6 . 'insert_jwplayer": true,
							"' . JWP6 . 'mediaid": ' . $post->ID . '
						},
						html: "",
						post_id: wp.media.view.settings.post.id
					}).done(function(response){
						var $embedfield = jQuery("#wpzoom_post_embed_code");
						$embedfield.val(response);
						try{tb_remove();}catch(e){};
						$embedfield.focus();
					});
				});
			</script>'
		);

		return $form_fields;
	}
}
