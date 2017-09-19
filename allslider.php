<?php
/*
 *
 * Template: allslider.php
 *
 */
?>
<div class="sliderblock">
    <?php
    global $evl_options;
        if ( isset($evl_options['evl_front_elements_header_area']['enabled']) )
            $evl_frontpage_slider = $evl_options['evl_front_elements_header_area']['enabled'];

        if ($evl_frontpage_slider):
                foreach ($evl_frontpage_slider as $sliderkey => $sliderval) {

                        switch ($sliderkey) {

                                case 'bootstrap_slider':
                                        if ($sliderval) {
                                                fp_bootstrap_slider();
                                        }
                                        break;
                                case 'parallax_slider':
                                        if ($sliderval) {
                                                fp_parallax_slider();
                                        }
                                        break;
                                case 'posts_slider':
                                        if ($sliderval) {
                                                fp_post_slider();
                                        }
                                        break;
                        }

                }
        endif;
    ?>
</div><!--/.sliderblock-->
