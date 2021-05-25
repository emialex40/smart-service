<?php 
    $video_enb = get_field('enb_video');
    $img_arr = get_field('video_img');
    $img_link = $img_arr['url'];
    $img_alt = ($img['alt']) ? $img['alt'] : 'Video Image';
?>


<div class="video wow animated fadeInUp">
    <a href="<?php the_field('video_link'); ?>" data-fancybox class="video_link">
        <img src="<?php echo $img_link; ?>" alt="<?php echo $img_alt; ?>" class="video_img">
        <span class="video_btn"><i class="fas fa-play"></i></span>
    </a>
</div>
