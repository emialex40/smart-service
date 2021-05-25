<?php

//debug function for var_dump()
function debug($bug)
{
    echo '<pre style="padding: 15px; background: #000; display:block; width: 100%; color: #fff;">';
    var_dump($bug);
    echo '</pre>';
}

$path = get_template_directory() . '/';

require_once $path . 'functions/default_sittings_func.php';

require_once $path . 'functions/load_styles_scripts_func.php';

require_once $path . 'functions/thumbnail_sizes_func.php';

require_once $path . 'functions/acf_optionns_func.php';

require_once $path . 'functions/menu_walker_class_func.php';

require_once $path . 'functions/create_post_type_func.php';

require $path . 'functions/packages_toggle_func.php';

require_once $path . 'functions/get_hero_func.php';

require_once $path . 'functions/pagination_func.php';

require_once $path . 'functions/breadcrumbs_func.php';

require_once $path . 'functions/packages_result_ajax_func.php';

require_once $path . 'functions/custom_packs_ajax_func.php';
