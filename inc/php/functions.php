<?php

/**
 * Copies a directory
 *
 * @return void
 * @author Matt Vickers
 **/

function copy_directory( $source, $destination ) {
	if ( is_dir( $source ) ) {
		@mkdir( $destination );
		$directory = dir( $source );
		while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
			if ( $readdirectory == '.' || $readdirectory == '..' ) {
				continue;
			}
			$PathDir = $source . '/' . $readdirectory; 
			if ( is_dir( $PathDir ) ) {
				copy_directory( $PathDir, $destination . '/' . $readdirectory );
				continue;
			}
			copy( $PathDir, $destination . '/' . $readdirectory );
		}
 
		$directory->close();
	}else {
		copy( $source, $destination );
	}
}

/**
 * Remove all the extra stuff from a theme name
 * 
 * @author Matt   Vickers
 * 
 * @param  string $theme
 * 
 * @return string
 */
function format_theme_name($theme){

	$theme = str_replace(' ', '_', strtolower($theme));
	$theme = preg_replace("/[^a-zA-Z0-9_]/", "", $theme);

	return $theme;

}

function toggle($name, $atts = null){
	
	$yes = 'Yes';
	$no = 'No';

	if(is_array($atts)){
		
		extract($atts);

	}

	return '<span class="toggle ' . strtolower($name) . '">
			<input type="radio" name="' . $name . '" value="on">
			<label for="' . $name . '">' . $yes . '</label>
			<input type="radio" name="' . $name . '" value="off" checked="checked">
			<label for="' . $name . '-none">' . $no . '</label>
			<em class="switch"></em>
		</span>';

}