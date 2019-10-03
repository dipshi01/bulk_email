<?php
/**
 * Template Name: LOGIN-SIGNUP
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Canyon Themes
 * @subpackage Canyon
 */
 
if(is_user_logged_in()){
     wp_redirect(site_url().'/account');
}


        
 
get_header();

while ( have_posts() ) : the_post();

    echo do_shortcode('[lrm_form default_tab="login" logged_in_message="You have been already logged in!"]');

endwhile; // End of the loop.

get_footer();
