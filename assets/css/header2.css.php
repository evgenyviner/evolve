<?php

$evolve_css_data = '
.woocommerce-menu,
.woocommerce-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
    z-index: 99998;
}

.woocommerce-menu {
    margin-right: 0px;
    float: left;
}

.woocommerce-menu li {
    position: relative;
    margin-left: 20px;
    padding: 0;
    float: left;
}

.my-account ul li {
    margin-left: 0px;
}

.woocommerce-menu li li {
    padding: 0 10px;
    background-image: none;
    position: relative;
}

.woocommerce-menu-holder {
    float: right;
    margin: 15px 0;
}

.fa.fa-user {
    font-size: 18px;
}

.woocommerce-menu li:first-child {
    background-image: none;
}

ul.woocommerce-menu a {
    display: block;
}

ul.woocommerce-menu ul a {
    padding: 7px 10px;
}

.woocommerce-menu .cart-content a .cart-desc {
    display: inline-block;
    width: 95px;
    float: left;
}

.woocommerce-menu .cart-content a img {
    display: inline-block;
    float: left;
    margin-right: 8px;
    max-width: 60px;
}

.fa-shopping-cart {
    font-size: 18px;
    margin-right: 5px;
}

.woocommerce-menu .cart-content a .cart-title,
.woocommerce-menu .cart-content a .quantity {
    display: block;
    font-size: 12px;
}

.woocommerce-menu .cart-content a .cart-title {
    margin-bottom: 5px;
}

.woocommerce-menu .cart-content a {
    border-bottom: 1px solid;
    display: block;
    line-height: normal;
    overflow: hidden;
    padding: 15px 13px;
    width: 190px;
}
#search-text-box #search_label_top .srch-btn {
    width: 270px;
}

#search-text-box #search_label_top .srch-btn::before {
    color: #273039;
    content: "\f0d9";
    cursor: pointer;
    font-family: icomoon;
    font-size: 22px !important;
    font-weight: normal;
    position: absolute;
    right: 53px;
    text-align: center;
    width: 3px;
	top: 0;
	line-height: 50px;
	height: 50px;
}

#search-text-box #search_label_top .srch-btn::after {
    background: #273039 none repeat scroll 0 0;
    border-radius: 3px;
    color: '. $evolve_top_menu_hover_font_color .';
    content: "\e91e";
    cursor: pointer;
    font-family: icomoon;
    font-size: 18px !important;
    font-weight: normal;
    position: absolute;
    right: 0;
    text-align: center;
    top: 0px !important;
    width: 50px;
	line-height: 50px;
	height: 50px;
}

#search-text-top {
    background: rgba(0, 0, 0, .1);
    border: 1px solid rgba(0, 0, 0, .1);
    border-radius: 4px;
    float: right !important;
    font-family: Roboto !important;
    font-weight: 500;
    text-indent: 1px !important;
    height: 50px;
    padding: 0 70px 0 25px !important;
    position: relative;
    transition: all 0.5s ease 0s;
    width: 270px;
	font-size: 15px;
}

div#search-text-box {
    margin-right: 0;
}

.social-media-links {
    float: none;
}

.social-media-links li a {
    padding: 8.7px 8px;
}

/*responsive*/

@media only screen and (max-width: 768px) {
    #search-text-box #search_label_top {
        width: 270px;
	}	
    .social-media-links{
        text-align: center;
    }
    .woocommerce-menu {
        float: none;
        margin-right: 0;
    }
    .woocommerce-menu li {
        background-image: none;
        margin-left: 0px;
    }
    #search-text-box {
        float: none;
    }
    #search_label_top::after {
        right: 15px !important;
    }
    .woocommerce-menu-holder {
        float: none;
    }
    .header .menu-container .col-md-3 {
        text-align: center;
        width: 100%;
        float: none !important;
    }
    .mobilemenu-icon span {
        display: block;
        background: #FFF none repeat scroll 0% 0%;
        height: 3px;
        width: 40px;
        margin-top: 6px;
    }
    .mobilemenu-icon {
        position: fixed;
        top: 54%;
        left: 45%;
    }
}

ul.nav-menu {
    padding: 0px;
}

ul.nav-menu li:hover {
    background: none;
}

.woocommerce-menu .my-account a {
    font-size: 12px;
}

.woocommerce-menu .cart > a .t4p-icon-cart::before,
.woocommerce-menu .my-account > a .t4p-icon-user::before {
    margin-right: 10px;
}

.woocommerce-menu .cart > a:before {
    font-family: IcoMoon;
    content: "\e90c";
    margin-right: 10px;
}

#righttopcolumn,
.social-media-links,
.header a,
#tagline,
#website-title {
    display: block;
}

ul.t4p-navbar-nav > li {
    display: inline-block;
    float: none;
}
';

$evolve_menu_font = evolve_theme_mod('evl_menu_font');

$evolve_tagline_font = evolve_theme_mod('evl_tagline_font');
if ($evolve_tagline_font['color'] !='') {
$color = $evolve_tagline_font['color'];
$evolve_css_data .= '
.woocommerce-menu .cart > a,
.woocommerce-menu .my-account > a {
    border: 1px solid '. $color .';
    border-radius: 3px;
    color: '. $color .' !important;
    font-weight: 500 !important;
    padding: 6px 15px;
}
.woocommerce-menu .my-account > a {
    padding: 6.5px 15px;
}
';
}
