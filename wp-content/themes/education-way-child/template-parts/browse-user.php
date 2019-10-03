<?php
/**
 * Template Name: BROWSE-USER
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Canyon Themes
 * @subpackage Canyon
 */


get_header();
$number   = 10;
$paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset   = ($paged - 1) * $number;
$users    = get_users();
$query    = get_users('&offset='.$offset.'&number='.$number);
$total_users = count($users);
$total_query = count($query);
$total_pages = intval($total_users / $number) + 1;

?> 

<section class="bg-page-header">
        <div class="page-header-overlay">
        <div class="container">
                <div class="row">
                <div class="page-header">
                                                  
                          <div class="page-title">
                            <h2>Profile</h2>
                          </div>

                        <div class="page-header-content ">
                        <div class="breadcrumb">
                             <nav role="navigation" class="breadcrumb-trail breadcrumbs" >
                             <ul class="trail-items" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                                <li class="trail-item trail-begin">
                                        <a href="<?php echo site_url() ?>" ><span itemprop="name">Home</span>
                                        </a>
                                </li>
                                <li class="trail-item trail-end">
                                        <span itemprop="name">Agents</span><meta itemprop="position" content="2">
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
<div class="container"> 
<div class="container"> 

        <h2 class="page_title" >Agents List</h2>
        <br>

        <div class="row">
                <div class="col-md-9" >
<?php 
//while ( have_posts() ) : the_post();
foreach ($query as $q) { ?>
        <div style="margin-bottom:2px; background-color:#EFEFEF; padding:15px;" >
                        
                        <span class="pull-left" style="max-width:50px;" ><?php echo get_avatar($q->user_email); ?></span>
                        
                        <a class="pull-left" style="margin-left:15px; font-weight:bold;" href="<?php echo site_url().'/account/?id='.$q->ID;?>" class="link" >
                                <?php 
                                        $u = new UP_User( $q->ID );
                                        $name = apply_filters( 'user_profile_filter_user_name', $u->display_name, $u );
                                        echo $name;
                                ?>
                        </a>
                        <br>
                        <span class="pull-left" style="margin-left:15px;" >
                        <?php echo $q->user_email ?>
                        </span>
                        <div class="clearfix"></div>
        </div>
<?php
}
?>
                </div> 
                <div class="col-md-3"><?php get_sidebar('members'); ?></div>

                <div class="col-md-12" >

                        <?php

                        echo '<div class="paginate custom-pagination">';
                                
                                $current_page = max(1, get_query_var('paged'));
                                echo paginate_links(array(
                                    'base' => get_pagenum_link(1) . '%_%',
                                    'format' => 'page/%#%/',
                                    'current' => $current_page,
                                    'total' => $total_pages,
                                    'prev_next'    => false,
                                    'type'         => 'list',
                                ));
                                
                        echo '</div>';


                ?> 

                </div>
        </div>
</div>
</div>
<?php


get_footer();
