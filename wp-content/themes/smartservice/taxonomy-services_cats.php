<?php
/**
 *  Template for the services category
 */

get_header();

$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
$taxonomy = $term->taxonomy;
$term_id = $term->term_id;

$children = get_term_children($term_id, $taxonomy);

$args = [
    'post_type' => 'service-pack',
    'order' => 'ASC',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => $taxonomy,
            'field' => 'id',
            'terms' => $term_id,
            'include_children' => false
        ]
    ]
];

$query = new WP_Query($args);

?>

<?php get_hero('post-hero', $term->name); ?>


<section class="services_cats">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-12">
                <ul class="services_cats_posts">
                    <?php
                    if ($children) :
                        foreach ($children as $child) :
                            $child_cat = get_term_by('id', $child, $taxonomy);
                            $child_id = $child_cat->term_id;
                            $child_name = $child_cat->name;
                            $child_link = get_term_link($child_id, $child_cat->taxonomy);
                            ?>
                            <li class="services_cats_item">
                                <a href="<?php echo $child_link; ?>"><?php echo $child_name; ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php
                    if ($query->have_posts()) :
                        while ($query->have_posts()) :
                            $query->the_post();
                            ?>
                            <li class="services_cats_item">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
            <div class="col-xl-9 col-lg-8 col-12">
                <div class="services_cats_content">
                    <?php
                    $img = get_field('serv_img', $taxonomy . '_' . $term_id);
                    $text = get_field('serv_cat_txt', $taxonomy . '_' . $term_id);

                    if ($img) :
                        ?>
                        <div class="service_single_image">
                            <img width="1140" src="<?php echo $img; ?>" alt="<?php echo $term->name; ?>">
                        </div>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                    <article class="post-article service_single_text content">
                        <?php echo $text; ?>
                    </article>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>


