<?php
/*
* Thumbnail Gallery Layout
*
*/
?>

<div id="thumnbnail-gallery-container" class="clearfix">
    <?php foreach ($gallery['thumbnail_gal_images'] as $gallery_image ) : ?>
        <div class="gallery-items">
            <a href="<?php echo $gallery_image['url']; ?>" data-fancybox="images">
                <img src="<?php echo $gallery_image['sizes']['medium']; ?>" alt="<?php echo $gallery_image['alt']; ?>">
            </a>
        </div>
    <?php endforeach; ?>
</div>