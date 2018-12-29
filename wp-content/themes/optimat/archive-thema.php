<?php
    get_header();
?>

<article class="page info">

<!--<h1><php the_archive_title(); ?></h1-->
	
<div class="space--2"></div>
	

<!--======= S E A R C H =======-->

	
		<?php get_search_form(); ?>


<!--===== TAGS / KATEGORIEN =====-->
	
	<div class="tags">
			<?php
		
				$term_id = 24;
				$taxonomy_name = 'category';
				$term_children = get_term_children( $term_id, $taxonomy_name );

				foreach ( $term_children as $child ) {
					
					$category = get_term_by( 'id', $child, $taxonomy_name );
					$term = get_term_by( 'id', $child, $taxonomy_name );
					$color = get_field('category-color', $category);
					
					echo '<a href="' . get_term_link( $child, $taxonomy_name ) . '"><div class="single-tag" style="background-color: ' . $color . ';"><div data-tooltip="' . esc_html( $category->description ) . '">' . $term->name . '</div></div></a>';
					
				}
		
		?>
		
	</div>

	<!--div class="tags">
			php
		
				$categories = get_categories();
		 		$output = '';

				foreach( $categories as $category ) {
						 
						  $color = get_field('category-color', $category);
						 
						  $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '"><div class="single-tag" style="background-color: ' . $color . ';"><div data-tooltip="' . esc_html( $category->description ) . '">' . esc_html( $category->name ) . '</div></div></a>';
					 }
		
				echo $output; ?>
	</div-->
	
	<div class="space--4"></div>

<!--===== THEMEN / KARTEN =====-->
	
	<div class="cards-container">
	 <div class="cards">
		<?php
			 while (have_posts()) {
				the_post();   
				singleCard(); 
			} 

			echo paginate_links();

		?>
	 </div>
	</div><!-- class="cards" -->
           
</article>

<?php	
	get_footer();
 ?>