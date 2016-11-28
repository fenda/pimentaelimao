<?php get_header(); ?>

<?php
$args = array(
	'posts_per_page' => 1,
	'meta_key' => 'meta-checkbox',
	'meta_value' => 'yes'
);
$featured = new WP_Query($args);

if ($featured->have_posts()): while($featured->have_posts()): $featured->the_post(); ?>
<div class="wrapper">
	<div class="ft-post post-item">
	<?php if ( has_post_thumbnail()) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="ft-post__image">
			<?php the_post_thumbnail('ft_post'); ?>
			<p class="post-item__category font--raleway"><?php the_category(', '); ?></p>
			<div class="ft-post__info">
				<h1 class="ft-post__title post-item__title font--raleway"><?php the_title(); ?></h1>
				<p class="ft-post__extrainfo post-item__extrainfo">
					<span class="date">
						<time datetime="<?php the_time('Y-m-d'); ?>">
							<?php the_date(); ?>
						</time>
					</span>· <span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Comente', 'html5blank' ), __( '1 Comentário', 'html5blank' ), __( '% Comentários', 'html5blank' )); ?></span>
				</p>
			</div>
		</a>
	<?php endif; ?>
	</div>
</div>
<?php
endwhile; else:
endif;
?>
<div class="wrapper clear">
	<main role="main">
		<section class="with-sidebar">
			<div class="blog-section">
				<div class="ads ad728x90">
					<?php the_ad(10544); ?>
				</div>
				<?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>
				<?php get_template_part('loop'); ?>
				<?php get_template_part('pagination'); ?>
			</div>

		</section>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
