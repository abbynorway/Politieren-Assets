<?php

require get_theme_file_path('/inc/search-route.php');

////////////////////////////////
// Add custom fields to JSON //
///////////////////////////////

function optimat_custom_rest() {

	
	// register_rest_field -> 3 args: post type, property, function( to call the value
	register_rest_field('post', 'authorName', array(
		'get_callback' => function() {return get_the_author();}
	)); 
}

add_action('rest_api_init', 'optimat_custom_rest');

//////////////////////////
// Get stylesheet & js //
/////////////////////////

function resources() 
   {
	wp_enqueue_script('main-optimat-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
   wp_enqueue_script( 'script', get_template_directory_uri() . '/js/mobilemenu.js', array ( 'jquery' ), 1.1, true);
   wp_enqueue_script( 'gradientgenerator', get_template_directory_uri() . '/js/gradientgenerator.js', array ( 'jquery' ), 1.1, true);
	wp_enqueue_style('style' , get_stylesheet_uri());
	wp_localize_script('main-optimat-js', 'optimatData', array(
		'root_url' => get_site_url(),
		'nonce' => wp_create_nonce('wp_rest')
	));
	
   //  wp_enqueue_script( 'search', get_template_directory_uri() . '/js/search.js', array ( 'jquery' ), 1.1, true);
   //  wp_enqueue_script( 'mynotes', get_template_directory_uri() . '/js/mynotes.js', array ( 'jquery' ), 1.1, true);
   //  wp_enqueue_script( 'mynotes', get_template_directory_uri() . '/js/mynotes.js', array ( 'jquery' ), 1.1, true);
    //wp_enqueue_script('scripts-bundled', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
	
    }

add_action('wp_enqueue_scripts', 'resources');

///////////////////////////
// Customizer additions //
/////////////////////////

require get_template_directory() . '/inc/customizer.php';

///////////////////////////////////////////////////
// Navigation Menus -> Register Theme Locations //
// so wp is aware they exist                    //
/////////////////////////////////////////////////

register_nav_menus(array
    (
     'primary' => __( 'Primary Menu'),
     'footer' => __( 'Footer Menu'),     // footer = code name ; Footer Menu = Offizieller Ausgabe Name         
	 )
);

//////////////////////////////////////////
// Customize excerpt word count length //
////////////////////////////////////////

function costum_excerpt_length() 
    
        {

            return 50;
        }

add_filter('excerpt_length', 'costum_excerpt_length'); /* Filter ersetzt wp standard excerpt (45 Worte) mit custom Funktion*/

///////////////////////////////////////
// Customize excerpt: Zeichenanzahl //
//////////////////////////////////////

function ng_get_excerpt( $count ){
  $permalink = get_permalink( $post->ID );
  $excerpt = get_the_content();
  $excerpt = strip_tags( $excerpt );
  $excerpt = mb_substr( $excerpt, 0, $count );
  $excerpt = mb_substr( $excerpt, 0, strripos( $excerpt, " " ) );
  $excerpt = rtrim( $excerpt, ",.;:- _!$&#" );
  return $excerpt;
}

//////////////////////////////////////////
// Customize posts / page //
////////////////////////////////////////

function optimat_postsperpage( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;
	
    if ( is_post_type_archive( 'thema' ) ) {
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'optimat_postsperpage', 1 );


///////////////////
// Theme Setup  //
//////////////////

function Optimat_setup() 

    {

    // Add featured image support to Theme
        add_theme_support('post-thumbnails');
    
    // generates different thumbnail sizes -> Values: Name, Breite in px, Höhe in px, Hard-Crop (true) / Soft Crop (false) ||  array: definieren wie das Bild beschnitten wird bzw welcher Ausschnitt zu sehen ist add_image_size('xyz', 960, 250, array('left', 'top'));
        add_image_size('small-thumbnail', 500, 500, true);
        add_image_size('banner-image', 960, 300, array('center'));

    // Add post format support
        add_theme_support('post-formats', array('aside', 'gallery', 'link'));

    }

add_action('after_setup_theme', 'Optimat_setup');

/////////////////////////////////////////////////
// Registers an editor stylesheet for backend  //
////////////////////////////////////////////////

function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );
						 

/////////////////////////////////////////////////////////////
// Change Archive Title for INFORMIEREN (Themen Archive)  //
///////////////////////////////////////////////////////////

function change_archive_title( $title ){
    if ( $title == "Archive: Themen" ) $title = "Informieren";
    return $title;
}
add_filter( "get_the_archive_title", "change_archive_title" );
						 

//////////////////////////////////
// CUSTOM FUNCTION  search Icon //
/////////////////////////////////

function searchIcon(){
?>
<div class="icon-ui">
<?php	
echo file_get_contents( get_stylesheet_directory_uri() . '/img/icon-suche.svg' );
?>
</div>	
<?php
}

//////////////////////////////////
// CUSTOM FUNCTION  pfeil Icon //
/////////////////////////////////

function pfeilIcon(){
?>
<div class="icon-ui icon-pfeil">
<?php	echo file_get_contents( get_stylesheet_directory_uri() . '/img/icon-pfeil.svg' );?>
</div>	
<?php
}

//////////////////////////////////
// CUSTOM FUNCTION  pfeil Icon //
/////////////////////////////////

function gridIcon(){
?>
<div class="icon-ui icon-grid">
<?php	echo file_get_contents( get_stylesheet_directory_uri() . '/img/icon-grid.svg' );?>
</div>	
<?php
}

//////////////////////////////////
// CUSTOM FUNCTION  single Card//
/////////////////////////////////

function singleCard(){
	//php
	?>

<!--===== EINZELNE THEMENKARTE =====-->		
		
		<div class="single-card">
			
			<!--div class="tags">
				
				?php

				$categories = get_the_category();
		 		$output = '';

				if ( ! empty( $categories ) ) {
					 foreach( $categories as $category ) {
						 
						  $color = get_field('category-color', $category);
						 
						  $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '"><div class="single-tag" style="background-color: ' . $color . ';"><div data-tooltip="' . esc_html( $category->description ) . '">' . esc_html( $category->name ) . '</a></div></div>';
					 }
					 echo $output;
	
				}

			 ?>

			</div> <!-- class: tags -->		
			
			<div class="icon-tags">
				
				<?php 
		 
		 		$categories = get_the_category();
		 		$output = '';

				if ( ! empty( $categories ) ) {
					 foreach( $categories as $category ) {

						  $icon = get_field('category-icon', $category);
						  $iconc = get_field('category-icon-c', $category);
						  $color = get_field('category-color', $category);
						 
						  $output .= '<div data-tooltip="' . esc_html( $category->description ) . '" class="cat-icon-c"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . file_get_contents( $iconc ) . '</a></div>';
					 }
					 echo $output;
	
				}

				?>

			</div> <!-- class: tags -->
			
			<!--?php echo file_get_contents( get_stylesheet_directory_uri() . '/img/logo.svg' ); ?-->
			
			<div class="single-card--text-container">
				<div>
				<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
				
				<p><?php if (has_excerpt()) {
						echo get_the_excerpt();
						} else {
					echo wp_trim_words(get_the_content(), 18);
					} ?>
				</p>
				</div>
				
					<a class="more" href="<?php the_permalink(); ?>">
						<p class="link">Weiterlesen</p>
						<?php pfeilIcon(); ?>
					</a>
				
			</div>

		</div>

<?php }

						 

///////////////////////////////////////////
// Reload Custom Editor Style css always //
//////////////////////////////////////////

 add_filter( 'mce_css', 't5_fresh_editor_style' );

    function t5_fresh_editor_style( $css )
    {
        global $editor_styles;

        if ( empty ( $css ) or empty ( $editor_styles ) )
        {
            return $css;
        }

        // Modified copy of _WP_Editors::editor_settings()
        $mce_css   = array();
        $style_uri = get_stylesheet_directory_uri();
        $style_dir = get_stylesheet_directory();

        if ( is_child_theme() )
        {
            $template_uri = get_template_directory_uri();
            $template_dir = get_template_directory();

            foreach ( $editor_styles as $key => $file )
            {
                if ( $file && file_exists( "$template_dir/$file" ) )
                {
                    $mce_css[] = add_query_arg(
                        'version',
                        filemtime( "$template_dir/$file" ),
                        "$template_uri/$file"
                    );
                }
            }
        }

        foreach ( $editor_styles as $file )
        {
            if ( $file && file_exists( "$style_dir/$file" ) )
            {
                $mce_css[] = add_query_arg(
                    'version',
                    filemtime( "$style_dir/$file" ),
                    "$style_uri/$file"
                );
            }
        }

        return implode( ',', $mce_css );
    }

////////////////////////////////////////////////////////////////
// Redirect Subscriber Account out of Admin and onto Homepage //
////////////////////////////////////////////////////////////////

add_action('admin_init', 'redirectSubsToFrontend');
	
function	redirectSubsToFrontend() {
	
	$ourCurrentUser = wp_get_current_user();
	
	if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		wp_redirect(site_url('/'));
		exit;
	}
}


add_action('wp_loaded', 'noSubsAdminBar');
	
function	noSubsAdminBar() {
	
	$ourCurrentUser = wp_get_current_user();
	
	if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		show_admin_bar(false);
	}
}
	

/////////////////////////
// WP Login Screen     //
////////////////////////

// use own link for login logo
add_filter('login_headerurl', 'ourHeaderUrl');
    
function ourHeaderUrl() {
    return esc_url(site_url('/'));
}


// Use style.css for login page
add_action( 'login_enqueue_scripts', 'ourLoginCSS' );

function ourLoginCSS() {
    wp_enqueue_style('style' , get_stylesheet_uri());
}

// Text: Hover über Login Logo
add_filter( 'login_headertitle', 'ourLoginTitle' );

function ourLoginTitle() {
    return get_bloginfo('name');
}

// use own logo on login page
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/cf_logo_illu_emblem2.png);
            background-position: center;
            background-size: contain;
            background-color: cadetblue;
            width: 300px;
            height: 175px;
            margin-bottom: 3rem;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
