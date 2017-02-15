<?php
/**
 * @package lontano
 */
?>
<?php $addLinkFeat = get_theme_mod('lontano_theme_options_linkfeatured', ''); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php lontano_entry_category(); ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php lontano_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
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
		<?php the_content(); ?>
		<?php
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

	<footer class="entry-footer">
		<?php lontano_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->