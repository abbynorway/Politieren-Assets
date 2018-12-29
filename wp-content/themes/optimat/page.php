<?php

    get_header();

    if (have_posts()) :    
    while (have_posts()) : the_post();   

?>      



<!--========================================================
                       START HTML
============================================================-->


<article class="page">

    <?php the_content(); ?>
           
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