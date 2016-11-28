<?php get_header(); ?>
<div class="wrapper clear">
	<main role="main">
		<section class="with-sidebar">
			<div class="blog-section">
				<div class="ads ad728x90">
					<?php the_ad(10544); ?>
				</div>
				<?php if (have_posts()): while (have_posts()) : the_post(); wpb_set_post_views(get_the_ID()); ?>
	
				<article id="post-<?php the_ID(); ?>" clas	s="post-el">
					<?php if ( has_post_thumbnail()) : ?>
						<?php the_post_thumbnail('ft_post'); ?>
					<?php endif; ?>
					<p class="post-item__category font--raleway post-el__category"><?php the_category(', '); ?></p>
					<h1 class="post-item__title font--raleway post-el__title"><?php the_title(); ?></h1>
					<p class="post-el__extrainfo post-item__extrainfo">
						<span class="date">
							<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_date(); ?></time>
						</span>· <span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Comente', 'html5blank' ), __( '1 Comentário', 'html5blank' ), __( '% Comentários', 'html5blank' )); ?></span>
					</p>
					<div class="post-el__content">
						<?php the_content(); ?>
					</div>
					<div class="tags">
						<h2 class="title_h2 font--raleway">Tags</h2>
						<p><?php the_tags( __( '' ), ' · ', '<br>'); ?></p>
					</div>
					
					<?php comments_template(); ?>
				</article>

			<?php endwhile; ?>
			<?php else: ?>

				<article>
					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
				</article>
			</div>
	<?php endif; ?>

	</section>
	</main>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
