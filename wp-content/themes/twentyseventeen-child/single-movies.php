<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();
global $post;

?>

<div class="wrap">
	<div  class="content-area">
		<main id="main" class="site-main movie" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				?>
		
				<div class="title_movie">
					<?php  the_title(); ?>
				</div>

				<div class="subtitle_movie">
					<?php
						$meta_subtitle = get_post_meta( $post->ID, '_movie_subtitle', true );
						echo "<div>". $meta_subtitle."</div>" ;
					?>
				</div>

				<?php the_content();?>

				<div>
					<?php
					$terms = get_the_terms( $post->ID, 'movie_cat' );
					echo "<span  class='cat_movie'>Categories:<br> </span>";

					foreach($terms as $term) {
					echo  $term->name ."<br>";
					}
					?>
				</div>

				<div>
					<?php
						$meta_price = get_post_meta( $post->ID, '_movie_price', true );
						echo "<span  class='cat_movie'>Price: </span>". $meta_price ;

					?>
				</div>
				<div class="buy_movie">
					<form action="" method="post">
						<input name="add-to-cart" type="hidden" value="<?php echo $post->ID ?>" />
						<label for="quantity">Choose quantity</label><input name="quantity" type="number" value="1" min="1" />
						<input name="submit" type="submit" value="Buy" />
					</form>
				</div>
				<div><?php  the_favorites_button($post->ID);?></div>


			<?php endwhile; // End of the loop.
				?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- .wrap -->

<?php get_footer();
