<?php

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'alger'); ?></p> 
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number(__('No comment', 'alger'), __('Has one comment', 'alger'), __('% comments', 'alger'));?> <?php printf(__('to &#8220;%s&#8221;', 'alger'), the_title('', '', false)); ?></h3>
<div class="upcomment"><?php _e('You can ','alger'); ?><a id="leaverepond" href="#comments"><?php _e('leave a reply','alger'); ?></a>  <?php _e(' or ','alger'); ?> <a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('Trackback','alger'); ?></a> <?php _e('this post.','alger'); ?></div>
	<ol id="thecomments" class="commentlist comments-list">
	<?php wp_list_comments('type=comment&callback=alger_comment');?>
	</ol>

<!-- comments pagenavi Start. -->
	<?php
	if (get_option('page_comments')) {
		$comment_pages = paginate_comments_links('echo=0');
		if ($comment_pages) {
?>
		<div id="commentnavi">
			<span class="pages"><?php _e('Comment pages', 'alger'); ?></span>
			<div id="commentpager">
				<?php echo $comment_pages; ?>
				
			</div>
			<div class="fixed"></div>
		</div>
<?php
		}
	}
?>

<?php else :  ?>

	<?php if ( comments_open() ) : ?>

	<?php else : ?>
		<!-- If comments are closed. -->
		<p class="nocomments"></p>

	<?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond" class="respondbg">

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'alger'),  esc_url(wp_login_url( get_permalink() ))); ?></p>
<?php else : ?>
<?php 
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
global $required_text;

$comments_args = array(
'class_submit' => 'submit',
         'comment_notes_before' => '<p class="comment-notes">' .
    esc_html__( 'Your email address will not be published.', 'alger' ) . ( $req ? $required_text : '' ) .
    '</p>',
        'title_reply'=> esc_html__('Leave a Reply', 'alger'),
        'comment_notes_after' => '',
		'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<section class="form-item"><input id="author" class="input-name form-control" name="author" placeholder="'.esc_attr__('Name', 'alger').'"  type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></section>',

    'email' =>
      '<section class="form-item"><input id="email" class="input-name form-control" name="email" placeholder="'.esc_attr__('Email', 'alger').'"  type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></section>',

    'url' =>
      '<section class="form-item"><input id="url" class="input-name form-control" placeholder="'.esc_attr__('Website', 'alger').'" name="url"  type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></section>'
    )
	
	),
        'comment_field' => '<section class="form-item"><textarea id="comment" name="comment" placeholder="'.esc_attr__('Message', 'alger').'" rows="8"  class="textarea-comment form-control" aria-required="true"></textarea></section>'
);
?>
<?php comment_form($comments_args);?>

<?php endif;  ?>
</div>
<?php endif;  ?>