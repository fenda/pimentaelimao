	<footer class="footer" role="contentinfo">
		<div class="wrapper">
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_widgets')) ?>
		</div>
		<p class="footer__copyright">
			&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <br>Desenvolvido por <a href="http://hypeberries.com" target="_blank">Hypeberries</a>
		</p>
	</footer>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//cdn.owlcdn.com/google/analytics/analytics.js','ga');ga('create', 'UA-80824609-2', 'auto');
    ga('send', 'pageview');
</script>
	<?php wp_footer(); ?>
</body>
</html>
