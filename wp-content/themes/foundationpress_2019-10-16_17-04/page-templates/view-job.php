<?php
/*
Template Name: View Job
*/
// $job_slug = basename($_SERVER['REQUEST_URI']);
$job_id = htmlspecialchars($_GET["job_id"]);
// echo $job_slug;
$teamtailor_auth = array(
	'headers'     => array(
			'Authorization' => 'Token ' . 'D_VGMEO0q8xx-jaEVrfez4_ks_O2RkxvKaSL495i',
			'X-Api-Version' => '20161108'
	),
);

$jobs_request = wp_remote_get( 'https://api.teamtailor.com/v1/jobs/'.$job_id,$teamtailor_auth );
if( is_wp_error( $jobs_request ) ) {
	return false;
}
$jobs_body = wp_remote_retrieve_body( $jobs_request );

$jobs_data = json_decode( $jobs_body );
$job = $jobs_data->data;
$job_url = 'careersite-job-url';
$job_url_iframe = 'careersite-job-apply-iframe-url';
$job_apply_button = 'apply-button-text';
// echo '<pre>';
// print_r($jobs_data);
// echo '</pre>';
$job_department_id = wp_remote_get( $job->relationships->department->links->self,$teamtailor_auth );
$job_department_id_body = wp_remote_retrieve_body( $job_department_id );
$job_department_id_data = json_decode( $job_department_id_body );


$job_location_id = wp_remote_get( $job->relationships->locations->links->self,$teamtailor_auth );
$job_location_id_body = wp_remote_retrieve_body( $job_location_id );
$job_location_id_data = json_decode( $job_location_id_body );

$job_department = wp_remote_get( 'https://api.teamtailor.com/v1/departments/'.$job_department_id_data->data->id,$teamtailor_auth );
$job_department_body = wp_remote_retrieve_body( $job_department );
$job_department_data = json_decode( $job_department_body );

$job_location = wp_remote_get( 'https://api.teamtailor.com/v1/locations/'.$job_location_id_data->data[0]->id,$teamtailor_auth );
$job_location_body = wp_remote_retrieve_body( $job_location );
$job_location_data = json_decode( $job_location_body );


$related_jobs_request = wp_remote_get( 'https://api.teamtailor.com/v1/jobs?page%5Bsize%5D=3&include=department,locations&filter%5Bdepartment%5D='.$job_department_id_data->data->id,$teamtailor_auth );
$related_jobs_body = wp_remote_retrieve_body( $related_jobs_request );
$related_jobs_data = json_decode( $related_jobs_body );


