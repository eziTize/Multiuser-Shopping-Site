<template>

<div class="bg-yellow-200 bg-cover" id="edit">

            <div class="container max-w-4xl mx-auto pt-10 mb-12 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Edit or Remove an Existing Product
                </p>
                <p class="text-sm text-black">Fields Marked * must not be empty</p>


  </div>

  <updateproduct>
</updateproduct>

</div>

</template>

<script>

import updateproduct from '../components/updateproduct.vue';


  export default {

  
    components: {
        updateproduct,
       },
  } 
   


</script>

<style scoped>

</style>