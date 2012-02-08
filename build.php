<?php

/**
 * WPBuild
 *
 * Build that blank theme
 *
 * Written by Matt Vickers
 * 
 * Don't steal :P
 *
 **/

define('BASE', __DIR__);
define('BASE_THEME', 'base_theme');
define('BASE_THEME_PATH', BASE . '/' . BASE_THEME . '/');

require BASE . '/inc/php/functions.php';
require BASE . '/inc/php/pluralize.php';

/*
    
    Setup our theme variables

*/

$theme_name = $_POST['theme_name'];
$theme_folder_name = format_theme_name($theme_name);
$author_name = $_POST['author_name'];
$author_website = $_POST['author_website'];

$use_less = $_POST['use_less'] == 'on' ? TRUE : FALSE;
$has_menu = $_POST['has_menu'] == 'on' ? TRUE : FALSE;
$has_widget = $_POST['has_widget'] == 'on' ? TRUE : FALSE;
$has_custom_post_type = $_POST['has_custom_post_type'] == 'on' ? TRUE : FALSE;

/*
    
    Remove these files from the array
    we can skip them

*/

$blacklist = array(
    '.','..',
    'screenshot.png',
    'inc',
    'README.markdown'
);

// Create a new version of the blank theme

// $theme_name = 'wpbuild_' . time();

$new_theme = BASE . '/themes/' . $theme_folder_name;

copy_directory(BASE_THEME_PATH, $new_theme);

// echo 'Copying the base theme'."\n";
// echo 'Creating new theme: ' . $theme_name."\n";

if ($handle = opendir($new_theme)) {

    while (false !== ($entry = readdir($handle))) {

        if(in_array($entry, $blacklist)){
            continue;
        }

        /*
            
            We have to open the file in readonly
            to grab the content, then close the file and
            reopen it to erase the contents
        
        */

        // echo 'Editing file: ' . $entry."\n";

        $open_file = fopen("$new_theme/$entry", "r");
        $contents = fread($open_file, filesize("$new_theme/$entry"));
        fclose($open_file);

        $open_file = fopen("$new_theme/$entry", "w");       

        /*
            
            Do the fomatting that we want
            to do for each file.
        
        */

        $generic_replaces = array(
            'THEME_NAME' => $theme_name,
            'YOUR_THEME' => str_replace(' ', '_', strtoupper($theme_name)),
            '@package WordPress' => '@package WPBuild',
            '{AUTHOR}' => $author_name,
            '{AUTHOR_WEBSITE}' => $author_website
        );

        foreach($generic_replaces as $replace => $with){
            
            $contents = preg_replace("/$replace/", $with, $contents);

        }
  
        /*
            
            Specific Replaces
        
        */

        switch($entry){
            
            case 'header.php':

                /*
                    
                    CSS
                
                */

                if($use_less){
                        
                    $css = file_get_contents(BASE . '/build_parts/less/_header.php');
                    $folder = 'less';

                }else{
                    
                    $css = file_get_contents(BASE . '/build_parts/css/_header.php');
                    $folder = 'css'; 

                }

                $contents = preg_replace("/{CSS}/", $css, $contents);
                copy_directory(BASE . '/build_parts/' . $folder . '/files/', $new_theme . '/inc/css/');

                /*
                    
                    Extras
                
                */
                $wp_nav_menu = '';

                if($has_menu){
                    
                    $wp_nav_menu = file_get_contents(BASE . '/build_parts/wp_nav_menu/_header.php');

                }

                $contents = preg_replace("/{WP_NAV_MENU}/", $wp_nav_menu, $contents);

            break;

            case 'functions.php':

                /*
                    
                    This will remove the {FUNCTION} text from
                    the functions file if no extras are needed
                
                */

                $functions = NULL;

                if($has_menu){
                    
                    $functions .= file_get_contents(BASE . '/build_parts/wp_nav_menu/_functions.php');

                }

                if($has_widget){
                    
                    $functions .= file_get_contents(BASE . '/build_parts/register_sidebar/_functions.php');

                }

                if($has_custom_post_type){                

                    // add the include to the functions file
                    $functions .= file_get_contents(BASE . '/build_parts/custom_post_type/_functions.php');                    
                    
                    // Copy over the custom_post_type.php file and add edits

                    copy_directory(BASE . '/build_parts/custom_post_type/files/', $new_theme . '/inc/php/');

                    $custom_post_type_contents = file_get_contents($new_theme . '/inc/php/custom_post_type.php');
                    $custom_post_type_name = $_POST['custom_post_type_name'];

                    $custom_post_type_info = array(
                        '{SINGULAR}' => ucfirst($custom_post_type_name),
                        '{PLURAL}' => Inflect::pluralize( ucfirst($custom_post_type_name) ),
                        '{PLURAL_LOWERCASE}' => strtolower( Inflect::pluralize($custom_post_type_name) )
                    );

                    $custom_post_type_file = fopen($new_theme . '/inc/php/custom_post_type.php', "w+");

                    foreach($custom_post_type_info as $replace => $with){
                        
                        $custom_post_type_contents = preg_replace("/$replace/", $with, $custom_post_type_contents);

                    }

                    fwrite($custom_post_type_file, $custom_post_type_contents);
                    fclose($custom_post_type_file); 

                }

                $contents = preg_replace("/{FUNCTIONS}/", $functions, $contents);

            break;

            case 'sidebar.php':

                $widget_area = '';

                if($has_widget){
                    
                    $widget_area = file_get_contents(BASE . '/build_parts/register_sidebar/_sidebar.php');

                }

                $contents = preg_replace("/{WIDGET_AREA}/", $widget_area, $contents);

            break;

        }  

        fwrite($open_file, $contents);
        fclose($open_file);
    
    }

    /*
        
        Zip it up fool
    
    */

    // echo '- - - - - - -'."\n\n";
    // echo 'Zipping...'."\n";
    // echo $new_theme."\n";

    $zip_name = "themes/wpbuild_" . $theme_folder_name . ".zip";

    `zip -r $zip_name "themes/$theme_folder_name"`;

    // echo 'Removing the old theme folder'."\n";

    // `rm -r $new_theme`;

    // we deliver a zip file
    header("Content-Type: archive/zip");

    // filename for the browser to save the zip file
    header("Content-Disposition: attachment; filename=" . str_replace('themes/','',$zip_name));

    // calc the length of the zip. it is needed for the progress bar of the browser
    header("Content-Length: " . filesize($zip_name));

    // deliver the zip file
    $fp = fopen("$zip_name","r");
    echo fpassthru($fp);

    closedir($handle);

}

?>