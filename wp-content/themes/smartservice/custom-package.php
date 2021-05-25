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

$periods = get_field('csm_raz_na_rik');

?>

<?php get_hero(); ?>

    <section class="custom_packs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="custom_packs_buttons">
                        <a href="javascript:;" class="custom_packs_btn now" data-type="flats"><?php the_field('kvartyry', 'option'); ?></a>
                        <a href="javascript:;" class="custom_packs_btn" data-type="houses"><?php the_field('budynky', 'option'); ?></a>
                    </div>
                    <p class="custom_packs_txt"><?php the_field('rozdil_mystyt', 'option'); ?></p>
                    <div class="custom_packs_wrapper">

                        <?php
                        $count = 0;
                        $length = count($terms);
                        foreach ($terms as $term) :
                            $cat_name = $term->name;
                            $count++;
                            $current = ($count === 1) ? ' p-current' : '';
                            $term_id = $term->term_id;

                            ?>

                            <div class="custom_packs_item<?php echo $current ?>">
                                <div class="custom_packs_nav">
                                    <span class="custom_packs_nav_item"></span>
                                </div>
                                <div class="custom_packs_body">
                                    <div class="custom_packs_name">
                                        <h4><?php echo $cat_name; ?></h4>
                                    </div>
                                    <div class="custom_packs_content">
                                        <div class="custom_packs_headers">
                                            <span><?php the_field('poslugy', 'option'); ?></span>
                                            <span><?php the_field('raz_v_god', 'option'); ?></span>
                                        </div>
                                        <div class="custom_packs_data js-custom-loop">
                                            <?php require 'templates/custom-packages/custom-loop.php'; ?>
                                        </div>
                                        <div class="custom_packs_pag">
                                            <?php if ($count === 1) : ?>
                                                <a href="javascript:;"
                                                   class="custom_packs_bn custom_packs_bn_next js-next"><?php the_field('dali', 'option');
                                                    ?></a>
                                            <?php elseif ($count === $length) : ?>
                                                <a href="javascript:;"
                                                   class="custom_packs_bn custom_packs_bn_prev js-prev"><?php the_field('nazad', 'option');
                                                    ?></a>
                                            <?php else : ?>
                                                <a href="javascript:;"
                                                   class="custom_packs_bn custom_packs_bn_prev js-prev"><?php the_field('nazad', 'option');
                                                    ?></a>
                                                <a href="javascript:;"
                                                   class="custom_packs_bn custom_packs_bn_next js-next"><?php the_field('dali', 'option');
                                                    ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <?php require 'templates/custom-packages/custom-result.php'; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>