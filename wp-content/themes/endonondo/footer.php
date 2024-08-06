<footer id="footer">	
	<div class="ft-top">
		<div class="container">
			<div class="ft-info list-flex flex-middle flex-center">
				<div class="ft-logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_field('logo','option') ?>" alt=""></a></div>
				<div class="ft-form">
					<div class="klaviyo-form-TcfuNL"></div>
				</div>
				<div class="social">
					<?php 
						$social = get_field('social', 'option');
						if($social){
							foreach($social as $social){
					?>
					<a target="_blank" href="<?php echo $social['link']; ?>"><img src="<?php echo $social['icon'];?>" /></a>
					<?php }} ?>
				</div>
			</div>
			<nav class="ft-menu">
				<?php 
					wp_nav_menu(array(
						'theme_location' => 'menu_cat',
					));
				?>
			</nav>
		</div>
	</div>
	<div class="ft-bottom text-center">
		<div class="container">
			<?php echo get_field('footer_bottom','option') ?>
		</div>
	</div>
</footer>	
</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-3.5.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/slick/slick.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/swiper/swiper-bundle.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/custom.js?v=1.0.5"></script>
<script async type="text/javascript" src="https://static.klaviyo.com/onsite/js/klaviyo.js?company_id=RG9krj"></script>
<?php
	$pty = get_post_type();
	$args = array(
		'post_type' => 'gp_elements',
		'posts_per_page' => 5,
		'meta_query' => array(
			array(
				'key' => 'emposition',
				'value' => 'before_close_body'
			),
			array(
				'key' => 'emdisplay',
				'value' => sprintf('"%s"', $pty),
				'compare' => 'LIKE'
			)
		)
	);
 	$the_query = new WP_Query( $args );
	while ($the_query->have_posts() ) : $the_query->the_post();
	echo get_field('emcode',$post->ID, false,false);
	endwhile;
	wp_reset_query();
	$args = array(
		'post_type' => 'gp_elements',
		'posts_per_page' => 5,
		'meta_query' => array(
			array(
				'key' => 'emposition',
				'value' => 'before_close_body'
			),
			array(
				'key' => 'display_with_id_$_pid',
				'value' => get_the_ID(),
				'compare' => '='
			)
		)
	);
 	$the_query = new WP_Query( $args );
	while ($the_query->have_posts() ) : $the_query->the_post();
	echo get_field('emcode',$post->ID,false, false);
	endwhile;
	wp_reset_query();
	if(is_front_page()) {
		$args = array(
			'post_type' => 'gp_elements',
			'posts_per_page' => 5,
			'meta_query' => array(
				array(
					'key' => 'emposition',
					'value' => 'before_close_body'
				),
				array(
					'key' => 'emdisplay',
					'value' => 'home_page',
					'compare' => 'LIKE'
				)
			)
		);
	 	$the_query = new WP_Query( $args );
		while ($the_query->have_posts() ) : $the_query->the_post();
		echo get_field('emcode',$post->ID,false, false);
		endwhile;
		wp_reset_query();
	}
	$args = array(
		'post_type' => 'gp_elements',
		'posts_per_page' => 5,
		'meta_query' => array(
			array(
				'key' => 'emposition',
				'value' => 'ads_footer'
			),
			array(
				'key' => 'emdisplay',
				'value' => sprintf('"%s"', $pty),
				'compare' => 'LIKE'
			)
		)
	);
 	$the_query = new WP_Query( $args );
	while ($the_query->have_posts() ) : $the_query->the_post();
?>
<div class="ads-script"><?php echo get_field('emcode',$post->ID,false, false); ?></div>
<?php 
	endwhile;
	wp_reset_query(); 
?>
<?php wp_footer();?>
</body>
</html>