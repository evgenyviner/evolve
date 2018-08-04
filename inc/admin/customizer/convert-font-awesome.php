<?php
function convert_font_awesome_ver4_to_ver5( $old ){
	$list_fonts = array(
		'500px' => array(
			'500px',
			'fab'
		),
		'address-book-o' => array(
			'address-book',
			'far'
		),
	);
	if(isset($list_fonts[$old])){
		if(isset($list_fonts[$old][0]) && isset($list_fonts[$old][1])){		
			return array('name' => $list_fonts[$old][0], 'prefix' => $list_fonts[$old][1]);
		}
	}
	return array('name' => $old, 'prefix' => '');
}