<?php
/**
 * Modify listing search behavior.
 *
 * @since 2.0.0
 *
 * @package Listing Labels
 * @category Frontend
 * @author Astoundify
 */

namespace Astoundify\WPJobManager\ListingLabels;

// Do not access this file directly.
if ( ! defined( 'ABSPATH' ) ) {
	wp_die();
}

/**
 * Admin-specific functionality.
 *
 * @since 2.0.0
 */
class Listings {

	/**
	 * Hook in to WordPress
	 *
	 * @since 2.0.0
	 */
	public static function register() {
		// Add new args in [jobs] shortcode "show_tags"/"show_labels" (default to true).
		add_filter( 'job_manager_output_jobs_defaults', array( __CLASS__, 'output_jobs_defaults' ) );

		// If enable (as default), add it at the end of filter form.
		add_action( 'job_manager_job_filters_search_jobs_end', array( __CLASS__, 'show_labels_filter' ) );

		// Add hidden input "listing_label[]" & "is_listing_label" if in label archive page.
		add_action( 'job_manager_job_filters_end', array( __CLASS__, 'job_manager_job_filters_end' ) );

		// Get all active labels in job query.
		add_filter( 'job_manager_get_listings_args', array( __CLASS__, 'job_manager_get_listings_args' ) );

		// Display label filter with only labels found in posts.
		add_filter( 'job_manager_get_listings_result', array( __CLASS__, 'job_manager_get_listings_result' ) );

		// Apply search by tax by modify query args.
		add_filter( 'job_manager_get_listings', array( __CLASS__, 'apply_label_filter' ), 10, 2 );

		// Output frontend.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'wp_enqueue_scripts' ) );
	}

	/**
	 * Change default [jobs] shortcode attributes.
	 *
	 * @since 2.0.0
	 *
	 * @param array $atts Shortcode attributes.
	 * @return array $atts
	 */
	public static function output_jobs_defaults( $atts ) {
		$atts['show_tags'] = true;
		$atts['show_labels'] = true;
		$atts['listing-labels'] = false;

		return $atts;
	}

	/**
	 * Display a list of labels at the end of the filters.
	 *
	 * @param array $atts Shortcode attributes.
	 * @return void
	 */
	public static function show_labels_filter( $atts ) {
		if ( isset( $atts['show_labels'] ) && ( false === $atts['show_labels'] || false === (string) $atts['show_labels'] ) ) {
			return;
		}

		if ( 0 === wp_count_terms( astoundify_wpjmll_taxonomy() ) ) {
			return;
		}

		wp_enqueue_script( 'astoundify-wp-job-manager-listing-labels' );
?>

<div class="filter_wide filter_by_tag astoundify-listing-labels">
	<?php esc_html_e( 'Subcategories:', 'wp-job-manager-listing-labels' ); ?>
	<span class="filter_by_tag_cloud astoundify-listing-labels-cloud"></span>

	<?php
	// Auto select listing labels using shortcode args.
	if ( isset( $atts['listing-labels'] ) && $atts['listing-labels'] ) {
		$labels = explode( ',', $atts['listing-labels'] );
		foreach ( $labels as $label ) {
			$term = get_term_by( 'name', esc_attr( trim( $label ) ), astoundify_wpjmll_taxonomy() );

			if ( $term ) { // Make sure labels exists.
				echo '<input type="hidden" name="listing_label[]" value="' . esc_attr( $term->name ) . '" />';
			}
		}
	}
	?>
</div>

<?php
	}

	/**
	 * When on a label taxonomy archive page hide the filters and
	 * create hidden fields to pass the data.
	 *
	 * @since 2.0.0
	 *
	 * @param array $atts Shortcode attributes.
	 * @return void
	 */
	public static function job_manager_job_filters_end( $atts ) {
		if ( is_tax( astoundify_wpjmll_taxonomy() ) ) { // In taxomy archive.
			$queried_object = get_queried_object();
			echo '<input type="hidden" name="is_listing_label" value="1" />';
			echo '<input type="hidden" name="listing_label[]" value="' . esc_attr( $queried_object->name ) . '" />';
		}
	}

