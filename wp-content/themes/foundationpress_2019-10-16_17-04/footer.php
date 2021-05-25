<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<!-- <footer class="site-footer section">
	<div class="footer-container">
		<div class="footer-grid">
			<?php dynamic_sidebar( 'footer-widgets' ); ?>
		</div>
	</div>
</footer> -->

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>

<?php wp_footer(); ?>
<script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.26.3'><\/script>".replace("HOST", location.hostname));
//]]></script>
<!-- <script src="//assets.cdn.teamtailor.com/assets/jobsite/jobsite-ef34841f62839940af87dcde2791e042a75a11f55c594e289094f653dcdcf6cf.js"></script>
<div>
	<iframe id="messenger-frame" class="hidden" src="//bestaffers.teamtailor.com/messenger" frameborder="0" allowtransparency="true"></iframe>
	<iframe id="messenger-launcher-frame" class="" src="//bestaffers.teamtailor.com/messenger/launcher" frameborder="0" allowtransparency="true" style="height: 233px; width: 300px;"></iframe>
</div> -->
<!-- <script>
	$(window).on('message onmessage', function(e) {
		var event = e.originalEvent;
		if (event.data === 'showMessenger') {
			$('#messenger-frame').removeClass('hidden');
			$('#messenger-frame')[0].contentWindow.postMessage(event.data, 'https://bestaffers.teamtailor.com');
		} else if (event.data === 'hideMessenger') {
			$('#messenger-frame').addClass('hidden');
		} else if (event.data === 'showLauncher') {
			$('#messenger-launcher-frame').removeClass('hidden');
		} else if (event.data.message) {
			$('#messenger-launcher-frame')[0].contentWindow.postMessage(event.data, 'https://bestaffers.teamtailor.com');
		} else if (event.data.height && event.data.width && event.data.origin === 'launcher') {
			$('#messenger-launcher-frame').height(event.data.height);
			$('#messenger-launcher-frame').width(event.data.width);
		}
	});
</script> -->
</body>
</html>
