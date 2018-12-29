<?php

    get_header();

    if (have_posts()) :    
    while (have_posts()) : the_post();   

?>      



<!--========================================================
                       START HTML
============================================================-->


<article class="page front-page">
<div class="front-page-options">
	<?php the_content(); ?>
</div>
	
<div class="space--4"></div>		

<h2>Random Infos</h2>		
	
<div class="cards">
	
<!-- CUSTOM QUERY: All Themen -->
	
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
	
</article>	


<!--========================================================
                        END HTML
============================================================-->


<?php endwhile;

    else :

         echo '<p><br>Hier gibt es noch nichts zu sehen :)</p><br>'; 

    endif;

    get_footer();

 ?>