function url_origin( $s, $use_forwarded_host = false )
{
	$ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
	$sp       = strtolower( $s['SERVER_PROTOCOL'] );
	$protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
	$port     = $s['SERVER_PORT'];
	$port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
	$host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
	$host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
	return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
  return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

$absolute_url = full_url( $_SERVER );

if($job_id) {
	// print_r($jobs_data);
}
get_header(); ?>

<?php if( ! empty( $job_id ) ) :?>

<section id="job" class="section" data-midnight="half-white">
	<div class="job-header">
		<div class="grid-container">
			<div class="grid-x">
				<div class="small-8 medium-6 medium-offset-2 cell" data-aos="fade-down" data-aos-offset="0" data-aos-duration="200" data-aos-delay="200">
					<h1 class="job-title"><?php echo $job->attributes->title;?></h1>
					<div class="job-category-city"><?php echo $job_department_data->data->attributes->name;?><?php if(!empty($job_location_data->data->attributes->city)):?> - <?php echo $job_location_data->data->attributes->city;?><?php endif;?></div>
				</div>
				<div class="small-4 medium-4 cell"  data-aos="fade-down" data-aos-offset="0" data-aos-duration="200" data-aos-delay="400">
					<div class="job-image" style="background-image:url('<?php echo $job->attributes->picture->original;?>');"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-12 medium-6 medium-offset-2 cell small-order-2 medium-order-1" data-aos="fade-up" data-aos-offset="0" data-aos-duration="200" data-aos-delay="600">
				<div class="job-body"><?php echo ( $job->attributes->body);?></div>
			</div>
			<div class="small-12 medium-4 cell small-order-1 medium-order-2" data-aos="fade-up" data-aos-offset="0" data-aos-duration="200" data-aos-delay="800">
				<div class="job-aside">
					<div class="job-pitch"><?php echo $job->attributes->pitch;	?></div>
					
					<div class="job-button text-center">
						<a data-open="applyModal" href="#" class="button"><?php echo( $job->attributes->$job_apply_button );?></a>
					</div>
					<div class="share-block">
						<div class="share-title"><?php _e('Share','bestaffers');?></div>	
						<a class="share-link" href="https://twitter.com/intent/tweet/?text=<?php echo $job->attributes->title;?>&amp;url=<?php echo urlencode($absolute_url);?>" target="_blank" rel="noopener" aria-label="">
							<i class="fab fa-twitter"></i>
						</a>

						<a class="share-link" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode($absolute_url);?>&amp;title=<?php echo $job->attributes->title;?>&amp;summary=<?php echo $job->attributes->title;?>&amp;source=<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" rel="noopener" aria-label="">
							<i class="fab fa-linkedin-in"></i>
						</a>

						<a class="share-link" href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode($absolute_url);?>" target="_blank" rel="noopener" aria-label="">
							<i class="fab fa-facebook-f"></i>
						</a>

						<a class="share-link" href="mailto:?subject=<?php echo $job->attributes->title;?>&amp;body=<?php echo urlencode($absolute_url);?>" target="_self" rel="noopener" aria-label="">
							<i class="fal fa-envelope"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="job-cta">
		<div class="grid-container">
			<div class="grid-x">
				<div class="small-12 cell text-right" data-aos="fade-left" data-aos-offset="0" data-aos-duration="200" data-aos-delay="200">
					<div class="share-block">
						<div class="share-title"><?php _e('Share','bestaffers');?></div>	
						<a class="share-link" href="https://twitter.com/intent/tweet/?text=<?php echo $job->attributes->title;?>&amp;url=<?php echo urlencode($absolute_url);?>" target="_blank" rel="noopener" aria-label="">
							<i class="fab fa-twitter"></i>
						</a>

						<a class="share-link" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode($absolute_url);?>&amp;title=<?php echo $job->attributes->title;?>&amp;summary=<?php echo $job->attributes->title;?>&amp;source=<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" rel="noopener" aria-label="">
							<i class="fab fa-linkedin-in"></i>
						</a>

						<a class="share-link" href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode($absolute_url);?>" target="_blank" rel="noopener" aria-label="">
							<i class="fab fa-facebook-f"></i>
						</a>

						<a class="share-link" href="mailto:?subject=<?php echo $job->attributes->title;?>&amp;body=<?php echo urlencode($absolute_url);?>" target="_self" rel="noopener" aria-label="">
							<i class="fal fa-envelope"></i>
						</a>
					</div>
					<div class="job-button">
						<a data-open="applyModal" class="button"><?php echo( $job->attributes->$job_apply_button );?></a>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="reveal full" id="applyModal" data-reveal data-animation-in="slide-in-up" data-animation-out="slide-out-down">
		<div class="grid-container">
			<div class="grid-x">
				<div class="small-12 medium-8 medium-offset-2 cell">
					<div class="full-iframe-container">
						<iframe class="full-iframe-inner" src="<?php echo( $job->links->$job_url_iframe );?>" frameborder="0" ></iframe>
					</div>
				</div>
			</div>
		</div>
		
		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php if( ! empty( $related_jobs_data ) ) :?>
	<div class="job-related">
		<div class="grid-container">
			<div class="grid-x grid-margin-x">
				<div class="small-12 cell text-center">
					<h3><?php _e('Trabajos relacionados','bestaffers');?></h3>
				</div>
			</div>
			<div id="jobs-list" class="grid-x grid-margin-x" data-equalizer="description">
				<?php $delay = 300;
					foreach( $related_jobs_data->data as $job ):
					$job_department = wp_remote_get( 'https://api.teamtailor.com/v1/departments/'.$job->relationships->department->data->id,$teamtailor_auth );
					$job_department_body = wp_remote_retrieve_body( $job_department );
					$job_department_data = json_decode( $job_department_body );

					$job_location = wp_remote_get( 'https://api.teamtailor.com/v1/locations/'.$job->relationships->locations->data[0]->id,$teamtailor_auth );
					$job_location_body = wp_remote_retrieve_body( $job_location );
					$job_location_data = json_decode( $job_location_body );
					?>
					<div class="small-12 medium-4 large-4 cell" data-aos="fade-up" data-aos-offset="100" data-aos-duration="200" data-aos-delay="<?php echo $delay;?>">
						<div class="card">
							
							<div class="card-content">
								<a href="/jobs/view-job/?job_id=<?php echo( $job->id );?>">
									<div class="card-header">
										<h5><?php echo $job->attributes->title;?></h5>
										<div class="category-city"><?php echo $job_department_data->data->attributes->name;?><?php if(!empty($job_location_data->data->attributes->city)):?> - <?php echo $job_location_data->data->attributes->city;?><?php endif;?></div>
									</div>
									<div class="description" data-equalizer-watch="description">
										<div class="job-image" style="background-image:url('<?php echo $job->attributes->picture->original;?>');"></div>
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
				<?php $delay = $delay + 100;
							endforeach;?>
			</div>
		</div>
	</div>
	<?php endif;?>
</section>
<?php endif;?>
<?php get_template_part( 'template-parts/footer-section' ); ?>
<?php get_footer();
