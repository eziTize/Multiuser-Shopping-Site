<template>

    <div id="home">


        <slider></slider>

        <fshop></fshop>

   <div class="mb-10 md:mb-12 lg:mb-16">

        <div class="py-4 flex justify-center bg-blue-400">

                <div class="flex h-0 w-8 md:w-32 lg:w-48 border-2 mt-3 md:mt-5 lg:mt-8"> </div>
                <div class="flex px-4 md:px-10 text-lg md:text-2xl lg:text-4xl font-bold text-gray-900"> Medical Home Products </div>
                <div class="flex h-0 w-8 md:w-32 lg:w-48 border-2 mt-3 md:mt-5 lg:mt-8"> </div>
              
        </div>

         <div v-show="ImgLoading1" class="justify-self-center flex justify-center items-center py-10">
            <div class="loader"> </div>
        </div>
        <router-link :to="{name: 'store'}">
          <img v-show="!ImgLoading1" style="max-height: 70vh" class="w-full px-4 md:px-10 object-cover" alt="Medical Home Products Banner" src="/banners/Medical_Home_Products_Banner.png" @load="onImgLoad1">
        </router-link>
    </div>

   <!-- <div class="mb-0 lg:mb-2 py-4 pb-5 lg:py-8">

        <div class="py-4 flex justify-center">

                <div class="flex h-0 w-12 md:w-40 lg:w-56 border-2 mt-3 md:mt-5 lg:mt-8"> </div>
                <div class="flex px-4 md:px-10 text-lg md:text-2xl lg:text-4xl font-bold text-gray-900"> Emergency Products </div>
                <div class="flex h-0 w-12 md:w-40 lg:w-56 border-2 mt-3 md:mt-5 lg:mt-8"> </div>
              
        </div>

          <img style="max-height: 70vh" class="w-full px-4 md:px-10 object-cover" alt="banner-2" src="/images/banner-2.png">
    </div> -->


    <router-link :to="{name: 'store'}" class="mb-10 mt-8 lg:mt-16 md:mb-12 lg:mb-16 pb-2 md:pb-4 lg:pb-6">
          <div v-show="ImgLoading2" class="justify-self-center flex justify-center items-center py-10">
            <div class="loader" v-show="ImgLoading2"> </div>
           </div>
          <img v-show="!ImgLoading2" style="max-height: 70vh" class="w-full object-cover" alt="HEALTH GOES BEYOND HAND SANITIZER" src="/banners/HEALTH_GOES_BEYOND_HAND_SANITIZER.png" @load="onImgLoad2">
    </router-link>

<h_footer />

</div>



</template>

<script>
    import fshop from '../components/fshop.vue';
    import Slider from '../components/Slider.vue';
    import h_footer from '../components/h_footer.vue';


    export default {
        components: {
            fshop,
            Slider,
            h_footer,
        },
        data () {
          return {
          ImgLoading1: true,
          ImgLoading2: true,
        }
      },
        methods: {
        onImgLoad1 () {
            this.ImgLoading1 = false
        },
        onImgLoad2 () {
            this.ImgLoading2 = false
        }
      }

        
    };


    
</script>

<style>
    .worksans {
        font-family: 'Work Sans', sans-serif;
    }

    #menu-toggle:checked + #menu {
        display: block;
    }

    .hover\:grow {
        transition: all 0.3s;
        transform: scale(1);
    }

    .hover\:grow:hover {
        transform: scale(1.02);
    }

    .carousel-open:checked + .carousel-item {
        position: static;
        opacity: 100;
    }

    .carousel-item {
        -webkit-transition: opacity 0.6s ease-out;
        transition: opacity 0.6s ease-out;
    }

    #carousel-1:checked ~ .control-1,
    #carousel-2:checked ~ .control-2,
    #carousel-3:checked ~ .control-3 {
        display: block;
    }

    .carousel-indicators {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        bottom: 2%;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 10;
    }

    #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
    #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
    #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
        color: #000;
        /*Set to match the Tailwind colour you want the active one to be */
    }
</style>