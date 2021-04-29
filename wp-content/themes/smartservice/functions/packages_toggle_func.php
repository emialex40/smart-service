<?php

add_action('wp_ajax_packages_toggle', 'packages_toggle_func');
add_action('wp_ajax_nopriv_packages_toggle', 'packages_toggle_func');

// ajax function
function packages_toggle_func()
{

    if (isset($_REQUEST)) {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            $taxonomy = (isset($_REQUEST['tax'])) ? (string)$_REQUEST['tax'] : 0;


            if ($taxonomy === 0) {
                echo '';
            } else {
                $args = [
                    'taxonomy' => $taxonomy,
                    'orderby' => 'term_id',
                    'order' => 'ASC'
                ];

                $prefix = ($taxonomy === 'packages_home') ? 'hm' : 'fl';

                $terms = get_terms($args);

                $flats_arg = [
                    'post_type' => 'service-pack',
                    'order' => 'ASC',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'tax_query' => [
                        [
                            'taxonomy' => $taxonomy,
                            'field' => 'id',
                            'terms' => '$tax_id'
                        ]
                    ]
                ];

                $flats = new WP_Query($flats_arg);
                $count = 0;

                foreach ($terms as $term) :
                    $count++;
                    $class = ($count === 2) ? ' cur' : ''; ?>

                    <!--                    --><?php //debug('templates/' . $taxonomy . '/package-icon' . $count . '.php');
                    ?>
                    <div class="packages_col">
                        <div class="packages_item<?php echo $class; ?>">
                            <div class="packages_item_header">
                                <div class="packages_item_icon">
                                    <?php
                                    load_template(get_template_directory() . '/templates/' . $taxonomy . '/package-icon' . $count . '.php', false);
                                    ?>
                                </div>
                                <h3><?php echo $term->name; ?></h3>
                            </div>

                            <div class="packages_item_content">
                                <div class="packages_item_price">
                                    <span><?php esc_html_e('від', 'home'); ?></span>
                                    <b><?php echo get_field($prefix . '_price_month', $term->taxonomy . '_' . $term->term_id); ?></b>
                                    <span><?php esc_html_e('грн', 'home'); ?></span>
                                </div>
                                <?php
                                $posts_args = [
                                    'post_type' => 'service-pack',
                                    'order' => 'ASC',
                                    'post_status' => 'publish',
                                    'posts_per_page' => 7,
                                    'tax_query' => [
                                        [
                                            'taxonomy' => $term->taxonomy,
                                            'field' => 'id',
                                            'terms' => $term->term_id
                                        ]
                                    ]
                                ];

                                $posts = new WP_Query($posts_args);
                                ?>
                                <ul class="packages_item_services">
                                    <?
                                    if ($posts->have_posts()) :
                                        while ($posts->have_posts()) :
                                            $posts->the_post();
                                            ?>
                                            <li>
                                                <span><i class="fas fa-check-circle"></i> <?php the_title(); ?> </span>
                                            </li>
                                        <?php
                                        endwhile;
                                    endif;
                                    wp_reset_postdata();
                                    ?>
                                </ul>
                            </div>
                            <div class="packages_item_footer">
                                <a href="<?php echo get_home_url() . '/calc-houses/#' . $term->slug; ?>"><?php the_field('detalnishe', 'option'); ?></a>
                            </div>
                        </div>
                    </div>

                <?php
                endforeach;
            }
        }
    }
    wp_die();
}
