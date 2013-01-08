<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div <?php post_class(); ?>>
        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="date"><?php the_date(); ?></div>
        <div class="content wysiwyg"><?php the_content(); ?></div>
    </div><!-- #post-<?php the_ID(); ?> -->
    
<?php endwhile; endif; ?>
