<?php
/**
 * Template Name: Layout: New Form
 *
 * @package Listify
 */

get_header(); ?>

<link rel="stylesheet" href="/wp-content/themes/listify-child/style.css" type="text/css" media="all">
<script type="text/javascript" src="/wp-content/themes/listify/js/form_js.js"></script>
<script src="https://use.fontawesome.com/9ea45ce4ff.js"></script>



<div <?php echo apply_filters( 'listify_cover', 'page-cover', array( 'size' => 'full' ) ); ?>>
    <h1 class="page-title cover-wrapper"><?php the_post(); the_title(); rewind_posts(); ?></h1>
</div>

<?php do_action( 'listify_page_before' ); ?>

<div id="primary" class="container_one">
    <div class="content-area_site">

        <div class="center_blocking">
            <div class="center_blocking_stepone">

                <div class="form_custom_all_one">
                    <div class="input_a_enter_title">
                        <h2>What kind of location is it?</h2>
                    </div>

                    <div class="input_a_enter_title_selected">
                        <div class="input_a_enter_title_selected_residential">
                            Residential
                        </div>
                        <div class="input_a_enter_title_selected_commercial">
                            Commercial
                        </div>

                    </div>
                </div>



                <div class="form_custom_all_two">


                    <div class="goinput_a_enter_one_blocks">
                        <h5>What type of location?</h5>

                        <?php
                        query_posts(array(
                            'post_type' => 'movies',
                            'showposts' => 100,
                            'category_name' => 'residential',
                            'order' => 'ASC'
                        ) );
                        ?>
                        <?php while (have_posts()) : the_post();
                            $image_src = get_the_post_thumbnail_url();
                            if($image_src == ''){
                            ?>
                            <a href="#ex1" rref="<?php the_title(); ?>" class="input_a_enter_one_blocks_all hover_none">
                                <div class="image_thembion"
                                     style="
                                             background-size: cover !important;
                                             background-position: 50% 50% !important;
                                             background: url(http://www.setfinder.co/wp-content/uploads/2017/08/photo.jpg)"></div>


                                <div class="input_a_ent_center">
                                    <span><?php the_title(); ?></span>
                                </div>
                            </a>
                            <?php

                            }
                            if($image_src != ''){
                                ?>
                                <a href="#ex1" rref="<?php the_title(); ?>" class="input_a_enter_one_blocks_all hover_none">
                                    <div class="image_thembion"
                                         style="
                                                 background-size: cover !important;
                                                 background-position: 50% 50% !important;
                                                 background: url(<?php echo $image_src; ?>)"></div>


                                    <div class="input_a_ent_center">
                                        <span><?php the_title(); ?></span>
                                    </div>
                                </a>
                                <?php

                            }
                            ?>

                        <?php endwhile;?>


                    </div>
                    <div class="goinput_a_enter_two_blocks">
                        <h5>What type?</h5>


                        <?php
                        query_posts(array(
                            'post_type' => 'movies',
                            'showposts' => 100,
                            'category_name' => 'commercial',
                            'order' => 'ASC'
                        ) );
                        ?>
                        <?php while (have_posts()) : the_post();
                            $image_src = get_the_post_thumbnail_url();
                            if($image_src == ''){
                                ?>
                                <a href="#ex1" rref="<?php the_title(); ?>" class="input_a_enter_one_blocks_all hover_none">
                                    <div class="image_thembion"
                                         style="
                                             background-size: cover !important;
                                             background-position: 50% 50% !important;
                                             background: url(http://www.setfinder.co/wp-content/uploads/2017/08/photo.jpg)">

                                    </div>

                                    <div class="input_a_ent_center">
                                        <span><?php the_title(); ?></span>
                                    </div>
                                </a>
                                <?php

                            }
                            if($image_src != ''){
                                ?>
                                <a href="#ex1" rref="<?php the_title(); ?>" class="input_a_enter_one_blocks_all hover_none">
                                    <div class="image_thembion"
                                         style="
                                                 background-size: cover !important;
                                                 background-position: 50% 50% !important;
                                                 background: url(<?php echo $image_src; ?>)"></div>



                                    <div class="input_a_ent_center">
                                        <span><?php the_title(); ?></span>
                                    </div>
                                </a>
                                <?php

                            }
                            ?>

                        <?php endwhile;?>

                    </div>
                </div>
                <div class="form_custom_all_three">
                    <div class="input_a_enter">

                    </div>
                </div>

            </div>
            <div class="form_custom_all_one_add_dop">
                <h5>What type of location?</h5>
                <div class="input_a_e_selected">
                    <?php
                    query_posts(array(
                        'post_type' => 'movies',
                        'showposts' => 100,
                        'category_name' => 'additionally',
                        'order' => 'ASC'
                    ) );
                    ?>
                    <?php while (have_posts()) : the_post();
                        $image_src = get_the_post_thumbnail_url();
                        if($image_src == ''){
                            ?>
                            <a href="#ex1" rref="<?php the_title(); ?>" class="input_a_enter_one_blocks_all hover_none">
                                <div class="image_thembion"
                                     style="
                                             background-size: cover !important;
                                             background-position: 50% 50% !important;
                                             background: url(http://www.setfinder.co/wp-content/uploads/2017/08/photo.jpg)"></div>


                                <div class="input_a_ent_center">
                                    <span><?php the_title(); ?></span>
                                </div>
                            </a>
                            <?php

                        }
                        if($image_src != ''){
                            ?>
                            <a href="#ex1" rref="<?php the_title(); ?>" class="input_a_enter_one_blocks_all hover_none">
                                <div class="image_thembion"
                                     style="
                                             background-size: cover !important;
                                             background-position: 50% 50% !important;
                                             background: url(<?php echo $image_src; ?>)"></div>


                                <div class="input_a_ent_center">
                                    <span><?php the_title(); ?></span>
                                </div>
                            </a>
                            <?php

                        }
                        ?>

                    <?php endwhile;?>



                </div>
            </div>
            <div class="center_blocking_steptwo">
                <h2>Location details.</h2>

                <div class="input_select_self">
                    <div role="form" class="location-details-form-js become-host-onboard-form">


                        <div class="become-host-onboard-section-location-details group int-val ft-size form-group-big">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">Number of bedrooms</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                        <input type="number" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="become-host-onboard-section-location-details group int-val ft-size ">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">Number of bathrooms</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                       <input type="number" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="become-host-onboard-section-location-details group int-val ft-size">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">Property size (sq ft)</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                       <input type="number" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="become-host-onboard-section-location-details group int-val ft-size ">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">Lot size (sq ft)</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                        <input type="number" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="become-host-onboard-section-location-details group int-val ft-size ">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">Main floor number (if applicable)</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                        <input type="number" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>







                    </div>
                </div>


            </div>
            <div class="center_blocking_stepthree">

                <h2>Add your property name</h2>

                <div class="input_select_self">
                    <div role="form" class="location-details-form-js become-host-onboard-form">


                        <div class="become-host-onboard-section-location-details group int-val ft-size form-group-big">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">Name</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                        <input type="text" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="become-host-onboard-section-location-details group int-val ft-size ">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">E-mail</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                       <input type="email" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="become-host-onboard-section-location-details group int-val ft-size ">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">Phone</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                       <input type="phone" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="become-host-onboard-section-location-details group int-val ft-size ">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">Pictures</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                       <input type="file" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="become-host-onboard-section-location-details group int-val ft-size ">
                            <div class="row row__def">
                                <div class="col-xs-8 become-host-onboard-col">
                                    <label class="form-label ">Keywords</label>
                                    <span class="ui-spinner ui-corner-all ui-widget ui-widget-content" style="height: 48px;">
                                       <input type="text" maxlength="99" minlength="0">
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="center_blocking_stepthree">



            </div>
            <div class="center_blocking_stepfour">

                <?php

                if ( is_user_logged_in() ) {
                    echo 'Вы авторизованы на сайте!';
                    ?>
                    <h2> Great progress,
                        <?php
                        global $current_user;
                        echo $current_user->display_name;
                        ?>
                    </h2>
                    <?php
                }
                else {
                    ?>
                    <h2> Great progress!
                    </h2>
                    <?php
                    wp_login_form();
                }
                ?>

            </div>
        </div>
    </div>
        <div class="line_progress">
            <div class="line_prg_all_green">
                <div class="line_prg_all_green_step1">

                </div>
                <div class="line_prg_all_green_step2">

                </div>
                <div class="line_prg_all_green_step3">

                </div>
            </div>

            <div class="line_prg_all_greenback_center">
                <div class="line_prg_all_greenback">
                    <div class="line_prg_all_greenback_btt">
                        <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back
                    </div>
                </div>

                <div class="line_prg_all_greennext">
                    <div class="line_prg_all_greenback_bttnext  next_step_one" id="ex1">

                    Next
                    </div>
                    <div class="line_prg_all_greenback_bttnextnext_step_fin">
                        Finish
                    </div>
                </div>
            </div>

        </div>


</div>

<?php get_footer(); ?>
