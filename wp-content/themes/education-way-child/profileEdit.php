
<?php /* Template Name: ProfileEdit */ ?>
 
<?php get_header(); ?>
 
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="row">
                <div class="col-md-3 col-sm-3"></div>
                <div class="col-md-3 col-sm-3">
                <?php echo do_shortcode("[user_profile_edit]"); ?>
</div>
        </div>
 
    </main><!-- .site-main -->
 
    <?php get_sidebar( 'content-bottom' ); ?>
 
</div><!-- .content-area -->
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>
