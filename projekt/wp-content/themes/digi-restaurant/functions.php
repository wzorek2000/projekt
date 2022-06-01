<?php
/**
 * Digi Restaurant functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Digi Restaurant
 */

function digi_restaurant_enqueue_styles() {
    wp_enqueue_style('digi-restaurant-font', digi_restaurant_font_url(), array());
    $parentcss = 'restaurant-zone-style';
    $theme = wp_get_theme(); wp_enqueue_style( $parentcss, get_template_directory_uri() . '/style.css', array(), $theme->parent()->get('Version'));
    wp_enqueue_style( 'digi-restaurant-style', get_stylesheet_uri(), array( $parentcss ), $theme->get('Version'));

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'digi_restaurant_enqueue_styles' );

function digi_restaurant_admin_scripts() {
    // demo CSS
    wp_enqueue_style( 'digi-restaurant-demo-css', get_theme_file_uri( 'assets/css/demo.css' ) );
}
add_action( 'admin_enqueue_scripts', 'digi_restaurant_admin_scripts' );

function digi_restaurant_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

function digi_restaurant_theme_color() {

    $theme_color_css = '';
    $restaurant_zone_theme_color = get_theme_mod('restaurant_zone_theme_color');
    $restaurant_zone_theme_color_2 = get_theme_mod('restaurant_zone_theme_color_2');
    $restaurant_zone_preloader_bg_color = get_theme_mod('restaurant_zone_preloader_bg_color');
    $restaurant_zone_preloader_dot_1_color = get_theme_mod('restaurant_zone_preloader_dot_1_color');
    $restaurant_zone_preloader_dot_2_color = get_theme_mod('restaurant_zone_preloader_dot_2_color');

    if(get_theme_mod('restaurant_zone_preloader_bg_color') == '') {
            $restaurant_zone_preloader_bg_color = '#000';
        }
        if(get_theme_mod('restaurant_zone_preloader_dot_1_color') == '') {
            $restaurant_zone_preloader_dot_1_color = '#fff';
        }
        if(get_theme_mod('restaurant_zone_preloader_dot_2_color') == '') {
            $restaurant_zone_preloader_dot_2_color = '#d26e2b';
        }

    $theme_color_css = '
        .sidebar input[type="submit"],.sidebar button[type="submit"],#button,.sticky .entry-title::before,.comment-respond input#submit,.main-navigation .menu > li > a:hover,.main-navigation .sub-menu,.btn-primary,.sidebar .tagcloud a:hover,.woocommerce ul.products li.product .onsale, .woocommerce span.onsale,.woocommerce .woocommerce-ordering select,.pro-button a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.reservation-btn a,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover,.toggle-nav button,.top-inner-btn a:hover{
            background: '.esc_attr($restaurant_zone_theme_color).';
         }
         p.price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price,.sidebar p a, .entry-content a, .entry-summary a, .comment-content a,.navbar-brand p,#colophon a:hover, #colophon a:focus,.sidebar a:hover,.woocommerce-message::before, .woocommerce-info::before,.top-info i,.widget a:hover, .widget a:focus,.top-inner h2,.welcome-box h2,.woocommerce .star-rating span::before,.top-info p, .social-link a{
            color: '.esc_attr($restaurant_zone_theme_color).';
         }
         h3.entry-title a:hover{
            color: '.esc_attr($restaurant_zone_theme_color).'!important;
         }
         .woocommerce-message, .woocommerce-info,.wp-block-quote, .wp-block-quote:not(.is-large):not(.is-style-large), .wp-block-pullquote,
            .post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover{
            border-color: '.esc_attr($restaurant_zone_theme_color).'!important;
         }
        .socialmedia,.reservation-btn a:hover,.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover {
            background: '.esc_attr($restaurant_zone_theme_color_2).';
         }
         .stick_header{
            background: '.esc_attr($restaurant_zone_theme_color_2).'!important;
         }
        .loading{
            background-color: '.esc_attr($restaurant_zone_preloader_bg_color).';
         }
         @keyframes loading {
          0%,
          100% {
            transform: translatey(-2.5rem);
            background-color: '.esc_attr($restaurant_zone_preloader_dot_1_color).';
          }
          50% {
            transform: translatey(2.5rem);
            background-color: '.esc_attr($restaurant_zone_preloader_dot_2_color).';
          }
        }
    ';
    wp_add_inline_style( 'digi-restaurant-style',$theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'digi_restaurant_theme_color' );

