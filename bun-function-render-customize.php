<?php
	class BinmaocomRefresh{
		function evolve_header_logo_color() {
        $title ='123'. esc_html( get_theme_mod( 'evolve_header_logo_color', __( 'Powerful Performance', 'agama' ) ) );
        return $title;
    }
    }