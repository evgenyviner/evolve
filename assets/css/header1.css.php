<?php
$evolve_css_data = '
.woocommerce-menu-holder {
    float: left;
}

.container-menu {
    z-index: auto;
}

#search-text-top {
    position: absolute;
    right: 0;
	top: 0;
}

#search-text-top:focus {
    position: absolute;
    right: 0px;
    left: initial;
}

@media all and (-ms-high-contrast:none) {
    #search-text-box #search_label_top,
    #stickysearch_label {
        position: absolute;
        right: 0px;
    }
    #search-text-top,
    #search-stickyfix {
        margin-right: 0px;
        position: relative !important;
    }
    #search-text-box #search_label_top::after {
        right: 30px;
    }
    #stickysearch-text-box #stickysearch_label::after {
        right: 15px !important;
    }
    #search-text-top:focus,
    #search-stickyfix:focus {
        position: relative !important;
    }
}

.header .woocommerce-menu {
    margin-right: 20px;
    padding: 5px;
}

@media (min-width: 767px) and (max-width: 1200px) {
	.sticky-header.sticky > .container{
		width: 100%;
	}
}

@media (max-width: 1023px) {
    .header #righttopcolumn {
        display: inline-block;
        float: none;
        margin-bottom: 20px;
        width: 100%;
    }
    .header-logo-container{
        display: inline-block;
        text-align: center;
        width: 100%;
    }
}

@media (max-width: 768px) {
    .header_v0 .title-container #logo a {
        padding: 0px;
    }
    #search-text-top {
        background: #fff;
        font-size: 15px;
        font-weight: normal;
        color: #888;
    }
    .sc_menu {
        float: none;
        text-align: center;
    }
    #search-text-top {
        border: 1px solid #fff;
        height: 40px;
        width: 220px;
    }
    .woocommerce-menu-holder {
        float: none;
    }
    .header .woocommerce-menu li{
        background-image: none;
    }
    .header .woocommerce-menu {
        float: none;
        margin-right: 0;
    }
    .title-container #logo {
        float: none;
    }
    #righttopcolumn,
     .header a,
    #tagline,
    #logo {
        width: auto;
        display: block;
    }
    .header .woocommerce-menu li{
        background-image: none;
    }
    .header {
      padding-bottom: 20px;
      padding-top: 20px;
    }
    .header #righttopcolumn {
      margin-bottom: 0;
    }
    .title-container{
        display: block;
    }
    .woocommerce-menu .dd-select{
        width: auto!important;
        display: inline-block;
    }
    .menu-header { padding: 20px 0; }

}

@media screen and (min-width: 1200px) {
    .header_v0 div#search-text-box {
        margin-right: 0px
    }
}

.sticky-header ul.t4p-navbar-nav > li {
    display: inline-block;
    float: none;
}
';
