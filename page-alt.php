<?php
/*
Template Name: Smaller Featured Image page
*/

get_header(); ?>

<section id="content" class="page threefourth" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<section id="featured-img" class="page cl2b">

<?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } ?>

<h1 class="entry-title cl1"><?php the_title(); ?></h1> 

</section>

<section class="entry-content full cl3b">

<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
<?php edit_post_link(); ?>
</section>
</article>

<?php endwhile; endif; ?>
</section>

<?php get_sidebar(); ?>


<?php get_footer(); ?>