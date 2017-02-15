<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lontano
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf(
					esc_html( _nx( '一条评论', '%1$s 条评论', get_comments_number(), '评论标题', 'lontano' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => '70',
					'reply_text'        =>  '<span>' .esc_html__( '回复'  , 'lontano' ) . '<i class="fa fa-reply spaceLeft"></i></span>',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( '评论列表', 'lontano' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( '历史评论', 'lontano' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( '最新评论', 'lontano' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( '评论被关闭。', 'lontano' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields =  array(
			'author' => '<p class="comment-form-author"><label for="author"><span class="screen-reader-text">' . esc_html__( '姓名*'  , 'lontano' ) . '</span></label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( '姓名*'  , 'lontano' ) . '"/></p>',
			'email'  => '<p class="comment-form-email"><label for="email"><span class="screen-reader-text">' . esc_html__( 'Email *'  , 'lontano' ) . '</span></label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( 'Email *'  , 'lontano' ) . '"/></p>',
			'url'    => '<p class="comment-form-url"><label for="url"><span class="screen-reader-text">' . esc_html__( '网址*'  , 'lontano' ) . '</span></label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( '网址'  , 'lontano' ) . '"/></p>',
		);
		$required_text = esc_html__(' 必填字段标记', 'lontano').' <span class="required">*</span>';
		?>
		<?php comment_form( array(
			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' , 'lontano' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'logged_in_as' => '<p class="logged-in-as smallPart">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  , 'lontano' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes smallPart">' . esc_html__( '
您的电子邮件地址将不会公布。'  , 'lontano' ) . ( $req ? $required_text : '' ) . '</p>',
			'title_reply' => esc_html__( '留言'  , 'lontano' ),
			'title_reply_to' => esc_html__( '留下答复 %s'  , 'lontano' ),
			'cancel_reply_link' => esc_html__( '取消回复'  , 'lontano' ) . '<i class="fa fa-times spaceLeft"></i>',
			'label_submit' => esc_html__( '发表评论'  , 'lontano' ),
			'comment_field' => '<p class="comment-form-comment"><label for="comment"><span class="screen-reader-text">' . esc_html__( '请留言*'  , 'lontano' ) . '</span></label><textarea id="comment" name="comment" rows="8" aria-required="true" placeholder="' . esc_attr__( '请留言*'  , 'lontano' ) . '"></textarea></p>',
		));
	?>

</div><!-- #comments -->
