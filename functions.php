<?php

if (!isset($content_width)) {
	$content_width = 900;
}

if (function_exists('add_theme_support')) {

	// Add Thumbnail Theme Support
	add_theme_support('post-thumbnails');
	add_image_size('home_thumb', 245, 294, true);
	add_image_size('ft_post', 1050, 540, true);
	add_image_size('page_header', 1050, 380, true);

	// Enables post and comment RSS feed links to head
	add_theme_support('automatic-feed-links');

	// Localisation Support
	load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav() {
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts() {
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
			// jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', array(), '1.11.1', false);

		// Conditionizr
		wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0', false);

		// Modernizr
		wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1', false);

		// Custom scripts
		wp_register_script(
			'html5blankscripts',
			get_template_directory_uri() . '/js/scripts.js',
			array(
				'conditionizr',
				'modernizr',
				'jquery'),
			'1.0.0');

		// Enqueue Scripts
		wp_enqueue_script('html5blankscripts');
	}
}

// Load HTML5 Blank styles
function html5blank_styles() {
	wp_register_style('normalize', get_template_directory_uri() . '/css/lib/normalize.css', array(), '3.0.1');
	wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');
	wp_enqueue_style('html5blank');
}

function enqueue_font_awesome() {
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
}

function load_fonts() {
	wp_register_style('raleway', 'https://fonts.googleapis.com/css?family=Raleway:400,400i,600,600i,700,700i');
	wp_enqueue_style( 'raleway');
	wp_register_style('libreBaskerville', 'https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700');
	wp_enqueue_style( 'libreBaskerville');
}

// Register HTML5 Blank Navigation
function register_html5_menu() {
	register_nav_menus(array(
		'header-menu' => __('Header Menu', 'html5blank')
	));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
	$args['container'] = false;
	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
	return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
	global $post;
	if (is_home()) {
		$key = array_search('blog', $classes);
		if ($key > -1) {
			unset($classes[$key]);
		}
	} elseif (is_page()) {
		$classes[] = sanitize_html_class($post->post_name);
	} elseif (is_singular()) {
		$classes[] = sanitize_html_class($post->post_name);
	}

	return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => __('Sidebar', 'html5blank'),
		'id' => 'sidebar_widget',
		'before_widget' => '<div id="%1$s" class="%2$s widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget__title font--raleway">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Footer Widgets', 'html5blank'),
		'id' => 'footer_widgets',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer__title font--raleway">',
		'after_title' => '</h3>'
	));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages
	));
}

// Custom Excerpts
function html5wp_index($length) {
	return 50;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length) {
	return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '') {
	global $post;
	if (function_exists($length_callback)) {
		add_filter('excerpt_length', $length_callback);
	}
	if (function_exists($more_callback)) {
		add_filter('excerpt_more', $more_callback);
	}
	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = '<p>' . $output . '</p>';
	echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more) {
	global $post;
	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('Continuar Lendo »', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
	return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
	$myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments() {
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}
	}
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body clear">
	<?php endif; ?>
	<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment ); ?>
		<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
		<p class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
			printf( __('%1$s'), get_comment_date()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
			?>
		</p>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>
	<div class="comment-text">
		<?php comment_text() ?>
	</div>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

function comment_placeholders( $fields ) {
    $fields['author'] = str_replace(
        '<input',
        '<input placeholder="'
            . _x(
                'Nome*',
                'comment form placeholder',
                'html5blank'
                )
            . '"',
        $fields['author']
    );
    $fields['email'] = str_replace(
        '<input id="email" name="email" type="text"',
        '<input type="email" placeholder="Email*"  id="email" name="email"',
        $fields['email']
    );
    $fields['url'] = str_replace(
        '<input id="url" name="url" type="text"',
        '<input placeholder="http://example.com" id="url" name="url" type="url"',
        $fields['url']
    );

    return $fields;
}

function wpsites_customize_comment_form_text_area($arg) {
    $arg['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Comentário" cols="45" rows="1" aria-required="true"></textarea></p>';
    return $arg;
}

// featured post meta box
function sm_custom_meta() {
	add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
}
function sm_meta_callback( $post ) {
	$featured = get_post_meta( $post->ID );

?>
	<p>
		<div class="sm-row-content">
			<label for="meta-checkbox">
				<input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
				<?php _e( 'Post Destacado', 'sm-textdomain' )?>
			</label>
		</div>
	</p>
 <?php }

function sm_meta_save( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	if( isset( $_POST[ 'meta-checkbox' ] ) ) {
		update_post_meta( $post_id, 'meta-checkbox', 'yes' );
	} else {
		update_post_meta( $post_id, 'meta-checkbox', '' );
	}

}

function wpb_set_post_views($postID) {
	$count_key = 'wpb_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}



// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'enqueue_font_awesome'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'load_fonts'); // Add Theme Stylesheet
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action('after_setup_theme', 'remove_admin_bar');
add_action('add_meta_boxes', 'sm_custom_meta' );
add_action('save_post', 'sm_meta_save' );

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('comment_form_default_fields', 'comment_placeholders' );
add_filter('comment_form_defaults', 'wpsites_customize_comment_form_text_area');

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether