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
				<div class="col-md-auto col-sm-12 col-logo">
					<?php
					$logo_svg = get_template_directory_uri() . '/assets/images/logo.svg';
					echo file_get_contents( $logo_svg );
					?>
				</div>
				<div class="col col-md col-sm-12 col-nav">
					<nav class="d-flex align-items-center">
						<div class="row">
							<div class="col-4">info@bijaproject.com</div>
							<div class="col-4">347–294–0653</div>
							<div class="col-4">Get our newsletter</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>
</div>
<main role="main">
	<div class="main-row row h-100">
		<div class="col col-sm-12 col-md-5 left">
			<div class="inner_content">
				<div class="container">
					<h2>
						<?php
						$links_html = get_field( 'links',  $post );
						echo $links_html;
						?>
					</h2>
				</div>
			</div>
		</div>
		<div class="col col-sm-12 col-md-7 right">
			<div class="inner_content">
				<div class="row">
					<div class="container">
						<h2><p>
							Currently serving Brooklyn and the Hudson Valley, The Bija Project invests in communities with programming for people ages 0+
						</p></h2>
					</div>
				</div>

				<?php
				if( have_rows('locations') ):
					echo '<div class="locations row">';
						while( have_rows('locations') ) : the_row();
							$title = get_sub_field('title');
							echo '<div class="location col-sm-12 col-md-6 col-lg-4">';
								echo '<h2>'.$title.'</h2>';
								if( have_rows('address') ):
									while( have_rows('address') ) : the_row();
										echo '<div class="address cell">';
											$title = get_sub_field('title');
											$subtitle = get_sub_field('subtitle');
											echo '<h3>'.$title.'</h3>';
											echo '<h4 class="black">'.$subtitle.'</h4>';
										echo '</div>';
									endwhile;
								endif;

							echo '</div>';
						endwhile;
					echo '</div>';
				endif;


				if( have_rows('events') ):
					echo '<div class="container">';
						echo '<h2>Upcoming Events</h2>';
					echo '</div>';
					echo '<div class="events row">';
						while( have_rows('events') ) : the_row();
							$title = get_sub_field('title');
							$subtitle = get_sub_field('subtitle');
							echo '<div class="event col-sm-12 col-md-6 col-lg-4">';
								echo '<div class="cell">';
									echo '<h3 class="">'.$title.'</h3>';
									echo '<h4 class="black">'.$subtitle.'</h4>';
								echo '</div>';
							echo '</div>';
						endwhile;
					echo '</div>';
				endif;
				?>

				<div class="container">
					<h2><p>
						Designed to help children and families to manifest their greatest selves, our programs nurture meaningful learning experiences, instill a sense of intellectual independence, and inspire curiosity. Our team is engaged and devoted to working with you throughout your journey. All programs have  nancial aid options or sliding scale pricing.
					</p></h2>
				</div>
				

				<?php
				if( have_rows('programs') ):
					echo '<div class="container">';
						echo '<h2>Upcoming Events</h2>';
					echo '</div>';
					echo '<div class="programs row">';
						while( have_rows('programs') ) : the_row();
							$title = get_sub_field('title');
							$subtitle_1 = get_sub_field('subtitle_1');
							$subtitle_2 = get_sub_field('subtitle_2');
							$soon = get_sub_field('coming_soon');
							echo '<div class="program col-sm-12 col-md-6 col-lg-4">';
								echo '<div class="cell">';
									echo '<h3 class="'.($soon==true?'soon':'').'">'.$title.'</h3>';
									echo '<h4 class="black">'.$subtitle_1.'</h4>';
									echo '<h4>'.$subtitle_2.'</h4>';
								echo '</div>';
							echo '</div>';
						endwhile;
					echo '</div>';
				endif;
				?>
				<div class="container">
					<h2><p>
						We want to be a pillar of support for our community. We want to learn more about you, your family, or your organization to see how Bija can work with you to create strategies that are e ective and meaningful.
					</p></h2>
				</div>
			</div>
			<footer>


			</footer>
		</div>
	</div>
</main>

<?php get_footer();
