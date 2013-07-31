<?php 
/*-----------------------------------------------------------------------------------*/
/* Initializing Widgetized Areas (Sidebars)											 */
/*-----------------------------------------------------------------------------------*/
 
 
/*----------------------------------*/
/* Sidebar                          */
/*----------------------------------*/
 
register_sidebar(array(
	'name'=>'Sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

/*----------------------------------*/
/* Home page				        */
/*----------------------------------*/

register_sidebar(array(
	'name'=>'Homepage: Content Widgets',
	'description' => 'Add here WPZOOM: Homepage Posts widgets',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '<div class="cleaner">&nbsp;</div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
 

/*----------------------------------*/
/* Footer widgetized areas     		*/
/*----------------------------------*/

register_sidebar(array(
	'name'=>'Footer: Column 1',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name'=>'Footer: Column 2',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name'=>'Footer: Column 3',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name'=>'Footer: Column 4',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

?>