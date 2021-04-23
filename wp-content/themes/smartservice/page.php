<?php
get_header();
?>

<?php get_hero(); ?>

    <section class="post">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <article class="post-article">
                        <?php the_content(); ?>
                    </article>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>