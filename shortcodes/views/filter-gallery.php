
<?php
/*
* Filter Gallery Layout
*
*/
?>

<?php if( have_rows('group', 'option') ): ?>

	<div id="filters" class="button-group">  
	 	<button class="button is-checked" data-filter="*">All</button>

	    <?php while ( have_rows('group', 'option') ) : the_row(); ?> 	
	        <button class="button" data-filter=".<?php the_sub_field('category_slug', 'option'); ?>"><?php the_sub_field('category_name', 'option'); ?></button>  
		<?php endwhile; ?>

	</div>
<?php else : ?>
	<h3>No Filter Added!</h3>
<?php endif; ?>

<div id="filter-gallery-container" class="clearfix grid">
    <?php foreach ($gallery['thumbnail_gal_images'] as $gallery_image ) : 

    	$gallery_filters = implode( ' ', get_field( 'image_tags', $gallery_image['id'] ) );

    ?>
        <div class="gallery-items <?php echo $gallery_filters;?>">
            <a href="<?php echo $gallery_image['url']; ?>" data-fancybox="images">
                <img src="<?php echo $gallery_image['sizes']['medium']; ?>" alt="<?php echo $gallery_image['alt']; ?>">
            </a>
        </div>
    <?php endforeach; ?>
</div>