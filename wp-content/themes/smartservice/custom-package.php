<?php
/**
 *  Template Name: Індівідуальний пакет
 */

get_header();

$terms_args = [
    'taxonomy' => 'services_cats',
    'orderby' => 'id',
    'hide_empty' => 0,
    'hierarchical' => false,
    'parent' => 0,
    'fields' => 'all'
];

$terms = get_terms($terms_args);

$template_dir = 'custom-packages';

?>

<?php get_hero(); ?>

    <section class="custom_packs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="custom_packs_wrapper">

                        <?php
                        foreach ($terms as $term) :
                            $cat_name = $term->name;
                            ?>

                            <div class="custom_packs_item">
                                <div class="custom_packs_nav">
                                    <span class="custom_packs_nav_item"></span>
                                </div>
                                <div class="custom_packs_wrapper">
                                    <div class="custom_packs_headers">

                                    </div>
                                    <div class="custom_packs_body">
                                        <div class="custom_packs_name">
                                            <h4><?php echo $cat_name; ?></h4>
                                        </div>
                                        <div class="custom_packs_data">
                                            <?php
                                            $term_id = $term->term_id;

                                            $args2 = [
                                                'post_type' => 'service-pack',
                                                'order' => 'ASC',
                                                'post_status' => 'publish',
                                                'posts_per_page' => -1,
                                                'tax_query' => [
                                                    [
                                                        'taxonomy' => $term->taxonomy,
                                                        'field' => 'id',
                                                        'terms' => $term_id,
                                                        'include_children' => true
                                                    ]
                                                ]
                                            ];

                                            $loop = new WP_Query($args2);

                                            if ($loop->have_posts()) :
                                                while ($loop->have_posts()) :
                                                    $loop->the_post();
                                                    ?>
                                                    <div class="custom_packs_serv_name"><h5><?php the_title(); ?></h5><span class="angle_icon"></span>
                                                    </div>
                                                    <div class="custom_packs_serv_text"><?php the_field('tekst_poslug'); ?></div>
                                                <?php
                                                endwhile;
                                            endif;
                                            wp_reset_postdata();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="col-lg-4 col-12">

                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>