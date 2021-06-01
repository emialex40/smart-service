<?php

add_action('wp_ajax_packages_result', 'packages_result_func');
add_action('wp_ajax_nopriv_packages_result', 'packages_result_func');

function packages_result_func()
{
    if (isset($_REQUEST)) {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            $cat_id = (isset($_REQUEST['catID'])) ? (int)$_REQUEST['catID'] : 0;
            $field = (isset($_REQUEST['field'])) ? (string)$_REQUEST['field'] : 0;
            $tax = (isset($_REQUEST['taxonomy'])) ? (string)$_REQUEST['taxonomy'] : 0;

            $res_time = get_field($field . '_time', $tax . '_' . $cat_id);
            $res_year = get_field($field . '_price', $tax . '_' . $cat_id);
            $res_month = get_field($field . '_price_month', $tax . '_' . $cat_id);
            ?>
            <div class="calc_check_top">
                <p class="calc_check_main"><?php the_field('vy_otrymayete', 'option') ?></p>
                <p class="calc_check_padd">
                    <b class="calc_check_big"><?php echo $res_time; ?></b><span><?php the_field('godyny', 'option'); ?></span>
                </p>
                <p><?php the_field('ekonomiyi_chasu', 'option'); ?></p>
            </div>
            <div class="calc_check_line"></div>
            <div class="calc_check_middle">
                <div class="calc_check_row">
                    <p><?php the_field('vartist_paketu', 'option'); ?></p>
                    <p class="calc_check_padd">
                        <b><?php echo $res_year; ?></b> <span>грн</span>
                    </p>
                </div>
                <div class="calc_check_row">
                    <p><?php the_field('na_misyacz', 'option'); ?></p>
                    <p class="calc_check_padd">
                        <b><?php echo $res_month; ?></b> <span>грн</span>
                    </p>
                </div>
            </div>
            <div class="calc_check_line"></div>
            <div class="calc_check_bottom">
                <a class="btn calc_check_btn js-flats" href="javascript:;"><?php the_field('zamovyty', 'option'); ?></a>
            </div>

            <?php
        }
    }
    wp_die();
}
