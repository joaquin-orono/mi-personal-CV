<?php
/*
 Template Name: Legal Texts
*/
get_header(); ?>

<section id="legal-texts" data-midnight="half-white">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-12 medium-8 medium-offset-2 large-6 large-offset-3 section-title">
				<h1 class="page-title"><?php the_title();?></h1>
			</div>
		</div>
		<div class="grid-x">
			<div class="small-12 medium-8 medium-offset-2 large-6 large-offset-3">
				<div class="content"><?php the_content();?></div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/footer-section' ); ?>

<?php get_footer();