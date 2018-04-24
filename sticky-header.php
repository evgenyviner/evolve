<header id="header" class="sticky-header"> 
<?php
$evolve_width_layout = evolve_get_option('evl_width_layout', 'fixed');
$evolve_frontpage_width_layout = evolve_get_option('evl_frontpage_width_layout', 'fixed');
$evolve_pos_logo = evolve_get_option('evl_pos_logo', 'left');
$evolve_header_logo = evolve_get_option('evl_header_logo', '');
$evolve_blog_title = evolve_get_option('evl_blog_title', '0');
$evolve_searchbox_sticky_header = evolve_get_option('evl_searchbox_sticky_header', '1');
?>
<div class="container">
    <div class="row align-items-center">
        <?php
        if ($evolve_pos_logo == "disable") {
            
        } else {


            if ($evolve_header_logo) {
                echo "<a class='logo-url' href=" . home_url() . "><img id='logo-image' src=" . $evolve_header_logo . "  alt=" . get_bloginfo('name') . "/></a>";
            }
        }

        if ($evolve_blog_title == "0") {
            ?>
            <div class="col-md-auto"><div id="sticky-logo"><a class='logo-url-text' href="<?php echo home_url(); ?>"><?php bloginfo('name') ?></a></div></div>
        <?php }
        ?>
        <div class="col">
            <div class="sticky-menubar">    
                <?php
                if (has_nav_menu('sticky_navigation')) {
                    echo '<nav class="nav nav-holder link-effect">';
                    wp_nav_menu(array('theme_location' => 'sticky_navigation', 'menu_class' => 'nav-menu', 'fallback_cb' => 'wp_page_menu', 'walker' => new evolve_Walker_Nav_Menu()));
                } elseif (has_nav_menu('primary-menu')) {
                    echo '<nav class="nav nav-holder link-effect">';
                    wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' => 'nav-menu', 'fallback_cb' => 'wp_page_menu', 'walker' => new evolve_Walker_Nav_Menu()));
                } else {
                    ?>
                    <nav class="nav nav-holder link-effect">
                        <?php
                        wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' => 'nav-menu'));
                    }
                    ?>
                </nav>
            </div>
        </div>
        <?php
        if ($evolve_searchbox_sticky_header == "1") {
            ?>
            <!--BEGIN #searchform-->
            <div class="col-md-1 col-sm-1">
                <form action="<?php echo home_url(); ?>" method="get" class="stickysearchform">
                    <div id="stickysearch-text-box">
                        <label class="searchfield" id="stickysearch_label" for="search-stickyfix"><input id="search-stickyfix" type="text" tabindex="1" name="s" class="search" placeholder="<?php _e('Type your search', 'evolve'); ?>" /></label>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
            <!--END #searchform-->
        <?php } ?>
    </div>
	</div>
</header>
