<?php
/**
 *  Template for the services category
 */

get_header();

$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
$taxonomy = $term->taxonomy;
$term_id = $term->term_id;
$cat_parent = get_term($term->parent);
$cat_parent_link = get_category_link($cat_parent->term_id);


$children = get_term_children($term_id, $taxonomy);

$args = [
    'post_type' => 'service-pack',
    'order' => 'ASC',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => $taxonomy,
            'field' => 'id',
            'terms' => $term_id,
            'include_children' => false
        ]
    ]
];

$query = new WP_Query($args);

?>

<?php get_hero('post-hero', $term->name, false, false); ?>

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

                    <span class="breadcrumbs__current"><?php echo $term->name; ?></span>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="services_cats">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-12">
                <ul class="services_cats_posts">
                    <?php
                    if ($children) :
                        foreach ($children as $child) :
                            $child_cat = get_term_by('id', $child, $taxonomy);
                            $child_id = $child_cat->term_id;
                            $child_name = $child_cat->name;
                            $child_link = get_term_link($child_id, $child_cat->taxonomy);
                            ?>
                            <li class="services_cats_item">
                                <a href="<?php echo $child_link; ?>"><?php echo $child_name; ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php
                    if ($query->have_posts()) :
                        while ($query->have_posts()) :
                            $query->the_post();
                            ?>
                            <li class="services_cats_item">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </ul>

                <div class="services_cats_packs">
                    <div class="services_cats_packs_item">
                        <div class="services_cats_packs_title"><?php the_field('pakety_standart', 'option'); ?></div>
                        <div class="services_cats_packs_text"><?php the_field('pakety_standart_tekst', 'option'); ?></div>
                        <div class="services_cats_packs_btn">
                            <a href="<?php the_field('pakety_standart_posylannya', 'option'); ?>"><?php the_field('detalnishe', 'option'); ?></a>
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
                <div class="services_cats_content">
                    <?php
                    $img = get_field('serv_img', $taxonomy . '_' . $term_id);
                    $text = get_field('serv_cat_txt', $taxonomy . '_' . $term_id);

                    if ($img) :
                        ?>
                        <div class="service_single_image">
                            <img width="1140" src="<?php echo $img; ?>" alt="<?php echo $term->name; ?>">
                        </div>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <article class="post-article service_single_text content">
                            <?php echo $text; ?>
                        </article>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>


