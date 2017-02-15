<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lontano
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
	$socialHeader = get_theme_mod('lontano_theme_options_socialheader', '');
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
	$showSearch = get_theme_mod('lontano_theme_options_showsearch', '');
	$showNews = get_theme_mod('lontano_theme_options_showflashnews', '');
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lontano' ); ?></a>
	<div class="lontanoTop">
		<?php if($showSearch == 1): ?>
			<div class="main-search-box"><i class="fa fa-search"></i></div>
		<?php endif; ?>
		<?php if($socialHeader == 1): ?>
			<div class="main-social-box"><i class="fa fa-share-alt"></i></div>
		<?php endif; ?>
		<?php if($showNews == 1): ?>
			<?php $newsTitle = get_theme_mod('lontano_theme_options_flashnewstext', 'Flash News'); ?>
			<div class="flashNews">
				<strong><?php echo esc_html($newsTitle); ?></strong>
				<ul id="lontanoFlash">
					<?php
					$number_post = get_theme_mod('lontano_theme_options_flashnewsnumber', '5');
					$args = array( 'posts_per_page' => intval($number_post), 'post_status'=>'publish', 'post_type'=>'post', 'orderby'=>'date', 'ignore_sticky_posts' => true );
					$myposts = new WP_Query( $args );
					if ( $myposts->have_posts() ) :
					while( $myposts->have_posts() ) : $myposts->the_post();
					?>
					<li>
						<a title="<?php the_time(get_option('date_format')); ?>" href="<?php esc_url(the_permalink()); ?>"><?php echo wp_trim_words( get_the_title(), 4 ); ?></a>
						<span class="theFlashDate"><i class="fa fa-angle-double-right spaceLeftRight"></i><?php echo wp_trim_words( get_the_content() , '25' ); ?></span>
					</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</ul>
			</div><!-- .flashNews -->
		<?php endif; ?>
	</div>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<div class="lontano-table">
				<div class="lontano-brand">
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
					endif; ?>
				</div><!-- .lontano-brand -->
			</div><!-- .lontano-table -->
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars spaceLeftRight"></i></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<?php if($showSearch == 1): ?>
		<!-- Start: Search Form -->
		<div id="search-full">
			<div class="search-container">
				<form role="search" method="get" id="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
					<label>
						<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'lontano' ); ?></span>
						<input type="search" name="s" id="search-field" placeholder="<?php esc_attr_e('Type here and hit enter...', 'lontano'); ?>">
					</label>
				</form>
			</div>
		</div>
		<!-- End: Search Form -->
	<?php endif; ?>
	<?php if($socialHeader == 1): ?>
		<div class="socialLine">
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
		</div>
	<?php endif; ?>
	<div id="content" class="site-content">
