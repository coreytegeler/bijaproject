<?php
global $post;
get_header(); 
$links_text = get_field( 'links',  $post );
$intro_text = get_field( 'intro_text', $post );
$programs_text = get_field( 'programs_text', $post );
$community_text = get_field( 'community_text', $post );
$services_text = get_field( 'services_text', $post );
$start_text = get_field( 'start_text', $post );
$closing_text = get_field( 'closing_text', $post );

$copyright = wpautop( get_field( 'copyright', 'option' ) );
$credits = wpautop( get_field( 'credits', 'option' ) );
$address = wpautop( get_field( 'address', 'option' ) );
$phone = get_field( 'phone', 'option' );
$email = get_field( 'email', 'option' );
$instagram = get_field( 'instagram', 'option' );
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
				<div class="col col-6 col-sm-5 col-logo">
					<div class="inner">
						<?= get_svg( 'logo' ); ?>
					</div>
				</div>
				<div class="col col-12 col-sm-7 col-nav">
					<div class="inner d-flex align-items-center">
						<div class="row">
							<div class="col col-4">
								<a href="<?= $email; ?>"><?= $email; ?></a>
							</div>
							<div class="col col-4">
								<div><?= $phone; ?></div>
							</div>
							<div class="col col-4">
								<form>
									<input type="email" placeholder="Get our newsletter" />
									<?= get_svg( 'arrow-right' ); ?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
</div>
<main role="main">
	<div class="wall"></div>
	<div class="main-row row">
		<div class="col col-6 col-sm-5 left">
			<div class="inner-content">
				<div class="container">
					<h2><?= $links_text; ?></h2>
				</div>
			</div>
		</div>
		<div class="col col-6 col-sm-7 right">
			<div class="inner-content">
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
							echo '<div class="location col-12 col-md-6 col-lg-4">';
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
							echo '<div class="event col-12 col-md-6 col-lg-4">';
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
							echo '<div class="program col-12 col-md-6 col-lg-4">';
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
					<div class="col-12 col-md-4">
						<h3>Our Services:</h3>
						<h4><?= $services_text; ?></h4>
					</div>
					<div class="col-12 col-md-8">
						<h3>To Get Started:</h3>
						<h3><?= $start_text; ?></h3>
					</div>
				</div>

				<div class="row">
					<div class="container">
						<h2><?= $closing_text; ?></h2>
					</div>
				</div>
			</div>

			
			<footer>
				<div class="row">
					<div class="col-12 col-md-4">
						<h4><?= $copyright; ?></h4>
						<h5><?= $credits; ?></h5>
					</div>
					<div class="col-12 col-md-4">
						<h4><?= $address; ?></h4>
						<h4><?= $phone; ?></h4>
						<h4>
							<a href="<?= $email; ?>"><?= $email; ?></a>
						</h4>
					</div>
					<div class="col-12 col-md-4">
						<div class="social">
							<a href="<?= $instagram; ?>">
								<h4>
									<?= get_svg( 'social-ig' ); ?>
									<span>Follow us on Instagram</span>
								</h4>
							</a>
							</h4>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
</main>

<?php get_footer();
