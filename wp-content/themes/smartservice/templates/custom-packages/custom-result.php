<div class="custom_packs_result">
    <div class="custom_packs_result_header">
        <span><?php the_field('typ_prymishhennya', 'option'); ?></span> <strong><?php the_field('kvartyry', 'option'); ?></strong>
    </div>
    <div class="calc_check_line"></div>
    <div class="custom_packs_result_body">
        <div class="custom_packs_result_body_item">

        </div>
        <div class="custom_packs_result_price">
            <strong><?php the_field('vartist_paketu_res', 'option'); ?> <b>___</b> грн</strong>
        </div>
    </div>
    <div class="calc_check_line"></div>
    <div class="custom_packs_result_footer">
        <button class="custom_packs_result_btn disabled" disabled><?php the_field('zamovyty', 'option'); ?></button>
        <p class="custom_packs_result_info">* <?php the_field('rozrahunok', 'option'); ?></p>
    </div>
</div>