<template>

<div class="carousel relative mx-auto w-full">

        <div class="p-2 md:p-4 bg-blue-400 flex justify-between"> 

        <div class="flex text-white text-center p-2"> </div>
        
       <!-- <div class="flex">  

            <input class="w-32 md:w-64 rounded-full p-2 shadow-lg focus-round focus:outline-none focus:shadow-outline" type="text" placeholder="Search...">
          
        </div> -->
        </div>


        <div class="carousel-inner relative overflow-hidden w-full h-full">
            <!--Slide 1-->
            <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
            <router-link :to="{name: 'store'}" class="carousel-item absolute opacity-0" style="max-height:70vh;">
                <img v-show="!sliderLdg1" class="block w-full mx-auto flex object-cover" src="/banners/ON_CALL_PLUS.png" alt="ON CALL PLUS" @load="onsliderLdg1">

                <div v-show="sliderLdg1" class="justify-self-center flex justify-center items-center py-10">
                    <div class="loader"> </div>
                </div>


                   <!-- <div class=" mx-auto">
                        <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                             <p class="text-black text-2xl my-4">Stripy Zig Zag Jigsaw Pillow and Duvet Set</p>
                            <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">view product</a> 
                        </div>
                    </div> -->
            </router-link>
            <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!--Slide 2-->
            <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
            <router-link :to="{name: 'store'}" class="carousel-item absolute opacity-0" style="max-height:70vh;">

                 <img v-show="!sliderLdg2" class="block w-full mx-auto flex object-cover" src="/banners/Sanitazion_Banner.png" alt="Sanitazion Banner" @load="onsliderLdg2">

                <div v-show="sliderLdg2" class="justify-self-center flex justify-center items-center py-10">
                    <div class="loader"> </div>
                </div>


                   <!-- <div class=" mx-auto">
                        <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                            <p class="text-black text-2xl my-4">Real Bamboo Wall Clock</p>
                            <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">view product</a>
                        </div>
                    </div> -->

            </router-link>
            <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!--Slide 3-->
            <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
           <router-link :to="{name: 'store'}" class="carousel-item absolute opacity-0" style="max-height:70vh;">

                 <img v-show="!sliderLdg3" class="block w-full mx-auto flex object-cover" src="/banners/HEALTH_GOES_BEYOND_HAND_SANITIZER.png" alt="Health Banner" @load="onsliderLdg3">

                <div v-show="sliderLdg3" class="justify-self-center flex justify-center items-center py-10">
                    <div class="loader"> </div>
                </div>

              <!--      <div class=" mx-auto">
                        <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                            <p class="text-black text-2xl my-4">Brown and blue hardbound book</p>
                            <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">view product</a>
                        </div>
                    </div> -->
            </router-link>
            <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!-- Add additional indicators for each slide-->
            <ol class="carousel-indicators">
                <li class="inline-block mr-3">
                    <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                </li>
            </ol>

        </div>

         <div class="p-2 md:p-4 bg-blue-400"> 

        <div class="text-white text-left p-2"> </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Slider",

        data () {
          return {
          sliderLdg1: true,
          sliderLdg2: true,
          sliderLdg3: true,
        }
      },
        methods: {
        onsliderLdg1 () {
            this.sliderLdg1 = false
        },
        onsliderLdg2 () {
            this.sliderLdg2 = false
        },
        onsliderLdg3 () {
            this.sliderLdg3 = false
        }
      }
    }
</script>
<style scoped>

</style>