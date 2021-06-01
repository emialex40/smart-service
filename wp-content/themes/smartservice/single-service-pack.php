<?php
/*
 *  Template of single page for service-pack post type
 */

get_header();

$id = get_the_ID();

$category = get_the_terms($id, 'services_cats');
$cat_link = get_category_link($category[0]->term_id);
$cat_parent = get_term($category[0]->parent);
$cat_parent_link = get_category_link($cat_parent->term_id);

?>

<?php get_hero('post-hero', '', false, false); ?>

    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a class="breadcrumbs__link" href="https://dev2.pineapple.zp.ua/" itemprop="item">
                                <span itemprop="name"><i class="fas fa-home"></i></span>
                            </a>
                            <meta itemprop="position" content="1">
                        </span>
                        <span class="breadcrumbs__separator"> / </span>

                        <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a class="breadcrumbs__link" href="<?php echo get_site_url(); ?>/services/" itemprop="item">
                                <span itemprop="name"><?php the_field('bc_poslugy', 'option') ?></span>
                            </a>
                            <meta itemprop="position" content="1">
                        </span>
                        <span class="breadcrumbs__separator"> / </span>

                        <?php if ($cat_parent->name) : ?>
                            <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a class="breadcrumbs__link" href="<?php echo $cat_parent_link; ?>" itemprop="item">
                                <span itemprop="name"><?php echo $cat_parent->name; ?></span>
                            </a>
                            <meta itemprop="position" content="1">
                        </span>
                            <span class="breadcrumbs__separator"> / </span>
                        <?php endif; ?>

                        <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a class="breadcrumbs__link" href="<?php echo $cat_link; ?>" itemprop="item">
                                <span itemprop="name"><?php echo $category[0]->name; ?></span>
                            </a>
                            <meta itemprop="position" content="1">
                        </span>
                        <span class="breadcrumbs__separator"> / </span>

                        <span class="breadcrumbs__current"><?php the_title(); ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="service_single">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                    $img_arr = get_field('zobrazhennya_poslug');
                    $img = $img_arr['sizes']['container-size'];
                    $alt = $img_arr['alt'] ? $img_arr['alt'] : get_the_title();
                    ?>
                    <div class="service_single_image">
                        <img width="1140" src="<?php echo $img; ?>" alt="<?php echo $alt; ?>">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-12">
                    <div class="services_cats_packs">
                        <div class="services_cats_packs_item">
                            <div class="services_cats_packs_title"><?php the_field('pakety_standart', 'option'); ?></div>
                            <div class="services_cats_packs_text"><?php the_field('pakety_standart_tekst', 'option'); ?></div>
                            <div class="services_cats_packs_btn">
                                <a href="<?php the_field('pakety_standart_posylannya', 'option'); ?>"><?php the_field('detalnishe', 'option'); ?></a>
                            </div>
                        </div>
                        <div class="services_cats_packs_item">
                            <div class="services_cats_packs_title"><?php the_field('pakety_budynky_zagolovok', 'option'); ?></div>
                            <div class="services_cats_packs_text"><?php the_field('pakety_budynky_tekst', 'option'); ?></div>
                            <div class="services_cats_packs_btn">
                                <a href="<?php the_field('pakety_budynky_posylannya', 'option'); ?>"><?php the_field('detalnishe', 'option'); ?></a>
                            </div>
                        </div>
                        <div class="services_cats_packs_item">
                            <div class="services_cats_packs_title"><?php the_field('paket_indyvidualnyj', 'option'); ?></div>
                            <div class="services_cats_packs_text"><?php the_field('paket_indyvidualnyj_tekst', 'option'); ?></div>
                            <div class="services_cats_packs_btn">
                                <a href="<?php the_field('paket_indyvidualnyj_posylannya', 'option'); ?>"><?php the_field('detalnishe', 'option'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8 col-12">
                    <article class="post-article service_single_text">
                        <?php the_field('tekst_poslug'); ?>
                    </article>
                </div>
            </div>
            <?php
            $galleries = get_field('galereya_poslugy');

            if ($galleries) :
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="post-gallery">
                            <?php foreach ($galleries as $gallery) : ?>
                                <div class="post-gallery-item">
                                    <a data-fancybox="service-gallery<?php echo $id; ?>" href="<?php echo $gallery['url']; ?>">
                                        <img width="350" height="233"
                                             src="<?php echo $gallery['sizes']['gallery-thumb']; ?>" alt="<?php the_title(); ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php get_footer(); ?>