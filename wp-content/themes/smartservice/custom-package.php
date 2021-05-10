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
$cur_id = get_the_ID();

$terms = get_terms($terms_args);

$template_dir = 'custom-packages';

?>

<?php get_hero(); ?>

    <section class="custom_packs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="custom_packs_buttons">
                        <a href="javascript:;" class="custom_packs_btn now"><?php the_field('kvartyry', 'option'); ?></a>
                        <a href="javascript:;" class="custom_packs_btn"><?php the_field('budynky', 'option'); ?></a>
                    </div>
                    <p class="custom_packs_txt"><?php the_field('rozdil_mystyt', 'option'); ?></p>
                    <div class="custom_packs_wrapper">

                        <?php
                        foreach ($terms as $term) :
                            $cat_name = $term->name;

                            $term_id = $term->term_id;

                            $args = [
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

                            $loop = new WP_Query($args);
                            ?>

                            <div class="custom_packs_item">
                                <div class="custom_packs_nav">
                                    <span class="custom_packs_nav_item"></span>
                                </div>
                                <div class="custom_packs_wrapper">
                                    <div class="custom_packs_body">
                                        <div class="custom_packs_name">
                                            <h4><?php echo $cat_name; ?></h4>
                                        </div>
                                        <div class="custom_packs_headers">
                                            <span><?php the_field('poslugy', 'option'); ?></span>
                                            <span><?php the_field('raz_v_god', 'option'); ?></span>
                                        </div>
                                        <div class="custom_packs_data">
                                            <?php
                                            if ($loop->have_posts()) :
                                                while ($loop->have_posts()) :
                                                    $loop->the_post();
                                                    ?>
                                                    <div class="custom_packs_serv_name">
                                                        <div class="custom_packs_serv_col">
                                                            <span class="angle_icon"></span>
                                                            <h5><?php the_title(); ?></h5>
                                                        </div>
                                                        <div class="custom_packs_serv_col">
                                                            <?php

                                                            if (get_field('csm_raz_na_rik', $cur_id)) :
                                                                $periods = get_field('csm_raz_na_rik', $cur_id);
                                                                ?>
                                                            <div class="custom_packs_select">
                                                                <select name="period" id="period">
                                                                    <?php foreach ($periods as $period) : ?>
                                                                        <option value="<?php echo $period['csm_add_point']; ?>"><?php echo $period['csm_add_point']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                                <div class="custom_packs_check">
                                                                    <input name="packs_choice" type="checkbox">
                                                                </div>

                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="custom_packs_serv_text" style="display: none;"><?php the_field('tekst_poslug');
                                                    ?></div>
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