<?php
/* Template Name: Search */
$pageid = get_the_ID();
get_header();
the_post();
?>
<main id="content">
	<div class="page-top bg-black">
		<div class="container">
			<div class="breacrump">
				<a href="<?php echo home_url(); ?>">Home</a>
				<span class="line">|</span>
				<span>Search</span>
			</div>
		</div>
	</div>
	<div class="search-main">
		<div class="container">
			<div class="search-form text-center">
				<h1 class="text-uppercase">I’M LOOKING FOR...</h1>
				<form action="<?php echo get_home_url(); ?>/" method="get">
					<input class="form-control" id="s" type="text" placeholder="Type what you are looking for"
						value="<?php the_search_query(); ?>" name="s" />
					<button class="btn-search ed-btn" type="submit ">Search</button>
				</form>
			</div>
			<div class="author-all">
				<h2 class="ed-title">Author</h2>
				<div class="people-list list-flex">
					<?php
					$args = array(
						'query_id' => 'authors',
						'search' => esc_attr($_GET['s']),
					);
					$author_query = new WP_User_Query($args);
					$authors = $author_query->get_results();
					if (!empty($authors)) {
						foreach ($authors as $author) {
							$userid = $author->ID;
							?>
							<div class="people-it list-flex">
								<div class="featured image-fit">
									<?php $avata = get_field('avata', 'user_' . $userid);
									if ($avata) {
										?>
										<img src="<?php echo $avata; ?>" alt="">
									<?php } else { ?>
										<img src="<?php echo get_field('avatar_default', 'option'); ?>" alt="">
									<?php } ?>
								</div>
								<div class="info">
									<h3><?php echo $author->display_name; ?></h3>
									<p><?php echo get_field('position', 'user_' . $userid) ?></p>
									<div class="social">
										<?php
										$social = get_field('social', 'user_' . $userid);
										if ($social) {
											foreach ($social as $social) {
												?>
												<a target="_blank" href="<?php echo $social['link']; ?>"><i
														class="<?php echo $social['icon']; ?>"></i></a>
											<?php }
										} ?>
									</div>
								</div>
							</div>
						<?php }
					} ?>
				</div>
			</div>
			<div class="blog-all">
				<h2 class="ed-title">All post</h2>
				<div class="news-list list-flex">
					<?php
					$args = array(
						'post_type' => array('post', 'informational_posts', 'round_up', 'single_reviews', 'step_guide'),
						'posts_per_page' => 8,
						'paged' => $paged,
						's' => $_GET['s'],
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
									<?php $category = get_the_category($post->ID); ?>
									<?php if (!empty($category) && count($category) > 0): ?>
										<div class="tag">
											<?php
											foreach ($category as $cat) { ?>
												<span><a
														href="<?php echo get_term_link($cat->term_id); ?>"><?php echo $cat->name; ?></a></span>
											<?php } ?>
										</div>
									<?php endif; ?>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<h5 class="author"><a href="<?php echo $post_author_url; ?>">By
											<?php echo $post_display_name; ?></a></h5>
								</div>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_query();
					?>
				</div>
			</div>
			<?php
			$big = 999999999;
			$mcs_paginate_links = paginate_links(array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $the_query->max_num_pages,
				'prev_text' => __('<i class="fal fa-angle-left"></i>', 'yup'),
				'next_text' => __('<i class="fal fa-angle-right"></i>', 'yup')
			));
			if ($mcs_paginate_links):
				?>
				<div class="pagination">
					<?php echo $mcs_paginate_links ?>
				</div>
			<?php endif; ?>
		</div>
	</div>


</main>
<?php get_footer(); ?>