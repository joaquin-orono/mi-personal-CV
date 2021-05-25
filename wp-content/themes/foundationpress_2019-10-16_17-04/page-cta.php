<?php
/*
 Template Name: CTA
*/
get_header(); ?>

<section id="cta" data-midnight="half-white">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-12 section-title">
				<h3><?php the_field('cta_title');?></h3>
				<h4><?php the_field('cta_subtitle');?></h4>
				<?php 
					$form_id = get_field('cta_contact_form')->ID;
					$form_title = get_field('cta_contact_form')->post_title;
					echo do_shortcode('[contact-form-7 id="'. $form_id .'" title="'.$form_title.'"]');
				?>
			</div>
		</div>
	</div>
</section>

<?php //get_template_part( 'template-parts/footer-section' ); ?>

<?php get_footer();