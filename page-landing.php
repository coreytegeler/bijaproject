<?php
global $post;
get_header(); 
$links_text = get_field( 'links',  $post );
$intro_text = get_field( 'intro_text', $post );
$programs_text = get_field( 'programs_text', $post );
$community_text = get_field( 'community_text', $post );
$closing_text = get_field( 'closing_text', $post );
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
				<div class="col-6 col-md-auto col-logo">
					<?php
					$logo_svg = get_template_directory_uri() . '/assets/images/logo.svg';
					echo file_get_contents( $logo_svg );
					?>
				</div>
				<div class="col-12 col-md col-nav">
					<nav class="d-flex align-items-center">
						<div class="row">
							<div class="col col-4">info@bijaproject.com</div>
							<div class="col col-4">347–294–0653</div>
							<div class="col col-4">
								<form>
									<input type="email" placeholder="Get our newsletter" />
									<span>Get our newsletter</span>
								</form>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>
</div>
<main role="main">
	<div class="main-row row h-100">
		<div class="col col-6 col-md-5 left">
			<div class="inner_content">
				<div class="container">
					<h2><?= $links_text; ?></h2>
				</div>
			</div>
		</div>
		<div class="col col-6 col-md-7 right">
			<div class="inner_content">
				<div class="row">
					<div class="container">
						<h2><?= $intro_text; ?></h2>
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

				<div class="row">
					<div class="container">
						<h2><?= $programs_text; ?></h2>
					</div>
				</div>
				

				<?php
				if( have_rows('programs') ):
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
				<div class="row">
					<div class="container">
						<h2><?= $community_text; ?></h2>
					</div>
				</div>


				<div class="row">
					<div class="container">
						<h2><?= $closing_text; ?></h2>
					</div>
				</div>
			</div>
			<footer>


			</footer>
		</div>
	</div>
</main>

<?php get_footer();
