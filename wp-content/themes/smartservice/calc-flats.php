<?php
/**
 *  Template Name: Квартиры калькулятор
 */

get_header()

?>

<?php get_hero(); ?>

    <section class="calc">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="calc_wrapper">
                        <?php
                        $taxonomy = 'packages_flats';
                        $flats_terms = get_terms($taxonomy);
                        ?>

                        <div class="calc_buttons">
                            <? foreach ($flats_terms as $term) : ?>
                                <div class="calc_buttons_col">
                                    <a href="javascript:;" class="btn calc_buttons_btn" data-cat="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a>
                                </div>
                            <?php endforeach; ?>
                            <div class="calc_buttons_col">
                                <a href="javascript:;" class="btn calc_buttons_btn calc_buttons_btn_indi">Індівидуальний</a>
                            </div>
                        </div>
                        <div class="calc_content">

                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="calc_check">

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>