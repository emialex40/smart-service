<?php
/**
 *  Template for single page posts
 */
get_header();

$id = get_the_ID();
$categories = get_the_category($id);

foreach ($categories as $category) $category_ids[] = $category->term_id;
$cat_ids = $category->term_id;

$args = [
    'post_type' => 'post',
    'category__in' => $cat_ids,
    'post__not_in' => [$id],
    'showposts' => 4,
    'orderby' => 'rand',
    'caller_get_posts' => 1
];

$query = new WP_Query($args);
?>

<?php get_hero('post-hero', '', '', false); ?>

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
                            <a class="breadcrumbs__link" href="<?php echo get_site_url(); ?>/blog/" itemprop="item">
                                <span itemprop="name"><?php the_field('blog', 'option') ?></span>
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

    <section class="post">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <article class="post-article">
                        <?php the_field('bg_content'); ?>
                    </article>
                    <?php
                    $galleries = get_field('bg_galereya');

                    if ($galleries) :
                        ?>
                        <div class="post-gallery">
                            <?php foreach ($galleries as $gallery) : ?>
                                <div class="post-gallery-item">
                                    <a data-fancybox="gallery<?php echo $id; ?>" href="<?php echo $gallery['url']; ?>">
                                        <img width="350" height="233"
                                             src="<?php echo $gallery['sizes']['gallery-thumb']; ?>" alt="<?php the_title(); ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php if ($query->have_posts()) : ?>
    <section class="post-related">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="post-related-header"><?php the_field('shozhi_posty', 'option'); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 post_list post-related-wrapper">
                    <?php
                    while ($query->have_posts()) : $query->the_post();
                        $post_id = get_the_ID();
                        $cat = get_the_category($post_id);
                        $cat_name = $cat[0]->name;
                        $date = get_the_date('d.m.Y');
                        ?>
                        <article class="post_list-item">
                            <?php
                            $thumb_arr = get_field('bg_thumb');
                            $thumb = $thumb_arr['sizes']['medium'];
                            $alt = ($thumb_arr['alt']) ? $thumb_arr['alt'] : $thumb_arr['name'];
                            ?>
                            <div>
                                <a href="<?php the_permalink(); ?>" class="post-related-img">
                                    <img width="267" height="178" src="<?php echo $thumb ?>" alt="<?php echo $alt; ?>">
                                </a>

                                <div class="post_list-meta">
                                    <span class="post_list-cat"><?php echo $cat_name; ?></span>
                                    <span class="post_list-date"><?php echo $date; ?></span>
                                </div>

                                <h4 class="post_list-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>

                                <p class="post_list-excerpt">
                                    <?php the_field('bg_excerpt'); ?>
                                </p>
                            </div>
                            <div>
                                <a class="post_list-more" href="<?php the_permalink(); ?>"><?php the_field('chytaty_bilshe', 'option'); ?> <i
                                            class="fas fa-angle-right"></i></a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif;
wp_reset_postdata(); ?>

<?php get_footer(); ?>