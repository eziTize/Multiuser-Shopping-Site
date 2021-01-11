<template>
     <div v-if="cloading" class="justify-self-center flex justify-center items-center py-10">
        <div class="loader"> </div>
    </div>
    <main class="my-8" v-else>
        <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-end mt-0 px-2 py-3">

                    <div class="flex items-center" id="store-nav-content">

                        <router-link class="pl-3 inline-block no-underline hover:text-black" :to="{name: 'cart'}">
                        <i class="fill-current hover:text-black fas fa-shopping-basket text-2xl" width="24" height="24" />
                            <b>{{cart_count}} item(s)</b></i>
                        </router-link>

                    </div>
                </div>
            </nav>
        <div class="container mx-auto px-6">
            <div class="md:flex md:items-center">
                <div class="w-full h-full">
                    <img v-if="product.image" v-show="!imgloading2" class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="'/' + product.image" alt="product image" @load="onImgLoad2">

                    <div v-show="imgloading2" class="justify-self-center flex justify-center items-center py-10">
                        <div class="loader"> </div>
                    </div> 

                </div>
                <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                    <h3 class="text-gray-700 uppercase text-lg">{{product.name}}</h3>

                    <div class="flex flex-col space-y-2">
                        <span class="text-lg text-gray-700 mt-3">Rs. {{product.price}}</span>
                        <span v-if="product.mrp" class="text-lg text-gray-500 mt-1 line-through">Rs. {{product.mrp}}</span>
                    </div>
                    <hr class="my-3">
                    <div class="flex items-center mt-6">
                        <button class="px-12 py-3 bg-blue-500 text-white text-sm font-medium hover:bg-blue-600 focus:outline-none focus:bg-blue-600" @click="addCart(product.id)">Add to cart</button>
                    </div>
                </div>
            </div>
            <div class="container mx-auto mt-12 flex- flex-col items-center"> 
                <p class="font-bold text-2xl text-gray-600 border-b border-gray-500"> Description </p>

                <pre class="parag text-base font-sans mt-5">{{product.description}}</pre>
            </div>
            <div class="mt-16">
             <h3 class="text-gray-600 text-2xl font-medium font-sans">More Products:</h3>
                <div class="flex items-center flex-wrap">
                <div v-for="rproduct in rproducts" v-bind:key="rproducts.slug" class="w-1/2 md:w-1/4 p-6 flex flex-col" > 
           
                <router-link :to.native="{ path: '/product/'+ rproduct.slug}">

                    <img v-show="!imgloading" v-if="rproduct.image" class="hover:grow hover:shadow-lg w-full h-40 lg:h-64 object-cover" :src="'/' + rproduct.image" style="max-width: 400px;" @load="onImgLoad">

                    <div v-show="imgloading" class="justify-self-center flex justify-center items-center py-10">
                        <div class="loader"> </div>
                    </div>
                   
                    <div class="pt-3 flex items-center justify-between" >
                        <p class="">{{rproduct.name}}</p>
                    </div>

                    <div class="flex justify-between pt-1 space-x-1"> 

                        <p class="text-gray-900">Rs. {{rproduct.price}}</p>
                        <p v-if="rproduct.mrp" class="text-gray-900 line-through">Rs. {{rproduct.mrp}}</p>

                    </div>

                </router-link>
                    <button class="flex items-center justify-center shadow bg-blue-500 px-4 py-2 text-white hover:bg-blue-400" @click="addCart(rproduct.id)" >
                     Add to Cart
                    </button>
            </div>
        </div>
            </div>
        </div>
    </main>
</template>


<script>

    export default {

         data(){
                return {
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
                    product: {
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

                totalprice: '0',
                imgloading: true,
                imgloading2: true,
                cloading: true,

                }
            },
            


        mounted() {
                this.fetchProduct();
                this.fetchCount();
                this.fetchrProducts();
            },

        watch: {
            $route(to, from) {

                this.fetchProduct();
                this.fetchCount();
                this.fetchrProducts();
                window.scrollTo(0, 0);
            }
        },


        methods: {


            fetchrProducts() {
                    fetch('/api/r-products', {
                                headers: {
                                    'Store_Key': 'WackAMolE'
                                }
                        })
                    .then(res => res.json())
                    .then(res => {
                        this.rproducts = res.data;
                        this.cloading = false;
                    })
                },
                
            fetchProduct() {
                                
                                fetch(`/api/product/${this.$route.params.slug}`, {
                                headers: {
                                    'Store_Key': 'WackAMolE'
                                }
                        })
                                    .then(res => res.json())
                                    .then(res => {
                                        this.product = res.data;
                                    })
                                },
            
            addCart(id) {
                    
                    if(localStorage.getItem('Store.jwt')){

                    fetch(`/api/add-to-cart/${id}`, 
                        {

                                method: 'post',
                                headers: {

                                    'Content-Type': 'application/json',
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })

                        .then(res => res.json())
                        .then(data => {

                            alert('Product Added');
                            this.fetchCount();
                            this.fetchProduct();
                        })
                        .catch(err => console.log(err));

                    }


                    else{

                        alert('Must login to add products');
                        if(confirm('Login to add products?')){

                            //window.location.replace("/login")
                            this.$router.push(('/login'))
                    }

                  }

                },
                fetchCount() {

                fetch('/api/count-total', {
                                
                                headers: {
                                    
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })
                    .then(res => res.json())
                    .then(res => {
                        this.cart_count = res.cart_count;
                    })

                },
                onImgLoad() {
                    this.imgloading = false
                },
                onImgLoad2() {
                    this.imgloading2 = false
                },
            }

       
    }
</script>

<style scoped>
div .parag{
    white-space: pre-wrap;
    overflow-wrap: break-word;
    word-wrap: break-word;
    -ms-word-break: break-all;
    word-break: break-all;
    word-break: break-word;
    -ms-hyphens: auto;
    -moz-hyphens: auto;
    -webkit-hyphens: auto;
    hyphens: auto;
    min-width: -webkit-min-content;
    min-width: min-content;
    min-width: -moz-min-content;
    max-width: -webkit-max-content;
    max-width: max-content;
    max-width: -moz-max-content;
}
</style>