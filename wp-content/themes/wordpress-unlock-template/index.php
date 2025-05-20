<?php get_header(); ?>
<main class="main-content" style="padding:32px 12px;min-height:60vh;text-align:center;">
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <article <?php post_class(); ?>>
      <h2 style="color:#66237d;font-weight:bold;font-size:1.5rem;"><?php the_title(); ?></h2>
      <div style="margin:16px 0 40px 0;font-size:1.18rem;">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
