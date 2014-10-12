<?php 
require_once(__DIR__ . '/parseMp3.php');

//called by sm-admin.js, after upload complete
add_action( 'wp_ajax_uploader_callback', 'uploaderCallback' );
add_action('admin_notices', 'uploaderFailed');


function uploaderCallback() {
	global $wpdb;
    if(!session_id()) {
        session_start();
    }
	$attachment = intval( $_POST['attachment'] ); 
	$filePath = get_attached_file( $attachment );
	$temp = new SimpleXMLElement(wp_get_attachment_link( $attachment ));
	$fileUrl = wp_slash($temp['href']);
	$_SESSION['post_details'] = get_id3($filePath);
	$_SESSION['post_details']['image'] = processAlbumArtwork($_SESSION['post_details']['image'], $filePath);
	$_SESSION['post_details']['url'] = $fileUrl;
    sendJSONResponse();
	die();
}
function sendJSONResponse(){
	$response['title'] = $_SESSION['post_details']['title'];
    $response['album'] = $_SESSION['post_details']['album'];
    $response['artist'] = $_SESSION['post_details']['artist'];
    echo json_encode($response);
}
function uploaderFailed(){
	 echo '<div style="display:none;" class="error"></div>';
	 echo '<div style="display:none;" class="updated"></div>';

}
add_action('admin_notices', "uploaderFailed");
function processAlbumArtwork($image, $filePath){
	$filePath = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filePath);
	$filePath = $filePath . '-artwork.jpg';
	$image = base64_decode($image);
	$success = file_put_contents($filePath, $image);
	if($success){
		return $filePath;
	}
}

add_action( 'wp_ajax_createNewSoundsFromFolderSubmit', 'createNewSoundsFromFolderSubmit' );

function createNewSoundsFromFolderSubmit(){

	//get value of folder url
	$soundsUrl = strval($_POST['soundsUrl']);
	$soundsUrlParsed = parse_url($soundsUrl);

	//check for trailing slash
	if(substr($soundsUrlParsed['path'], -1) == '/') {
		$localPath = $_SERVER['DOCUMENT_ROOT'].$soundsUrlParsed['path'];
	} else{
		$localPath = $_SERVER['DOCUMENT_ROOT'].$soundsUrlParsed['path']."/";
	}

	$dir  = new RecursiveDirectoryIterator($localPath, RecursiveDirectoryIterator::SKIP_DOTS);
	$files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::SELF_FIRST);

	foreach ($files as $file) {
		if($file->getExtension() == "mp3"){
			echo $file;
			$friendlyPath = renameFriendly($file->getPath()."/", $file->getFilename());
			$id3info = get_id3($friendlyPath);
			//Valid file found, add to wordpress attachment database
			// Prepare an array of post data for the attachment.
			$attachment = array(
				'guid'           => $friendlyPath, 
				'post_mime_type' => 'audio/mpeg',
				'post_title'     => $id3info['title'],
				'post_content'   => '',
				'post_status'    => 'inherit'
			);
			$attachment = wp_insert_attachment( $attachment, $friendlyPath);
			error_log(wp_get_attachment_url( $attachment ));
			$fileUrl = wp_slash(wp_get_attachment_url( $attachment ));
			$id3info['url'] = $fileUrl;
			$id3info['image'] = processAlbumArtwork($id3info['image'], $friendlyPath);
			createPost($id3info);
			
		}
	}
	die();

}

function renameFriendly($dir, $unfriendlyName){
	$friendlyName = str_replace(' ', '-', $unfriendlyName);
	rename($dir.$unfriendlyName, $dir.$friendlyName);
	return $dir.$friendlyName;
}

add_action( 'wp_ajax_createNewSoundSubmit', 'createNewSoundSubmit' );

function createNewSoundSubmit(){
  if(!session_id()) {
    session_start();
    error_log( "starting session");
  }
	echo createPost($_SESSION['post_details']);
	releaseSession($_SESSION['post_details']);
	die();

}

