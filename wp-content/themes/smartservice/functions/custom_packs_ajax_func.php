<?php

add_action('wp_ajax_custom_type', 'custom_type_func');
add_action('wp_ajax_nopriv_custom_type', 'custom_type_func');

function custom_type_func()
{
    if (isset($_REQUEST)) {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            $data_type = (isset($_REQUEST['dataType'])) ? (string)$_REQUEST['dataType'] : 0;

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

            if ($loop->have_posts()) :
                while ($loop->have_posts()) :
                    $loop->the_post();
                    ?>
                    <div class="custom_packs_el">
                        <div class="custom_packs_serv_name">
                            <div class="custom_packs_serv_col js-col">
                                <span class="angle_icon"></span>
                                <h5><?php the_title(); ?></h5>
                            </div>
                            <div class="custom_packs_serv_col">
                                <?php
                                if (get_field('csm_raz_na_rik', $cur_id)) : ?>
                                    <div class="custom_packs_select">
                                        <?php
                                        $price = ($data_type === 'houses') ? get_field('cziny_budynkiv') : get_field('czen_kvartyr');
                                        ?>
                                        <select name="period" id="period">
                                            <option value="0" data-price="0"><?php the_field('obraty', 'option');
                                                ?></option>
                                            <?php foreach ($periods as $period) : ?>
                                                <option value="<?php echo $period['csm_add_point']; ?>"
                                                        data-price="<?php echo $price; ?>"><?php echo
                                                    $period['csm_add_point']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="custom_packs_serv_text" style="display: none;">
                            <?php the_field('tekst_poslug'); ?>
                        </div>
                    </div>

                <?php
                endwhile;
            endif;
            wp_reset_postdata();
        }
    }
    wp_die();
}
