<?php get_header(); ?>
<div class="wrapper clear">
	<?php if ( has_post_thumbnail()) : ?>
		<div class="page-header">
			<?php the_post_thumbnail('page_header'); ?>
			<h1 class="title-over-image font--raleway"><span><?php the_title(); ?></span></h1>
		</div>
	<?php endif; ?>
	<main role="main">
		<section class="with-sidebar">

		
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
				<?php comments_template( '', true ); ?>
			</article>
		<?php endwhile; ?>

		<?php else: ?>

			<article>
				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
			</article>
		<?php endif; ?>
		</section>
	</main>
	<?php get_sidebar(); ?>
</div>



<?php get_footer(); ?>
