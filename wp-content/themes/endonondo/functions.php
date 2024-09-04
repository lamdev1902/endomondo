<?php
include(TEMPLATEPATH . '/shortcode/chart/chart-shortcode.php');
include(TEMPLATEPATH . '/shortcode/muscle/anatomy.php');
include(TEMPLATEPATH.'/shortcode/calorie/calorie-shortcode.php');
include(TEMPLATEPATH.'/shortcode/calorie/bmi-shortcode.php');
// include(TEMPLATEPATH.'/shortcode/calorie/chinese-gender-shortcode.php');
include(TEMPLATEPATH.'/shortcode/calorie/body-fat-shortcode.php');
include(TEMPLATEPATH.'/shortcode/calorie/ideal-weight-shortcode.php');
include(TEMPLATEPATH.'/shortcode/calorie/lean-body-mass-shortcode.php');
// include(TEMPLATEPATH.'/shortcode/calorie/healthy-weight-shortcode.php');
// include(TEMPLATEPATH.'/shortcode/calorie/age-shortcode.php');
// include(TEMPLATEPATH.'/shortcode/calorie/tdee-shortcode.php');
// include(TEMPLATEPATH.'/shortcode/calorie/army-body-fat-shortcode.php');
// include(TEMPLATEPATH.'/shortcode/calorie/absi-shortcode.php');
// include(TEMPLATEPATH.'/shortcode/calorie/adjusted-body-weight-shortcode.php');
// include(TEMPLATEPATH.'/shortcode/calorie/body-adiposity-index-shortcode.php');
include(TEMPLATEPATH.'/shortcode/calorie/bmr-shortcode.php');

function enqueue_infinite_scroll_script()
{
	if (is_category()) {
		global $wp_query;

		wp_enqueue_script(
			'infinite-scroll',
			get_template_directory_uri() . '/assets/js/infinite-scroll.js',
			array('jquery'),
			'1.0.0', 
			true
		);
	} elseif (is_tag()) {
		global $wp_query;

		wp_enqueue_script(
			'infinite-scroll-tag',
			get_template_directory_uri() . '/assets/js/infinite-tag.js',
			array('jquery'),
			'1.0.0',
			true
		);
	}
}
add_action('wp_enqueue_scripts', 'enqueue_infinite_scroll_script');

