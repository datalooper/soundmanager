<?php
/**
 * Plugin Name: Sound Manager
 * Plugin URI: http://www.speakstudios.org/plugin
 * Description: Allows you to upload mp3's and create sound data based on the ID3 tags.
 * Version: 1.0
 * Author: Vince Cimo
 * Author URI: http://www.vincentcimo.com
 * License: GPL2
 */
/*  Copyright 2014 Vincent Cimo (email : vincent.cimo@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once(__DIR__ . '/PhpConsole/__autoload.php');
require_once(__DIR__ . '/multiple-post-thumbnails/multi-post-thumbnails.php');
require_once(__DIR__ . '/create-post-from-id3.php');
require_once(__DIR__ . '/shortcodes.php');

// PhpConsole\Helper::register(); // required to register PC class in global namespace, must be called only once

//global vars
$post_type_slug = 'sounds';

//adds sound category
add_action('init','sound_manager_activation' );

//hooks to wp admin menu
add_action( 'admin_menu', 'sound_manager_admin_menu' );

// add action to create genre taxonomies
add_action( 'init', 'create_taxonomies' );

// add function to put metaboxes on the admin page
add_action( 'admin_init', 'mt_admin_init' );

// save custom post data
add_action('save_post', 'mt_save_sound_file');

// save custom post data
add_action('save_post', 'save_video_meta');

// save custom post data
add_action('save_post', 'save_artist_link');

// add js actions
add_action('admin_enqueue_scripts', 'my_admin_scripts');

add_action( 'wp_ajax_remove_artist_link', 'remove_artist_link_callback' );

function hide_add_new_custom_type()
{
    global $submenu;
    // replace my_type with the name of your post type
    unset($submenu['edit.php?post_type=sounds'][10]);
}
add_action('admin_menu', 'hide_add_new_custom_type');
/** ADMIN STUFF **/

//adds submenu under tools
function sound_manager_admin_menu() {
	$menuSlug = 'sound_manager_options';
    $menuSlug2 = 'sound_manager_folder';
    add_submenu_page('edit.php?post_type=sounds', 'Add New Sound', 'Add New Sound', 'manage_options', $menuSlug, 'sound_manager_admin_page');
    add_submenu_page('edit.php?post_type=sounds', 'Add Sounds from Folder', 'Add Sounds from Folder', 'manage_options', $menuSlug2, 'sound_manager_folder_page');

}
function sound_manager_folder_page(){
     //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    // variables for the field and option names 
    $opt_name = 'mt_favorite_color';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'mt_favorite_color';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
<?php

    }

    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Sound Manager', 'menu-test' ) . "</h2>";

    // settings form
    
    ?>
</div>
<p class="description">Specify a local url containing mp3's and the meta-data for your new sounds will be auto-populated based on the ID3 tags. Folder <strong>MUST</strong> be located inside the wp-uploads dir. </p>
<h3>Enter Folder Path</h3>
<label for="upload_sound">
    <input id="upload_sound" type="text" size="36" name="ad_sound" placeholder="http://www.mysite.com/wp-content/uploads/my-sounds" /> 
    <input id="create_sounds_button" class="button" type="button" value="Create Sounds" />
    <br />Enter a local URL here
</label>


<div id="upload_status"></div>
<h3>Support further development!</h3>

<p class="description">This plugin was developed with love to help musicians and sound artists organize and control their musical distribution. <br/> If this plugin helps you, or you
would like to see new features added, donate a few dollars to help the cause! Good luck with your sounds!</p> 

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="2TAECXLXUE2ZA">
    <input type="submit" value="Donate using PayPal" class="button-primary" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


<?php   
}
//constructs admin page
function sound_manager_admin_page() {

    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    // variables for the field and option names 
    $opt_name = 'mt_favorite_color';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'mt_favorite_color';


    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
<?php

    }

    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Sound Manager', 'menu-test' ) . "</h2>";

    // settings form
    
    ?>
</div>
<p class="description">Upload an .mp3 file and the meta-data for your new sound will be auto-populated based on the ID3 tags.</p>
<h3>Upload New Sound</h3>
<label for="upload_sound">
    <input id="upload_sound" type="text" size="36" name="ad_sound" value="http://" /> 
    <input id="upload_sound_button" class="button" type="button" value="Upload Sound" />
    <br />Enter a URL or upload a sound
