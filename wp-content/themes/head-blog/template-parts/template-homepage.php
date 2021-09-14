<?php
/**
 *
 * Template name: Homepage
 * 
 */
get_header();
?>

<?php get_template_part( 'template-parts/template-part', 'head' ); ?>

<!-- start content container -->       
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div <?php post_class(); ?>>
		<?php get_template_part( 'template-parts/homepage', 'widgets' ); ?>
	</div>
	<?php endwhile; ?>        
<?php else : ?>            
	<?php get_template_part( 'content', 'none' ); ?>        
<?php endif; ?>    
<!-- end content container -->
<?php
get_footer();

