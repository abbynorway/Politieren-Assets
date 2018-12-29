<?php get_header();

 if (have_posts()) :    
   while (have_posts()) : the_post();   

?>      

<!--========================================================
                       START HTML
============================================================-->

<div class="article-container">

 <div class="thema-single-nav">
	 
	 <div class="flex flex-left flex-v-center">
	 	<a href="<?php echo get_post_type_archive_link('thema'); ?>">Letztes Thema: XYZ</a>
	 </div>
	 
	 <div class="flex flex-center flex-v-center">
		<?php gridIcon(); ?>
	 	<a href="<?php echo get_post_type_archive_link('thema'); ?>">Alle Themen</a>
	 </div>
	 
	 <div class="flex flex-right flex-v-center">
	 	<a href="<?php echo get_post_type_archive_link('thema'); ?>">Nächstes Thema</a>
	 </div>
	 
 </div>	
	
<article class="thema-single">

 <div class="item title">
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
	
	<h1 style="color: <?php echo $color; ?>"><?php the_title(); ?></h1>
	 
</div>
	
 <div class="item excerpt">
	 
	 <?php the_excerpt(); ?>
	 
 </div>	
	
 <div class="item">
	 
	 <?php the_content(); ?>
	 
 </div>

 <div class="item">	
	 
	 <?php if( get_field('pro_argumente') || get_field('contra_argumente') ): ?> <!--Wenn Feld Inhalt hat-->
	
	<br>
	<h2>Argumente</h2>
	<br>
	<div class="argumente-container">

		<div class="argumente">
			<h2>Pro</h2>
			<?php the_field('pro_argumente'); ?>
		</div>

		<div class="argumente">      	
			<h2>Kontra</h2>
			<?php the_field('contra_argumente'); ?>
		</div>

	</div>  
	<?php endif; ?>
	 
 </div>	
	
</article>

<!--===== THEMA ENDE =====-->	

<div class="space--10"></div>	

<!--===== RANDOM THEMENKARTEN =====-->	
	
<div class="single-thema-random">	
	
	<h2>Weitere Themen</h2>
	<div class="cards">

	<?php	

		$themenInfos = new WP_Query(array(
			'post_type' 		=> 'thema',
			'posts_per_page' 	=> 3, // -1 = unlimited
			'orderby'			=> 'rand'
		));

		while ($themenInfos->have_posts()) {
			$themenInfos->the_post(); 
			singleCard(); 	
		} 

		wp_reset_postdata();

	?>

	</div><!-- class="cards" -->
	
</div>
	
</div> <!-- class="article-container" -->	

<!--========================================================
                        END HTML
============================================================-->

<?php endwhile;

    else :

         echo '<p><br>Hier gibt es noch nichts zu sehen :)</p><br>'; 

    endif;

get_footer(); ?>