</label>

<h3>New Sound Info</h3>

<form id ="soundForm">
    <p>Sound Name: </p>
    <input class="soundName" name="title" readonly type="text" />
    <p>Artist Name:</p>
    <input class="artist" name="artist" readonly type="text" />
    <p>Album Name:</p>
    <input class="album" name="album" readonly type="text" />
    <p>YouTube ID:</p>
    <input class="videoLink" size="20" name="videoLink" type="text" />
    <p>Artist Link:</p>
    <input class="artistLink" size="20" name="artistLink" type="text" />
    <p><input type="checkbox" name="isFeatured" value="featured" class="featured"/> Featured?</p>
    <input type="submit" value="Create New Sound" class="createSound button-primary" />
</form>

<div id="upload_status"></div>
<h3>Support further development!</h3>

<p class="description">This plugin was developed with love to help musicians and sound artists organize and control their musical distribution. <br/> If this plugin helps you, or you
would like to see new features added, donate a few dollars to help the cause! Good luck with your sounds!</p> 

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="2TAECXLXUE2ZA">
    <input type="submit" value="Donate using PayPal" class="button-primary" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


<?php
}

function sound_manager_activation() { 
	global $post_type_slug;

    $args = array(
    'labels' => array(
	'name' => __( 'Sounds' ), // general name in menu & admin page
	'singular_name' => __( 'Sound' ) 
	),
    'taxonomies' => array('category'),
	'public' => true,
	'has_archive' => true,
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    );

    // now register the post type

    register_post_type( $post_type_slug, $args );

}
function create_taxonomies(){
    create_taxonomy("Genres", "Genre", "genres");
    create_taxonomy("Artists", "Artist", "artists");
    create_taxonomy("Albums", "Album", "albums");
}

function create_taxonomy($name, $singular_name, $slug){
// add a hierarchical taxonomy called Genre (same as Post Categories)

    // create the array for 'labels'
    $labels = array(
	'name' => ( $name ),
	'singular_name' => ( $singular_name),
	'search_items' =>  ( 'Search '.$name ),
	'all_items' => ( 'All '.$name ),
	'parent_item' => ( 'Parent '.$singular_name ),
	'parent_item_colon' => ( 'Parent '.$singular_name.':' ),
	'edit_item' => ( 'Edit '.$singular_name ),
	'update_item' => ( 'Update '.$singular_name ),
	'add_new_item' => ( 'Add New '.$singular_name ),
	'new_item_name' => ( 'New '.$singular_name.' Name' ),
    ); 
	
    // register your Groups taxonomy
    register_taxonomy( $slug, 'sounds', array(
	'hierarchical' => true,
	'labels' => $labels, // adds the above $labels array
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => $slug ), // changes name in permalink structure
    ));


}

function mt_admin_init(){
   
    // Define the custom attachment for posts
    add_meta_box(
        'sound_file',
        'Sound File',
        'sound_file_metabox',
        'sounds',
        'side'
    );

    add_meta_box(
        'video_link',
        'YouTube ID',
        'video_link_metabox',
        'sounds'
        
    );
    add_meta_box(
        'artist_link',
        'Artist Link',
        'artist_link_metabox',
        'sounds'

    );
    // Define additional "post thumbnails". Relies on MultiPostThumbnails to work
    if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(array(
            'label' => 'Featured Video First Frame (1920x1080)',
            'id' => 'first-frame',
            'post_type' => 'sounds'
            )
        );   
     
    };
    /* ADD ANOTHER META BOX HERE */
}


function artist_link_metabox() {
    wp_nonce_field(plugin_basename(__FILE__), 'wp_artist_link_nonce');
    $artistLink = get_post_meta(get_the_ID(), 'artist_link', true);
    $html = '';
    if(!empty($artistLink)){
        $html .= "<div class='artistLinkContainer'><p class='description'>Current Artist Link: </p><a href='";
        $html .= $artistLink . "'>".$artistLink."</a><a data-post-id='".get_the_ID()."' href='#' style='padding-left:20px;' class='removeArtistLink'>Remove</a></div>";

    }
    $html .= "<p style='margin-top:10px;' class='description'>Specify Artist Link, (http://www.redwillowsband.com)</p>";
    $html .= "<input type='text' name='artistLink' id='artist_link' size='40'/>";
    echo $html;
}

