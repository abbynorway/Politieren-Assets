<?php

    get_header();

    if (have_posts()) :    
    while (have_posts()) : the_post();      // loop trough posts - if  there are posts, they gets displayed

?>      



<!--========================================================
                       START HTML
============================================================-->


<article class="post">
       
    <!--------------------------- 
            Featured Image 
    ---------------------------> 
        
        <div class="<?php if ( has_post_thumbnail() ) { ?>post-thumbnail<?php }?>"> <!-- If post has featured img, lass has-thumbnail is added -->
            
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-thumbnail'); ?></a>

        </div>
           
    <!--------------------------- 
            Headline
    --------------------------->    
        
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>      <!-- a href permalink: Leitet zum einzelnen Blogpost bei klick auf Titel-->
        
    <!--------------------------- 
            Post Info
    --------------------------->   
        
        <p class="post-info"><?php the_time('l, d. F Y'); ?> by <?php the_author(); ?></p>
    
    <!--------------------------- 
            Beitrag 
    --------------------------->
    

			<?php the_content(); ?>
    
       
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