<?php
/**
 * The template for displaying all single job
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
$job_slug = basename($_SERVER['REQUEST_URI']);
// echo $job_slug;
$teamtailor_auth = array(
	'headers'     => array(
			'Authorization' => 'Token ' . 'D_VGMEO0q8xx-jaEVrfez4_ks_O2RkxvKaSL495i',
			'X-Api-Version' => '20161108'
	),
);

$jobs_request = wp_remote_get( 'https://api.teamtailor.com/v1/jobs/'.$job_slug,$teamtailor_auth );
if( is_wp_error( $jobs_request ) ) {
	return false;
}
$jobs_body = wp_remote_retrieve_body( $jobs_request );

$jobs_data = json_decode( $jobs_body );
$job_url = 'careersite-job-url';

print_r($jobs_data);
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', '' ); ?>
				<?php the_post_navigation(); ?>
				<?php comments_template(); ?>a
			<?php endwhile; ?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer();
