<?php
/**
 * Template Name: Layout: New Page
 *
 * @package Listify
 */

get_header(); ?>

<link rel="stylesheet" href="\wp-content\themes\listify-child\style.css" type="text/css" media="all">

<div <?php echo apply_filters( 'listify_cover', 'page-cover', array( 'size' => 'full' ) ); ?>>
    <h1 class="page-title cover-wrapper"><?php the_post(); the_title(); rewind_posts(); ?></h1>
</div>

<?php do_action( 'listify_page_before' ); ?>

<div id="primary" class="container_one">
    <div class="content-area">

        <div class="container-fluid">
            <div class="row row-height-sm">
                <div class="col-sm-6 col-height-sm no-gutter insurance-img-container col-middle">
                    <div class="text-center insurance-heading-container"> 
                        <h3>$1,000,000 liability coverage</h3>
                    </div>
                </div>
                <div class="col-sm-6 text-xs-center text-sm-left insurance-text col-height-sm col-middle">
                    <div class="row">
                        <div class="col-sm-8 insurance-info-col">
                            <h2>Peace of mind. Every time.</h2>
                            <h4>
                               <?php
                               the_content();
                               ?>
                            </h4>
                            <br>
                            <a href="#">
                                <button class="btn btn-sm btn-success classic" type="button" name="button">Learn More</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
