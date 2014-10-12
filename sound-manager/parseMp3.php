<?php 

require_once('getid3/getid3.php');
require_once(__DIR__ . '/getid3/getid3.php');



/**
 * Gets the ID3 info of a file
 * 
 * @param $filePath
 * String, base path to the mp3 file
 * 
 * @return array
 * Keyed array with title, comment and category as keys.  
 */
function get_ID3($filePath) {
   // Initialize getID3 engine
  $get_ID3 = new getID3;

  $ThisFileInfo = $get_ID3->analyze($filePath);

  /**
   * Optional: copies data from all subarrays of [tags] into [comments] so
   * metadata is all available in one location for all tag formats
   * metainformation is always available under [tags] even if this is not called 
   */
  getid3_lib::CopyTagsToComments($ThisFileInfo);
  $title = $ThisFileInfo['tags']['id3v2']['title'][0];
  $artist = $ThisFileInfo['tags']['id3v2']['artist'][0];
  $album = $ThisFileInfo['tags']['id3v2']['album'][0];  
  $genre = $ThisFileInfo['tags']['id3v2']['genre'][0]; 
  if(isset($ThisFileInfo['comments']['picture'][0])){
     $image= base64_encode($ThisFileInfo['comments']['picture'][0]['data']);
  } 
  $details = array(
    'title' => $title,
    'artist' => $artist,
    'album' => $album,
    'genre' => $genre,
    'image' => $image,
  );

  return $details;
}

function getAbsPath($filePath){
  // Get the path to the upload directory.
    $wp_upload_dir = wp_upload_dir();


    // Check folder permission and define file location
    if( wp_mkdir_p( $wp_upload_dir['path'] ) ) {
        $absPath = $wp_upload_dir['path'] . '/' . basename( $filePath );
    } else {
        $absPath = $wp_upload_dir['basedir'] . '/' . basename( $filePath );
    }
    return $absPath;
}

?>