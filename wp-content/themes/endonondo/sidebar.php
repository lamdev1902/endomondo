<?php 
	$postid = get_the_ID();
	$author_id = get_post_field ('post_author', $post_id);
	$author_name = get_the_author_meta( 'nickname' , $author_id ); 
	$author_url = get_author_posts_url( $author_id );
	$post_type = $post->post_type;
?>
<aside class="single-sidebar">
	<div class="sg-author">
		<div class="author-it">
			<?php $avata = get_field('avata', 'user_'.$author_id);
			if($avata){
			?>
			<img src="<?php echo $avata; ?>" alt="">
			<?php } else { ?>
			<img src="<?php echo get_field('avatar_default','option'); ?>" alt="">
			<?php } ?>
			<div class='ag-author-info'>
				<h5><a href="<?php echo $author_url; ?>"><?php the_author(); ?></a></h5>
				<p class="color-grey"><i class="fal fa-clock"></i>Updated on <?php the_date('d F, Y'); ?></p>
			</div>
		</div>
		<?php $medically_reviewed = get_field('select_author',$postid); 
		 if($medically_reviewed) { ?>
		<div class="author-it">
				<img src="<?php echo get_field('avata', 'user_'. $medically_reviewed[0]["ID"]) ?>" alt="">
			<div class='ag-author-info'>
				<h5><?php foreach($medically_reviewed as $m=>$mr) {?><a href="<?php echo get_author_posts_url($mr['ID']); ?>"><?php if($m>0) echo ', '; ?><?php echo $mr['display_name']; ?></a><?php } ?></h5>
				<p class="color-grey">Medically reviewed the article</p>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php 
		if(get_field('enable_source','option') == true && $checktime == false) { 
	?>
	<div class="sg-resources on-sp">
		<h4>Resources</h4>
		<?php $source_content = get_field('source_content',$postid);
		if($source_content) echo $source_content; else echo get_field('source_intro','option'); ?>
	</div>
	<?php } ?>
	<div class="sg-lastest on-pc">
		<h3 class="title">Latest news</h3>
		<div class="sg-lastest-list">
			<?php
				$args = array(
					'posts_per_page'	=> 1,
					'post_type' => $post_type,
				);
				 $the_query = new WP_Query( $args );
				while ($the_query->have_posts() ) : $the_query->the_post();
				$post_author_id = get_post_field ('post_author', $post->ID);
				$post_display_name = get_the_author_meta( 'nickname' , $post_author_id ); 
				$post_author_url = get_author_posts_url( $post_author_id );
			?>
			<div class="sg-lastest-it">
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
			<?php
				endwhile;
				wp_reset_query();
			?>
			<?php
				$args = array(
					'posts_per_page'	=> 4,
					'post_type' => $post_type,
					'offset'           => 1,	
				);
				 $the_query = new WP_Query( $args );
				while ($the_query->have_posts() ) : $the_query->the_post();
				$post_author_id = get_post_field ('post_author', $post->ID);
				$post_display_name = get_the_author_meta( 'nickname' , $post_author_id ); 
				$post_author_url = get_author_posts_url( $post_author_id );
			?>
			<div class="sg-lastest-it position-relative">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<h5 class="author"><a href="<?php echo $post_author_url; ?>">By <?php echo $post_display_name; ?></a></h5>
				<a href="<?php the_permalink(); ?>" class="news-link position-absolute"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/right-black.svg" alt=""></a>
			</div>
			<?php
				endwhile;
				wp_reset_query();
			?>
		</div>
	</div>
</aside>