<?php
global $post;
get_header(); 
?>

<div id="intro" class="d-flex align-items-center">
	<div class="container">
	  <div class="row">
	    <div class="col-lg">
	    	<h1>
		      <?php while ( have_posts() ) : the_post();
							echo the_content();
					endwhile; ?>
				</h1>
	    </div>
	  </div>
	</div>
</div>
<div class="header-wrap">
	<header role="header" class="d-flex align-items-center">
		<div class="container-fluid">
		  <div class="row">
		    <div class="col-md-auto col-logo">
					<?php
					$logo_svg = get_template_directory_uri() . '/assets/images/logo.svg';
					echo file_get_contents( $logo_svg );
					?>
				</div>
				<div class="col col-md-6 col-nav">
					<nav class="d-flex align-items-center">
						<div class="row">
							<div class="col-md">info@bijaproject.com</div>
							<div class="col-md">347–294–0653</div>
							<div class="col-md">Get our newsletter</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>
</div>
<main role="main">
	<div class="row h-100">
	  <div class="col left links">
	  	<div class="container">
	  		<?php
	  		$links_html = get_field( 'links',  $post );
	  		echo $links_html;
	  		?>
	  	</div>
	  </div>
	  <div class="col right">
	    <div class="container"></div>
	  </div>
	</div>
</main>

<?php get_footer();
