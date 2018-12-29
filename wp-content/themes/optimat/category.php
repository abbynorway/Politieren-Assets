<?php
    get_header();
?>

<article class="page info">
	
<h1><?php the_archive_title(); ?></h1>	

<!--===== SUCHE =====-->
	
	<div class="search"><?php get_search_form(); ?></div>

<!--===== TAGS / KATEGORIEN =====-->
	
	<div class="tags">
		<div class="single-tag" style="background-color: red;">Außenpolitik</div>
		<div class="single-tag" style="background-color: dodgerblue;">Steuern</div>
		<div class="single-tag" style="background-color: darkorange;">Bildung</div>
		<div class="single-tag" style="background-color: violet;">Umwelt</div>
	</div>

<!--===== THEMEN / KARTEN =====-->
	
	<div class="cards">

<?php
    while (have_posts()) {
		the_post();   	
?>      

<!--===== EINZELNE THEMENKARTE =====-->		
		
		<div class="single-card">
			<?php
		 	
			$categories = get_the_category();
			$separator = ' ';
			$output = '';
		 
		 	$color = get_term_meta( $term_id, 'color', true );
		 
			if ( ! empty( $categories ) ) {
				 foreach( $categories as $category ) {
					  $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" style="background-color: ' . $color . ';" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				 }
				 echo trim( $output, $separator );
			}
		 
		 ?>
			<div class="tags"><div class="single-tag umwelt">Umwelt</div><div class="single-tag steuern">Steuern</div></div>
			<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
			<p><?php if (has_excerpt()) {
					echo get_the_excerpt();
					} else {
				echo wp_trim_words(get_the_content(), 18);
				} ?>
			</p>
			<p><?php print_r($color); ?></p>
			
			<a class="more" href="<?php the_permalink(); ?>">Weiterlesen</a>
		</div>
	

<?php } 
		
		echo paginate_links();
?>
		
	</div><!-- class="cards" -->
           
</article>

<?php	
	get_footer();
 ?>