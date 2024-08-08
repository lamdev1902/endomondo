<?php
/* Template Name: About*/
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
	<div class="container">
		<article class="about-main">
			<div class="container-small">
				<h1 class="text-center text-uppercase"><?php the_title(); ?></h1>
				<div class="about-custom">
					<?php the_content(); ?>
				</div>

				<?php $team = get_field('team',$pageid); 
					if($team){
						foreach ($team as $team) {
				?>
				<div class="about-author">
					<h2 class="text-uppercase"><?php echo $team['title']; ?></h2>
					<div class="people-list list-flex">
						<?php $team_list = $team['select_team']; 
							if($team_list){
								foreach ($team_list as $team_it) {
								$userid = $team_it['ID'];
								$post_author_url = get_author_posts_url( $userid );
									
						?>
						<div class="people-it">
							<div class="featured image-fit">
								<a href="<?php echo $post_author_url; ?>">
									<?php $avata = get_field('avata', 'user_'.$userid);
									if($avata){
									?>
									<img src="<?php echo $avata; ?>" alt="">
									<?php } else { ?>
									<img src="<?php echo get_field('avatar_default','option'); ?>" alt="">
									<?php } ?>
								</a>
							</div>
							<div class="info">
								<h3><a href="<?php echo $post_author_url; ?>"><?php echo $team_it['display_name']; ?></a></h3>
								<p><?php echo get_field('position', 'user_'.$userid); ?></p>
								<div class="social">
									<?php $social = get_field('social', 'user_'.$userid); 
										if($social){
											foreach ($social as $social) {
									?>
									<a target="_blank" href="<?php echo $social['link']; ?>"><i class="<?php echo $social['icon']; ?>"></i></a>
									<?php }} ?>
								</div>
							</div>
						</div>
						<?php }} ?>
					</div>
				</div>
				<?php }} ?>
			</div>
		</article>
	</div>
</main>
<?php get_footer(); ?>