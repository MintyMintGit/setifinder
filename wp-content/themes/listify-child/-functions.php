<?php
/**
 * Listify child theme.
 */
 @ini_set( 'upload_max_size' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'max_execution_time', '600' );

function listify_child_styles() {
    wp_enqueue_style( 'listify-child', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'listify_child_styles', 999 );

add_filter( 'submit_job_form_fields', 'scustom_submit_job_form_fields',9999999999 );

// This is your function which takes the fields, modifies them, and returns them
// You can see the fields which can be changed here: https://github.com/mikejolley/WP-Job-Manager/blob/master/includes/forms/class-wp-job-manager-form-submit-job.php
function scustom_submit_job_form_fields( $fields ) {

    // Here we target one of the job fields (job_title) and change it's label
    $fields['job']['job_tags']['label'] = "Sub Categories";
     $fields['job']['job_category']['priority'] = 2;
   $fields['job']['job_tags']['priority'] = 3;
     $fields['job']['job_location']['priority'] = 4;
      $fields['job']['job_region']['priority'] = 5;
           $fields['job']['application']['priority'] = 6;
       
       $fields['job']['gallery_images']['priority'] = 8;
      $fields['job']['featured_image']['priority'] = 9;
       $fields['job']['job_description']['priority'] = 10;

    // And return the modified fields
    return $fields;
}
// Add your own function to filter the fields
add_filter( 'submit_job_form_fields', 'remove_listify_submit_job_form_fields', 9999999999 );
// This is your function which takes the fields, modifies them, and returns them
// You can see the fields which can be changed here: https://github.com/mikejolley/WP-Job-Manager/blob/master/includes/forms/class-wp-job-manager-form-submit-job.php
function remove_listify_submit_job_form_fields( $fields ) {
    if( ! isset( $fields['job'] ) ) return $fields;
    // If phone, company_website, or company_video fields exist in company array, remove them
    if( isset( $fields['job']['job_hours'] ) ) unset( $fields['job']['job_hours']);
    if( isset( $fields['company']['company_website'] ) ) unset( $fields['company']['company_website']);
    if( isset( $fields['company']['company_video'] ) ) unset( $fields['company']['company_video']);
    if( isset( $fields['company']['company_linkedin'] ) ) unset( $fields['company']['company_linkedin']);
    if( isset( $fields['company']['company_github'] ) ) unset( $fields['company']['company_github']);
    if( isset( $fields['company']['company_instagram'] ) ) unset( $fields['company']['company_instagram']);
    if( isset( $fields['company']['company_pinterest'] ) ) unset( $fields['company']['company_pinterest']);
    if( isset( $fields['company']['company_facebook'] ) ) unset( $fields['company']['company_facebook']);
     if( isset( $fields['company']['company_googleplus'] ) ) unset( $fields['company']['company_googleplus']);
        if( isset( $fields['company']['company_twitter'] ) ) unset( $fields['company']['company_twitter']);
         if( isset( $fields['company']['phone'] ) ) unset( $fields['company']['phone']);
    if( isset( $fields['job']['featured_image'] ) ) unset( $fields['job']['featured_image']);
           $fields['job']['gallery_images']['required'] = true;
       //$fields['company']['phone']['priority']=7;
    // And return the modified fields
    return $fields;
}
add_filter( 'submit_job_form_fields', 'resume_file_required' );

// This is your function which takes the fields, modifies them, and returns them
function resume_file_required( $fields ) {

    // Here we target one of the job fields (candidate name) and change it's label
    $fields['job']['job_location']['required'] = false;
   
     $fields['job']['job_location']['description'] = 'Recommended for more search results';   

    // And return the modified fields
    return $fields;
}
function my_wpcf7_dropdown_form($html) {
	$text = 'Please select...';
	$html = str_replace('---', 'Please select...', $html);
	return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_dropdown_form');

// Add field to frontend
add_filter( 'submit_job_form_fields', 'wpjms_frontend_resume_form_fields' );
function wpjms_frontend_resume_form_fields( $fields ) {
	
	$fields['job']['phone'] = array(
	    'label' => __( 'Phone', 'job_manager' ),
	    'type' => 'text',
	    'required' => true,
	    'placeholder' => '',
	    'priority' => 7
	);

	return $fields;
	
}

