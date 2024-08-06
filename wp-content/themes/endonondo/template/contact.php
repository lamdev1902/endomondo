<?php
/* Template Name: Contact */
$pageid = get_the_ID();
get_header(); 
the_post();
?>
<main id="content">
	<div class="page-top-white mb-top-black">
		<div class="container">
			<?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<div id="breadcrumbs" class="breacrump">','</div>' );
			}
			?>
		</div>
	</div>
	<div class="contact-main">
		<div class="container">
			<h1 class="ed-title text-uppercase"><?php echo get_field('title',$pageid); ?></h1>
		</div>
		<div class="contact-box list-flex">
			<div class="contact-left">
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
				<h5><?php echo get_field('form_title',$pageid); ?></h5>
				<div class="contact-form">
					<?php echo do_shortcode(get_field('form_contact',$pageid));?>
				</div>
			</div>
			<div class="contact-right bg-black color-white">
				<div class="contact-right-box">
					<h2><?php echo get_field('office_title',$pageid); ?></h2>
					<address class="ct-info">
						<?php echo get_field('office__description',$pageid); ?>
					</address>
					<h2><?php echo get_field('follow_title',$pageid); ?></h2>
					<div class="follow-list list-flex">
						<?php $follow_social = get_field('follow_social',$pageid); 
						if($follow_social){
							foreach ($follow_social as $follow){
						?>
						<a href="<?php echo $follow['link']; ?>" target="_blank"><i class="<?php echo $follow['icon']; ?>"></i><?php echo $follow['title']; ?></a>
						<?php }} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>