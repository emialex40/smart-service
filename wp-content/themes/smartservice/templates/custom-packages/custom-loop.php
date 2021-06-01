<?php
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
        $post_id = get_the_ID();
        $slug = $term->slug;
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

                            <select name="period" id="period" class="period">
                                <option value="0" data-flats="0" data-houses="0"><?php the_field('obraty', 'option');
                                    ?></option>
                                <?php foreach ($periods as $period) : ?>
                                    <?php
                                    $mult = (float)$period['mnozhennya'];
                                    $flats_price = (float)get_field('czen_kvartyr');
                                    $houses_price = (float)get_field('cziny_budynkiv');

                                    ?>
                                    <option value="<?php echo $period['csm_add_point']; ?>"
                                            data-cat="<?php echo $slug;  ?>"
                                            data-flats="<?php echo $flats_price * $mult; ?>"
                                            data-houses="<?php echo $houses_price * $mult; ?>">
                                        <?php echo $period['csm_add_point']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="custom_packs_serv_text" style="display: none;">
                <?php the_field('opys_poslug'); ?>
            </div>
        </div>
    <?php
    endwhile;
endif;
wp_reset_postdata();
?>
