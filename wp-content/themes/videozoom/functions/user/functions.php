<?php /* Add the [jwplayer] shortcode
==================================== 

function wpz_jwplayer_shortcode( $atts ) {
  extract( shortcode_atts( array(
    'src' => '',
    'skin' => 'five',
    'height' => '300',
    'width' => '500'
  ), $atts ) );
  
  $image = get_the_image( array( 'size' => 'featured', 'width' => option::get('slider_thumb_width'), 'height' => option::get('slider_thumb_height'),  'image_scan' => false, 'echo' => false, 'format' => 'array' ) );
  if (!empty ($image)) {  $url = $image['src']; }

  $random = rand(0,1000);

  return empty($src) ? '' : '<div class="clearfix" id="video_'  . $random .  '">Video</div>
  <script type="text/javascript">
    jwplayer("video_' . $random . '").setup({  
      "file": "' . $src . '",
      "skin": "' . get_template_directory_uri() . '/js/skins/' . $skin . '/' . $skin . '.zip",
      "image": "' . $url . '",
      "width": "' . $width . '",
      "height": "' . $height . '",
      "modes": [
        {type: "flash", src: "' . get_template_directory_uri() . '/js/player.swf"},
        {type: "html5"}
      ]
    });
  </script>';
}
add_shortcode( 'jwplayer', 'wpz_jwplayer_shortcode' );

function wpz_jwplayer_shortcode_js() {
  ?><script type="text/javascript">
    if ( typeof QTags != 'undefined' ) {
      QTags.addButton('wpz_jwplayer', '<?php _e('JW Player', 'wpzoom'); ?>', function(e, c, ed, defaultValue) {
        if ( ! defaultValue ) defaultValue = 'http://';
        var src = prompt('<?php _e('Enter Video URL', 'wpzoom'); ?>', defaultValue);
        if ( src ) {
          this.tagStart = '[jwplayer src="' + src + '" skin="five" height="300" width="500"]';
          QTags.TagButton.prototype.callback.call(this, e, c, ed);
        }
      });
    }
  </script><?php
}
add_action( 'admin_print_footer_scripts', 'wpz_jwplayer_shortcode_js', 100 );
*/