<?php  
$logo = get_field('site_logo', 'option');
$logo_thumb = $logo['sizes']['gallery-thumb'];
?>

<!DOCTYPE HTML>
<html>

<head <?php language_attributes(); ?>>
    <title><?php wp_title(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php
    wp_head();
    $favicon = get_option('theme_favicon');
    $logo = get_field('header_logo', 'option');
    ?>
    <meta name='apple-itunes-app' content='app-id=​myAppStoreID​'>
    <link rel="icon" href="<?php print $favicon; ?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php print $favicon; ?>" type="image/x-icon" />

    <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) : ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
        integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
        crossorigin="anonymous" />
    <?php endif; ?>
</head>

<body <?php body_class(); ?>>
    <script>
    </script>
    <div id="root">
        <div class="app">
            <div class="app_main">
                <header class="header">
                    <div class="container">
                        <div class="row">
                            <div class="col-3 v-centered">
                                <div class="header_logo">
                                    <?php if (!is_front_page()) : ?>
                                    <a href="<?php echo home_url('/'); ?>">
                                        <?php endif; ?>
                                        <img src="<?php echo $logo_thumb; ?>" alt="<?php echo bloginfo( 'name' ); ?>">
                                        <?php if (!is_front_page()) : ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col">
                                <nav class="header_menu">
                                    <?php 
                                    if (has_nav_menu('header_menu')) {
                                        wp_nav_menu(array(
                                            'theme_location' => 'header_menu',
                                            'menu_class' => 'header_menu_links',
                                            'container' => '',
                                            'container_class' => '',
                                            'menu_id' => 'header_menu_links',
                                            'depth' => 1,
                                            'walker' => new Main_Submenu_Class()));
                                    }
                                ?>
                                </nav>
                            </div>
                            <div class="col-md-3 col v-centered flex-center space-between header_btn_wrapper">
                                <div id="lang_switcher">
                                    <div class="lang_switch_wrap">
                                        <div class="lang_current"></div>
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
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <a class="btn header_btn"
                                    href="<?php the_field('contact_link', 'option'); ?>"><?php esc_html_e( 'Контакти', 'smart' ); ?></a>
                                <div class="header_hamburger">
                                    <div>
                                        <button class="hamburger hamburger--collapse" type="button">
                                            <span class="hamburger-box">
                                                <span class="hamburger-inner"></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <main>
