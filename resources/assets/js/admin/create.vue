<template>

    <div class="bg-yellow-200 bg-cover bg-center" id="create">

            <div class="container max-w-4xl mx-auto pt-5 mb-20 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                   Create a New Product
                </p>
                <p class="text-sm text-black">Fields Marked * are Important</p>
            </div>

<createform>
</createform>

    </div>

</template>

<script>

   import createform from '../components/createform.vue';

  export default {
    components: {
        createform,
       },
   }
</script>

<style scoped>

</style>