<?php
/**
 * Template Name: Layout: Message page
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
    <div class="content-area_site">
        <div class="center_blocking2">
            <div class="form_go_message">
                <div class="form_go_message">
                    <form action= "<?php bloginfo(template_url); ?>/page-templates/template-posts.php" method= "POST">
                        <div class="form_imail_refins">
                            <span>Subject</span>
                            <input name= "name" type="text" class="title_message">
                        </div>
                        <div class="form_imail_refins">
                            <span>Message</span>
                            <textarea  name= "message" placeholder="Message..." class="title_message_body"></textarea>
                        </div>
                        <div class="form_imail_refins_btt">
                            <input type= "submit" class="dutting_resolt" value= "Submit">
                        </div>



                    </form>



                </div>
            </div>

        </div>
    </div>
</div>

 

<?php get_footer(); ?>
