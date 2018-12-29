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
	$themenQuery = new WP_Query(array(
		'post_type' => array('thema', 'page'),
		's' => sanitize_text_field($data['term'])
	));
	
	$results = array(
		'generalInfo' => array(),
		'themen' => array()
	);
	
	while($themenQuery->have_posts()) {
		$themenQuery->the_post();
		
		if (get_post_type() == 'page') {
			array_push($results['generalInfo'], array(
			'title' => get_the_title(),
			'permalink' => get_the_permalink(),
			'category' => get_the_category(),
			'postType' => get_post_type(),
			'authorName' => get_the_author()
			)); 	
		}	
		
		if (get_post_type() == 'thema') {
			$excerpt = null;
				if (has_excerpt()) {
					$excerpt = get_the_excerpt();
				} else {
					$excerpt = wp_trim_words(get_the_content(), 18);
				}
			
			array_push($results['themen'], array(
			'title' => get_the_title(),
			'permalink' => get_the_permalink(),
			'postType' => get_post_type(),
			'category' => get_the_category(),
			'excerpt' => $excerpt
			)); 	
		}
		
	}
	
	return $results;
}
