<?php get_header(); ?>
<div class="wrapper clear">

	<main role="main">
		<section class="with-sidebar">
			<article id="post-404">
				<h1><?php _e( 'Ops! Você se perdeu...', 'html5blank' ); ?></h1>
				<h2>
					<a href="<?php echo home_url(); ?>"><?php _e( 'Deseja voltar para a página inicial?', 'html5blank' ); ?></a>
				</h2>
			</article>

		</section>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>