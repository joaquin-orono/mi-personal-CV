<?php
/*
 Template Name: Jobs list
*/
$department_id = htmlspecialchars($_GET["department_id"]);
$location_id = htmlspecialchars($_GET["location_id"]);
$teamtailor_auth = array(
	'headers'     => array(
			'Authorization' => 'Token ' . 'D_VGMEO0q8xx-jaEVrfez4_ks_O2RkxvKaSL495i',
			'X-Api-Version' => '20161108'
	),
);
if($department_id) {
	$jobs_request = wp_remote_get( 'https://api.teamtailor.com/v1/jobs?include=department,locations&filter%5Bdepartment%5D='.$department_id,$teamtailor_auth );
} elseif($location_id) {
	$jobs_request = wp_remote_get( 'https://api.teamtailor.com/v1/jobs?include=department,locations&filter%5Blocations%5D='.$location_id,$teamtailor_auth );
} else {
	$jobs_request = wp_remote_get( 'https://api.teamtailor.com/v1/jobs?include=department,locations',$teamtailor_auth );
}
if( is_wp_error( $jobs_request ) ) {
	return false; // Bail early
}
$jobs_body = wp_remote_retrieve_body( $jobs_request );
$jobs_data = json_decode( $jobs_body );


$departments = wp_remote_get( 'https://api.teamtailor.com/v1/departments/',$teamtailor_auth );
$departments_body = wp_remote_retrieve_body( $departments );
$departments_data = json_decode( $departments_body );

$locations = wp_remote_get( 'https://api.teamtailor.com/v1/locations/',$teamtailor_auth );
$locations_body = wp_remote_retrieve_body( $locations );
$locations_data = json_decode( $locations_body );

$departments_list = array();
$locations_list = array();

// print_r($departments_data);

foreach( $jobs_data->data as $job ) {
	if(!in_array($job->relationships->department->data->id, $departments_list, true)){
		array_push($departments_list, $job->relationships->department->data->id);
	};
	if(!in_array($job->relationships->locations->data[0]->id, $locations_list, true)){
		array_push($locations_list, $job->relationships->locations->data[0]->id);
	};
};
get_header(); ?>

<?php if( ! empty( $jobs_data ) ) :?>
<section id="jobs" data-midnight="half-white">
	<div class="jobs-list-header">
			<div class="grid-container">
				<div class="grid-x">
					<div class="small-12 medium-5 medium-offset-2 cell" data-aos="fade-down" data-aos-offset="0" data-aos-duration="200" data-aos-delay="200">
						<h3 class="job-title">De qué quieres trabajar:</h3>
						<div class="departments">
							<?php //print_r($departments_list);?>
							<?php foreach( $departments_data->data as $department ):?>
								<?php if(in_array($department->id,$departments_list)):?>
								<div class="department<?php if($department->id == $department_id): echo ' active'; endif;?>"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Jobs' ) ) ); ?>?department_id=<?php echo $department->id;?>"><?php echo $department->attributes->name;?></a></div>
								<?php endif;?>
							<?php endforeach;?>
							<?php if($department_id):?>
								<div class="department all"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Jobs' ) ) ); ?>"><i class="fal fa-times"></i></a></div>
							<?php endif;?>
						</div>
					</div>
					<div class="small-12 medium-5 cell" data-aos="fade-down" data-aos-offset="0" data-aos-duration="200" data-aos-delay="400">
						<h3 class="job-title">Dónde quieres trabajar:</h3>
						<div class="departments">
							
							<?php foreach( $locations_data->data as $location ):?>
								<?php if(in_array($location->id,$locations_list)):?>
								<div class="department<?php if($location->id == $location_id): echo ' active'; endif;?>"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Jobs' ) ) ); ?>?location_id=<?php echo $location->id;?>"><?php echo $location->attributes->city;?></a></div>
								<?php endif;?>
							<?php endforeach;?>
							
							<?php if($location_id):?>
								<div class="department all"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Jobs' ) ) ); ?>"><i class="fal fa-times"></i></a></div>
							<?php endif;?>
						</div>
					</div>
				</div>
			</div>
		</div>
  <div class="grid-container">
    <div id="jobs-list" class="grid-x grid-margin-x" data-equalizer="description">

			<?php 
				if(count($jobs_data->data) > 0):
				$delay = 300;
				foreach( $jobs_data->data as $job ):
				$job_department = wp_remote_get( 'https://api.teamtailor.com/v1/departments/'.$job->relationships->department->data->id,$teamtailor_auth );
				$job_department_body = wp_remote_retrieve_body( $job_department );
				$job_department_data = json_decode( $job_department_body );

				$job_location = wp_remote_get( 'https://api.teamtailor.com/v1/locations/'.$job->relationships->locations->data[0]->id,$teamtailor_auth );
				$job_location_body = wp_remote_retrieve_body( $job_location );
				$job_location_data = json_decode( $job_location_body );
				?>
				<div class="small-12 medium-4 large-4 cell" data-aos="fade-up" data-aos-offset="0" data-aos-duration="200" data-aos-delay="<?php echo $delay;?>">
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
			<?php 
				$delay = $delay + 100;
				endforeach;
				else:?>
				<div class="small-12 medium-4 large-4 cell no-results" data-aos="fade-up" data-aos-offset="100" data-aos-duration="200" data-aos-delay="300">
					<div class="card">
						
						<div class="card-content">
							<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Jobs' ) ) ); ?>">
								<div class="card-header">
									<h5><?php _e('No hay ofertas disponibles','bestaffers');?></h5>
								</div>
								<div class="description">
									<?php _e('En estos momentos no hay ninguna vacante en esta categoría. Prueba en otra o muestra todas las ofertas.','bestaffers');?>
								</div>
							</a>
						</div>
						
						
							
						<div class="card-link">
							<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Jobs' ) ) ); ?>"><span class="triangle"><i class="fal fa-plus"></i></span></a>
						</div>
						
					</div>
				</div>
				<?php endif;?>
		</div>
  </div>
</section>
<?php endif;?>
<?php get_template_part( 'template-parts/footer-section' ); ?>
<?php get_footer();