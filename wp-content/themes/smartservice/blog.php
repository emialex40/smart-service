<?php
/**
 *  Template name: Блог
 */
get_header();

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$args = [
    'post_type' => 'post',
    'order' => 'DESC',
    'post_status' => 'publish',
    'paged' => $paged,
    'posts_per_page' => 9
];

$query = new WP_Query($args);


?>

<?php get_hero(); ?>

<?php if ($query->have_posts()) : ?>
<section class="blog">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog_list">
                    <?
                        while ($query->have_posts()) :
                            $query->the_post();
                            ?>

                            <article class="blog_list-item">
                                <?php
                                $id = get_the_ID();
                                $categories = get_the_category($id);


                                foreach ($categories as $category) $category_ids[] = $category->term_id;
                                $cat_ids = $category->term_id;
                                $cat_name = $category->name;
                                $date = get_the_date('d.m.Y');

                                $thumb_arr = get_field('bg_thumb');
                                $thumb = $thumb_arr['sizes']['gallery-thumb'];
                                $alt = ($thumb_arr['alt']) ? $thumb_arr['alt'] : $thumb_arr['name'];
                                ?>
                                <div>
                                    <a href="<?php the_permalink(); ?>" class="post-related-img">
                                        <img width="334" height="223" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>">
                                    </a>

                                    <div class="blog_list-meta">
                                        <span class="blog_list-cat"><?php echo $cat_name; ?></span>
                                        <span class="blog_list-date"><?php echo $date; ?></span>
                                    </div>

                                    <h4 class="blog_list-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>

                                    <p class="blog_list-excerpt">
                                        <?php the_field('bg_excerpt'); ?>
                                    </p>
                                </div>
                                <div>
                                    <a class="blog_list-more" href="<?php the_permalink(); ?>"><?php the_field('chytaty_bilshe', 'option'); ?> <i class="fas fa-angle-right"></i></a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="paged">
                    <?php theme_pagination( $query->max_num_pages); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>