<?php get_header(); ?>

<div class="wrapper clear">
	<?php if ( has_post_thumbnail()) : ?>
		<div class="page-header">
			<?php the_post_thumbnail('page_header'); ?>
			<h1 class="title-over-image font--raleway"><span><?php _e( 'Tag:: ', 'html5blank' ); echo single_tag_title('', false); ?></span></h1>
		</div>
	<?php endif; ?>
	<main role="main">
		<section class="with-sidebar">
			<div class="ads">
				<?php the_ad(10544); ?>
			</div>
			<?php get_template_part('loop'); ?>
			<?php get_template_part('pagination'); ?>
		</section>
	</main>

	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>