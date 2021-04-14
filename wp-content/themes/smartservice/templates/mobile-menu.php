<div id="mobile_menu" class="mobile_menu ">
    <div class="mobile_menu_header">
        <div id="lang_chooser_mob">
            <?php
            the_widget('qTranslateXWidget',
                array(
                    'type'           => 'custom',
                    'format'         => '%c',
                    'hide-title'     => true,
                    'widget-css-off' => true
                ));
            ?>
        </div>
    </div>
    <nav class="mob_menu">
        <?php  if (has_nav_menu('header_menu')) {
        wp_nav_menu(array(
            'theme_location' => 'header_menu',
            'menu_class' => 'mob_menu_links_mob',
            'container' => '',
            'container_class' => '',
            'menu_id' => 'mob_menu_links_mob',
            'depth' => 0,
            'walker' => new Main_Submenu_Class()));
    } ?>
    </nav>
</div>

<!-- <div class="bg"></div> -->
