<div class="single-card-blog">

    <!--------------------------- 
            Featured Image 
    ---------------------------> 
        
   <div class="<?php if ( has_post_thumbnail() ) { ?>post-thumbnail<?php }?>">      
   	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-thumbnail'); ?></a>
   </div>
           
	<div class="single-card--text-container">

	<!--------------------------- 
				Headline
	--------------------------->   

	 <div>
		<a href="<?php the_permalink(); ?>">
			<h3><?php the_title(); ?></h3>
		</a>

	<!--------------------------- 
			Post Info
	--------------------------->   

		<p class="post-info"><?php the_time('l, d. F Y'); ?></p>

	<!--------------------------- 
				Excerpt
	--------------------------->

		<p><?php if (has_excerpt()) {
					echo get_the_excerpt();
				} else {
					echo wp_trim_words(get_the_content(), 18);
				} ?>
		</p>
	</div>

	<!--------------------------- 
				Weiterlesen
	--------------------------->			  

	<a class="more" href="<?php the_permalink(); ?>">
		<p class="link">Weiterlesen</p>
		<?php pfeilIcon(); ?>
	</a>

	</div>

</div>