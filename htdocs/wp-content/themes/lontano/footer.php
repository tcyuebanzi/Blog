<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lontano
 */

?>
<?php 
	$socialFooter = get_theme_mod('lontano_theme_options_socialfooter', '');
	$facebookURL = get_theme_mod('lontano_theme_options_facebookurl', '');
	$twitterURL = get_theme_mod('lontano_theme_options_twitterurl', '');
	$googleplusURL = get_theme_mod('lontano_theme_options_googleplusurl', '');
	$linkedinURL = get_theme_mod('lontano_theme_options_linkedinurl', '');
	$instagramURL = get_theme_mod('lontano_theme_options_instagramurl', '');
	$youtubeURL = get_theme_mod('lontano_theme_options_youtubeurl', '');
	$pinterestURL = get_theme_mod('lontano_theme_options_pinteresturl', '');
	$tumblrURL = get_theme_mod('lontano_theme_options_tumblrurl', '');
	$vkURL = get_theme_mod('lontano_theme_options_vkurl', '');
	$wechatURL = get_theme_mod('lontano_theme_options_wechaturl', '');
	$weiboURL = get_theme_mod('lontano_theme_options_weibourl', '');
	$snapURL = get_theme_mod('lontano_theme_options_snapurl', '');
	$okruURL = get_theme_mod('lontano_theme_options_okruurl', '');
?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if($socialFooter == 1): ?>
			<div class="socialLineFooter">
				<?php if (!empty($facebookURL)) : ?>
					<a href="<?php echo esc_url($facebookURL); ?>" title="<?php esc_attr_e( 'Facebook', 'lontano' ); ?>"><i class="fa fa-facebook spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($twitterURL)) : ?>
					<a href="<?php echo esc_url($twitterURL); ?>" title="<?php esc_attr_e( 'Twitter', 'lontano' ); ?>"><i class="fa fa-twitter spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($googleplusURL)) : ?>
					<a href="<?php echo esc_url($googleplusURL); ?>" title="<?php esc_attr_e( 'Google Plus', 'lontano' ); ?>"><i class="fa fa-google-plus spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Google Plus', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($linkedinURL)) : ?>
					<a href="<?php echo esc_url($linkedinURL); ?>" title="<?php esc_attr_e( 'Linkedin', 'lontano' ); ?>"><i class="fa fa-linkedin spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Linkedin', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($instagramURL)) : ?>
					<a href="<?php echo esc_url($instagramURL); ?>" title="<?php esc_attr_e( 'Instagram', 'lontano' ); ?>"><i class="fa fa-instagram spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($youtubeURL)) : ?>
					<a href="<?php echo esc_url($youtubeURL); ?>" title="<?php esc_attr_e( 'YouTube', 'lontano' ); ?>"><i class="fa fa-youtube spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'YouTube', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($pinterestURL)) : ?>
					<a href="<?php echo esc_url($pinterestURL); ?>" title="<?php esc_attr_e( 'Pinterest', 'lontano' ); ?>"><i class="fa fa-pinterest spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Pinterest', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($tumblrURL)) : ?>
					<a href="<?php echo esc_url($tumblrURL); ?>" title="<?php esc_attr_e( 'Tumblr', 'lontano' ); ?>"><i class="fa fa-tumblr spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Tumblr', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($vkURL)) : ?>
					<a href="<?php echo esc_url($vkURL); ?>" title="<?php esc_attr_e( 'VK', 'lontano' ); ?>"><i class="fa fa-vk spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'VK', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($wechatURL)) : ?>
				<a href="<?php echo esc_url($wechatURL); ?>" title="<?php esc_attr_e( 'WeChat', 'lontano' ); ?>"><i class="fa fa-weixin spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'WeChat', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($weiboURL)) : ?>
					<a href="<?php echo esc_url($weiboURL); ?>" title="<?php esc_attr_e( 'Weibo', 'lontano' ); ?>"><i class="fa fa-weibo spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Weibo', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($snapURL)) : ?>
					<a href="<?php echo esc_url($snapURL); ?>" title="<?php esc_attr_e( 'Snapchat', 'lontano' ); ?>"><i class="fa fa-snapchat spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'Snapchat', 'lontano' ); ?></span></i></a>
				<?php endif; ?>
				<?php if (!empty($okruURL)) : ?>
				<a href="<?php echo esc_url($okruURL); ?>" title="<?php esc_attr_e( 'OK.ru', 'lontano' ); ?>"><i class="fa fa-odnoklassniki  spaceLeftRight"><span class="screen-reader-text"><?php esc_html_e( 'OK.ru', 'lontano' ); ?></span></i></a>
			<?php endif; ?>
			</div><!-- .socialLineFooter -->
		<?php endif; ?>
		<div class="site-info">
<a href="http://www.yuebanzi.xin">&#x738B;&#x6625;&#x6656;&#x7684;&#x4E2A;&#x4EBA;&#x535A;&#x5BA2; &nbsp; &nbsp; &nbsp; </a>
<span style="font-family:'ËÎÌו',font-size:15px">&#67;&#111;&#112;&#121;&#114;&#105;&#103;&#104;&#116;&#169;&#50;&#48;&#49;&#54;&#45;&#50;&#48;&#49;&#55;</span>
			<span style="font-family:'ËÎÌו',font-size:15px"> &nbsp; &nbsp; &nbsp; &#x4EAC;ICP&#x5907;16053468&#x53F7;-1</span>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<a href="#top" id="toTop"><i class="fa fa-angle-up fa-lg"></i></a>
<?php wp_footer(); ?>

</body>
</html>
