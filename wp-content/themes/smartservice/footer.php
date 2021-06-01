<?php
$logo = get_field('site_logo', 'option');
$logo_thumb = $logo['sizes']['gallery-thumb'];


?>

</main>
</div>
</div>
</div>

<footer class="footer bg_dark">
    <div class="container">
        <div class="row footer_wrapper">
            <div class="col-lg-3 col-12">
                <div class="footer_logo">
                    <?php if (!is_front_page()) : ?>
                    <a href="">
                        <?php endif; ?>
                        <img src="<?php echo $logo_thumb; ?>" alt="<?php echo bloginfo( 'name' ); ?>">
                        <?php if (!is_front_page()) : ?>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="footer_desc">
                    <p><?php the_field('site_desc', 'option'); ?></p>
                </div>
                <div class="social footer_social">
                    <a href="<?php the_field('facebook', 'option'); ?>"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php the_field('insta', 'option'); ?>""><i class=" fab fa-instagram"></i></a>
                    <a href="<?php the_field('viber', 'option'); ?>""><i class=" fab fa-viber"></i></a>
                    <a href="<?php the_field('telegram', 'option'); ?>""><i class=" fab fa-telegram-plane"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-12">
                <h6><?php esc_html_e( 'про нас', 'themefooter' ) ?></h6>
                <nav class=footer_nav>
                    <?php  if (has_nav_menu('footer_menu_left')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer_menu_left',
                            'menu_class' => 'footer_menu',
                            'container' => '',
                            'container_class' => '',
                            'menu_id' => 'footer_menu_left',
                            'depth' => 0,
                            'walker' => new Main_Submenu_Class()));
                        } 
                    ?>
                </nav>
            </div>
            <div class="col-lg-2 col-12">
                <h6><?php esc_html_e( 'послуги', 'themefooter' ) ?></h6>
                <nav class=footer_nav>
                    <?php  if (has_nav_menu('footer_menu_center')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer_menu_center',
                            'menu_class' => 'footer_menu',
                            'container' => '',
                            'container_class' => '',
                            'menu_id' => 'footer_menu_center',
                            'depth' => 0,
                            'walker' => new Main_Submenu_Class()));
                        } 
                    ?>
                </nav>
            </div>
            <div class="col-lg-2 col-12">
                <h6><?php esc_html_e( 'пакети', 'themefooter' ) ?></h6>
                <nav class=footer_nav>
                    <?php  if (has_nav_menu('footer_menu_center')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer_menu_right',
                            'menu_class' => 'footer_menu',
                            'container' => '',
                            'container_class' => '',
                            'menu_id' => 'footer_menu_right',
                            'depth' => 0,
                            'walker' => new Main_Submenu_Class()));
                        } 
                    ?>
                </nav>
            </div>
            <div class="col-lg-3 col-12">
                <div class="footer_address">
                    <h6><?php esc_html_e( 'адреса', 'themefooter' ) ?></h6>
                    <p>
                        <?php the_field('address', 'option'); ?>
                    </p>
                    <?php echo get_email(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="footer_bottom">
                    <span>Copyright &copy; <?php echo date('Y'); ?> <?php echo bloginfo( 'name' ); ?></span>
                </div>
            </div>
        </div>

    </div>
</footer>

<?php include_once 'templates/mobile-menu.php'; ?>



<script>
var ajax_web_url = '<?php echo admin_url('admin-ajax.php', 'relative') ?>';
</script>

<div id="custom_pcks_form" style="display: none;">
    <div class="callback_form_header">
        <h2 class=""><?php the_field('individualnyj', 'option'); ?> пакет</h2>
        <h5 class="callback_form_subtitle js-type"></h5>
    </div>
    <?php echo do_shortcode('' . get_field('cm_pcgs_form', 'option') . ''); ?>
</div>

<div id="callback_form" class="callback_form" style="display: none;">
    <div class="callback_form_header">
        <h2>передзвонить мені</h2>
    </div>
    <?php echo do_shortcode('' . get_field('callback_form', 'option') . ''); ?>
</div>

<div id="packs_flats" class="callback_form" style="display: none;">
    <div class="callback_form_header">
        <h2 class=""></h2>
        <h5 class="callback_form_subtitle js-subtitle"></h5>
    </div>
    <?php echo do_shortcode('' . get_field('packs_standart', 'option') . ''); ?>
</div>

<!--<script src="/js/wow.min.js"></script>-->

<?php wp_footer(); ?>
<script>
new WOW().init();
</script>
</body>

</html>
