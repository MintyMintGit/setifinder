<?php
/**
 * Listify child theme.
 */
 @ini_set( 'upload_max_size' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'max_execution_time', '600' );

function listify_child_styles() {
    wp_enqueue_style( 'listify-child', get_stylesheet_uri() );
    wp_enqueue_script( 'geocomplete_js', get_template_directory_uri() . '/js/jquery.geocomplete.min.js', array( 'jquery' ), '1.0', true );

    // TODO: specify only for listify single template
    wp_enqueue_script( 'listify-single-js', get_stylesheet_directory_uri() . '/js/listify-single.js', array( 'jquery' ), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'listify_child_styles', 999 );

add_filter( 'submit_job_form_fields', 'scustom_submit_job_form_fields',9999999999 );

// This is your function which takes the fields, modifies them, and returns them
// You can see the fields which can be changed here: https://github.com/mikejolley/WP-Job-Manager/blob/master/includes/forms/class-wp-job-manager-form-submit-job.php
function scustom_submit_job_form_fields( $fields ) {
$user_id = get_current_user_id();
  $user = get_userdata( $user_id );
 
  if ( !$user )
    return;
 
  $phone = get_user_meta( $user_id, 'phone', true );
  
    // Here we target one of the job fields (job_title) and change it's label
    $fields['job']['job_title']['label'] = "Property Name";
    $fields['job']['job_title']['placeholder'] = "Your Property Name";
    $fields['job']['phone']['value'] = $phone;
    $fields['job']['job_category']['label'] = "Property Category";
    $fields['job']['job_tags']['label'] = "Sub Categories";
    $fields['job']['job_region']['label'] = "Property Region";
     $fields['job']['job_category']['priority'] = 2;
   $fields['job']['job_tags']['priority'] = 3;
     $fields['job']['job_location']['priority'] = 4;
      $fields['job']['job_region']['priority'] = 5;
           $fields['job']['application']['priority'] = 6;
       
       $fields['job']['gallery_images']['priority'] = 9;
      $fields['job']['featured_image']['priority'] = 10;
       $fields['job']['job_description']['priority'] = 11;

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
            if(isset($values['job']['address'] )) { 
                //s$values['job']['address']
                update_post_meta($job_id,'geolocation_formatted_address',$values['job']['address']); 
                        
            } 
            
            else { update_post_meta($job_id,'geolocation_formatted_address','Value not set'); }
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
        
        $fields['job']['address'] = array(
	    'label' => __( 'Address', 'job_manager' ),
	    'type' => 'text',
	    'required' => true,
	    'placeholder' => '',
	    'priority' => 8
	);
        $fields['job']['lng'] = array(
	    'label' => __( 'Longitude', 'job_manager' ),
	    'type' => 'text',
	    'required' => false,
	    'placeholder' => '',
	    'priority' => 13
	);
        $fields['job']['lat'] = array(
	    'label' => __( 'Latitude', 'job_manager' ),
	    'type' => 'text',
	    'required' => false,
	    'placeholder' => '',
	    'priority' => 14
	);

	return $fields;
	
}

add_action( 'job_manager_update_job_data', 'save_addresses', 100,2);
function save_addresses($job_id, $values){
    $address = $values[ 'job' ][ 'address' ];
	
			update_post_meta( $job_id, 'geolocation_formatted_address', $address );
 $lat = $values[ 'job' ][ 'lat' ];
 update_post_meta( $job_id, 'geolocation_lat', $lat );
 $lng = $values[ 'job' ][ 'lng' ];
 update_post_meta( $job_id, 'geolocation_long', $lng );
			
		}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_salary_field' );
function admin_add_salary_field( $fields ) {
  $fields['geolocation_formatted_address'] = array(
    'label'       => __( 'formatted_address', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => 'e.g. 20000',
    'description' => ''
  );
  return $fields;
}
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>
<h3>Extra profile information</h3>
    <table class="form-table">
<tr>
            <th><label for="phone">Phone Number</label></th>
            <td>
            <input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your phone number.</span>
            </td>
</tr>
</table>
<?php }
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) )
    return false;

update_usermeta( $user_id, 'phone', $_POST['phone'] );
}
function wooc_extra_register_fields() {?>
       <p class="form-row form-row-wide">
       <label for="phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
       <input type="text" class="input-text" name="phone" id="phone" value="<?php esc_attr_e( $_POST['phone'] ); ?>" />
       </p>

       <div class="clear"></div>
       <?php
 }
 add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );
 function save_address($user_id)
{
    global $woocommerce;
  
   
    // Condition to add firstname and last name to user meta table
    
    //$new_key = explode('billing_',$key);
    update_user_meta( $user_id, phone, $_POST['phone'] );
    
  
   

}
add_action('woocommerce_created_customer','save_address', 10, 3);
add_action( 'woocommerce_edit_account_form', 'my_woocommerce_edit_account_form' );
add_action( 'woocommerce_save_account_details', 'my_woocommerce_save_account_details' );
 
function my_woocommerce_edit_account_form() {
 
  $user_id = get_current_user_id();
  $user = get_userdata( $user_id );
 
  if ( !$user )
    return;
 
  $phone = get_user_meta( $user_id, 'phone', true );
  
 
  ?>
 
  <fieldset>

    <p class="form-row form-row-thirds">
      <label for="twitter">Phone:</label>
      <input type="text" name="phone" value="<?php echo esc_attr( $phone ); ?>" class="input-text" />
    </p>
  </fieldset>

 
  <?php
 
}
 
function my_woocommerce_save_account_details( $user_id ) {
 
  update_user_meta( $user_id, 'phone', htmlentities( $_POST[ 'phone' ] ) );
   
 
}