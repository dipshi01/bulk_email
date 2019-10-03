<?php
/**
 * Template Name: LECTURES
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Canyon Themes
 * @subpackage Canyon
 */

get_header();



$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
while ( have_posts() ) : the_post();

$query = new WP_Query( array('post_type' => array('Videos', 'Articles', 'pdf&docs'), 'posts_per_page' =>4,'paged'=> $paged));

$posts = $query->posts;
?>

<section class="bg-page-header">
        <div class="page-header-overlay">
        <div class="container">
                <div class="row">
                <div class="page-header">
                        <div class="page-header-content ">
                        <div class="breadcrumb">
                             <nav role="navigation" class="breadcrumb-trail breadcrumbs" >
                             <ul class="trail-items" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                                <li class="trail-item trail-begin">
                                        <a href="<?php echo site_url() ?>" ><span itemprop="name">Home</span></a>
                                </li>
                                <li class="trail-item trail-end">
                                        <span itemprop="name">Lectures</span><meta itemprop="position" content="2">
                                </li>
                             </ul>
                             </nav>
                        </div>
                        </div>
                </div>
                </div>
        </div>
        </div>
</section>
<br><br>

<div class= "container">
<div class= "container-fluid">
<div class= "row">
  <div class= "col-md-9"> <?php
foreach($posts as $post) { ?>
    <div class="cpt" style="background: #f3f3f3 !important; margin-bottom:45px;">
                <div class="entry-content" style="padding:15px;">
                    <h4 class="pull-left title" >
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <p class="pull-right" style="margin-top:7.5px;" ><i class="fa fa-calendar" ></i> <?php echo date("d M - ", strtotime($post->post_date)); ?> <?php echo date("h:i A", strtotime($post->post_time)); ?></p>
                    <div class="clearfix"></div>
                    <div><?php echo $post->post_content; ?> <a href="#" >read more</a></div>
                </div>
            </div> 
            <?php 
             }
                echo '<div class="container class="clearfix">';
                echo '<div class="pagination"class="clearfix">';
                if (function_exists("pagination")) {
                    pagination($query->max_num_pages);
                } 
                echo '</div>';
                echo '</div>';
             ?> 
             </div> 
             
             <div class= "col-md-3"><?php get_sidebar('members'); ?></div>     
 </div>
</div>
</div>
<?php


endwhile;
get_footer();