	/**
	 * Hook in to the [jobs] shortcode and create a list of tags
	 * that remain active based on the results of the other filters.
	 *
	 * @since 2.0.0
	 *
	 * @param array $args Shortcode arguments.
	 * @return array $args
	 */
	public static function job_manager_get_listings_args( $args ) {
		global $astoundify_wpjmll_active_labels;

		$astoundify_wpjmll_active_labels = array();

		$temp_args = array(
			'search_keywords'   => '',
			'search_location'   => '',
			'search_categories' => array(),
			'job_types'         => array(),
			'offset'            => '',
		);

		$temp_args = wp_parse_args( $args, $temp_args );

		// Only attempt if there are args.
		if ( ! $temp_args['offset'] && ( $temp_args['search_keywords'] || $temp_args['search_location'] || $temp_args['search_categories'] || $temp_args['job_types'] ) ) {

			// Fetch active labels for first 100 results.
			$temp_args['posts_per_page'] = 100;
			$temp_args['fields'] = 'ids';

			// Query again with new arguments so we can check active tags.
			$get_jobs = get_job_listings( $temp_args );

			if ( 99 < intval( $get_jobs->post_count ) ) {
				return $args;
			}

			// Check...
			if ( $get_jobs->have_posts() ) {
				while ( $get_jobs->have_posts() ) {
					$get_jobs->the_post();

					$terms = get_the_terms( get_the_ID(), astoundify_wpjmll_taxonomy() );

					if ( $terms ) {
						$terms = wp_list_pluck( $terms, 'term_id' );

						foreach ( $terms as $term ) {
							$astoundify_wpjmll_active_labels[] = intval( $term );
						}
					}
				}
			}
		}

		$astoundify_wpjmll_active_labels = array_unique( $astoundify_wpjmll_active_labels );

		return $args;
	}

	/**
	 * Return a label cloud to the AJAX request.
	 *
	 * @param array $results Found result data.
	 * @return array
	 */
	public static function job_manager_get_listings_result( $results ) {
		if ( isset( $_REQUEST['form_data'] ) ) {
			wp_parse_str( wp_unslash( $_REQUEST['form_data'] ), $params );

			if ( isset( $params['is_listing_label'] ) ) {
				return $results;
			}
		}

		// Global active labels.
		global $astoundify_wpjmll_active_labels;

		if ( ! isset( $astoundify_wpjmll_active_labels ) ) {
			$astoundify_wpjmll_active_labels = null;
		}

		$html = '';

		$atts = array(
			'smallest'                  => 1,
			'largest'                   => 1,
			'unit'                      => 'em',
			'number'                    => 0,
			'format'                    => 'flat',
			'separator'                 => "\n",
			'orderby'                   => astoundify_wpjmll_cloud_orderby(),
			'order'                     => astoundify_wpjmll_cloud_order(),
			'exclude'                   => null,
			'include'                   => $astoundify_wpjmll_active_labels,
			'link'                      => 'view',
			'taxonomy'                  => astoundify_wpjmll_taxonomy(),
			'echo'                      => false,
			'topic_count_text_callback' => 'astoundify_wpjmll_tag_cloud_text_callback',
		);

		$html = wp_tag_cloud( apply_filters( 'astoundify_wpjmll_filter_tag_cloud', $atts ) );

		$results['listing_labels_filter'] = $html;

		return $results;
	}

	/**
	 * Apply a filter to the WP_Query.
	 *
	 * @since 2.0.0
	 *
	 * @param array $query_args Current WP_Query arguments.
	 * @param array $args Current [jobs] shortcode arguments.
	 * @return array $query_args
	 */
	public static function apply_label_filter( $query_args, $args ) {
		if ( isset( $_REQUEST['form_data'] ) ) {
			$params = array();

			wp_parse_str( wp_unslash( $_REQUEST['form_data'] ), $params );

			if ( isset( $params['listing_label'] ) ) {
				$labels = array_filter( $params['listing_label'] );
				$_labels = array();

				foreach ( $labels as $label ) {
					$label = get_term_by( 'name', esc_attr( $label ), astoundify_wpjmll_taxonomy() );
					if ( $label ) {
						$_labels[] = $label->slug;
					}
				}

				if ( $_labels ) {
					$query_args['tax_query'][] = array(
						'taxonomy' => astoundify_wpjmll_taxonomy(),
						'field'    => 'slug',
						'terms'    => $_labels,
						'operator' => 'any' === get_option( 'job_manager_tags_filter_type', 'any' ) ? 'IN' : 'AND',
					);
				}
			}
		} elseif ( ! empty( $args['search_tags'] ) ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => astoundify_wpjmll_taxonomy(),
				'field'    => 'slug',
				'terms'    => $args['search_tags'],
				'operator' => 'any' === get_option( 'job_manager_tags_filter_type', 'any' ) ? 'IN' : 'AND',
			);
		} elseif ( ! empty( $args['search_labels'] ) ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => astoundify_wpjmll_taxonomy(),
				'field'    => 'slug',
				'terms'    => $args['search_labels'],
				'operator' => 'any' === get_option( 'job_manager_tags_filter_type', 'any' ) ? 'IN' : 'AND',
			);
		} // End if().

		return $query_args;
	}

	/**
	 * Frontend scripts.
	 *
	 * @since 2.0.0
	 */
	public static function wp_enqueue_scripts() {
		wp_register_script( 'astoundify-wp-job-manager-listing-labels', ASTOUNDIFY_WPJMLL_URL . 'public/js/listing-labels.min.js', array( 'jquery' ), ASTOUNDIFY_WPJMLL_VERSION, true );
	}

}
