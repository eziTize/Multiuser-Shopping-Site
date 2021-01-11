<template>
    <div v-if="loading" class="justify-self-center flex justify-center items-center py-10">
        <div class="loader"> </div>
    </div>

    <section class="bg-white py-0 lg:py-2" v-else>

        <div v-if="fproduct>4" class="mx-auto flex items-center flex-wrap md:px-10 py-4 lg:py-8">

            <div class="w-full z-30 top-0 py-2 text-center flex justify-center">
                
                <div class="flex h-0 w-20 md:w-48 lg:w-64 border-2 mt-3 md:mt-5 lg:mt-8"> </div>
                <div class="flex px-4 md:px-10 text-lg md:text-2xl lg:text-4xl font-bold text-gray-900"> Sanitization </div>
                <div class="flex h-0 w-20 md:w-48 lg:w-64 border-2 mt-3 md:mt-5 lg:mt-8"> </div>
            

            </div>

            <div v-for="fproduct in fproducts" v-bind:key="fproducts.slug" class="w-1/2 md:w-1/4 p-4 flex flex-col">
                <router-link :to="{ path: '/product/'+ fproduct.slug}">
                    <img v-if="fproduct.image" v-show="!imgloading" class="hover:grow hover:shadow-lg border-2 border-gray-500" :src="'/' + fproduct.image" @load="onImgLoad">

                    <img v-else class="hover:grow hover:shadow-lg w-full h-40 lg:h-64 object-cover" src="https://cdn.pixabay.com/photo/2016/12/21/16/34/shopping-cart-1923313_960_720.png" style="max-width: 400px;">

                    <div v-show="imgloading" class="justify-self-center flex justify-center items-center py-10">
                        <div class="loader"> </div>
                    </div>

                    <div class="pt-3 flex items-center justify-between">
                        <p class="">{fproduct.name}}</p>
                    </div>
                    <p class="pt-1 text-gray-900">Rs. {{fproduct.price}}</p>
                </router-link>
            </div>

        </div>


        <!-- If no Sanitization products found then display Random Products -->

        <div v-else class="mx-auto flex items-center flex-wrap md:px-10 py-4 lg:py-8">

            <div class="w-full z-30 top-0 py-2 text-center flex justify-center">
                
                <div class="flex h-0 w-20 md:w-48 lg:w-64 border-2 mt-3 md:mt-5 lg:mt-8"> </div>
                <div class="flex px-4 md:px-10 text-lg md:text-2xl lg:text-4xl font-bold text-gray-900"> Products </div>
                <div class="flex h-0 w-20 md:w-48 lg:w-64 border-2 mt-3 md:mt-5 lg:mt-8"> </div>
            

            </div>

            <div v-for="rproduct in rproducts" v-bind:key="rproducts.slug" class="w-1/2 md:w-1/4 p-4 flex flex-col">
                <router-link :to="{ path: '/product/'+ rproduct.slug}">
                    <img v-show="!imgloading" v-if="rproduct.image" class="hover:grow hover:shadow-lg border-2 border-gray-500" :src="'/' + rproduct.image" @load="onImgLoad">

                    <img v-else class="hover:grow hover:shadow-lg w-full h-40 lg:h-64 object-cover" src="https://cdn.pixabay.com/photo/2016/12/21/16/34/shopping-cart-1923313_960_720.png" style="max-width: 400px;">

                    <div v-show="imgloading" class="justify-self-center flex justify-center items-center py-10">
                        <div class="loader"> </div>
                    </div>

                    <div class="pt-3 flex items-center justify-between">
                        <p class="">{{rproduct.name}}</p>
                    </div>
                    <div class="flex justify-between pt-1 space-x-1"> 
                        <p class="text-gray-900">Rs. {{rproduct.price}}</p>
                        <p v-if="rproduct.mrp" class="text-gray-900 line-through">Rs. {{rproduct.mrp}}</p>
                    </div>
                </router-link>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        name: "fshop",

        data(){
                return {
                    fproducts : [],
                    fproduct: {

                        id: '',
                        name: '',
                        description: '',
                        slug: '',
                        units: '',
                        image: '',
                        price: '', 
                        inCart: '',
                        cartId: '',
                        category_name: '',

                    },

                    rproducts : [],
                    rproduct: {

                        id: '',
                        name: '',
                        description: '',
                        slug: '',
                        units: '',
                        image: '',
                        price: '', 
                        inCart: '',
                        cartId: '',
                        category_name: '',

                    },
                    loading: true,
                    imgloading: true,

                }
            },
            


        mounted() {
                this.fetchfProducts();
                this.fetchrProducts();
            },

        methods: {

            fetchfProducts() {
                    fetch('/api/f-products', {
                                headers: {
                                    'Store_Key': 'WackAMolE'
                                }
                        })
                    .then(res => res.json())
                    .then(res => {
                        this.fproducts = res.data;
                        this.loading = false;


                    })
                },

            fetchrProducts() {
                    fetch('/api/r-products', {
                                headers: {
                                    'Store_Key': 'WackAMolE'
                                }
                        })
                    .then(res => res.json())
                    .then(res => {
                        this.rproducts = res.data;
                        this.loading = false;


                    })
                },

            onImgLoad() {
                    this.imgloading = false
                },

        }
    }
</script>

<style scoped>

</style>