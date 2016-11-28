<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<div class="post-item clear">
	<?php if ( has_post_thumbnail()) : ?>
		<div class="post-item__image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-item__image-link">
				<?php the_post_thumbnail('home_thumb'); ?>
			</a>
			<p class="post-item__category font--raleway"><?php the_category(', '); ?></p>
		</div>
	<?php endif; ?>
	<h2 class="post-item__title font--raleway"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p class="post-item__extrainfo">
		<span class="date">
			<time datetime="<?php the_time('Y-m-d'); ?>">
				<?php the_date(); ?>
			</time>
		</span>· <span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Comente', 'html5blank' ), __( '1 Comentário', 'html5blank' ), __( '% Comentários', 'html5blank' )); ?></span>
	</p>
	<div class="post-item__excerpt">
		<?php html5wp_excerpt('html5wp_index') ?>
	</div>
</div>
<?php endwhile; endif; ?>