add_action( 'wp_ajax_create_post', 'createPost' );

function createPost($attachment){
  global $post_type_slug;

  if(!empty($attachment['title'])){
    // Create post object
    $new_post = array(
      'post_title'    => $attachment['title'],
      'post_content'  => '',
      'post_status'   => 'publish',
      'post_type'     => $post_type_slug,
      'post_author'   => 1,

    );

    // Insert the post into the database

	   $post_id = wp_insert_post( $new_post );
	   if($post_id != 0){
	   	if($isFeatured){
       		addToTax($post_id, "Featured", "category", "Featured Sounds", "featured" );
       	}
		addFeaturedImage($post_id, $attachment['image']);
		addToTax($post_id, $attachment['artist'], "artists", "", sanitize($attachment['artist']) );
		addToTax($post_id, $attachment['album'] , "albums", "", sanitize($attachment['album']) );	  

		//sound file url 
	    add_post_meta($post_id, 'wp_custom_attachment', $attachment['url']);
	    update_post_meta($post_id, 'wp_custom_attachment', $attachment['url']);  

	   	//video file url
	   	add_post_meta($post_id, 'video_link', $attachment['videoLink']);
	    update_post_meta($post_id, 'video_link', $attachment['videoLink']); 

	    wp_set_object_terms( $post_id, $attachment['genre'], 'genres' );
	    attachSoundtoPost($attachment, $attachment['url'], $post_id);
		return admin_url( 'post.php?post=' . $post_id ) . '&action=edit';
	}
  }
  return 0;
}

function releaseSession($sessionVar){
	if(isset($sessionVar)){
 	 unset($sessionVar);
	}
	session_destroy();
}
function sanitize($str){
	$invalid_characters = array("$", "%", "#", "<", ">", "|");
	return str_replace($invalid_characters, "", $str);
}
function addToTax($post_id, $taxName, $taxonomy, $description, $slug){
	if(!term_exists( $taxName, $taxonomy )){ // array is returned if taxonomy is given

		wp_insert_term(
		  $taxName, // the term 
		  $taxonomy, // the taxonomy
		  array(
		    'description'=> $description,
		    'slug' => $slug,
		  )
		);
	}
	wp_set_object_terms($post_id, $slug, $taxonomy, true);
}
function addFeaturedImage($post_id, $image){
	$filetype = wp_check_filetype( basename( $image ), null );
	// Prepare an array of post data for the attachment.
	$attachment = array(
		'guid'           => $wp_upload_dir['url'] . '/' . basename( $image ), 
		'post_mime_type' => $filetype['type'],
		'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $image  ) ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	);

	$attachmentId = wp_insert_attachment( $attachment, $image , $post_id);
	wp_update_attachment_metadata( $attachmentId, wp_generate_attachment_metadata( $attachmentId, $image ));
	add_post_meta( $post_id, '_thumbnail_id', $attachmentId, true );
}

function attachSoundtoPost($details, $filePath, $post_id){
    // Check the type of tile. We'll use this as the 'post_mime_type'.
    $filetype = wp_check_filetype( $filePath, null );
    getAbsPath($filePath);
    // Prepare an array of post data for the attachment.
    $attachment = array(
      'guid'           => $absPath, 
      'post_mime_type' => $filetype['type'],
      'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filePath)),
      'post_content'   => '',
      'post_status'    => 'inherit'
    );

    // Insert the attachment.
    $attach_id = wp_insert_attachment( $attachment, $absPath, $post_id  );
  }
function updatePostSound($urlPath, $id){
  	global $wpdb;
  	$absPath = getAbsPath($urlPath);

	$id3 = get_ID3($absPath);
	$_POST['mt_field_one'] = $id3['artist'];
	$_POST['mt_field_two'] = $id3['album'];
	$post_title = $id3['title'];
	$where = array( 'ID' => $id );
	$wpdb->update( $wpdb->posts, array( 'post_title' => $post_title ), $where );

}
?>