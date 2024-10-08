<?php
/**
 * woocomerce_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package woocomerce_theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function woocomerce_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on woocomerce_theme, use a find and replace
		* to change 'woocomerce_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'woocomerce_theme', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'woocomerce_theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'woocomerce_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'woocomerce_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function woocomerce_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'woocomerce_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'woocomerce_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function woocomerce_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'woocomerce_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'woocomerce_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'woocomerce_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function woocomerce_theme_scripts() {
	wp_enqueue_style( 'woocomerce_theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'woocomerce_theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'woocomerce_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_style('bootstrap.css', get_template_directory_uri() . '/css/style.css', array(), '5.0.1', 'all');
	wp_enqueue_style('bootstrap.icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css', array(), '1.11.2', 'all');
	wp_enqueue_script( 'bootstrap.js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', 'jquery', '5.0.2', true );
	//font
	wp_enqueue_script('font.sansource', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,600&display=swap', array(), '1.0.1', false);
	wp_enqueue_script('font.nunito', 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap', array(), '1.0.2', false);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'woocomerce_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> – <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

add_theme_support( 'woocommerce' );

//hook: woocommerce_archive_description
function woocommerce_taxonomy_archive_description() {
	echo "this is shop page";
}

add_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

//hook: woocommerce_before_shop_loop
function notices() {
	?>
		<strong>notification</strong>
	<?php
}

add_action( 'woocommerce_before_shop_loop', 'notices', 10 );

//hook: woocommerce_after_shop_loop_item_title
function woocommerce_template_loop_price() {
	?>
		<p><?php the_excerpt(  ); ?></p>
	<?php
}

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );



// hook: woocommere_after_shoop_loop_item
function ui_show_variation_stock() {
  //get current product
  global $product;
  
  //check if it's a variable product
  if ( $product->get_type() == 'variable' ) {
      //loop through each variation
    
      foreach ( $product->get_available_variations() as $variation ) {
      
        //lets store the attributes so users will know it
        $attributes = array();
    
        foreach ( $variation['attributes'] as $attribute ) {
          //write each individual attribute (e.g. brown, plastic||green, metal)
          $attributes[] = $attribute;
        }
		
        
		
		
    //combine all attributes in a string
    // $attributes = implode( ', ', $attributes );
	// var_dump($attributes[0]);
    
    //check if product is in stock
        if ( $variation['max_qty'] > 0 || ! empty ( $variation['is_in_stock'] ) ) { 
          //display stock count if any
          echo '<br/>' . "Variations: " .  $attributes[0]; 
        } else {
      //just display out of stock
          echo '<br/>' . "Variation: " .  $attributes[0]; 
        }
      }
    }
}

add_action( 'woocommerce_after_shop_loop_item', 'ui_show_variation_stock' );


// woocommerce single product hook
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 1 );


//custom product tab
// function short_description_custom($tabs) {
// 	// $tabs = the_content();
// 	// return $tabs;
// 	unset($tabs['description']);
// 	unset($tabs['additional_information']);
// 	unset($tabs['reviews']);

// 	$tabs['description_product'] = array(
// 		"title" => "Full Description",
// 		"priority" => "5",
// 		"callback" => "woocommerce_description"
// 	);

// 	return $tabs;
// }

// function woocommerce_description() {
// 	?>
// 		<div><?php the_content(); ?></div>
// 	<?php
// }

function short_description_custom($tabs) {
	?>
		<div class="woocommerce-tabs wc-tabs-wrapper">
			<?php 
				$tabs = the_content();
				return $tabs;
			?>
		</div>
	<?php
}


add_filter('woocommerce_product_tabs', 'short_description_custom');

//handle related product
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}



// cart-page

//free ship >= 20
add_action("woocommerce_before_cart_table", "show_notice_free_ship");

function show_notice_free_ship() {
	$min_amount = 20;
	$current_amount = WC()->cart->subtotal;
	if($current_amount < $min_amount) {
		?>
			<div class="woocommerce-message">
				You must buy <?php echo wc_price($min_amount - $current_amount) ?> for free ship
			</div>
		<?php
	}
}

//coupon 
add_action('woocommerce_cart_coupon', 'show_expire_date');

function show_expire_date() {
	?>
		<div class="woocommerce-error">
				You have 30 days to use your coupon
		</div>
	<?php
}