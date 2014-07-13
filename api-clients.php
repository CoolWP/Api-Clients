<?php
/**
 * Plugin Name: Api Clients
 * Version 0.1
 */

function api_clients_admin_page() {
	add_options_page('Api Clients', 'Api Clients', 'administrator', 'apiclients', 'api_clients_options_page' );
}
add_action('admin_menu', 'api_clients_admin_page');
add_action('network_admin_menu', 'api_clients_admin_page');

function api_clients_options_page() {
?>

	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Api Clients</h2>
		<?php list_clients(); ?>
	</div>

<?php
}
 
function list_clients() {
	$consumers = get_posts( array ( 'post_type' => 'json_consumer', 'post_status' => 'draft' ) );
	
	if ( $consumers ) {
	    echo '<ul>';
	
	    foreach ( $consumers as $consumer ) {
	        $secret = get_post_meta( $consumer->ID, 'secret', true );
	        $key = get_post_meta( $consumer->ID, 'key', true );
	        echo '<li> id:     ' . $consumer->ID . '</li>';
	        echo '<li> key:     ' . $key . '</li>';
	        echo '<li> secret:  ' . $secret . '</li></br>';
	    }
	
	    echo '</ul>';
	} else {
		echo 'No clients Created';
	}
}
