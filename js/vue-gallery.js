Vue.component('thumbnail-gallery', {
    template: `
        <div id="thumnbnail-gallery-container" class="clearfix">
            <div class="gallery-items" v-for="image in images">
                <a :href="image.image_url" data-fancybox="images">
                    <img :src="image.medium_image_url" :alt="image.image_title">
                </a>
            </div>
        </div>`,
    props: ['images']
});

Vue.component('slider-gallery', {
    template: `
        <div id="slider-gallery-container" >
            <div class="custom-gal">
                <div v-for="image in images">
                    <a :href="image.image_url" data-fancybox="images">
                        <img :src="image.image_url" :alt="image.image_title" />
                    </a>
                </div>
            </div>

            <div class="custom-gal-thumb">
                <div v-for="image in images">
                    <img :src="image.medium_image_url" :alt="image.image_title" />
                </div>
            </div>
        </div>`,

    props: ['images']
});

Vue.component('filter-gallery', {
    template: `
        <div id="filter-gallery">
            <div id="filters" class="button-group">  
                <button class="button is-checked" data-filter="*">All</button>
                <button class="button" v-for="filter in filters" :data-filter="'.'+slugify(filter)">{{filter}}</button>  
            </div>

            <div id="filter-gallery-container" class="clearfix filter-gallery-grid">
                <div v-for="image in images" :class="'gallery-items '+ slugifyArray( image.image_filter )">
                    <a :href="image.image_url" data-fancybox="images">
                        <img :src="image.medium_image_url" :alt="image.image_title">
                    </a>
                </div>
            </div>
        </div>`,

    props: ['images', 'filters'],

    mounted() {
        setTimeout(function () { 
            
            var grid = jQuery('#filter-gallery-container').isotope({
                itemSelector: '.gallery-items'
            });

            jQuery('#filters').on('click', 'button', function () {
                var filterValue = jQuery(this).attr('data-filter');
                filterValue = filterValue;
                grid.isotope({ filter: filterValue });
            });
         }, 500);
    },

    methods: {
        slugify: function (text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')        
                .replace(/[^\w\-]+/g, '')       
                .replace(/\-\-+/g, '-')         
                .replace(/^-+/, '')             
                .replace(/-+$/, '');
        },

        slugifyArray: function(params) {
            var array_class = "";
            for (i = 0; i < params.length; i++) {
                array_class += this.slugify( params[i] ) + ' ';
            }
            return array_class;
        }
    }
    
});


var elements = document.querySelectorAll('[data-gallery-atts]');
elements.forEach(function (element) {
    var atts = JSON.parse(element.getAttribute('data-gallery-atts'))
    console.log(atts);

    var app1 = new Vue({
        el: '#mix-gallery',

        data: {
            images: [],
            type : '',
            filters : []
        },

        template: `
            <div class="gallery-wrapper">
                <thumbnail-gallery :images="images" v-if="type == 'thumb-gal'"></thumbnail-gallery>
                <slider-gallery :images="images" v-else-if="type == 'slider-gal'"></slider-gallery>
                <filter-gallery :images="images" :filters="filters" v-else-if="type == 'filter-gal'"></filter-gallery>
            </div>`,

        created: function() {
            this.images = atts.gallery;
            this.type = atts.type;
            this.filters = atts.filters;
        },
         
        
    });
});








