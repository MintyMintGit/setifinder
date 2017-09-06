<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Listify
 */
?>

	</div><!-- #content -->

</div><!-- #page -->

<div class="footer-wrapper">

	<?php if ( ! listify_is_job_manager_archive() ) : ?>

		<?php get_template_part( 'content', 'aso' ); ?>

		<?php if ( is_active_sidebar( 'widget-area-footer-1' ) || is_active_sidebar( 'widget-area-footer-2' ) || is_active_sidebar( 'widget-area-footer-3' ) ) : ?>

			<footer class="site-footer-widgets">
				<div class="container">
					<div class="row">

						<div class="footer-widget-column col-xs-12 col-sm-12 col-lg-5">
							<?php dynamic_sidebar( 'widget-area-footer-1' ); ?>
						</div>

						<div class="footer-widget-column col-xs-12 col-sm-6 col-lg-3 col-lg-offset-1">
							<?php dynamic_sidebar( 'widget-area-footer-2' ); ?>
						</div>

						<div class="footer-widget-column col-xs-12 col-sm-6 col-lg-3">
							<?php dynamic_sidebar( 'widget-area-footer-3' ); ?>
						</div>

					</div>
				</div>
			</footer>

		<?php endif; ?>

	<?php endif; ?>

	<footer id="colophon" class="site-footer">
		<div class="container">

			<div class="site-info">
				<?php echo listify_partial_copyright_text(); ?>
			</div><!-- .site-info -->

			<div class="site-social">
				<?php wp_nav_menu( array(
					'theme_location' => 'social',
					'menu_class' => 'nav-menu-social',
					'fallback_cb' => '',
					'depth' => 1
				) ); ?>
			</div>

		</div>
	</footer><!-- #colophon -->

</div>

<div id="ajax-response"></div>


<?php wp_footer(); ?>
<script>jQuery(document).ready(function(){
	jQuery("#search_location").val("Los Angeles, CA, USA");
	}); 
                 jQuery(function(){
        jQuery("#address").geocomplete({
                   details: "form",
          types: ["geocode", "establishment"],
        });

        
      });</script>

    <script>

//        jQuery( document ).ready(function() {
//            jQuery('script').each(function(indx, element) {
//
//                console.log(indx + " = " + element.src  );
//
//                if (this.src === "http://maps.googleapis.com/maps/api/js?libraries=geometry,places&language=en&key=%20AIzaSyDBFneZKMNXbbnu8DGnrSvuoDHXa1Dr2rY%20&region=us") {
//                    alert("Hello World!!!");
//                    this.remove();
//                    //this.parentNode.removeChild( this );
//                }
//            });
//        });
</script>
</body>
</html>
