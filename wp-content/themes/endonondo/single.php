<?php 
$postid = get_the_ID();
$post_terms = wp_get_post_terms($postid,'category');
$author_id = get_post_field ('post_author', $post_id);
$author_name = get_the_author_meta( 'nickname' , $author_id ); 
$author_url = get_author_posts_url( $author_id );
get_header(); 
the_post();
$post_type = $post->post_type;
?>
<main id="content">
	<div class="container">
	    <div class="single-top">
			<div class="list-flex flex-center flex-middle">
				<?php
					if ( function_exists('yoast_breadcrumb') ) {
					  yoast_breadcrumb( '<div id="breadcrumbs" class="breacrump">','</div>' );
					}
				?>
				<div class="social on-pc">
					<?php 
						$social = get_field('social', 'option');
						if($social){
							foreach($social as $social){
					?>
					<a target="_blank" href="<?php echo $social['link']; ?>"><img src="<?php echo $social['icon'];?>" /></a>
					<?php }} ?>
				</div>
			</div>
		</div>
		<div class="single-main list-flex">
			<?php get_sidebar(); ?>
			<div class="sg-right">
				<h1><?php the_title();?></h1>
				<article class="sg-custom">
					<div class="social on-sp">
						<?php 
						$social = get_field('social', 'option');
						if($social){
							foreach($social as $social){
					?>
					<a target="_blank" href="<?php echo $social['link']; ?>"><img src="<?php echo $social['icon'];?>" /></a>
					<?php }} ?>
					</div>
					
					<div class="single-featured">
						<figure class="wp-block-image size-full">
						  <?php $image_featured = wp_get_attachment_url(get_post_thumbnail_id($postid)); ;
							if($image_featured){
							?>
								<div class="image-fit">	
									<img src="<?php echo $image_featured; ?>" alt="">
								</div>
							<?php } else { ?>
								<div class="image-fit">	
									<img src="<?php echo get_field('fimg_default','option'); ?>" alt="">
								</div>
							<?php } ?>
							<?php $post_thumbnail_id = get_post_thumbnail_id( $postid );
							$caption = wp_get_attachment_caption( $post_thumbnail_id )?>
						  <figcaption class="wp-element-caption text-center"><?php echo $caption; ?></figcaption>
						</figure>
					</div>
					<div class="sg-editor">
						<?php the_content(); ?>
					</div>
					<?php 
						if(get_field('enable_source','option') == true && $checktime == false) { 
					?>
					<div class="sg-resources box-grey mt-64 on-pc">
						<h4>Resources</h4>
						<?php $source_content = get_field('source_content',$postid);
						if($source_content) echo $source_content; else echo get_field('source_intro','option'); ?>
					</div>
					<?php } ?>
				</article>
			</div>
		</div>
		<aside class="sg-other">
			<h2 class="ed-title text-center text-uppercase"><?php echo get_field('other_single_page','option'); ?></h2>
			<div class="news-list list-flex">
				<?php
					$args = array(
						'posts_per_page'	=> 4,
						'post__not_in'      => array($postid),
						'post_type' => $post_type,		
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
							<a href="<?php the_permalink(); ?>">
								<?php $image_featured = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ;
									if($image_featured){
								?>
									<div class="image-fit">	
										<img src="<?php echo $image_featured; ?>" alt="">
									</div>
								<?php } else { ?>
									<div class="image-fit">	
										<img src="<?php echo get_field('fimg_default','option'); ?>" alt="">
									</div>
								<?php } ?>
							</a>
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
							<?php
								$yoast_meta = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);
								if ($yoast_meta) { 
									$current_year = date('Y');
									$yoast_meta = str_replace('%%currentyear%%', $current_year, $yoast_meta);
								?>
								<div class="des-news"><?php echo $yoast_meta; ?></div>
							<?php } ?>
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