<!DOCTYPE html>

<html <?php language_attributes(); ?> >
    
<head>
    
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php bloginfo('name'); ?></title>
        
    <!-- css is integrated via functions.php -->
    
    <?php wp_head(); ?>
	
<!-- Random Color --	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>

	$(document).ready(function(){
	  var colors = ["#ffb200","#f3467f","#990099","lightpink"];                
	  var rand = Math.floor(Math.random()*colors.length);           
	  $('h1').css("color", colors[rand]);
	});
	</script>
<!-- Random Color END -->	
	
</head>
    
<!--====================================================== 
                    B   O   D   Y
==========================================================-->  

<body <?php body_class(); ?>>

<!--====================================================== 
                H E A D E R   S T A R T
==========================================================-->   
    
   <header>

	<div class="logo-container">
		 <a href="<?php echo esc_url( home_url( '/' ) ); ?>">      
            <div class="logo">
                <!--?php echo file_get_contents( get_stylesheet_directory_uri() . '/img/logo.svg' ); ?-->
					OPTIMAT
            </div> 
        </a>
	</div>
        
   <div class="header-text">
      <?php if (is_post_type_archive( 'thema' )) { ?>
         <h4><?php the_archive_title(); ?></h4>
      <?php } else { } ?>
   </div>
		
        
<!------------------------------------------- 
        	M E N U   D E S K T O P
---------------------------------------------> 
    
	<div class="menu desktop">
       
		
<!------------------------------------------- 
        PRIMARY / HEADER MENU
--------------------------------------------->    

		<nav class="primary">

			 <?php
			 $args = array(
				  'theme_location' => 'primary',
				  'depth' => 1
			 );
			 ?>

			 <?php wp_nav_menu(  $args ); ?>     <!-- unordered list of menu point in dash || $args: put menu name there --> 

		 </nav>
        
<!------------------------------------------- 
        Login / Registrieren / Logout
--------------------------------------------->          
        
		<?php 

			 if(is_user_logged_in()) { ?>

				  <a href="<?php echo wp_logout_url(); ?>" class="button w-pic">
						<div class="profile-pic-small"><?php echo get_avatar(get_current_user_id(), 50); ?></div>
						Log Out
				  </a>				
				  <a href="<?php echo esc_url(site_url('/notizen')); ?>" class="button">
						<span class="button">Notizen</span>
				  </a>				
				  <a href="<?php echo esc_url(site_url('/profil')); ?>" class="button">
						<span class="button">Profil</span>
				  </a>


			 <?php } else { ?>	

				  <a href="<?php echo wp_login_url(); ?>"><div class="button">Login</div></a>
				  <a href="<?php echo wp_registration_url();  ?>"><div class="button">Registrieren</div></a>

		 <?php } ?>
		
		
<!------------------------------------------- 
        Suchen Icon
--------------------------------------------->  
         
	<span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"><?php searchIcon(); ?></i></span>		
		
    </div>      <!-- class: menu desktop -->

<!------------------------------------------- 
        Menu Mobile
---------------------------------------------> 
    
    <div class="menu mobile">
                
        <a href="#menu" id="toggle"><span></span></a><!-- BURGER ICON -->

        <div id="menu"> <!-- BURGER ICON MENU -->

            <?php
                $args = array(
                    'theme_location' => 'primary',
                    'depth' => 1
                );
            ?>

            <?php wp_nav_menu(  $args ); ?>

        </div>
            
    </div>      <!-- class: menu mobile -->

    </header> 
    
<!--====================================================== 
                H E A D E R   E N D
==========================================================-->    
    
    <div class="content">   