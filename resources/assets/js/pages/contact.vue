<template>

    <div class="bg-blue-500 bg-cover bg-center" id="contact" style="background-image:url('/images/mail_img.svg');">

            <div class="container max-w-4xl mx-auto pt-16 md:pt-32 text-center break-normal">
                <!--Title-->
                <p class="text-white font-extrabold text-3xl md:text-5xl">
                   Contact Us
                </p>
                <p class="text-xl md:text-2xl text-black">Have questions? Reach us out!</p>
            </div>
<contactform>

</contactform>
    </div>

</template>

<script>

    import contactform from '../components/contactform.vue';

    export default {
        components: {
            contactform,
        },
    }
</script>

<style scoped>

</style>