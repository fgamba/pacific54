<?php
/**
 * pacific54 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pacific54
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
function pacific54_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on pacific54, use a find and replace
		* to change 'pacific54' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'pacific54', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'pacific54' ),
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
			'pacific54_custom_background_args',
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
add_action( 'after_setup_theme', 'pacific54_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pacific54_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pacific54_content_width', 640 );
}
add_action( 'after_setup_theme', 'pacific54_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pacific54_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pacific54' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pacific54' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pacific54_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pacific54_scripts() {
	wp_enqueue_style( 'pacific54-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'pacific54-style', 'rtl', 'replace' );
	wp_enqueue_style( 'pacific54-form-style', get_template_directory_uri().'/css/pacific-form.css', array(), _S_VERSION );

	wp_enqueue_script( 'pacific54-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'jquery-validation', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'pacific54-form-logger', get_template_directory_uri() . '/js/form-logger.js', array('jquery'), _S_VERSION, true );
	wp_localize_script('pacific54-form-logger', 'pacific54_ajax', array('ajax_url' => admin_url('admin-ajax.php')));


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pacific54_scripts' );

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

function form_log_type_registration() {
    $labels = array(
        'name'               => _x('Form Logs', 'form logs', 'pacific54'),
        'singular_name'      => _x('Form Log', 'form log', 'pacific54'),
        'menu_name'          => _x('Form Logs', 'admin menu', 'pacific54'),
        'name_admin_bar'     => _x('Form Log', 'add new on admin bar', 'pacific54'),
        'add_new'            => _x('Add New', 'Form Log', 'pacific54'),
        'add_new_item'       => __('Add New Form Log', 'pacific54'),
        'new_item'           => __('New Form Log', 'pacific54'),
        'edit_item'          => __('Edit Form Log', 'pacific54'),
        'view_item'          => __('View Form Log', 'pacific54'),
        'all_items'          => __('All Form Logs', 'pacific54'),
        'search_items'       => __('Search Form Logs', 'pacific54'),
        'parent_item_colon'  => __('Parent Form Logs:', 'pacific54'),
        'not_found'          => __('No Form Logs found.', 'pacific54'),
        'not_found_in_trash' => __('No Form Logs found in Trash.', 'pacific54')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'form-logs'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    );

    register_post_type('form_log', $args);
}
add_action('init', 'form_log_type_registration');


function pacific54_custom_form() {
	$action = esc_url(admin_url('admin-post.php'));
    $html = '<div class="pacific54-form"><h3>Pacific 54</h3>';
	$html .= '<form action="'.$action.'" method="post" id="pacific-form-logger"><div class="field"><label for="name">Name:* </label><input type="text" name="name" id="name" required /></div>';
	$html .= '<input type="hidden" name="action" value="pacific54_form_submission">';
	$html .= '<div class="field"><label for="phone">Phone Number:* </label><input type="phone" name="phone" id="phone" required /></div>';
	$html .= '<div class="field"><label for="email">Email:* </label><input type="email" name="email" id="email" required /></div>';
	$html .= '<div class="field"><label for="message">Message:* </label><textarea name="message" id="message" cols="10" rows="8" required ></textarea></div>';
	$html .= '<div class="field"><input type="submit" name="submit" id="submit" value="SAVE" /></div><div class="field"><p id="response"></p></div></form>';
    return $html;
}
add_shortcode('pacific54_custom_form', 'pacific54_custom_form');

function handle_pacific54_form_submission() {
	if (isset($_POST['name'])) {
        $name = sanitize_text_field($_POST['name']);
	}
	if (isset($_POST['phone'])) {
        $phone = sanitize_text_field($_POST['phone']);
	}
	if (isset($_POST['email'])) {
        $email = sanitize_text_field($_POST['email']);
	}
	if (isset($_POST['message'])) {
        $message = sanitize_text_field($_POST['message']);
	}
	$date = new DateTime();
	$formattedDate = $date->format('m-d-Y H:i');
	
	$post_data = array(
		'post_title'    => 'Form sent on '.$formattedDate,
		'post_content'  => $message,
		'post_status'   => 'publish',  
		'post_author'   => 1,  
		'post_type'     => 'form_log',  
	);

	$post_id = wp_insert_post( $post_data );
	
	if ( is_wp_error( $post_id ) ) {
		$error_message = 'An error occurred while processing the request: '.$post_id->get_error_message();
        wp_send_json_error($error_message);
	} else {
		update_field('name', $name, $post_id);
		update_field('phone', $phone, $post_id);
		update_field('email', $email, $post_id);
		update_field('message', $message, $post_id);
		$success_message = 'Form successfully sent.';
		wp_send_json_success($success_message);
	}

	exit(0);

	
  }
  add_action('wp_ajax_handle_pacific54_form_submission', 'handle_pacific54_form_submission');
  add_action('wp_ajax_nopriv_handle_pacific54_form_submission', 'handle_pacific54_form_submission');
  
  function pacific54_show_logs() {
	$args = array(
		'post_type' => 'form_log', 
		'posts_per_page' => -1, 
	);
	
	$query = new WP_Query($args);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

			?>
			<h3><?php the_title(); ?></h3>
			<p><?php the_field('name'); ?></p>
			<p><?php the_field('phone'); ?></p>
			<p><?php the_field('email'); ?></p>
			<p><?php the_field('message'); ?></p>
			<hr/>
			<?php
		}
		wp_reset_postdata(); 
	} else {
		?>
		<p>No form logs found.</p>
		<?php
	}
	
  }

  add_shortcode('pacific54_show_logs', 'pacific54_show_logs');