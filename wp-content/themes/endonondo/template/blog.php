<?php
/* Template Name: Blog */
$pageid = get_the_ID();
get_header(); 
the_post();
?>
<main id="content">
	<div class="page-top-white">
		<div class="container">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb( '<div id="breadcrumbs" class="breacrump">','</div>' );
				}
			?>
		</div>
	</div>
	<div class="blog-main">
		<div class="blog-top position-relative">
		    <div class="container">
				<div class="top-box list-flex">
					<div class="info">
						<h1 class="ed-title text-uppercase color-white"><?php echo get_field('title',$pageid); ?></h1>
						<div class="on-pc"><?php echo get_field('description',$pageid); ?></div>
					</div>
					<div class="featured list-flex">	
						<img src="<?php echo get_field('image_big',$pageid); ?>" alt="" class="big">
						<img src="<?php echo get_field('image_small',$pageid); ?>" alt="" class="small on-pc">
					</div>
					<div class="on-sp"><?php echo get_field('description',$pageid); ?></div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="blog-select">
				<div class="news-list list-flex">
					<?php
						$args = array(
							'post_type' => array('post','informational_posts','round_up','single_reviews','step_guide'),
							'posts_per_page'	=> 3,	
							'paged'   => $paged,	
						);
						 $the_query = new WP_Query( $args );
						while ($the_query->have_posts() ) : $the_query->the_post();
						$post_author_id = get_post_field ('post_author', $post->ID);
						$post_display_name = get_the_author_meta( 'nickname' , $post_author_id ); 
						$post_author_url = get_author_posts_url( $post_author_id );
					?>
					<div class="news-it">
						<div class="news-box">
							<div class="featured image-fit hover-scale">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							</div>
							<div class="info">
								<div class="tag">
									<?php $category = get_the_category($post->ID);
									 	foreach( $category as $cat ) { ?>
									 	<span><a href="<?php echo get_term_link($cat->term_id); ?>"><?php echo $cat->name; ?></a></span>
									<?php } ?>
								</div>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<h5 class="author"><a href="<?php echo $post_author_url; ?>">By <?php echo $post_display_name; ?></a></h5>
							</div>
						</div>
					</div>
					<?php
						endwhile;
						wp_reset_query();
					?>
				</div>
			</div>
			<div class="blog-all">
				<h2 class="ed-title">All post</h2>
				<div class="news-list list-flex">
					<?php
						$args = array(
							'post_type' => array('post','informational_posts','round_up','single_reviews','step_guide'),
							'posts_per_page'	=> 12,	
							'cat'          => $term_id, 
							'offset'           => 3,
							'paged'   => $paged,	
						);
						 $the_query = new WP_Query( $args );
						while ($the_query->have_posts() ) : $the_query->the_post();
						$post_author_id = get_post_field ('post_author', $post->ID);
						$post_display_name = get_the_author_meta( 'nickname' , $post_author_id ); 
						$post_author_url = get_author_posts_url( $post_author_id );
					?>
					<div class="news-it">
						<div class="news-box">
							<div class="featured image-fit hover-scale">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							</div>
							<div class="info">
								<div class="tag">
									<?php $category = get_the_category($post->ID);
									 	foreach( $category as $cat ) { ?>
									 	<span><a href="<?php echo get_term_link($cat->term_id); ?>"><?php echo $cat->name; ?></a></span>
									<?php } ?>
								</div>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<h5 class="author"><a href="<?php echo $post_author_url; ?>">By <?php echo $post_display_name; ?></a></h5>
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
				$mcs_paginate_links = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $the_query->max_num_pages,
					'prev_text'    => __('<i class="fal fa-angle-left"></i>','yup'),
					'next_text'    => __('<i class="fal fa-angle-right"></i>','yup') 
				  ) );
				 if($mcs_paginate_links) : 
			 ?>
			    <div class="pagination">
				  <?php echo $mcs_paginate_links ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>