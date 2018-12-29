<?php get_header();

	if (have_posts()) : ?>

<div class="cards-blog">

	<?php while (have_posts()) : the_post();
    


    get_template_part('content', get_post_format());  
    // gets content from content.php -> posts || get_post_format: reads what post type it is and looks after template. Aside -> content-aside.php


    
   endwhile; ?>

</div>

<?php    

	else :

		echo '<p><br>Hier gibt es noch nichts zu sehen.</p><br>';

	endif;

get_footer(); ?>