function load_more_posts()
{

	$paged = 6;
	$args = $_POST['query_vars'];
	$args['post_type'] = array('post', 'informational_posts', 'round_up', 'single_reviews', 'step_guide');
	$args['posts_per_page'] = 3;

	$paged = $_POST['page'] + 1;
	$args['paged'] = $paged;


	$the_query = new WP_Query($args);

	if ($the_query->have_posts()):
		while ($the_query->have_posts()):
			$the_query->the_post();
			$post_author_id = get_post_field('post_author', get_the_ID());
			$post_display_name = get_the_author_meta('nickname', $post_author_id);
			$post_author_url = get_author_posts_url($post_author_id);
			?>
			<div class="news-it">
				<div class="news-box">
					<div class="featured image-fit hover-scale">
						<?php $image_featured = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
						<a href="<?php the_permalink(); ?>">
							<?php if ($image_featured): ?>
								<img src="<?php echo $image_featured; ?>" alt="">
							<?php else: ?>
								<img src="<?php echo get_field('fimg_default', 'option'); ?>" alt="">
							<?php endif; ?>
						</a>
					</div>
					<div class="info">
						<?php $category = get_the_category(get_the_ID()); ?>
						<?php if (!empty($category) && count($category) > 0): ?>
							<div class="tag mr-bottom-16">
								<?php
								foreach ($category as $cat) { ?>
									<span><a href="<?php echo get_term_link($cat->term_id); ?>"><?php echo $cat->name; ?></a></span>
								<?php } ?>
							</div>
						<?php endif; ?>
						<p class="has-medium-font-size text-special clamp-2"><a class="pri-color-2"
								href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></p>
						<p class="has-small-font-size"><a target="_blank" class="sec-color-3"
								href="<?php echo $post_author_url; ?>">By <?php echo $post_display_name; ?></a>
						</p>
					</div>
				</div>
			</div>
			<?php
		endwhile;
	endif;
	die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function custom_image_sizes_choose($sizes)
{
	unset($sizes['thumbnail']);
	unset($sizes['medium']);
	unset($sizes['large']);

	return array('full' => __('Full Size'));

}

add_filter('image_size_names_choose', 'custom_image_sizes_choose');

/* Replace Year current */
function year_shortcode()
{
	$year = date('Y');
	return $year;
}

add_filter('single_post_title', 'my_shortcode_title');
add_filter('the_title', 'my_shortcode_title');
add_filter('wp_title', 'my_shortcode_title');
function my_shortcode_title($title)
{
	$title = strip_tags($title);
	return do_shortcode($title);
}
add_filter('pre_get_document_title', function ($title) {
	// Make any changes here
	return do_shortcode($title);
}, 999, 1);

add_shortcode('Year', 'year_shortcode');
add_shortcode('year', 'year_shortcode');
/* year seo */
include(TEMPLATEPATH . '/sitemap/sitemap-loader.php');
include(TEMPLATEPATH . '/include/menus.php');
include(TEMPLATEPATH . '/hcfunction/update-modifile-be.php');
add_theme_support('post-thumbnails', array('post', 'page', 'informational_posts', 'round_up', 'single_reviews', 'step_guide'));
/* Script Admin */
function my_script()
{ ?>
	<style type="text/css">
		#dashboard_primary,
		#icl_dashboard_widget,
		#dashboard_right_now #wp-version-message,
		#wpfooter {
			display: none;
		}
	</style>
<?php }
add_action('admin_footer', 'my_script');
function custom_style_login()
{
	?>
	<style type="text/css">
		.login h1 a {
			background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/endomondo-1.svg");
			background-size: 100% auto;
			height: 35px;
			width: 200px;
		}

		.wp-social-login-provider-list img {
			max-width: 100%;
		}
	</style>
<?php }
add_action('login_head', 'custom_style_login');
/* add css, jquery */
function theme_mcs_scripts()
{
	/* general css */
	wp_enqueue_style('style-slick', get_template_directory_uri() . '/assets/js/slick/slick.css');
	wp_enqueue_style('style-slick-theme', get_template_directory_uri() . '/assets/js/slick/slick-theme.css');
	wp_enqueue_style('style-swiper', get_template_directory_uri() . '/assets/js/swiper/swiper-bundle.min.css');
	wp_enqueue_style('style-main', get_template_directory_uri() . '/assets/css/main.css', '', '1.6.3');
	wp_enqueue_style('style-custom', get_template_directory_uri() . '/assets/css/custom.css', '', '1.3.3');
	wp_enqueue_style('style-base', get_template_directory_uri() . '/assets/css/base.css', '', '1.3.4');
	wp_enqueue_style('tool-css', get_template_directory_uri() . '/shortcode/calorie/assets/css/tool.css', '', '1.0.1');
	wp_enqueue_style('style-element', get_template_directory_uri() . '/assets/css/element.css', '', '1.5.1');
	wp_enqueue_style('style-responsive', get_template_directory_uri() . '/assets/css/responsive.css', '', '1.6.1');
	wp_enqueue_style( 'style-awesome', get_template_directory_uri() . '/assets/fonts/css/fontawesome.css');
	wp_enqueue_style( 'style-solid', get_template_directory_uri() . '/assets/fonts/css/solid.css');
	wp_enqueue_style( 'style-regular', get_template_directory_uri() . '/assets/fonts/css/regular.css');
}
add_action('wp_enqueue_scripts', 'theme_mcs_scripts');
/* register page option ACF */
if (function_exists('acf_add_options_page')) {
	$parent = acf_add_options_page(array(
		'page_title' => 'Website Option',
		'menu_title' => 'Website Option',
		'icon_url' => 'dashicons-image-filter',
	));
	acf_add_options_sub_page(array(
		'page_title' => 'Option',
		'menu_title' => 'Option',
		'parent_slug' => $parent['menu_slug'],
	));
	acf_add_options_sub_page(array(
		'page_title' => 'Sitemap',
		'menu_title' => 'Sitemap',
		'parent_slug' => $parent['menu_slug'],
	));
}
//add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
	show_admin_bar(false);
}
/* Hide editor not use */
//add_action( 'admin_init', 'hide_editor_not_use' );
function hide_editor_not_use()
{
	if (isset($_GET['post']) && $_POST['post_ID']) {
		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
		if (!isset($post_id))
			return;

		$template_file = get_post_meta($post_id, '_wp_page_template', true);

		if ($template_file == 'template/home.php') {
			remove_post_type_support('page', 'editor');
		}
	}
}
/* Update date when publish post */
function post_unpublished($new_status, $old_status, $post)
{
	if ($old_status == 'future' && $new_status == 'publish') {
		$update_post = array(
			'ID' => $post->ID,
			'post_modified' => $post->post_date
		);
		wp_update_post($update_post);
	}
}
add_action('transition_post_status', 'post_unpublished', 10, 3);

add_filter('request', 'my_tag_nav');
function my_tag_nav($request)
{
	if (isset($request['post_tag'])) {
		$request['posts_per_page'] = 1;
	}
	return $request;
}

function custom_social_share_buttons_shortcode()
{
	ob_start(); ?>

	<div class="addtoany_share_buttons">
		<?php if (function_exists('ADDTOANY_SHARE_SAVE_KIT')) {
			ADDTOANY_SHARE_SAVE_KIT();
		} ?>
	</div>

	<?php
	return ob_get_clean();
}


?>