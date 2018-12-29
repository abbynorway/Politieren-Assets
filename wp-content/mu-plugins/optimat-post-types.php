<?php

function optimat_post_types () {
    
// Themen / Informieren
register_post_type('thema', array(
	'rewrite' => array('slug' => 'informieren'),
	'has_archive' => true,
	'public' => true, 
	'show_in_rest' => true,
	'menu_position' => 20, // below pages, default: below comments
	'supports' => array(
		'title',
		'editor',
		'thumbnail',
		'excerpt'
		//'custom-fields'
	),
	'taxonomies' => array('topics', 'category' ),
	'labels' => array(
		'name' => 'Themen',
		'add_new_item' => 'Neues Thema hinzufügen',
		'edit_item' => 'Thema bearbeiten',
		'all_items' => 'Alle Themen',
		'singular_name' => 'Thema'
	),
	'menu_icon' => 'dashicons-media-spreadsheet' // Icon im Dashboard
));
    
    
//  notes Post Type  
register_post_type('note', array(
	'show_in_rest' => true,
	'supports' => array('title', 'editor'),
	'public' => false, 
   'show_ui' => true, //show in admin dashboard
	'menu_position' => 20, // below pages, default: below comments
	'labels' => array(
		'name' => 'Notizen',
		'add_new_item' => 'Neue Notiz hinzufügen',
		'edit_item' => 'Notiz bearbeiten',
		'all_items' => 'Alle Notizen',
		'singular_name' => 'Notiz'
	),
	'menu_icon' => 'dashicons-welcome-write-blog' // Icon im Dashboard
));
}

add_action('init', 'optimat_post_types');