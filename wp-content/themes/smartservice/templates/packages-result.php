<div class="calc_check_top">
    <p class="calc_check_main"><?php the_field('vy_otrymayete', 'option') ?> </p>
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
