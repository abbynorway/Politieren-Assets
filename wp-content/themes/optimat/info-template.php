<?php
/*
Template Name: Informieren Template
*/

    get_header();

    if (have_posts()) :    
    while (have_posts()) : the_post();      // loop trough posts - if  there are posts, they gets displayed

?>      



<!--========================================================
                       START HTML
============================================================-->


<article class="page info">
	

	<div class="search">        
		  <?php get_search_form(); ?>
	</div>
<div class="suche"><?php get_search_form(); ?></div>

			<div class="tags">
				<div class="single-tag" style="background-color: red;">Außenpolitik</div>
				<div class="single-tag" style="background-color: dodgerblue;">Steuern</div>
				<div class="single-tag" style="background-color: darkorange;">Bildung</div>
				<div class="single-tag" style="background-color: violet;">Umwelt</div>
			</div>

	
<div class="cards">
	
<!-- CUSTOm QUERY: All Themen -->
	
<?php	

	$themenInfos = new WP_Query(array(
		'post_type' 		=> 'thema',
		'posts_per_page' 	=> -1 // -1 = unlimited
	));
	
	while ($themenInfos->have_posts()) {
		$themenInfos->the_post(); ?>
	
		<div class="single-card">
			<div class="tags"><div class="single-tag umwelt">Umwelt</div><div class="single-tag steuern">Steuern</div></div>
			<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
			<p><?php echo wp_trim_words(get_the_content(), 18); ?></p>
			<a class="more" href="<?php the_permalink(); ?>">Weiterlesen</a>
		</div>
	
	<?php	} wp_reset_postdata();
?>
			
</div><!-- class="cards" -->
           
</article>


<!--========================================================
                        END HTML
============================================================-->


<?php endwhile;

    else :

         echo '<p><br>Hier gibt es noch nichts zu sehen :)</p><br>';        /* No posts found: Echo out */ 

    endif;

    get_footer();

 ?>