function digi_restaurant_customize_register($wp_customize){

    // Banner Section
    $wp_customize->add_section( 'digi_restaurant_top_image_section' , array(
        'title'      => __( 'Banner Settings', 'digi-restaurant' ),
        'priority'   => null
    ) );

    $wp_customize->add_setting('digi_restaurant_top_section_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('digi_restaurant_top_section_heading',array(
        'label' => esc_html__('Section Title','digi-restaurant'),
        'section' => 'digi_restaurant_top_image_section',
        'setting' => 'digi_restaurant_top_section_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('digi_restaurant_top_section_content',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('digi_restaurant_top_section_content',array(
        'label' => esc_html__('Section Content','digi-restaurant'),
        'section' => 'digi_restaurant_top_image_section',
        'setting' => 'digi_restaurant_top_section_content',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('digi_restaurant_top_section_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('digi_restaurant_top_section_text',array(
        'label' => esc_html__('Button Text','digi-restaurant'),
        'section' => 'digi_restaurant_top_image_section',
        'setting' => 'digi_restaurant_top_section_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('digi_restaurant_top_section_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('digi_restaurant_top_section_url',array(
        'label' => esc_html__('Button URL','digi-restaurant'),
        'section' => 'digi_restaurant_top_image_section',
        'setting' => 'digi_restaurant_top_section_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('digi_restaurant_image_one', array(
        'transport'         => 'refresh',
        'height'         => 325,
        'sanitize_callback' => 'esc_url_raw'
    ));    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'digi_restaurant_image_one', array(
        'label'             => esc_html__('Image #1', 'digi-restaurant'),
        'section'           => 'digi_restaurant_top_image_section',
        'settings'          => 'digi_restaurant_image_one',    
    )));

    $wp_customize->add_setting('digi_restaurant_image_two', array(
        'transport'         => 'refresh',
        'height'         => 325,
        'sanitize_callback' => 'esc_url_raw'
    ));    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'digi_restaurant_image_two', array(
        'label'             => esc_html__('Image #2', 'digi-restaurant'),
        'section'           => 'digi_restaurant_top_image_section',
        'settings'          => 'digi_restaurant_image_two',    
    )));

    $wp_customize->add_setting('digi_restaurant_image_three', array(
        'transport'         => 'refresh',
        'height'         => 325,
        'sanitize_callback' => 'esc_url_raw'
    ));    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'digi_restaurant_image_three', array(
        'label'             => esc_html__('Image #3', 'digi-restaurant'),
        'section'           => 'digi_restaurant_top_image_section',
        'settings'          => 'digi_restaurant_image_three',    
    )));

    $wp_customize->add_setting('digi_restaurant_image_four', array(
        'transport'         => 'refresh',
        'height'         => 325,
        'sanitize_callback' => 'esc_url_raw'
    ));    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'digi_restaurant_image_four', array(
        'label'             => esc_html__('Image #4', 'digi-restaurant'),
        'section'           => 'digi_restaurant_top_image_section',
        'settings'          => 'digi_restaurant_image_four',    
    )));

    // Welcome Section
    $wp_customize->add_section( 'digi_restaurant_welcome_section' , array(
        'title'      => esc_html__( 'Welcome Section Settings', 'digi-restaurant' ),
        'priority'   => null
    ) );

    $wp_customize->add_setting('digi_restaurant_welcome_section_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('digi_restaurant_welcome_section_heading',array(
        'label' => esc_html__('Section Heading','digi-restaurant'),
        'section' => 'digi_restaurant_welcome_section',
        'setting' => 'digi_restaurant_welcome_section_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting( 'digi_restaurant_welcome_page', array(
        'default'           => '',
        'sanitize_callback' => 'restaurant_zone_sanitize_dropdown_pages'
    ) );
    $wp_customize->add_control( 'digi_restaurant_welcome_page', array(
        'label'    => esc_html__( 'Select Page', 'digi-restaurant' ),
        'section'  => 'digi_restaurant_welcome_section',
        'type'     => 'dropdown-pages'
    ) );
}
add_action('customize_register', 'digi_restaurant_customize_register');

if ( ! function_exists( 'digi_restaurant_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function digi_restaurant_setup() {

        add_theme_support( 'responsive-embeds' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        add_image_size('digi-restaurant-featured-header-image', 2000, 660, true);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'restaurant_zone_custom_background_args', array(
            'default-color' => '',
            'default-image' => '',
        ) ) );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 50,
            'flex-width'  => true,
        ) );

        add_editor_style( array( '/editor-style.css' ) );

        add_theme_support( 'align-wide' );

        add_theme_support( 'wp-block-styles' );
    }
endif;
add_action( 'after_setup_theme', 'digi_restaurant_setup' );

function digi_restaurant_font_url(){
    $font_url = '';
    $lobster = _x('on','Berkshire Swash:on or off','digi-restaurant');
    
    if('off' !== $lobster ){
        $font_family = array();
        if('off' !== $lobster){
            $font_family[] = 'Berkshire Swash';
        }
        $query_args = array(
            'family'    => urlencode(implode('|',$font_family)),
        );
        $font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
    }
    return $font_url;
}

function digi_restaurant_remove_customize_register() {
    global $wp_customize;
    $wp_customize->remove_section( 'restaurant_zone_top_slider' );
    $wp_customize->remove_section( 'restaurant_zone_menu_items_section' ); 
}

add_action( 'customize_register', 'digi_restaurant_remove_customize_register', 11 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function digi_restaurant_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'digi-restaurant' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'digi-restaurant' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'digi-restaurant' ),
        'id'            => 'restaurant-zone-footer1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="footer-column-widget-title">',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'digi-restaurant' ),
        'id'            => 'restaurant-zone-footer2',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="footer-column-widget-title">',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 3', 'digi-restaurant' ),
        'id'            => 'restaurant-zone-footer3',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="footer-column-widget-title">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'digi_restaurant_widgets_init' );

if ( ! defined( 'RESTAURANT_ZONE_CONTACT_SUPPORT' ) ) {
    define('RESTAURANT_ZONE_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/digi-restaurant','digi-restaurant'));
}
if ( ! defined( 'RESTAURANT_ZONE_REVIEW' ) ) {
    define('RESTAURANT_ZONE_REVIEW',__('https://wordpress.org/support/theme/digi-restaurant/reviews/#new-post','digi-restaurant'));
}