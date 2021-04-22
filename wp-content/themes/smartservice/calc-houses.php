<?php
/**
 *  Template Name: Будинки калькулятор
 */

get_header();

?>

<?php get_hero(); ?>

    <section class="calc">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="calc_wrapper">
                        <?php
                        $taxonomy = 'packages_home';
                        $tax_args = [
                            'taxonomy' => $taxonomy,
                            'orderby' => 'id',
                            'hide_empty' => false,
                            'update_term_meta_cache' => true,
                        ];
                        $houses_terms = get_terms($tax_args);
                        ?>
<!--                      TODO:  calc buttons-->
                        <div class="calc_buttons">
                            <?
                            $count = 0;
                            foreach ($houses_terms as $term) :
                                $count++;
                                $active = ($count === 1) ? ' activate' : '';

                                ?>

                                <div class="calc_buttons_col">
                                    <a href="javascript:;" class="btn calc_buttons_btn<?php echo $active; ?> js-btn"
                                       data-hash="#<?php echo $term->slug; ?>" data-cat="<?php echo $term->term_id; ?>"><?php
                                        echo
                                        $term->name; ?></a>
                                </div>
                            <?php endforeach; ?>
                            <div class="calc_buttons_col">
                                <a href="javascript:;"
                                   class="btn calc_buttons_btn calc_buttons_btn_indi">
                                    <?php echo get_field('individualnyj', 'option'); ?>
                                </a>
                            </div>

                            <!--                            mobile buttons-->
                            <div class="calc_buttons_mob">
                                <select name="calc_buttons_select" id="calc_select" class="calc_buttons_select">
                                    <?
                                    $count = 0;
                                    foreach ($houses_terms as $term) :
                                        $count++;
                                        $active = ($count === 1) ? ' activate' : '';
                                        ?>
                                        <option value="<?php echo $term->term_id; ?>"
                                                data-hash="#<?php echo $term->slug; ?>" data-cat="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                                    <?php endforeach; ?>
                                    <option value="indi"><?php echo get_field('individualnyj', 'option'); ?></option>
                                </select>
                            </div>
                            <!--                mobile buttons end-->
                        </div>
                        <div class="calc_content">
                            <div class="calc_content_titles">
                                <strong><?php the_field('poslugy', 'option'); ?></strong>
                                <strong><?php the_field('raz_v_god', 'option'); ?></strong>
                            </div>
                            <!-- TODO: start base -->
                            <?php
                            $slug_min = $houses_terms[0]->slug;

                            $args_min = [
                                'post_type' => 'service-pack',
                                'orderby' => 'id',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'tax_query' => [
                                    [
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' => $slug_min
                                    ]
                                ]
                            ];

                            $query_min = new WP_Query($args_min);
                            ?>

                            <?php if ($query_min->have_posts()) : ?>
                                <div data-slug="<?php echo $slug_min; ?>" class="calc_content_wrapper js-calc">
                                    <?php
                                    while ($query_min->have_posts()) :
                                        $query_min->the_post();
                                        ?>
                                        <div class="calc_content_item">
                                            <div class="calc_content_item_title js-calc-toggle">
                                                <div class="calc_content_item_left">
                                                    <i class="angle-bottom"></i><h5><?php the_title(); ?></h5>
                                                </div>
                                                <?php
                                                $time = get_field('raz_na_rik');
                                                if ($time) :
                                                    ?>
                                                    <span><?php echo $time['standart']; ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="calc_content_item_desc" style="display: none;">
                                                <?php the_field('opys_poslug'); ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif;
                            wp_reset_postdata(); ?>
<!--                            base end-->

<!--                           TODO: start optimal -->
                            <?php
                            $slug_opt = $houses_terms[1]->slug;

                            $args_opt = [
                                'post_type' => 'service-pack',
                                'orderby' => 'id',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'tax_query' => [
                                    [
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' => $slug_opt
                                    ]
                                ]
                            ];

                            $query_opt = new WP_Query($args_opt);
                            ?>

                            <?php if ($query_opt->have_posts()) : ?>
                                <div data-slug="<?php echo $slug_opt; ?>" class="calc_content_wrapper js-calc" style="display: none;">
                                    <?php
                                    while ($query_opt->have_posts()) :
                                        $query_opt->the_post();
                                        ?>
                                        <div class="calc_content_item">
                                            <div class="calc_content_item_title js-calc-toggle">
                                                <div class="calc_content_item_left">
                                                    <i class="angle-bottom"></i><h5><?php the_title(); ?></h5>
                                                </div>
                                                <?php
                                                $time = get_field('raz_na_rik');
                                                if ($time) :
                                                    ?>
                                                    <span><?php echo $time['optimalnyj']; ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="calc_content_item_desc" style="display: none;">
                                                <?php the_field('opys_poslug'); ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif;
                            wp_reset_postdata(); ?>
<!--                            optimal end-->

<!--                         TODO:   start premium -->
                            <?php
                            $slug_max = $houses_terms[2]->slug;

                            $args_max = [
                                'post_type' => 'service-pack',
                                'orderby' => 'id',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'tax_query' => [
                                    [
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' => $slug_max
                                    ]
                                ]
                            ];

                            $query_max = new WP_Query($args_max);
                            ?>

                            <?php if ($query_max ->have_posts()) : ?>
                                <div data-slug="<?php echo $slug_max; ?>" class="calc_content_wrapper js-calc" style="display: none;">
                                    <?php
                                    while ( $query_max ->have_posts()) :
                                        $query_max ->the_post();
                                        ?>
                                        <div class="calc_content_item">
                                            <div class="calc_content_item_title js-calc-toggle">
                                                <div class="calc_content_item_left">
                                                    <i class="angle-bottom"></i><h5><?php the_title(); ?></h5>
                                                </div>
                                                <?php
                                                $time = get_field('raz_na_rik');
                                                if ($time) :
                                                    ?>
                                                    <span><?php echo $time['premium']; ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="calc_content_item_desc" style="display: none;">
                                                <?php the_field('opys_poslug'); ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif;
                            wp_reset_postdata(); ?>
<!--                            premium end-->

                        </div>
                    </div>
                </div>

<!--               TODO: packages result-->
                <div class="col-lg-4 col-12">
                    <div class="calc_check">
                        <?
                        $res_time = get_field('hm_time', $taxonomy . '_' . $houses_terms[0]->term_id);
                        $res_year = get_field('hm_price', $taxonomy . '_' . $houses_terms[0]->term_id);
                        $res_month = get_field('hm_price_month', $taxonomy . '_' . $houses_terms[0]->term_id);

                        require 'templates/packages-result-houses.php';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>