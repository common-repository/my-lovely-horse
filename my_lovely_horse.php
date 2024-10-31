<?php
/**
 * @package My_Lovely_Horse
 * @version 1.6
 */
/*
Plugin Name: My Lovely Horse
Plugin URI: http://wordpress.org/plugins/my-lovely-horse/
Description: My Lovely Horse is a very simple re-write of the ‘Hello Dolly’ plugin, so that it now displays the lyrics to the song ‘My Lovely Horse’, from the hit British TV comedy ‘Father Ted’.
Author: Nick Taylor
Version: 1.6
Author URI: http://www.ntdesignstudio.co.uk/
*/

function my_lovely_horse_get_lyric() {
	/** These are the lyrics to My Lovely Horse */
	$lyrics = "My lovely horse, running through the field
Where are you going, with your fetlocks blowing in the wind? 
I want to shower you with sugar lumps, and ride you over fences
Polish your hooves every single day, and bring you to the horse dentist 
My lovely horse, you're a pony no more
Running around with a man on your back, like a train in the night...";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function my_lovely_horse() {
	$chosen = my_lovely_horse_get_lyric();
	echo "<p id='lovely_horse'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'my_lovely_horse' );

// We need some CSS to position the paragraph
function lovely_horse_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#lovely_horse {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'lovely_horse_css' );

?>
