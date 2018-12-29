<?php

    // redirect users that are not logged in to homepgae if they type in adress manually
    if (!is_user_logged_in()) {
        wp_redirect(esc_url(site_url('/')));
        exit;
    }

    get_header();

    if (have_posts()) :    
    while (have_posts()) : the_post();   

?>      


<!--========================================================
                       START HTML
============================================================-->


<article class="page">
    
    <ul id="my-notes">
    
        <?php
        
        $userNotes = new WP_Query(array(
            'post_type' => 'note',
            'posts_per_page' => -1
            //'author' => get_current_user_id()
        ));
        
        while($userNotes->have_posts()) {
            $userNotes->the_post(); ?>
            
        <li data-id="<?php the_ID(); ?>">
            <input readonly class="note-title-field input-field" value="<?php echo esc_attr(get_the_title()); ?>">
			  	<div class="button edit-note">Edit</div>
			  	<div class="button delete-note">Delete</div>
            <textarea readonly class="note-body-field textarea-field"><?php echo esc_attr(get_the_content()); ?></textarea>
        </li>
            
        <?php }
        ?>
    
    </ul>
           
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