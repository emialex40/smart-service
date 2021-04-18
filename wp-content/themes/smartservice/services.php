<?php
/*
 *  Template Name: Послуги
 */

get_header();

$taxonomy = 'services_cats';
$cats = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
    'orderby' => 'id',
    'parent' => 0,
    'order' => 'ASC'
]);


?>

<?php get_hero(); ?>

<?php //echo esc_url(get_term_link($cat)); ?><!--"-->
    <section class="services_list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="services_list_grid">
                        <?php foreach ($cats as $cat) : ?>
                            <div class="services_list_item">
                                <div class="services_list_main">
                                    <div class="services_list_icon">
                                        <img src="<?php echo get_field('serv_icon', $cat->taxonomy . '_' . $cat->term_id); ?>"
                                             alt="">
                                    </div>
                                    <h3><?php echo $cat->name; ?></h3>
                                </div>
                                <div class="services_list_hide">
                                    <?php if ($cat->description) : ?>
                                        <div class="services_list_cat"><?php echo substr($cat->description, 0, 100) . ' ...' ?></div>
                                    <?php endif; ?>
                                    <a class="services_list_btn"
                                       href="<?php echo esc_url(get_term_link($cat)); ?>"><?php echo get_field('detalnishe', 'option'); ?></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>