function save_artist_link($id){
    $artistLink = $_POST['artistLink'];
    if(!empty($_POST['artistLink']) && verifySecurity($id) && wp_verify_nonce($_POST['wp_artist_link_nonce'], plugin_basename(__FILE__))) {
        add_post_meta($id, 'artist_link', $artistLink);
        update_post_meta($id, 'artist_link', $artistLink);
    } // end save_custom_meta_data
}

function remove_artist_link_callback(){
    delete_post_meta($_POST['post_id'], 'artist_link');
}

function video_link_metabox() {
    wp_nonce_field(plugin_basename(__FILE__), 'wp_video_link_nonce');
    $videoLink = get_post_meta(get_the_ID(), 'video_link', true);
	$html = '';
    if(!empty($videoLink)){
        $html .= "<p class='description'>Current YouTube ID: </p><a href='";
        $html .= $videoLink . "'>".$videoLink."</a>";
    }
    $html .= "<p style='margin-top:10px;' class='description'>Specify YouTube ID, for example: id2i49</p>";
    $html .= "<input type='text' name='videoLink' id='video_link' size='40'/>";
    echo $html;
}

function save_video_meta($id){ 
    $videoLink = $_POST['videoLink'];
    if(!empty($_POST['videoLink']) && verifySecurity($id) && wp_verify_nonce($_POST['wp_video_link_nonce'], plugin_basename(__FILE__))) {
          add_post_meta($id, 'video_link', $videoLink);
        update_post_meta($id, 'video_link', $videoLink);                       
    } // end save_custom_meta_data
}
// design sound file metabox
function sound_file_metabox() {
 
    wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');
    $sound = get_post_meta(get_the_ID(), 'wp_custom_attachment', true);
    $html = '<p class="description">';
    if(!empty($sound)){
        $html .= "Current Song File: </p><a href='";
        $html .= $sound . "'>".get_the_title()."</a>";
        $html .= "<p style='margin-top:10px;' class='description'>Upload new sound</p>";
    } else{
        $html .= 'Upload your Sound here.';
        $html .= '</p>';
    }
    $html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25">';  
    echo $html; 
}


function my_admin_scripts() {
    if ($_GET['page'] == 'sound_manager_options' || $_GET['page'] == 'sound_manager_folder' || get_post_type( get_the_ID() )== 'sounds') {
        wp_enqueue_media();
        wp_register_script('sm-admin-js', WP_PLUGIN_URL.'/sound-manager/sm-admin.js', array('jquery'));
        wp_enqueue_script('sm-admin-js');
        // in javascript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
		wp_localize_script( 'sm-admin-js', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'attachment' => "" ) );
    	}
	}

function update_edit_form() {
    echo ' enctype="multipart/form-data"';
} // end update_edit_form
add_action('post_edit_form_tag', 'update_edit_form');



function verifySecurity($id){
    /* --- security verification --- */

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return false;
    } // end if
       
    if('page' == $_POST['post_type']) {
      if(!current_user_can('edit_page', $id)) {
        return false;
      } // end if
    } else {
        if(!current_user_can('edit_page', $id)) {
            return false;
        } // end if
    } // end if
    return true;
    /* - end security verification - */
}

function mt_save_sound_file($id) {
    // Make sure the file array isn't empty
    if(!empty($_FILES['wp_custom_attachment']['name']) && verifySecurity($id) && wp_verify_nonce($_POST['wp_custom_attachment_nonce'], plugin_basename(__FILE__))) {

        // Setup the array of supported file types. In this case, it's just MP3.
        $supported_types = array('audio/mpeg');
         
        // Get the file type of the upload
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));
        $uploaded_type = $arr_file_type['type'];
         
        // Check if the type is supported. If not, throw an error.
        if(in_array($uploaded_type, $supported_types)) {

            // Use the WordPress API to upload the file
            $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
            updatePostSound($upload['url'], $id);
            
            if(isset($upload['error']) && $upload['error'] != 0) {
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
            } else {
                add_post_meta($id, 'wp_custom_attachment', $upload['url']);
                update_post_meta($id, 'wp_custom_attachment', $upload['url']);     
            } // end if/else
 
        } else {
            wp_die("The file type that you've uploaded is not an MP3.");
        } // end if/else
         
    } // end if
     
} // end save_custom_meta_data
?>