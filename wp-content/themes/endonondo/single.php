<?php
$postid = get_the_ID();
$post_terms = wp_get_post_terms($postid, 'category');
$author_id = get_post_field('post_author', $postid);
$author_name = get_the_author_meta('nickname', $author_id);
$author_url = get_author_posts_url($author_id);
$user_info = get_userdata($author_id);
$avt = get_field('avata', 'user_' . $author_id);
get_header();
the_post();
$post_type = $post->post_type;
$user_description = get_field('story', 'user_' . $author_id);
?>
<main id="content">
	<div class="container">
		<div class="single-top">
			<div class="list-flex flex-center flex-middle">
				<?php
				if (function_exists('yoast_breadcrumb')) {
					yoast_breadcrumb('<div id="breadcrumbs" class="breacrump">', '</div>');
				}
				?>
			</div>
		</div>
		<div class="single-main list-flex">
			<?php get_sidebar(); ?>
			<div class="sg-right">
				<h1><?php the_title(); ?></h1>
				<div class="social on-pc">
					<p class="has-small-font-size pri-color-2" style="margin-bottom: 0">Follow us: </p>
					<?php
					$social = get_field('social', 'option');
					if ($social) {
						foreach ($social as $social) {
							?>
							<a target="_blank" href="<?php echo $social['link']; ?>"><img
									src="<?php echo $social['icon']; ?>" /></a>
						<?php }
					} ?>
				</div>
				<article class="sg-custom">
					<div class="single-featured">
						<figure class="wp-block-image size-full">
							<?php $image_featured = wp_get_attachment_url(get_post_thumbnail_id($postid));
							;
							if ($image_featured) {
								?>
								<div class="image-fit">
									<img src="<?php echo $image_featured; ?>" alt="">
								</div>
							<?php } else { ?>
								<div class="image-fit">
									<img src="<?php echo get_field('fimg_default', 'option'); ?>" alt="">
								</div>
							<?php } ?>
							<?php $post_thumbnail_id = get_post_thumbnail_id($postid);
							$caption = wp_get_attachment_caption($post_thumbnail_id) ?>
							<figcaption class="wp-element-caption text-center"><?php echo $caption; ?></figcaption>
						</figure>
					</div>
					<div class="sg-editor">
						<?php the_content(); ?>
					</div>
					<?php
					if (get_field('enable_source', 'option') == true && $checktime == false) {
						?>
						<div class="sg-resources box-grey pd-main on-pc">
							<h4>Resources</h4>
							<div class="intro">
								<?= get_field('source_intro', 'option');?>
							</div>
							<?php $source_content = get_field('source_content', $postid);
							if ($source_content)
								echo $source_content;
							?>
						</div>
					<?php } ?>
					<div class="author-about pd-main">
						<h3>About the Author</h3>
						<div class="author-write">
							<div class="author-link">
								<?php 
								if ($avt) {
									?>
									<a href="<?php echo $author_url; ?>"><img src="<?php echo $avt; ?>" alt=""></a>
								<?php } else { ?>
									<a href="<?php echo $author_url; ?>"><img
											src="<?php echo get_field('avatar_default', 'option'); ?>" alt="">
									<?php } ?>
									<p class="has-large-font-size"><a style="color: var(--pri-color-2) !important;"
											href="<?php echo $author_url; ?>"><?php the_author(); ?>
										</a>
										<span class="has-small-font-size sec-color-3">
											<?php echo get_field('position', 'user_' . $author_id);; ?></span>
									</p>
									<div class="social-author">
										<?php
										$user_linkedin = get_field('user_linkedin', 'user_' . $author_id);
										$user_website = get_field('user_website', 'user_' . $author_id);
										$user_fb = get_field('user_fb', 'user_' . $author_id);
										$user_instagram = get_field('user_instagram', 'user_' . $author_id);
										$user_twitter = get_field('user_twitter', 'user_' . $author_id);
										?>
										<?php if ($user_linkedin) { ?><a class="share-linkedin"
												href="<?php echo $user_linkedin; ?>" target="_blank" rel="noopener"><img
													src="<?php echo get_template_directory_uri(); ?>/assets/img/so-linkein.svg"
													alt=""></a><?php } ?>
										<?php if ($user_website) { ?><a class="share-link"
												href="<?php echo $user_website; ?>" target="_blank" rel="noopener"><img
													src="<?php echo get_template_directory_uri(); ?>/assets/img/so-website.svg"
													alt=""></a><?php } ?>
										<?php if ($user_fb) { ?><a class="share-linkedin" href="<?php echo $user_fb; ?>"
												target="_blank" rel="noopener"><img
													src="<?php echo get_template_directory_uri(); ?>/assets/img/so-facebook.svg"
													alt=""></a><?php } ?>
										<?php if ($user_instagram) { ?><a class="share-linkedin"
												href="<?php echo $user_instagram; ?>" target="_blank" rel="noopener"><img
													src="<?php echo get_template_directory_uri(); ?>/assets/img/so-instagram.svg"
													alt=""></a><?php } ?>
										<?php if ($user_twitter) { ?><a class="share-linkedin"
												href="<?php echo $user_twitter; ?>" target="_blank" rel="noopener"><img
													src="<?php echo get_template_directory_uri(); ?>/assets/img/so-twitter.svg"
													alt=""></a><?php } ?>
									</div>
							</div>
							<?php if ($user_description) { ?>
								<div class="author-info">
									<p><?php echo $user_description ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</article>
			</div>
		</div>
		<aside class="sg-other">
			<h2 class="text-center text-uppercase"><?php echo get_field('other_single_page', 'option'); ?></h2>
			<div class="news-list list-flex">
				<?php
				$args = array(
					'posts_per_page' => 4,
					'post__not_in' => array($postid),
					'post_type' => $post_type,
				);
				$the_query = new WP_Query($args);
				while ($the_query->have_posts()):
					$the_query->the_post();
					$post_author_id = get_post_field('post_author', $post->ID);
					$post_display_name = get_the_author_meta('nickname', $post_author_id);
					$post_author_url = get_author_posts_url($post_author_id);

					?>
					<div class="news-it">
						<div class="news-box">
							<div class="featured image-fit hover-scale">
								<a href="<?php the_permalink(); ?>">
									<?php $image_featured = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
									;
									if ($image_featured) {
										?>
										<div class="image-fit">
											<img src="<?php echo $image_featured; ?>" alt="">
										</div>
									<?php } else { ?>
										<div class="image-fit">
											<img src="<?php echo get_field('fimg_default', 'option'); ?>" alt="">
										</div>
									<?php } ?>
								</a>
							</div>
							<div class="info">
								<div class="tag">
									<?php $category = get_the_category($post->ID);
									foreach ($category as $cat) { ?>
										<span><a
												href="<?php echo get_term_link($cat->term_id); ?>"><?php echo $cat->name; ?></a></span>
									<?php } ?>
								</div>
								<p class="has-large-font-size"><a class="pri-color-2"
										href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
								<p class="has-small-font-size"><a class="sec-color-3"
										href="<?php echo $post_author_url; ?>">By <?php echo $post_display_name; ?></a></p>
							</div>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_query();
				?>
			</div>
		</aside>
	</div>
</main>
<?php get_footer(); ?>