	<footer class="footer" role="contentinfo">
		<div class="wrapper">
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_widgets')) ?>
		</div>
		<p class="footer__copyright">
			&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <br>Desenvolvido por <a href="http://hypeberries.com" target="_blank">Hypeberries</a>
		</p>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
