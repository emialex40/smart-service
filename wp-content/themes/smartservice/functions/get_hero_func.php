<?php

function get_hero($is_class = '', $is_title = '')
{
    $id = get_the_ID();
    $get_background = get_the_post_thumbnail_url($id, 'full');
    $default = '/wp-content/uploads/2021/04/single-scaled.jpg';
    $background = (!empty($get_background)) ? $get_background : $default;

    $title = ($is_title !== '') ? $is_title : get_the_title();

    $class = ($is_class !== '') ? ' ' . $is_class : '';
    ?>
    <section class="page-hero<?php echo $class; ?>" style="background-image: url(<?php echo $background; ?>);">
        <div class="page-hero-ovelay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 page-hero-wrapper">
                    <h1 class="h1 wow animated fadeInLeft"><?php echo $title; ?></h1>
                </div>
            </div>
        </div>

<!--        --><?php //require 'templates/inside_svg.php'; ?>
        <?php require  get_template_directory() . '/templates/inside_svg.php'; ?>
    </section>
<?php }
