<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Canyon Themes
 * @subpackage Canyon
 */

?>
<?php
        $posts = getTopPosts();
        if($posts){
?>
                <h3 class="widget-title">Most Viewed Articles</h3>
                <div class="sidebar-top-posts" >
                <ul>
                <?php foreach($posts as $p){ 
                        $p = get_post($p['post_id']);                        
                ?>
                        <li><a href="<?php echo get_the_permalink($p->ID) ?>" ><?php echo $p->post_title ?></a></li>
                <?php } ?>
                </ul>
                </div>
<?php
        }
?> 
<!-- ------------------------ -->
<!-- ------------------------ -->
<?php
        $users = getTopUsers();
        if($users){
?>
                <h3 class="widget-title">Top Users</h3>
                <div class="sidebar-top-posts" >
                <ul>
                <?php foreach($users as $u){ 
                        $u = new UP_User( $u['user_id']);
                        $name = apply_filters( 'user_profile_filter_user_name', $u->display_name, $u );
                ?>
                        <li><a href="<?php echo site_url().'/account/?id='.($u->ID) ?>" ><?php echo $name ?></a></li>
                <?php } ?>
                </ul>
                </div>
<?php
        }
?>
