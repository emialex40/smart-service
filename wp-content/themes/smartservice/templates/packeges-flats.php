<?php 
    $args = [
        'post_type'      => 'home-packs',
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'posts_per_page' => -1
    ];

    $query = new WP_Query($args);
    $count = 0;
    

    if ( $query->have_posts() ) : 
        while ( $query->have_posts() ) :
            $query->the_post();

            $count++;
            $hide = ($count > 1) ? 'style="display: none"' : '';


            $min = get_field('pk_min');
            $opt = get_field('pk_opt');
            $bus = get_field('pk_bus');


?>
<div id="packages_row<?php echo $count; ?>" class="row packages_row" <?php echo $hide; ?>>
    <div class="packages_col">
        <div class="packages_item">
            <div class="packages_item_header">
                <div class="packages_item_icon"><i class="<?php echo $min['icon_min_class']; ?>"></i></div>
                <h3><?php echo $min['pk_min_header']; ?></h3>
            </div>
            <div class="packages_item_content">
                <div class="packages_item_price">
                    <span><?php esc_html_e('від', 'home'); ?></span>
                    <b><?php echo $min['pk_min_price']; ?></b>
                    <span><?php esc_html_e('грн', 'home'); ?></span>
                </div>
                <ul class="packages_item_services">
                    <?php 
                        $servs = $min['pk_min_servs'];
                        if ( $servs ) :
                        foreach ($servs as $serv) :
                    ?>
                    <li><span><i class="fas fa-check-circle"></i><?php echo $serv['pk_min_serv']; ?></span></li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>
            <div class="packages_item_footer">
                <a href="<?php echo $min['pk_min_link'] ?>"><?php the_field('detalnishe', 'option'); ?></a>
            </div>
        </div>

    </div>
    <div class="packages_col">
        <div class="packages_item  cur">
            <div class="packages_item_header">
                <div class="packages_item_icon"><i class="<?php echo $opt['pk_opt_class'];?>"></i></div>
                <h3><?php echo $opt['pk_opt_header'] ?></h3>
            </div>
            <div class="packages_item_content">
                <div class="packages_item_price">
                    <span><?php esc_html_e('від', 'home'); ?></span>
                    <b><?php echo $opt['pk_opt_price'] ?></b>
                    <span><?php esc_html_e('грн', 'home'); ?></span>
                </div>
                <ul class="packages_item_services">
                    <?php 
                        $servs2 = $opt['pk_opt_servs'];
                        if ( $servs2 ) :
                        foreach ($servs2 as $serv2) :
                    ?>
                    <li><span><i class="fas fa-check-circle"></i><?php echo $serv2['pk_opt_serv']; ?></span></li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>
            <div class="packages_item_footer">
                <a href="<?php echo $opt['pk_opt_link'] ?>"><?php the_field('detalnishe', 'option'); ?></a>
            </div>
        </div>
    </div>
    <div class="packages_col">
        <div class="packages_item">
            <div class="packages_item_header">
                <div class="packages_item_icon"><i class="<?php echo $bus['pk_bus_class']; ?>"></i></div>
                <h3><?php echo $bus['pk_bus_header']; ?></h3>
            </div>
            <div class="packages_item_content">
                <div class="packages_item_price">
                    <span><?php esc_html_e('від', 'home'); ?></span>
                    <b><?php echo $bus['pk_bus_price']; ?></b>
                    <span><?php esc_html_e('грн', 'home'); ?></span>
                </div>
                <ul class="packages_item_services">
                    <?php 
                        $servs3 = $bus['pk_bus_servs'];
                        if ( $servs3  ) :
                        foreach ($servs3 as $serv3) :
                    ?>
                    <li><span><i class="fas fa-check-circle"></i><?php echo $serv3['pk_bus_serv']; ?></span></li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>
            <div class="packages_item_footer">
                <a href="<?php echo $bus['pk_bus_link']; ?>"><?php the_field('detalnishe', 'option'); ?></a>
            </div>
        </div>
    </div>
</div>
<?php   
            endwhile; 
        endif;
    wp_reset_postdata();
?>
