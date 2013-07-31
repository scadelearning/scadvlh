<?php return array(

/* Theme Admin Menu */
"menu" => array(
    array("id"    => "1",
          "name"  => "General"),

    array("id"    => "2",
          "name"  => "Homepage"),

    array("id"    => "5",
          "name"  => "Styling"),

    array("id"    => "7",
          "name"  => "Banners"),
),

/* Theme Admin Options */
"id1" => array(
    array("type"  => "preheader",
          "name"  => "Theme Settings"),

    array("name"  => "Color Style",
          "desc"  => "Choose the style that you would like to use.<br />",
          "id"    => "theme_style",
          "options" => array('Dark', 'Light', 'Blue', 'Pink'),
          "std"   => "Dark",
          "type"  => "select"),

  array("name"  => "Logo Image",
          "desc"  => "Upload a custom logo image for your site, or you can specify an image URL directly.",
          "id"    => "misc_logo_path",
          "std"   => "",
          "type"  => "upload"),

    array("name"  => "Favicon URL",
          "desc"  => "Upload a favicon image (16&times;16px).",
          "id"    => "misc_favicon",
          "std"   => "",
          "type"  => "upload"),

    array("name"  => "Custom Feed URL",
          "desc"  => "Example: <strong>http://feeds.feedburner.com/wpzoom</strong>",
          "id"    => "misc_feedburner",
          "std"   => "",
          "type"  => "text"),

  array("name"  => "Enable comments for static pages",
          "id"    => "comments_page",
          "std"   => "off",
          "type"  => "checkbox"),


  array("type"  => "preheader",
          "name"  => "Header Icons"),

    array("name"  => "Show Social Icons in the Header?",
          "id"    => "social_icons",
          "std"   => "off",
          "type"  => "checkbox"),

  array("type"  => "startsub",
          "name"  => "RSS Icon"),

    array("name"  => "Show RSS icon?",
        "id"    => "social_rss",
        "std"   => "off",
        "type"  => "checkbox"),

    array("name"  => "RSS Icon Title",
        "desc"  => "Example: <strong>Subscribe to RSS</strong>",
        "id"    => "social_rss_title",
        "type"  => "text"),

  array("type"  => "endsub"),


  array("type"  => "startsub",
          "name"  => "Twitter Icon"),

    array("name"  => "Show Twitter icon?",
        "id"    => "social_twitter_show",
        "std"   => "off",
        "type"  => "checkbox"),

    array("name"  => "Twitter Username",
        "desc"  => "Example: <strong>wpzoom</strong>",
        "id"    => "social_twitter",
        "type"  => "text"),

    array("name"  => "Twitter Icon Title",
        "desc"  => "Example: <strong>Follow us</strong>",
        "id"    => "social_twitter_title",
        "type"  => "text"),

  array("type"  => "endsub"),


  array("type"  => "startsub",
          "name"  => "Facebook Icon"),

    array("name"  => "Show Facebook icon?",
        "id"    => "social_facebook_show",
        "std"   => "off",
        "type"  => "checkbox"),

    array("name"  => "Facebook URL",
        "desc"  => "Example: <strong>http://facebook.com/wpzoom</strong>",
        "id"    => "social_facebook",
        "type"  => "text"),

    array("name"  => "Facebook Icon Title",
        "desc"  => "Example: <strong>Facebook Page</strong>",
        "id"    => "social_facebook_title",
        "type"  => "text"),

  array("type"  => "endsub"),


  array("type"  => "preheader",
          "name"  => "Global Posts Options"),

    array("name"  => "Enable Post Layout Switch?",
          "desc"  => "If you disable Layout Switch, then your visitors will see posts in the default layout you select in the next option.",
          "id"    => "post_switcher",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Default Layout",
          "id"    => "post_layout",
          "options" => array('Grid', 'List'),
          "std"  => "Grid",
          "type" => "select"),

    array("name"  => "Excerpt length",
          "desc"  => "Default: <strong>80</strong> (words)",
          "id"    => "excerpt_length",
          "std"   => "80",
          "type"  => "text"),

    array("name"  => "Show Category",
          "id"    => "display_category",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Show Read More link",
          "id"    => "display_readmore",
          "std"   => "on",
          "type"  => "checkbox"),

  array("name"  => "Show Date/Time",
          "desc"  => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
          "id"    => "display_date",
          "std"   => "on",
          "type"  => "checkbox"),


  array("type"  => "preheader",
          "name"  => "Single Post Options"),

    array("name"  => "Show Meta Sidebar",
          "desc"  => "Select if you want to show the left sidebar which contains: Category, Tags and Share Buttons.",
          "id"    => "meta_sidebar",
          "std"   => "on",
          "type"  => "checkbox"),


  array("type"  => "startsub",
          "name"  => "Meta Settings"),

    array("name"  => "Show Date/Time",
        "desc"  => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
        "id"    => "post_date",
        "std"   => "on",
        "type"  => "checkbox"),

    array("name"  => "Show Author",
        "desc"  => "You can edit your profile on this <a href='profile.php' target='_blank'>page</a>.",
        "id"    => "post_author",
        "std"   => "on",
        "type"  => "checkbox"),

    array("name"  => "Show Category",
        "id"    => "post_category",
        "std"   => "on",
        "type"  => "checkbox"),

    array("name"  => "Show Tags",
        "id"    => "post_tags",
        "std"   => "on",
        "type"  => "checkbox"),

  array("type"  => "endsub"),


  array("name"  => "Show Share Buttons",
          "id"    => "post_share",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Show Comments",
          "id"    => "post_comments",
          "std"   => "on",
          "type"  => "checkbox"),

  array("name"  => "Show Trackbacks",
          "id"    => "post_trackbacks",
          "std"   => "off",
          "type"  => "checkbox"),

),

"id2" => array(

    array("type"  => "preheader",
          "name"  => "Homepage Settings"),

    array("name"  => "Display Recent Posts on Homepage",
          "id"    => "recent_posts",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Title for Recent Posts",
          "desc"  => "Default: <em>Recent Videos</em>",
          "id"    => "recent_title",
          "std"   => "Recent Videos",
          "type"  => "text"),

    array("name"  => "Exclude categories",
          "desc"  => "Choose the categories which should be excluded from the main Loop on the homepage.<br/><em>Press CTRL or CMD key to select/deselect multiple categories </em>",
          "id"    => "recent_part_exclude",
          "std"   => "",
          "type"  => "select-category-multi"),

    array("name"  => "Hide Featured Posts in Recent Posts?",
          "desc"  => "You can use this option if you want to hide posts which are featured in the slider on front page.",
          "id"    => "hide_featured",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Show the Sidebar on Homepage and Archives?",
          "id"    => "sidebar_home",
          "std"   => "on",
          "type"  => "checkbox"),


  array("type"  => "preheader",
          "name"  => "Slider Settings"),

  array("name"  => "Enable the featured slider",
          "desc"  => "The featured slider will display 4 featured posts. Edit posts which you want to feature, and check the box from editing page: <strong>Feature in Homepage Slider</strong> ",
          "id"    => "featured_enable",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Number of Featured Posts",
          "desc"  => "Default: 12",
          "id"    => "slideshow_posts",
          "std"   => "12",
          "type"  => "text"),

  array("name"  => "Autoplay slider",
          "desc"  => "Should the slider start rotating automatically?",
          "id"    => "featured_rotate",
          "std"   => "off",
          "type"  => "checkbox"),

  array("name"  => "Autoplay Interval",
          "desc"  => "Select the interval (in miliseconds) at which the slider should change posts (if autoplay is enabled). Default: 3000 (3 seconds).",
          "id"    => "featured_interval",
          "std"   => "3000",
          "type"  => "text"),

  array("name" => "Slideshow Effect",
          "desc" => "Select the effect for slides transition.",
          "id"   => "slideshow_effect",
          "options" => array('Slide', 'Fade'),
          "std"  => "Slide",
          "type" => "select"),

  array("name"  => "Pause slider on hover",
          "desc"  => "Stop slider movement then user keeps mouse over it",
          "id"    => "featured_pause_hover",
          "std"   => "off",
          "type"  => "checkbox"),

    array("name"  => "Video/Image Width (pixels)",
          "desc"  => "Default: <strong>460</strong> (pixels)",
          "id"    => "slider_thumb_width",
          "std"   => "460",
          "selector" => "#featPosts .cover",
          "attr" => "width",
          "css" => true,
          "type"  => "text"),

    array("name"  => "Video/Image Height (pixels)",
          "desc"  => "Default: <strong>260</strong> (pixels)",
          "id"    => "slider_thumb_height",
          "std"   => "260",
          "selector" => "#featPosts .cover",
          "attr" => "height",
          "css" => true,
          "type"  => "text"),

    array("name"  => "Show Thumbnails",
          "id"    => "slider_thumb",
          "std"   => "on",
          "type"  => "checkbox"),


  array("type"  => "startsub",
          "name"  => "Slider Meta"),

    array("name"  => "Show Date/Time",
        "desc"  => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
        "id"    => "slider_date",
        "std"   => "on",
        "type"  => "checkbox"),

    array("name"  => "Show Category",
        "id"    => "slider_category",
        "std"   => "on",
        "type"  => "checkbox"),

    array("name"  => "Show Author",
        "id"    => "slider_author",
        "std"   => "on",
        "type"  => "checkbox"),

    array("name"  => "Show Read More button",
        "id"    => "slider_morebtn",
        "std"   => "on",
        "type"  => "checkbox"),

  array("type"  => "endsub"),

),


"id5" => array(
    array("type"  => "preheader",
          "name"  => "Colors"),

    array("name"  => "Logo Color",
           "id"   => "logo_color",
           "type" => "color",
           "selector" => "#logo h1 a",
           "attr" => "color"),
   
    array("name"  => "Link Color",
           "id"   => "a_css_color",
           "type" => "color",
           "selector" => "a, p.postmetadata a",
           "attr" => "color"),
           
    array("name"  => "Link Hover Color",
           "id"   => "ahover_css_color",
           "type" => "color",
           "selector" => "a:hover, p.more a:hover, #main #submit:hover, #commentform #submit:hover, div.navigation a.next:hover, div.navigation a.prev:hover, .dropdown a:hover, .dropdown li:hover a",
           "attr" => "color"),

    array("name"  => "Current Navigation Page Color",
           "id"   => "current_nav_color",
           "type" => "color",
           "selector" => "div.navigation .current",
           "attr" => "background-color"),

    array("name"  => "Widget Title Color",
           "id"   => "widget_color",
           "type" => "color",
           "selector" => ".widget h3",
           "attr" => "color"),
 

    array("type"  => "preheader",
          "name"  => "Fonts"),

    array("name" => "General Text Font Style", 
          "id" => "typo_body", 
          "type" => "typography", 
          "selector" => "body, .entry" ),

    array("name" => "Logo Text Style", 
          "id" => "typo_logo", 
          "type" => "typography", 
          "selector" => "#logo h1 a" ),

    array("name"  => "Slider Post Title Style",
           "id"   => "typo_slider_title",
           "type" => "typography",
           "selector" => "#slider li h2 a"),

    array("name"  => "Recent Post Title Style",
           "id"   => "typo_post_title",
           "type" => "typography",
           "selector" => ".postcontent h2 a"),

    array("name"  => "Individual Post Title Style",
           "id"   => "typo_individual_title",
           "type" => "typography",
           "selector" => ".singlepost h1 a"),
 
     array("name"  => "Widget Title Style",
           "id"   => "typo_widget",
           "type" => "typography",
           "selector" => ".widget h3.title "),

),


"id7" => array(
  array("type"  => "preheader",
          "name"  => "Header Ad"),

    array("name"  => "Enable ad space in the header?",
          "id"    => "ad_head_select",
          "std"   => "off",
          "type"  => "checkbox"),

    array("name"  => "HTML Code (Adsense)",
          "desc"  => "Enter complete HTML code for your banner (or Adsense code) or upload an image below.",
          "id"    => "ad_head_code",
          "std"   => "",
          "type"  => "textarea"),

  array("name"  => "Upload your image",
          "desc"  => "Upload a banner image or enter the URL of an existing image.<br/>Recommended size: <strong>768 × 60px</strong>",
          "id"    => "banner_top",
          "std"   => "",
          "type"  => "upload"),

  array("name"  => "Destination URL",
          "desc"  => "Enter the URL where this banner ad points to.",
          "id"    => "banner_top_url",
          "type"  => "text"),

  array("name"  => "Banner Title",
          "desc"  => "Enter the title for this banner which will be used for ALT tag.",
          "id"    => "banner_top_alt",
          "type"  => "text"),


  array("type"  => "preheader",
          "name"  => "Sidebar Ad"),

  array("name"  => "Enable ad space in sidebar?",
          "id"    => "ad_side",
          "std"   => "off",
          "type"  => "checkbox"),

  array("name"  => "Ad Position",
          "desc"  => "Do you want to place the banner before the widgets or after the widgets?",
          "id"    => "ad_side_pos",
          "options" => array('Before widgets', 'After widgets'),
          "std"   => "Before widgets",
          "type"  => "select"),

    array("name"  => "HTML Code (Adsense)",
          "desc"  => "Enter complete HTML code for your banner (or Adsense code) or upload an image below.",
          "id"    => "ad_side_imgpath",
          "std"   => "",
          "type"  => "textarea"),

  array("name"  => "Upload your image",
          "desc"  => "Upload a banner image or enter the URL of an existing image.<br/>Recommended size: <strong>225 × 125px</strong>",
          "id"    => "banner_sidebar",
          "std"   => "",
          "type"  => "upload"),

  array("name"  => "Destination URL",
          "desc"  => "Enter the URL where this banner ad points to.",
          "id"    => "banner_sidebar_url",
          "type"  => "text"),

  array("name"  => "Banner Title",
          "desc"  => "Enter the title for this banner which will be used for ALT tag.",
          "id"    => "banner_sidebar_alt",
          "type"  => "text"),

)


/* end return */);