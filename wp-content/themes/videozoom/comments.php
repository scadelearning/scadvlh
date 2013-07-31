<?php
// Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if ( post_password_required() ) { ?>
        <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'wpzoom' ); ?></p>
    <?php
        return;
    }
?>

<!-- You can start editing here. -->

<?php if (have_comments()) { ?>
<div class="box">
    <div id="commentspost">
        <a name="commentspost"></a>
    
        <h2 class="title sep"><?php comments_number( __('No Comments', 'wpzoom'), __('1 Comment', 'wpzoom'), __('% Comments', 'wpzoom')); ?></h2>
        
        <ol class="normalComments"><?php wp_list_comments('type=comment&avatar_size=55');?></ol>
        
        <div class="navigation">
            <p>
                <?php previous_comments_link( __('Previous Comments' , 'wpzoom')); ?>
                <?php next_comments_link( __('Next Comments', 'wpzoom')); ?>
            </p>
        </div>

            <?php if (option::get('post_trackbacks') == 'Show') { ?>
                <h3><span><?php _e('Trackbacks', 'wpzoom'); ?></span></h3> 
            <ol class="trackblist">
            
               <?php //Displays trackbacks only
                foreach ($comments as $comment) : ?>
                    <?php $comment_type = get_comment_type(); ?>

                    <?php if($comment_type != 'comment') { ?>
                    <li><?php comment_author_link() ?></li>
                <?php }
                endforeach; ?>
                </ol>
            <?php } ?>
        
    </div><!-- /#commentspost -->
 
<?php if ('closed' == $post->comment_status) : ?>

</div>
<?php endif; ?>
    
    <?php } 
    else { // this is displayed if there are no comments so far ?>

    <?php if ('open' == $post->comment_status) { ?>
        <!-- If comments are open, but there are no comments. -->

<div class="box">
    <div id="commentspost">
        <h2 class="title"><?php _e('0 Comments', 'wpzoom');?></h2>
        
        <p><?php _e('You can be the first one to leave a comment.', 'wpzoom');?></p>
    </div>
    
    <?php } else { // comments are closed ?>
        <!-- If comments are closed. -->
    <?php } ?>
    <?php } ?>

    <?php if ('open' == $post->comment_status) : ?>

    <?php
    $commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

    comment_form( array(
    	'fields' => array(
    		'author' => '<div class="column">
                     		<label for="author">' . __('Name', 'wpzoom') . ($req ? '(' . __( 'required', 'wpzoom' ) : '') . '):</label>
                        	<input type="text" name="author" id="author" value="' . $commenter['comment_author'] . '" size="22" tabindex="1" ' . $aria_req . '/><br />
                     	</div>',
            'email'  => '<div class="column">
                            <label for="author">' . __('E-Mail', 'wpzoom') . ($req ? '(' . __( 'required', 'wpzoom' ) : '') . '):</label>
                            <input type="text" name="email" id="email" value="' . $commenter['comment_author_email'] . '" size="22" tabindex="2"' . $aria_req . '/><br />
                        </div>',
            'url'	 => '<div class="column last">
                            <label for="url">' . __('Website', 'wpzoom') . ':</label>
                            <input type="text" name="url" id="url" value="' . $commenter['comment_author_url'] . '" size="22" tabindex="3" /><br />
                        </div>'
        ),
		'comment_field'     => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="140" rows="8" tabindex="4" aria-required="true"></textarea></p>',
    	'comment_notes_before' => '<div class="sep">&nbsp;</div><div class="cleaner">&nbsp;</div>',
    	'comment_notes_after'  => '',
    	'title_reply'       => __( 'Leave a Comment', 'wpzoom' ),
    	'title_reply_to'    => __( 'Leave a Reply to %s', 'wpzoom' ),
    	'cancel_reply_link' => __( 'Click here to cancel reply.', 'wpzoom' ),
    	'label_submit'      => __( 'Submit Comment', 'wpzoom' ),
    ) );
    ?>
</div><!-- /#box -->
 
<?php endif; // if you delete this the sky will fall on your head ?>