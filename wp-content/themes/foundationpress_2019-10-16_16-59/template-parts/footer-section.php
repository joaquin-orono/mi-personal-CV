<footer class="site-footer section fp-auto-height" data-midnight="half-white">
	<div class="footer-container">
		<?php if(is_front_page()):?>
		<div class="footer-grid widgets">
		<?php else:?>
		<div class="footer-grid widgets" data-aos="fade-up" data-aos-offset="0" data-aos-duration="400" data-aos-delay="200">
		<?php endif;?>
			<?php dynamic_sidebar( 'footer-widgets' ); ?>
		</div>
		<?php if(is_front_page()):?>
		<div class="footer-grid menu">
		<?php else:?>
		<div class="footer-grid menu" data-aos="fade-up" data-aos-offset="0" data-aos-duration="400" data-aos-delay="400">
		<?php endif;?>
			<?php foundationpress_footer(); ?>
		</div>
	</div>
</footer>

<div>
	<iframe id="messenger-frame" class="hidden" src="https://bestaffers.teamtailor.com/messenger" frameborder="0" allowtransparency="true"></iframe>
	<div id="messenger-launcher-frame">
		<div id="launcher-container" class="launcher-container">
			<div id="messenger-btn" class="messenger-btn">
				<span class="messenger-btn-icon icon-chat"></span>
			</div>
			<div id="messenger-close" class="messenger-close hidden">
				<span class="messenger-btn-icon icon-cross"></span>
			</div>
		</div>
	</div>
</div>