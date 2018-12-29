<?php

add_action('rest_api_init', 'optimatRegisterSearch'); // 2 args: moment to fire action, name of the function to be executed

function optimatRegisterSearch() {
	// new api search url: 1. name 2. route
	register_rest_route('optimat/v1', 'search', array(
		'methods' => WP_REST_SERVER::READABLE, // like 'GET'
		'callback' => 'optimatSearchResults'
	)); 
}

function optimatSearchResults($data) {
	$mainQuery = new WP_Query(array(
		'post_type' => array('thema', 'page', 'post'),
		's' => sanitize_text_field($data['term']) // s = search argument from wp. sanitize = sicherheit bei input fields
	));
	
	$results = array();
	
	while($themen->have_posts()) {
		$themen->the_post();
		
		// 1. which array to push data onto 2. what data?
		array_push($themaResults, array(
			'title' => get_the_title(),
			'permalink' => get_the_permalink(),
			'category' => get_the_category()
		)); 
	}
	
	return $results;
}
