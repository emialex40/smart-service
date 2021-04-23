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

    <!--services list beginning-->
<?php
$services_list = get_field('sv_cat_list');

if ($services_list) :
    ?>
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
<?php endif; ?>
    <!--services list end-->

    <!--why as beginning-->

    <section class="waranty bg-light-grey" style="background-image: url(<?php the_field('sv_why_bg'); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="waranty_wrapper">
                        <h2 class="h2 wow animated fadeInUp"><?php the_field('sv_why_title'); ?></h2>
                        <div class="waranty_subtitle wow animated fadeInUp">
                            <?php the_field('sv_why_subtitle'); ?>
                        </div>
                        <?php
                        $akks = get_field('sv_why_list');

                        if ($akks) :
                            ?>
                            <ul class="accordion-small wow animated fadeInUp delay-1s">
                                <?php foreach ($akks as $akk) : ?>
                                    <li>
                                        <div class="accordion-small_title">
                                            <h6><?php echo $akk['sv_why_list_title']; ?> </h6>
                                            <i aria-hidden="true" class="fas fa-plus"></i>
                                        </div>
                                        <div class="accordion-small-content" style="display: none;">
                                            <?php echo $akk['sv_why_list_text']; ?>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <a class="btn btn-standart freedom_btn wow animated fadeInUp delay-2s"
                           href="<?php the_field('why_btn_link'); ?>"><?php the_field('why_btn_text'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--why as end-->

    <!--packages beginning-->
    <section class="f-packs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="principles_titles f-packs_header">
                        <h6 class="text-blue text-center wow animated fadeInUp"><?php the_field('sv_fr_subtitle'); ?></h6>
                        <h2 class="principles_header text-center wow animated fadeInUp"><?php the_field('sv_fr_title'); ?></h2>
                        <p class="principles_text text-center wow animated fadeInUp"><?php the_field('sv_fr_text'); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    if (get_field('sv_fr_packages')) :

                        $images = get_field('sv_fr_packages');
                        ?>
                        <div class="four-images">
                            <?php foreach ($images as $item) : ?>
                                <div class="four-images_item" style="background-image: url(<?php echo $item['sv_fr_img']; ?>)">
                                    <div class="four-images_wrapper">
                                        <div class="four-images_top">
                                            <h4><?php echo $item['sv_fr_title_rp'] ?></h4>
                                        </div>
                                        <div class="four-images_bottom">
                                            <p><?php echo $item['sv_fr_txt_rp']; ?></p>
                                            <a class="four-images_link"
                                               href="<?php echo $item['sv_fr_link_rp']; ?>"><?php the_field('detalnishe', 'option');
                                                ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 f-packs_button">
                    <a class="btn btn-border btn-padd f-packs_btn" href="<?php the_field('sv_fr_btn_link'); ?>"><?php the_field('sv_fr_btn_text');
                    ?></a>
                </div>
            </div>
        </div>
    </section>
    <!--packages ebd-->
<?php get_footer(); ?>