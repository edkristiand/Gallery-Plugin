<?php 

    $images = $gallery; 
    
?>

    <div class="custom-gal">
        <?php foreach( $images['thumbnail_gal_images'] as $image ): ?>
            <div>
                <a href="<?php echo $image['url']; ?>" data-fancybox="images">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="custom-gal-thumb">
        <?php foreach( $images['thumbnail_gal_images'] as $imageThumb ): ?>
            <div>
                <img src="<?php echo $imageThumb['sizes']['medium']; ?>" alt="<?php echo $imageThumb['alt']; ?>" />
            </div>
        <?php endforeach; ?>
    </div> 