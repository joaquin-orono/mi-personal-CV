<?php
/*
 Template Name: Homepage
*/
get_header(); 
$video_mp4 = get_field('video_mp4');
$video_webm = get_field('video_webm');
?>

<div id="fullpage">
	<section id="home-title" class="section" data-midnight="white">
		<div class="triangle-top"></div>
		<div class="triangle-middle"></div>
		<div class="triangle-bottom"></div>
		<video id="home-video" loop muted data-autoplay>
			<?php if( $video_mp4 ): ?>
			<source src="<?php echo $video_mp4['url']; ?>" type="video/mp4">
			<?php endif;?>
			<?php if( $video_webm ): ?>
			<source src="<?php echo $video_webm['url']; ?>" type="video/webm">
			<?php endif;?>
		</video>
		<div class="grid-container page-content">
			<div class="grid-x">
				<div class="small-12 medium-10 large-8 medium-offset-1 large-offset-2 text-center cell home-title <?php if(!get_field('subtitle')): echo ('no-subtitle');endif;?>">
					<h1><?php the_field('title');?></h1>
					<!-- <h3><?php the_field('subtitle');?></h3> -->
				</div>
			</div>
			<?php if(get_field('subtitle')):?>
			<div class="grid-x">
				<div class="small-12 medium-8 large-6 medium-offset-2 large-offset-0 cell home-title">
					<h3><?php the_field('subtitle');?></h3>
				</div>
			</div>
			<?php endif;?>
			<?php
				$teamtailor_auth = array(
					'headers'     => array(
							'Authorization' => 'Token ' . 'D_VGMEO0q8xx-jaEVrfez4_ks_O2RkxvKaSL495i',
							'X-Api-Version' => '20161108'
					),
				); 
				$jobs_request = wp_remote_get( 'https://api.teamtailor.com/v1/jobs?page%5Bsize%5D=3&include=department,locations',$teamtailor_auth );
				if( is_wp_error( $jobs_request ) ) {
					return false;
				}
				$jobs_body = wp_remote_retrieve_body( $jobs_request );
				$jobs_data = json_decode( $jobs_body );
				$job_url = 'careersite-job-url';
				
			?>
			<?php if( ! empty( $jobs_data ) ) :?>
				<div class="grid-x grid-margin-x home-jobs-container">
					<div class="small-12 medium-11 cell">
						<div id="home-jobs" class="grid-x grid-margin-x" data-equalizer="description">
							<?php foreach( $jobs_data->data as $job ):
								$job_department = wp_remote_get( 'https://api.teamtailor.com/v1/departments/'.$job->relationships->department->data->id,$teamtailor_auth );
								$job_department_body = wp_remote_retrieve_body( $job_department );
								$job_department_data = json_decode( $job_department_body );

								$job_location = wp_remote_get( 'https://api.teamtailor.com/v1/locations/'.$job->relationships->locations->data[0]->id,$teamtailor_auth );
								$job_location_body = wp_remote_retrieve_body( $job_location );
								$job_location_data = json_decode( $job_location_body );
								?>
								<div class="small-12 medium-4 large-4 cell job-cell">
									<div class="card">
										
										<div class="card-content">
											<a href="/jobs/view-job/?job_id=<?php echo( $job->id );?>">
												<h5><?php echo $job->attributes->title;?></h5>
												<div class="category-city"><?php echo $job_department_data->data->attributes->name;?><?php if(!empty($job_location_data->data->attributes->city)):?> - <?php echo $job_location_data->data->attributes->city;?><?php endif;?></div>
												<div class="description" data-equalizer-watch="description">
													
													<?php 
													if(!empty($job->attributes->pitch)){
														echo wp_trim_words( $job->attributes->pitch, 20, '...' );	
													} else {
														echo wp_trim_words( $job->attributes->body, 20, '...' );
													}
													
													?>
												</div>
											</a>
										</div>
										
										
											
										<div class="card-link">
											<a href="/jobs/view-job/?job_id=<?php echo( $job->id );?>"><span class="triangle"><i class="fal fa-plus"></i></span></a>
										</div>
										
									</div>
								</div>
							<?php endforeach;?>
						</div>
					</div>
					<div class="small-12 medium-1 cell all-jobs-cell">
						<a href="/jobs" class="button-all-jobs"><span><?php _e('Ver más','bestaffers');?></span></a>
					</div>
				</div>
			<?php endif;?>
		</div>
	</section>

	<section id="home-about" class="section">
		<div class="grid-container">
			
			<div class="grid-x">
				<?php $team_photo = get_field('team_photo');?>
				<div class="small-5 medium-4 large-3 cell photo-cell" style="background-image:url('<?php echo $team_photo['url']; ?>')">
					<?php if( !empty($team_photo) ): ?>
							<!-- <img id="team_photo" src="<?php echo $team_photo['url']; ?>" alt="<?php echo $team_photo['alt']; ?>" /> -->
					<?php endif; ?>
					<div id="member_photo"></div>
				</div>
				<div class="small-7 medium-8 large-9 cell team-cell">
					<div class="section-title">
						<h3><?php the_field('about_title');?></h3>
						<h4><?php the_field('about_subtitle');?></h4>
					</div>
					<?php if( have_rows('team') ): ?>

						<ul class="members">

						<?php while( have_rows('team') ): the_row(); 

							// vars
							$image = get_sub_field('image');
							$name = get_sub_field('name');
							$job_title = get_sub_field('job_title');
							$linkedin_url = get_sub_field('linkedin_url');
							$email = get_sub_field('email');

							?>

							<li class="member" data-image="<?php echo $image['url']; ?>">
									<!-- <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" /> -->
									<div class="name"><?php echo $name; ?></div>
									<div class="job_title"><?php echo $job_title; ?></div>
									<div class="links">
										<?php if($email):?><a href="mailto:<?php echo $email; ?>"><i class="fa fa-envelope"></i></a><?php endif;?>
										<?php if($linkedin_url):?><a href="<?php echo $linkedin_url; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a><?php endif;?>
									</div>

							</li>

						<?php endwhile; ?>

						</ul>

					<?php endif; ?>
				</div>
				
			</div>
		</div>
	</section>

	<?php if( have_rows('testimonials') ): ?>
	<section id="home-testimonials" class="section">
		<div class="grid-container">
			<div class="grid-x">
				<div class="small-12 medium-9 large-8 medium-offset-3 cell section-title">
					<h3><?php the_field('testimonials_title');?></h3>
					<?php if(get_field('testimonials_subtitle')):?><h4><?php the_field('testimonials_subtitle');?></h4><?php endif;?>
				</div>
			</div>
			<div class="grid-x">
				<div class="small-12 medium-8 large-5 medium-offset-3 large-offset-3 cell">
					<div class="orbit testimonials" role="region" aria-label="Testimonials" data-orbit data-options="animInFromLeft:slide-in-up; animInFromRight:slide-in-up; animOutToLeft:slide-out-up; animOutToRight:slide-out-up;" data-pause-on-hover="false">
						<div class="orbit-wrapper">
							<ul class="orbit-container">

							<?php while( have_rows('testimonials') ): the_row(); 

								// vars
								$company = get_sub_field('company');
								$name = get_sub_field('name');
								$job_title = get_sub_field('job_title');
								$text = get_sub_field('text');
								$rating = get_sub_field('rating');
								?>

								<li class="orbit-slide testimonial" id="">
									<?php if($company):?><img class="company" src="<?php echo $company['url']; ?>" alt="<?php echo $company['alt'] ?>" /><?php endif;?>
									<?php if($text):?><div class="text"><?php echo $text; ?></div><?php endif;?>
									<?php if($name):?><div class="name"><?php echo $name; ?></div><?php endif;?>
									<?php if($job_title):?><div class="job_title"><?php echo $job_title; ?></div><?php endif;?>
									<!-- <?php if($rating):?>
									<div class="rating">
										<?php
										for ($count = 1; $count <= 5; $count ++) {
											$starRatingId = $row['id'] . '_' . $count;
											
											if ($count <= $rating) {
													
													echo '<i class="fas fa-star"></i>';
											} else {
													echo '<i class="far fa-star"></i>';
											}
									}
										?>
									</div>
									<?php endif;?> -->
								</li>

							<?php endwhile; ?>
							</ul>
						</div>
						<nav class="orbit-bullets">
							<?php $i=0; while( have_rows('testimonials') ): the_row(); ?>
							<!-- <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
							<button data-slide="1"><span class="show-for-sr">Second slide details.</span></button> -->
							<button <?php if($i == 0) { echo 'class="is-active"';}?> data-slide="<?php echo $i;?>"></button>
							<?php $i++; endwhile; ?>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="orbit testimonials-image" role="region" aria-label="Testimonials image" data-orbit  data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;" data-pause-on-hover="false">
			<div class="orbit-wrapper">
				<ul class="orbit-container">

				<?php while( have_rows('testimonials') ): the_row(); 
					$image = get_sub_field('image');
					?>

					<li class="orbit-slide testimonial-image-container" id="">
					<?php if($image):?><div class="testimonial-image" style="background-image:url('<?php echo $image['url']; ?>')"></div><?php endif;?>
					</li>

				<?php endwhile; ?>
				</ul>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<section id="home-cta" class="section" data-midnight="half-white">
		<div class="grid-container">
			<div class="grid-x">
				<div class="small-12 medium-6 medium-offset-6 cell section-title">
					<h3><?php the_field('cta_title');?></h3>
					<h4><?php the_field('cta_subtitle');?></h4>
					<?php 
						$form_id = get_field('cta_contact_form')[0]->ID;
						$form_title = get_field('cta_contact_form')[0]->post_title;
						echo do_shortcode('[contact-form-7 id="'. $form_id .'" title="'.$form_title.'"]');
					?>
					<script>
					document.addEventListener( 'wpcf7mailsent', function( event ) {
							location = '/gracias-por-tu-mensaje/';
					}, false );
					</script>
				</div>
			</div>
		</div>
	</section>

	<section id="home-cv" class="section">
		<div class="grid-container">
			<div class="grid-x">
				<div class="small-12 medium-8 medium-offset-2 text-center cell section-title">
					<h3><?php the_field('cv_title');?></h3>
					<h4><?php the_field('cv_subtitle');?></h4>
					<a href="<?php the_field('cv_button_url');?>" class="button primary"><?php the_field('cv_button_text');?></a>
					<div class="cv_text"><?php the_field('cv_text');?></div>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/footer-section' ); ?>
</div>
<?php get_footer();