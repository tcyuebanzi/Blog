<?php
/**
 * lontano Theme Customizer.
 *
 * @package lontano
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lontano_customize_preview_js() {
	wp_enqueue_script( 'lontano_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'lontano_customize_preview_js' );

 /**
 * Register Custom Settings
 */
function lontano_custom_settings_register( $wp_customize ) {
	
	/*
	Start Lontano Colors
	=====================================================
	*/
	
	$colors = array();
	
	$colors[] = array(
	'slug'=>'lontano_box_background_color', 
	'default' => '#ffffff',
	'label' => __('Box background color', 'lontano')
	);
	
	$colors[] = array(
	'slug'=>'lontano_sidebar_background_color', 
	'default' => '#f2f2f2',
	'label' => __('Sidebar background color', 'lontano')
	);
	
	$colors[] = array(
	'slug'=>'lontano_main_text_color', 
	'default' => '#4c4c4c',
	'label' => __('Main text color', 'lontano')
	);
	
	$colors[] = array(
	'slug'=>'lontano_sidebar_text_color', 
	'default' => '#7c7c7c',
	'label' => __('Sidebar text color', 'lontano')
	);
	
	$colors[] = array(
	'slug'=>'lontano_special_text_color', 
	'default' => '#75b17d',
	'label' => __('Link and special color', 'lontano')
	);
	
	$colors[] = array(
	'slug'=>'lontano_footer_background_color', 
	'default' => '#404040',
	'label' => __('Footer background color', 'lontano')
	);
	
	$colors[] = array(
	'slug'=>'lontano_footer_text_color', 
	'default' => '#adadad',
	'label' => __('Footer text color', 'lontano')
	);
	
	$colors[] = array(
	'slug'=>'lontano_footer_link_color', 
	'default' => '#eeeeee',
	'label' => __('Footer link color', 'lontano')
	);
	
	foreach( $colors as $lontano_theme_options ) {
		// SETTINGS
		$wp_customize->add_setting( 'lontano_theme_options[' . $lontano_theme_options['slug'] . ']', array(
			'default' => $lontano_theme_options['default'],
			'type' => 'option', 
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options'
		)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$lontano_theme_options['slug'], 
				array('label' => $lontano_theme_options['label'], 
				'section' => 'colors',
				'settings' =>'lontano_theme_options[' . $lontano_theme_options['slug'] . ']',
				)
			)
		);
	}
	
	/*
	Start Lontano Options
	=====================================================
	*/
	$wp_customize->add_section( 'cresta_lontano_options', array(
	     'title'    => esc_html__( 'Lontano Theme Options', 'lontano' ),
	     'priority' => 50,
	) );
	
	/*
	Show social on header
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_socialheader', array(
        'default'    => '',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'lontano_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('lontano_theme_options_socialheader', array(
        'label'      => __( 'Show Social Buttons on Header', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_socialheader',
        'type'       => 'checkbox',
    ) );
	
	/*
	Show social on footer
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_socialfooter', array(
        'default'    => '',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'lontano_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('lontano_theme_options_socialfooter', array(
        'label'      => __( 'Show Social Buttons on Footer', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_socialfooter',
        'type'       => 'checkbox',
    ) );
	
	/*
	Show search button
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_showsearch', array(
        'default'    => '',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'lontano_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('lontano_theme_options_showsearch', array(
        'label'      => __( 'Show search button', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_showsearch',
        'type'       => 'checkbox',
    ) );
	
	/*
	Show flash news
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_showflashnews', array(
        'default'    => '',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'lontano_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('lontano_theme_options_showflashnews', array(
        'label'      => __( 'Show flash news', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_showflashnews',
        'type'       => 'checkbox',
    ) );
	
	/*
	Flash news number of posts
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_flashnewsnumber', array(
        'default'    => '5',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint'
    ) );
	
	$wp_customize->add_control('lontano_theme_options_flashnewsnumber', array(
        'label'      => __( 'Flash News: number of posts to show', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_flashnewsnumber',
		'active_callback' => 'lontano_is_active',
        'type'       => 'number',
    ) );
	
	/*
	Flash news text
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_flashnewstext', array(
        'default'    => 'Flash News',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage'
    ) );
	
	$wp_customize->add_control('lontano_theme_options_flashnewstext', array(
        'label'      => __( 'Flash News: text to show', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_flashnewstext',
		'active_callback' => 'lontano_is_active',
        'type'       => 'text',
    ) );
	
	/*
	Social Icons
	=====================================================
	*/
	$socialmedia = array();
	
	$socialmedia[] = array(
	'slug'=>'facebookurl', 
	'default' => '',
	'label' => __('Facebook URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'twitterurl', 
	'default' => '',
	'label' => __('Twitter URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'googleplusurl', 
	'default' => '',
	'label' => __('Google Plus URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'linkedinurl', 
	'default' => '',
	'label' => __('Linkedin URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'instagramurl', 
	'default' => '',
	'label' => __('Instagram URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'youtubeurl', 
	'default' => '',
	'label' => __('YouTube URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'pinteresturl', 
	'default' => '',
	'label' => __('Pinterest URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'tumblrurl', 
	'default' => '',
	'label' => __('Tumblr URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'vkurl', 
	'default' => '',
	'label' => __('VK URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'wechaturl', 
	'default' => '',
	'label' => __('WeChat URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'weibourl', 
	'default' => '',
	'label' => __('Weibo URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'snapurl', 
	'default' => '',
	'label' => __('Snapchat URL', 'lontano')
	);
	$socialmedia[] = array(
	'slug'=>'okruurl', 
	'default' => '',
	'label' => __('OK.ru URL', 'lontano')
	);
	
	foreach( $socialmedia as $lontano_theme_options ) {
		// SETTINGS
		$wp_customize->add_setting(
			'lontano_theme_options_' . $lontano_theme_options['slug'], array(
				'default' => $lontano_theme_options['default'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
				'type'     => 'theme_mod',
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			$lontano_theme_options['slug'], 
			array('label' => $lontano_theme_options['label'], 
			'section'    => 'cresta_lontano_options',
			'settings' =>'lontano_theme_options_' . $lontano_theme_options['slug'],
			'active_callback' => 'lontano_is_social_active',
			)
		);
	}
	
	/*
	Show full post or excerpt
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_postshow', array(
        'default'    => 'excerpt',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'lontano_sanitize_select',
    ) );
	
	$wp_customize->add_control('lontano_theme_options_postshow', array(
        'label'      => __( 'Post show', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_postshow',
        'type'       => 'select',
		'choices' => array(
			'full' => __( 'Show full post', 'lontano'),
			'excerpt' => __( 'Show excerpt', 'lontano'),
		),
    ) );
	
	/*
	Show shaded text
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_shadedtext', array(
        'default'    => '1',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'lontano_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('lontano_theme_options_shadedtext', array(
        'label'      => __( 'Show shaded text', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_shadedtext',
        'type'       => 'checkbox',
		'active_callback' => 'lontano_is_excerpt_active',
    ) );
	
	/*
	Show vertical bar
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_verticalbar', array(
        'default'    => '1',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'lontano_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('lontano_theme_options_verticalbar', array(
        'label'      => __( 'Show vertical bar', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_verticalbar',
        'type'       => 'checkbox',
    ) );
	
	/*
	Add link on featured images
	=====================================================
	*/
	$wp_customize->add_setting('lontano_theme_options_linkfeatured', array(
        'default'    => '',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'lontano_sanitize_checkbox'
    ) );
	
	$wp_customize->add_control('lontano_theme_options_linkfeatured', array(
        'label'      => __( 'Add link on featured images', 'lontano' ),
        'section'    => 'cresta_lontano_options',
        'settings'   => 'lontano_theme_options_linkfeatured',
        'type'       => 'checkbox',
    ) );
	
	/*
	Upgrade to PRO
	=====================================================
	*/
    class Lontano_Customize_Upgrade_Control extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="lontano-upgrade-title">
        		<span class="customize-control-title">
					<h3 style="text-align:center;"><div class="dashicons dashicons-megaphone"></div> <?php esc_html_e('Get Lontano PRO WP Theme for only', 'lontano'); ?> 29,90&euro;</h3>
        		</span>
        	</p>
			<p style="text-align:center;" class="lontano-upgrade-button">
				<a style="margin: 10px;" target="_blank" href="http://crestaproject.com/demo/lontano-pro/" class="button button-secondary">
					<?php esc_html_e('Watch the demo', 'lontano'); ?>
				</a>
				<a style="margin: 10px;" target="_blank" href="https://crestaproject.com/downloads/lontano/" class="button button-secondary">
					<?php esc_html_e('Get Lontano PRO Theme', 'lontano'); ?>
				</a>
			</p>
			<ul>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Advanced Theme Options', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Font switcher', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Loading Page', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Unlimited Colors and Skin', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Manage Sidebar Position', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Posts Slider', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Footer Slider', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('WooCommerce CSS Style', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Footer Widgets', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Breadcrumb', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Stick menu', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Sticky sidebar', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Post views counter', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Post formats (Audio, Video, Gallery)', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('7 Shortcodes', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('10 Exclusive Widgets', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Related Posts Box', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('Information About Author Box', 'lontano'); ?></b></li>
				<li><div class="dashicons dashicons-yes" style="color: #1fa67a;"></div><b><?php esc_html_e('And much more...', 'lontano'); ?></b></li>
			<ul><?php
        }
    }
	
	$wp_customize->add_section( 'cresta_upgrade_pro', array(
	     'title'    => esc_html__( 'More features? Upgrade to PRO', 'lontano' ),
	     'priority' => 999,
	));
	
	$wp_customize->add_setting('lontano_section_upgrade_pro', array(
		'default' => '',
		'type' => 'option',
		'sanitize_callback' => 'esc_attr'
	));
	
	$wp_customize->add_control(new Lontano_Customize_Upgrade_Control($wp_customize, 'lontano_section_upgrade_pro', array(
		'section' => 'cresta_upgrade_pro',
		'settings' => 'lontano_section_upgrade_pro',
	)));
	
}
add_action( 'customize_register', 'lontano_custom_settings_register' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lontano_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'lontano_theme_options_flashnewstext' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'lontano_customize_register' );

function lontano_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

function lontano_is_social_active() {
	$showHeader = get_theme_mod('lontano_theme_options_socialheader', '');
	$showFooter = get_theme_mod('lontano_theme_options_socialfooter', '');
	if ($showHeader != 1 && $showFooter != 1) {
		return false;
	}
	return true;
}

function lontano_is_excerpt_active() {
	$showExcerpt = get_theme_mod('lontano_theme_options_postshow', 'excerpt');
	if ($showExcerpt == 'excerpt') {
		return true;
	}
	return false;
}

function lontano_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function lontano_is_active() {
	$showFlash = get_theme_mod('lontano_theme_options_showflashnews', '');
	if ($showFlash == 1) {
		return true;
	}
	return false;
}

/**
 * Add Custom CSS to Header 
 */
function lontano_custom_css_styles() {
	global $lontano_theme_options;
	$se_options = get_option( 'lontano_theme_options', $lontano_theme_options );
	if( isset( $se_options[ 'lontano_box_background_color' ] ) ) {
		$lontano_box_background_color = $se_options['lontano_box_background_color'];
	}
	if( isset( $se_options[ 'lontano_sidebar_background_color' ] ) ) {
		$lontano_sidebar_background_color = $se_options['lontano_sidebar_background_color'];
	}
	if( isset( $se_options[ 'lontano_main_text_color' ] ) ) {
		$lontano_main_text_color = $se_options['lontano_main_text_color'];
	}
	if( isset( $se_options[ 'lontano_sidebar_text_color' ] ) ) {
		$lontano_sidebar_text_color = $se_options['lontano_sidebar_text_color'];
	}
	if( isset( $se_options[ 'lontano_special_text_color' ] ) ) {
		$lontano_special_text_color = $se_options['lontano_special_text_color'];
	}
	if( isset( $se_options[ 'lontano_footer_background_color' ] ) ) {
		$lontano_footer_background_color = $se_options['lontano_footer_background_color'];
	}
	if( isset( $se_options[ 'lontano_footer_text_color' ] ) ) {
		$lontano_footer_text_color = $se_options['lontano_footer_text_color'];
	}
	if( isset( $se_options[ 'lontano_footer_link_color' ] ) ) {
		$lontano_footer_link_color = $se_options['lontano_footer_link_color'];
	}
	?>
	<style type="text/css">
		<?php if (!empty($lontano_box_background_color) ) : ?>
			<?php list($r, $g, $b) = sscanf($lontano_box_background_color, '#%02x%02x%02x'); ?>
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.site-branding a,
			.site-branding .site-title a:hover,
			.site-branding .site-title a:focus,
			.site-branding .site-title a.focus,
			.main-navigation ul ul a,
			.main-navigation div > ul.nav-menu > li:hover > a,
			.main-navigation div > ul.nav-menu > li:active > a,
			.main-navigation div > ul.nav-menu > li:focus > a,
			.main-navigation div > ul.nav-menu > li.focus > a,
			.main-navigation div ul li.current-menu-item > a, 
			.main-navigation div ul li.current-menu-parent > a, 
			.main-navigation div ul li.current-page-ancestor > a,
			.main-navigation div .current_page_item > a, 
			.main-navigation div .current_page_parent > a,
			.site-main .navigation.pagination .nav-links a,
			.page-links a,
			#wp-calendar > caption,
			.site-description,
			.read-link a:hover,
			.read-link a:focus,
			.read-link a.focus,
			.more-link:hover,
			.more-link:focus,
			.more-link.focus,
			.tagcloud a:hover,
			.tagcloud a:focus,
			.tagcloud a.focus,
			.tags-links a:hover,
			.tags-links a:focus,
			.tags-links a.focus,
			#toTop {
				color: <?php echo esc_html($lontano_box_background_color); ?>;
			}
			button:hover,
			input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			button:focus,
			input[type="button"]:focus,
			input[type="reset"]:focus,
			input[type="submit"]:focus,
			button:active,
			input[type="button"]:active,
			input[type="reset"]:active,
			input[type="submit"]:active,
			input[type="text"],
			input[type="email"],
			input[type="url"],
			input[type="password"],
			input[type="search"],
			input[type="number"],
			input[type="tel"],
			input[type="range"],
			input[type="date"],
			input[type="month"],
			input[type="week"],
			input[type="time"],
			input[type="datetime"],
			input[type="datetime-local"],
			input[type="color"],
			textarea,
			select,
			.site-content,
			header.site-header,
			.socialLine a:hover,
			.socialLine a:focus,
			.socialLine a.focus,
			.site-main .navigation.pagination .nav-links a:hover,
			.site-main .navigation.pagination .nav-links a:focus,
			.site-main .navigation.pagination .nav-links a.focus,
			.page-links a:hover,
			.page-links a:focus,
			.page-links a.focus,
			.entry-meta > span,
			h3.widget-title:after,
			.main-search-box,
			.main-social-box,
			.flashNews {
				background: <?php echo esc_html($lontano_box_background_color); ?>;
			}
			.lontanoImage:before {
				border: 1px solid <?php echo esc_html($lontano_box_background_color); ?>;
			}
			.lontano-excerpt:after {
				background: -moz-linear-gradient(top,  rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0) 0%, rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,1) 100%);
				background: -webkit-linear-gradient(top,  rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0) 0%,rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,1) 100%);
				background: linear-gradient(to bottom,  rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0) 0%,rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,1) 100%);
			}
			@media all and (max-width: 1024px) {
				.main-navigation.toggled button,
				.main-navigation button:hover,
				.main-navigation button:focus,
				.main-navigation button.focus,
				.main-navigation button:active,
				.menu-toggle {
					color: <?php echo esc_html($lontano_box_background_color); ?>;
				}
			}
		<?php endif; ?>
		<?php if (!empty($lontano_sidebar_background_color) ) : ?>
			#search-full,
			.content-area:before,
			.widget-area,
			header.page-header,
			.wp-caption .wp-caption-text,
			.socialLine {
				background: <?php echo esc_html($lontano_sidebar_background_color); ?>;
			}
		<?php endif; ?>
		<?php if (!empty($lontano_main_text_color) ) : ?>
			<?php list($r, $g, $b) = sscanf($lontano_main_text_color, '#%02x%02x%02x'); ?>
			body,
			button,
			input,
			select,
			textarea,
			a:hover,
			a:focus,
			a:active {
				color: <?php echo esc_html($lontano_main_text_color); ?>;
			}
			.site-main .navigation.pagination .nav-links .current,
			.page-links > .page-links-number {
				border: 1px solid <?php echo esc_html($lontano_main_text_color); ?>;
			}
			hr,
			.post-navigation .nav-previous:after,
			.posts-navigation .nav-previous:after,
			.comment-navigation .nav-previous:after,
			#wp-calendar th,
			.hentry:after,
			.site-main .post-navigation:after,
			.site-main .posts-navigation:after,
			.site-main .comment-navigation:after,
			.site-main .navigation.pagination:after,
			.lontano-bar:before {
				background: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
			}
			input[type="text"],
			input[type="email"],
			input[type="url"],
			input[type="password"],
			input[type="search"],
			input[type="number"],
			input[type="tel"],
			input[type="range"],
			input[type="date"],
			input[type="month"],
			input[type="week"],
			input[type="time"],
			input[type="datetime"],
			input[type="datetime-local"],
			input[type="color"],
			textarea,
			select,
			#wp-calendar tbody td {
				border: 1px solid rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
			}
			.main-navigation,
			#search-full,
			aside ul li,
			#comments ol .pingback,
			#comments ol article,
			.main-search-box,
			.main-social-box,
			.flashNews {
				border-bottom: 1px solid rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
			}
			.entry-meta:before {
				border-top: 4px double rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
			}
			.flashNews.withAll,
			.flashNews.withHalf,
			.main-social-box.withS {
				border-left: 1px solid rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
			}
			aside ul.menu li a,
			aside ul.menu .indicatorBar {
				border-color: rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
			}
			#page {
				-webkit-box-shadow: 0px 1px 3px 0px rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
				-moz-box-shadow: 0px 1px 3px 0px rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
				box-shadow: 0px 1px 3px 0px rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
			}
			@media all and (max-width: 1024px) {
				.main-navigation a {
					border-bottom: 1px solid rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
				}
				.main-navigation ul li .indicator {
					border-left: 1px solid rgba(<?php echo esc_html($r).', '.esc_html($g).', '.esc_html($b); ?>,0.2);
				}
			}
		<?php endif; ?>
		<?php if (!empty($lontano_sidebar_text_color) ) : ?>
			.widget-area,
			header.page-header,
			.wp-caption .wp-caption-text {
				color: <?php echo esc_html($lontano_sidebar_text_color); ?>;
			}
		<?php endif; ?>
		<?php if (!empty($lontano_special_text_color) ) : ?>
			blockquote::before,
			button:hover,
			input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			button:focus,
			input[type="button"]:focus,
			input[type="reset"]:focus,
			input[type="submit"]:focus,
			button:active,
			input[type="button"]:active,
			input[type="reset"]:active,
			input[type="submit"]:active,
			a,
			.main-navigation a,
			.socialLine a:hover,
			.socialLine a:focus,
			.socialLine a.focus,
			.site-main .navigation.pagination .nav-links a:hover,
			.site-main .navigation.pagination .nav-links a:focus,
			.site-main .navigation.pagination .nav-links a.focus,
			.page-links a:hover,
			.page-links a:focus,
			.page-links a.focus,
			.main-search-box,
			.main-social-box {
				color: <?php echo esc_html($lontano_special_text_color); ?>;
			}
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.main-navigation div > ul.nav-menu > li:before,
			.read-link a:before,
			.more-link:before,
			.tagcloud a:before,
			.tags-links a:before,
			.main-navigation ul ul a,
			.main-navigation div ul li.current-menu-item > a, 
			.main-navigation div ul li.current-menu-parent > a, 
			.main-navigation div ul li.current-page-ancestor > a,
			.main-navigation div .current_page_item > a, 
			.main-navigation div .current_page_parent > a,
			.site-main .navigation.pagination .nav-links a,
			.page-links a,
			#wp-calendar > caption,
			.site-branding,
			.entry-featuredImg,
			.read-link a:hover,
			.read-link a:focus,
			.read-link a.focus,
			.more-link:hover,
			.more-link:focus,
			.more-link.focus,
			.tagcloud a:hover,
			.tagcloud a:focus,
			.tagcloud a.focus,
			.tags-links a:hover,
			.tags-links a:focus,
			.tags-links a.focus,
			#toTop,
			.lontano-bar:after,
			h3.widget-title:before {
				background: <?php echo esc_html($lontano_special_text_color); ?>;
			}
			blockquote {
				border-left: 4px solid <?php echo esc_html($lontano_special_text_color); ?>;
				border-right: 1px solid <?php echo esc_html($lontano_special_text_color); ?>;
			}
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			input[type="text"]:focus,
			input[type="email"]:focus,
			input[type="url"]:focus,
			input[type="password"]:focus,
			input[type="search"]:focus,
			input[type="number"]:focus,
			input[type="tel"]:focus,
			input[type="range"]:focus,
			input[type="date"]:focus,
			input[type="month"]:focus,
			input[type="week"]:focus,
			input[type="time"]:focus,
			input[type="datetime"]:focus,
			input[type="datetime-local"]:focus,
			input[type="color"]:focus,
			textarea:focus,
			select:focus,
			.site-main .navigation.pagination .nav-links a,
			.page-links a,
			#wp-calendar tbody td#today,
			.read-link a,
			.more-link,
			.tagcloud a,
			.tags-links a {
				border: 1px solid <?php echo esc_html($lontano_special_text_color); ?>;
			}
			.main-navigation div > ul > li > ul::before,
			.main-navigation div > ul > li > ul::after {
				border-bottom-color: <?php echo esc_html($lontano_special_text_color); ?>;
			}
			@media all and (max-width: 1024px) {
				.main-navigation.toggled button,
				.main-navigation button:hover,
				.main-navigation button:focus,
				.main-navigation button.focus,
				.main-navigation button:active {
					background: <?php echo esc_html($lontano_special_text_color); ?>;
				}
				.main-navigation.toggled .nav-menu {
					border: 2px solid <?php echo esc_html($lontano_special_text_color); ?>;
				}
				.main-navigation ul li .indicator {
					color: <?php echo esc_html($lontano_special_text_color); ?>;
				}
				.main-navigation div > ul.nav-menu > li:hover > a,
				.main-navigation div > ul.nav-menu > li:active > a,
				.main-navigation div > ul.nav-menu > li:focus > a,
				.main-navigation div > ul.nav-menu > li.focus > a,
				.main-navigation ul ul a,
				.main-navigation div ul li.current-menu-item > a, 
				.main-navigation div ul li.current-menu-parent > a, 
				.main-navigation div ul li.current-page-ancestor > a,
				.main-navigation div .current_page_item > a, 
				.main-navigation div .current_page_parent > a {
					color: <?php echo esc_html($lontano_special_text_color); ?> !important;
				}
			}
		<?php endif; ?>
		<?php if (!empty($lontano_footer_background_color) ) : ?>
			footer.site-footer {
				background: <?php echo esc_html($lontano_footer_background_color); ?>;
			}
		<?php endif; ?>
		<?php if (!empty($lontano_footer_text_color) ) : ?>
			footer.site-footer {
				color: <?php echo esc_html($lontano_footer_text_color); ?>;
			}
		<?php endif; ?>
		<?php if (!empty($lontano_footer_link_color) ) : ?>
			footer.site-footer a,
			footer.site-footer a:hover,
			footer.site-footer a:focus,
			footer.site-footer a.focus {
				color: <?php echo esc_html($lontano_footer_link_color); ?>;
			}
		<?php endif; ?>	
	</style>
	<?php
}
add_action('wp_head', 'lontano_custom_css_styles');