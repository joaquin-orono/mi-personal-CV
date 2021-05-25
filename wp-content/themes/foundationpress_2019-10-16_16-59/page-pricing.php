<?php
/*
 Template Name: Pricing
*/

get_header(); ?>


	<section id="pricing" class="section" data-midnight="default">
		<div class="grid-container">
			<div class="grid-x">
				<div class="small-12 cell page-title text-center" data-aos="fade-down" data-aos-offset="100" data-aos-duration="400" data-aos-delay="100">
					<h1><?php the_title();?></h1>
					<?php if( get_field('subtitle') ): ?><h3 class="subtitle"><?php the_field('subtitle');?></h3><?php endif; ?>
				</div>
			</div>
			<div class="grid-x">
				<div class="small-12 medium-3 price_titles cell show-for-medium" data-aos="fade-right" data-aos-offset="100" data-aos-duration="400" data-aos-delay="100">
					<div class="price_title"></div>
					<div class="price_amount"></div>
					<div class="process_number"><?php _e('Procesos de selección a contratar','bestaffers');?></div>
					<div class="exclusivity"><?php _e('Exclusividad','bestaffers');?></div>
					<div class="guarantee_candidate"><?php _e('Garantía de presentación de candidatos','bestaffers');?></div>
					<div class="guarantee_time"><?php _e('Garantía de tiempo de éxito','bestaffers');?></div>
					<div class="guarantee_reposition"><?php _e('Garantía de reposición','bestaffers');?></div>
					<div class="fee"><?php _e('Fee de inicio de servicio','bestaffers');?></div>
					<div class="payment_method"><?php _e('Forma de pago','bestaffers');?></div>
					<div class="advisor_text"><?php the_field('advisor_text');?></div>
				</div>
					<?php if( have_rows('pricing') ): ?>
						<?php $delay=200;while( have_rows('pricing') ): the_row(); 
							// vars
							$featured = get_sub_field('featured');
							$name = get_sub_field('name');
							$amount = get_sub_field('amount');
							$amount_type = get_sub_field('amount_type');
							$price_description = get_sub_field('price_description');
							$process_number = get_sub_field('process_number');
							$exclusivity = get_sub_field('exclusivity');
							$guarantee_candidate = get_sub_field('guarantee_candidate');
							$guarantee_time = get_sub_field('guarantee_time');
							$guarantee_reposition = get_sub_field('guarantee_reposition');
							$fee = get_sub_field('fee');
							$payment_method = get_sub_field('payment_method');
							?>
							<div class="cell small-12 medium-auto price <?php if($featured == 1) : echo 'featured'; endif;?>" data-aos="fade-right" data-aos-offset="100" data-aos-duration="400" data-aos-delay="<?php echo $delay;?>">
								<?php if($featured == 1) : ?><div class="featured-label"><?php _e('Recomendado','bestaffers');?></div><?php endif;?>
								<div class="price_title"><?php echo $name;?></div>
								<div class="price_amount">
									<div class="amount">
										<?php echo $amount;?>
										<?php if($amount_type == 'percentage') : echo ("%"); endif;?>
										<?php if($amount_type == 'amount') : echo ("€"); endif;?>
									</div>
									<div class="price_description"><?php echo $price_description;?></div>
								</div>
								<div class="process_number"><span class="pricing-label show-for-small-only"><?php _e('Procesos de selección a contratar','bestaffers');?>: </span><?php echo $process_number;?></div>
								<div class="exclusivity"><span class="pricing-label show-for-small-only"><?php _e('Exclusividad','bestaffers');?>: </span>
									<?php if($exclusivity == 1) {?>
										<i class="fal fa-check success"></i>
									<?php } else {?>
										<i class="fal fa-times alert"></i>
									<?php };?>
								</div>
								<div class="guarantee_candidate align-middle"><span class="pricing-label show-for-small-only"><?php _e('Garantía de presentación de candidatos','bestaffers');?>: </span><?php echo $guarantee_candidate;?></div>
								<div class="guarantee_time"><span class="pricing-label show-for-small-only"><?php _e('Garantía de tiempo de éxito','bestaffers');?>: </span><?php echo $guarantee_time;?></div>
								<div class="guarantee_reposition"><span class="pricing-label show-for-small-only"><?php _e('Garantía de reposición','bestaffers');?>: </span><?php echo $guarantee_reposition;?></div>
								<div class="fee"><span class="pricing-label show-for-small-only"><?php _e('Fee de inicio de servicio','bestaffers');?>: </span><?php echo $fee;?></div>
								<div class="payment_method"><span class="pricing-label show-for-small-only"><?php _e('Forma de pago','bestaffers');?>: </span><?php echo $payment_method;?></div>
								<div class="buy_button"><a data-open="applyPrice_<?php echo get_row_index(); ?>" class="button"><?php _e('Contratar','bestaffers');?></a></div>
							</div>
							<div class="reveal large" id="applyPrice_<?php echo get_row_index(); ?>" data-reveal data-animation-in="slide-in-right" data-animation-out="slide-out-right">
								<div class="grid-container">
									<div class="grid-x">
										<div class="small-12 medium-8 medium-offset-2 cell">
											<div class="full-iframe-container">
												<iframe class="full-iframe-inner" src="/buscas-talento?price=<?php echo $name;?>" frameborder="0" ></iframe>
											</div>
										</div>
									</div>
								</div>
								
								<button class="close-button" data-close aria-label="Close modal" type="button">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php $delay = $delay + 100;?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	
	<?php get_template_part( 'template-parts/footer-section' ); ?>


<?php get_footer();