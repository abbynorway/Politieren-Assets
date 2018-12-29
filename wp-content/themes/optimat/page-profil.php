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
	
	<div class="bg-card profile-card">
	
	<div id="random-grad-container"> </div>
	
	<div class="button" onclick="generate();">
		Zufälliger Verlauf
	</div>
	
	<p>
		<?php global $current_user;
      get_currentuserinfo();

      echo $current_user->user_login . '<br>' . $current_user->user_email;
		?>
	</p>
	
	<div class="icon" data-tooltip="Two atoms of hydrogen.">
		<?php echo file_get_contents( get_stylesheet_directory_uri() . '/img/icon-buch.svg' ); ?>
	</div>

</div>
	
<div class="space--4"></div>	
	
    <ul id="my-notes">
    
        <?php
        
        $userNotes = new WP_Query(array(
            'post_type' => 'note',
            'posts_per_page' => -1
            //'author' => get_current_user_id()
        ));
        
        while($userNotes->have_posts()) {
            $userNotes->the_post(); ?>
            
        <li>
            <input value="<?php echo esc_attr(get_the_title()); ?>">
            <span aria-hidden="true">Edit</span>
            <span aria-hidden="true" class="delete-note">Delete</span>
            <textarea><?php echo esc_attr(get_the_content()); ?></textarea>
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