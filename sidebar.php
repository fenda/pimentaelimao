<aside class="sidebar" role="complementary">
	<div class="widget">
		<?php get_template_part('searchform'); ?>
	</div>
	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_widget')) ?>
	<div class="popular-posts widget">
		<h3 class="widget__title font--raleway">Posts mais populares</h3>
		<?php 
			$popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
			while ( $popularpost->have_posts() ) : $popularpost->the_post();
			?>
			<article class="most-read clear">
				<?php if ( has_post_thumbnail()) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-item__image post-item__image--widget">
						<?php the_post_thumbnail('thumbnail'); ?>
					</a>
				<?php endif; ?>
				<h2 class="post-item__title post-item__title--widget font--raleway"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="post-item__extrainfo post-item__extrainfo--widget">
					<span class="date">
						<time datetime="<?php the_time('Y-m-d'); ?>">
							<?php the_date(); ?>
						</time>
					</span>·
				</p>
			</article>
			<?php
			endwhile;
		?>
	</div>
</aside>