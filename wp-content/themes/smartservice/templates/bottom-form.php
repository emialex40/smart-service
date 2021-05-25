<section id="info" class="info">
    <div class="info_bg" style="background-image: url(<?php the_field('i_img') ?>);"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-12 info_pos">
                <h2 class="h2 info_title wow animated fadeInUp"><?php the_field('i_title'); ?></h2>
                <p class="info_subtitle wow animated fadeInUp"><?php the_field('i_text'); ?></p>
                <div class="info_wrapper wow animated fadeInUp">
                    <?php 
                        $items = get_field('i_info'); 

                        foreach ( $items as $item ) :
                    ?>
                    <div class="info_item">
                        <div class="info_item_icon"><img src="<?php echo $item['i_icon']; ?>"
                                alt="<?php echo $item['i_name']; ?>"></div>
                        <h6 class="info_item_title"><?php echo $item['i_name']; ?></h6>
                        <?php 
                        $info_link = $item['i_link_type']; 
                        
                        if ( $info_link !== 'none' ) :
                            $link_type = ( $info_link === 'email' ) ? 'mailto:' . $item['i_data']  : phone_format( $item['i_data'] );
                        ?>
                        <a href="<?php echo $link_type; ?>" class="info_item_data"><?php echo $item['i_data']; ?></a>
                        <?php else : ?>
                        <p class="info_item_data"><?php echo $item['i_data']; ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div class="info_form wow animated fadeInUp">
                    <h4 class="info_form_title"><?php the_field('i_form_title'); ?></h4>
                    <div class="info_form_place">
                        <?php echo do_shortcode(''. get_field('i_form') . ''); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
