jQuery(function ($) {
    wp.customize('evl_bootstrap_slider_support', function (setting) {
        setting.bind(function (value) {
            console.log(value);
            var status = 'ACTIVE';
            if (value == false) {
                status = 'INACTIVE';
            }
            jQuery('li.kirki-sortable-item[data-value="bootstrap_slider"] span').html('Bootstrap Slider (' + status + ')');
        });
    });
    wp.customize('evl_parallax_slider_support', function (setting) {
        setting.bind(function (value) {
            console.log(value);
            var status = 'ACTIVE';
            if (value == false) {
                status = 'INACTIVE';
            }
            jQuery('li.kirki-sortable-item[data-value="parallax_slider"] span').html('Parallax Slider (' + status + ')');
        });
    });
    wp.customize('evl_carousel_slider', function (setting) {
        setting.bind(function (value) {
            console.log(value);
            var status = 'ACTIVE';
            if (value == false) {
                status = 'INACTIVE';
            }
            jQuery('li.kirki-sortable-item[data-value="posts_slider"] span').html('Posts Slider (' + status + ')');
        });
    });
});