<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lontano
 */

?>
<?php $addLinkFeat = get_theme_mod('lontano_theme_options_linkfeatured', ''); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ($addLinkFeat == '1') {
				if ( '' != get_the_post_thumbnail() ) {
					$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
					echo '<div class="entry-featuredImg"><a href="' . esc_url($src[0]) . '" title="' . the_title_attribute('echo=0') . '"><div class="lontanoImage"></div>';
					the_post_thumbnail('lontano-normal-post');
					echo '</a></div>';
				}
			} else {
				if ( '' != get_the_post_thumbnail() ) {
					echo '<div class="entry-featuredImg">';
					the_post_thumbnail('lontano-normal-post');
					echo '</div>';
				}
			}
		?>
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'lontano' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links-number">',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'lontano' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->
	<span style="display:none" class="updated"><?php the_time(get_option('date_format')); ?></span>
	<div style="display:none" class="vcard author"><a class="url fn" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></div>

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'lontano' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link" style="margin-top: 1em; display: block;"><i class="fa fa-wrench spaceLeftRight"></i>',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
