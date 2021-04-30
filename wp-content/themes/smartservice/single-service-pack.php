<?php
/*
 *  Template of single page for service-pack post type
 */

get_header();

$id = get_the_ID();
?>

<?php get_hero('post-hero'); ?>

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
                <div class="col-12">
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