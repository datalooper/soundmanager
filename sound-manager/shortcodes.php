<?php
if( is_admin()){
    add_action( 'wp_ajax_get_songs', 'getSongs' );
    add_action( 'wp_ajax_nopriv_get_songs', 'getSongs' );
}

function getSongs(){
    $args = array( 'post_type' => 'sounds', 'numberposts' => -1 );
    $postArray = get_posts($args);
    $i = 0;
    $songs = array();
    foreach($postArray as $post){
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $thumbnail_object = get_post($thumbnail_id);
        $firstGenre =reset( get_the_terms( $post->ID, 'genres' ))->name;

        $song = array(
            "id" => $post->post_name,
            "songName" => $post->post_title ,   //song name
            "songUrl" => get_post_meta($post->ID, 'wp_custom_attachment', true), //song url
            "artistName" => getArtist($post->ID), //artist
            "albumName" => getAlbum($post->ID), //album
            "albumArtUrl" => wp_get_attachment_image_src( $thumbnail_object->ID, 'full')[0],
            "genre" => $firstGenre,
            "releaseDate" => mysql2date('j M Y', $post->post_date),
            "isFeatured" => in_category("featured", $post->ID),
            "trackInfo" => $post->post_content,
            "artistLink" =>  get_post_meta($post->ID, 'artist_link', true)
        );
        array_push($songs, $song);
        $i++;
    }
    $json = json_encode($songs);
    echo $json;

    die();
}





// [featured-sounds foo="foo-value"]
function shortcodeFeaturedSounds( $atts ) {
    $a = shortcode_atts( array(
        'num' => 0,
    ), $atts );
    $html = "<ul class='sound-list'>";
    $idObj = get_category_by_slug('featured'); 
  	$id = $idObj->term_id;
    $args = array( 'post_type' => 'sounds', 'offset' => '0', 'cat' => $id,);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
    
		$html .= "<li>".get_post_meta( get_the_ID(), 'wp_custom_attachment', true )."</li>";

	endwhile;
	$html .= "</ul>";
    return $html;
}
add_shortcode( 'featured-sounds', 'shortcodeFeaturedSounds' );


function getFeaturedVideo(){ 
    /* Get the featured post */
    $args = array( 'post_type' => 'sounds', 'numberposts' => 1, 'category_name' => 'featured' );
    $postArray = get_posts($args);
    $featuredPost = $postArray[0];
    $videoId = get_post_meta($featuredPost->ID, 'video_link', true);
    if (class_exists('MultiPostThumbnails')) {

        if (MultiPostThumbnails::has_post_thumbnail('sounds', 'first-frame', $featuredPost->ID)) {
            $firstFrame = MultiPostThumbnails::get_the_post_thumbnail('sounds', 'first-frame', $featuredPost->ID); 
        }
    }
    $videoInfo = array('ID' => $videoId, 'firstframe' => $firstFrame);
    $videoInfo = json_encode($videoInfo);
    return $videoInfo;
}
add_shortcode( 'smGetFeatureVideo', 'getFeaturedVideo' );


function getFeaturedSound(){ 
    /* Get the featured post */
    $args = array( 'post_type' => 'sounds', 'numberposts' => 1, 'category_name' => 'featured' );
    $postArray = get_posts($args);
    $featuredPost = $postArray[0];
    $id = $featuredPost->ID;
    $artist = getArtist($id);
    $obj = "<a class='sound' data-soundfile='";
    $obj .= get_post_meta($id, 'wp_custom_attachment', true) . "' ";
    $obj .= "data-artistname='".$artist."' ";
    $obj .= "data-soundname='".$featuredPost->post_title."' ";
    $obj .= ">".$featuredPost->post_title."</a>";  
    return $obj;
}
add_shortcode( 'smGetFeaturedSound', 'getFeaturedSound' );

function getArtist($id){
    $terms = get_the_terms( $id, "artists" );
    foreach ( $terms as $term ) {
        return $term->name;
    }
}
function getAlbum($id){
    $terms = get_the_terms( $id, "albums" );
	if($terms != null) {
		foreach ( $terms as $term ) {
			return $term->name;
		}
	}
}

?>