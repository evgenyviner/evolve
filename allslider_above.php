<?php
/*
 *
 * Template: allslider.php
 *
 */
?>
<div class="sliderblock">
    <?php
    global $evolve_options, $evolve_frontpage_slider_status;
    $evolve_frontpage_slider = array();
        if ( isset($evolve_options['evl_front_elements_header_area']['enabled']) )
            $evolve_frontpage_slider = $evolve_options['evl_front_elements_header_area']['enabled'];

        if ($evolve_frontpage_slider):
                foreach ($evolve_frontpage_slider as $sliderkey => $sliderval) {
                        if ($sliderkey == 'bootstrap_slider') {
                                fp_bootstrap_slider();
                                $evolve_frontpage_slider_status['bootstrap'] = false;
                        } elseif ($sliderkey == 'parallax_slider') {
                                fp_parallax_slider();
                                $evolve_frontpage_slider_status['parallax'] = false;
                        } elseif ($sliderkey == 'posts_slider') {
                                fp_post_slider();
                                $evolve_frontpage_slider_status['posts'] = false;
                        } elseif ($sliderkey == 'header') {
                                break;
                        }
                }
        endif;
    ?>
</div><!--/.sliderblock-->
