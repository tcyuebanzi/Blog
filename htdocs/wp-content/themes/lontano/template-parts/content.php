<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lontano
 */

?>
<?php 
	$showPost = get_theme_mod('lontano_theme_options_postshow', 'excerpt'); 
	$showVerticalBar = get_theme_mod('lontano_theme_options_verticalbar', '1'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ($showVerticalBar == 1):?>
	<div class="lontano-bar">
	<?php endif; ?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php lontano_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				if ( '' != get_the_post_thumbnail() ) {
					echo '<div class="entry-featuredImg"><a href="' . esc_url( get_permalink() ) . '"><div class="lontanoImage"></div>';
					the_post_thumbnail('lontano-normal-post');
					echo '</a></div>';
				}
			?>
			<?php if($showPost == 'excerpt'): ?>
				<?php $showShaded = get_theme_mod('lontano_theme_options_shadedtext', '1'); ?>
				<div class="lontano-excerpt <?php echo $showShaded == 1 ? 'withShade' : 'noShade' ?>">
					<?php the_excerpt(); ?>
				</div><!-- .lontano-excerpt -->
			<?php else: ?>
				<?php the_content(); ?>
			<?php endif; ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php if($showPost == 'excerpt'): ?>
				<span class="read-link">
					<a class="readMoreLink" href="<?php echo esc_url( get_permalink()); ?>"><?php esc_html_e('阅读全文', 'lontano'); ?><i class="fa fa-lg fa-angle-double-right spaceLeft"></i></a>
				</span>
			<?php endif; ?>
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'lontano' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link" style="margin-top: 1em; text-align: center; display: block;"><i class="fa fa-wrench spaceLeftRight"></i>',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php if ($showVerticalBar == 1):?>
	</div>
	<?php endif; ?>
</article><!-- #post-## -->
