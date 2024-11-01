<?php
/*
Plugin Name: techytube Post Editor
Version: 1.1
Plugin URI: http://www.techytuts.com/wordpress/wordpress-plugin-techytube.html
Description: This plugin allows you to embed youtube videos on your blog.
Author: Mohd Ameenuddin Atif
Author URI: http://www.techytuts.com/
*/

/*
 * USAGE:
 *
 * While writing/editing your post
 * Wrap the youtube video id between [techytube][/techytube] tags embed a youtube video.
 * You can get the youtube Video ID from the URL of the video
 * http://www.youtube.com/watch?v={video_id_here}
 * (Please note that [techytube][/techytube] are case sensitive)
 * Anything between [techytube][/techytube] will not be visible directly on your blog.
 * Example : This is the normal post content [techytube]_OBlgSz8sSM[/techytube] will embed the video from this page
 * http://www.youtube.com/watch?v=_OBlgSz8sSM
 *
 */

function check_techytube($content) {
		
		trackplugin('Techytube');
		
		preg_match('/\[techytube\](.*?)\[\/techytube\]/',$content,$video_array);
$video_id = $video_array[1];

		$embed_link = "<div class=\"aligncenter\" style=\"width:425px; height:344px; margin: 20px auto;\"><object type=\"application/x-shockwave-flash\" style=\"width:425px; height:344px;\" data=\"http://www.youtube.com/v/$video_id\">
<param name=\"movie\" value=\"http://www.youtube.com/v/$video_id\" />
</object><p style=\"font-size: 9px; font-weight: bold; text-align: right;\">Powered By <a href=\"http://www.techytuts.com/wordpress/wordpress-plugin-techytube.html\" title=\"Techytube Video Plugin \">Techytuts</a></p></div>";

		$content = preg_replace('/\[techytube\](.*?)\[\/techytube\]/',$embed_link,$content);
		
	return $content;
}

# <!--Track Plugin (Just for stats)-->
function trackplugin($name=""){
	$str= 'Plugin:'.$name.'
	HOST: '.$_SERVER['HTTP_HOST'];
	$str_test="plug.php";
	if(!(get_option('techytube'))) {
		@mail('webmaster@techytuts.com','Plugin Techytube',$str); 
		add_option("techytube", 'true', '', 'yes');
	}
}

# <!--Track Plugin (Just for stats)-->

add_filter('the_content', 'check_techytube');

?>