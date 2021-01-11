<template>
    <div v-if="Loading" class="justify-self-center flex justify-center items-center py-20">
        <div class="loader"> </div>
    </div>
    <section v-else class="bg-white py-2">

        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-5">

            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <div>
                      

                    <div class="uppercase tracking-wide font-bold text-xl">
                        <a class="pr-3 inline-block no-underline hover:text-black flex" href="#">
                            Products <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                            </svg>
                        </a>
                    </div>

                </div>

                    <div class="flex items-center" id="store-nav-content">

                        <router-link class="pl-3 inline-block no-underline hover:text-black" :to="{name: 'cart'}">
                        <i class="fill-current hover:text-black fas fa-shopping-basket text-2xl" width="24" height="24" />
                            <b>{{cart_count}} item(s)</b></i>
                        </router-link>

                    </div>
                </div>
            </nav>

        <div v-for="product in products" v-bind:key="products.slug" class="w-1/2 md:w-1/4 p-6 flex flex-col" > 
           
            <router-link :to="{ path: '/product/'+product.slug}">

                    <img v-show="!imgloading" v-if="product.image" class="hover:grow hover:shadow-lg w-full h-40 lg:h-64 object-cover" :src="product.image" style="max-width: 400px;" @load="onImgLoad">

                    <div v-show="imgloading" class="justify-self-center flex justify-center items-center py-10">
                        <div class="loader"> </div>
                    </div>
                   
                    <div class="pt-3 flex items-center justify-between" >
                        <p class="">{{product.name}}</p>
                <!--        <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black" xmlns="http://www.w3.org/20 00/svg" viewBox="0 0 24 24">
                            <path d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                        </svg> -->
                    </div>

                    <div class="flex justify-between pt-1 space-x-1"> 

                        <p class="text-gray-900">Rs. {{product.price}}</p>
                        <p v-if="product.mrp" class="text-gray-900 line-through">Rs. {{product.mrp}}</p>

                    </div>

            </router-link>
            <button class="flex items-center justify-center shadow bg-blue-500 px-4 py-2 text-white hover:bg-blue-400" @click="addCart(product.id)" >
             Add to Cart
            </button>

        </div>
        </div>


<div class="container mx-auto flex justify-center my-8 mt-auto pt-8 pb-">
    <button :class="!pagination.prev_page_url ? 'hidden' : 'block'" class="border border-blue-500 text-blue-500 block rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-blue-500 hover:text-white"@click="fetchProducts(pagination.prev_page_url)">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
            <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
        Previous page
    </button>

    <button :class="!pagination.next_page_url ? 'hidden' : 'block'" class="border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white block rounded-sm font-bold py-4 px-6 ml-2 flex items-center" @click="fetchProducts(pagination.next_page_url)" :disabled = "!pagination.next_page_url">
        Next page
        <svg class="h-5 w-5 ml-2 fill-current" clasversion="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_11_" d="M-24,422h401.645l-72.822,72.822c-9.763,9.763-9.763,25.592,0,35.355c9.763,9.764,25.593,9.762,35.355,0
            l115.5-115.5C460.366,409.989,463,403.63,463,397s-2.634-12.989-7.322-17.678l-115.5-115.5c-9.763-9.762-25.593-9.763-35.355,0
            c-9.763,9.763-9.763,25.592,0,35.355l72.822,72.822H-24c-13.808,0-25,11.193-25,25S-37.808,422-24,422z"/>
        </svg>
    </button>
</div>



    </section>
</template>

<script>


    export default {


         data(){
                return {

                    products : [],
                    product: {
                        id: '',
                        name: '',
                        description: '',
                        slug: '',
                        units: '',
                        image: '',
                        price: '',
                        mrp: '', 
                        
                    }, 

                product_id: '',
                pagination: {},
                edit: false,
                carts: [],
                cartadd:{
                    id: '',
                    name: '',
                    price: '',
                   // amount: '',
                   // units: '',

                },

                cart_count: '',
                quantity: '1',
                totalprice: '0',
                Loading: true,
                imgloading: true,

                }
            },

            

//mounted() & created()  almost same
            created() {
                this.fetchProducts();
                this.fetchCount();
                this.fetchCarts();

                //this.$eventBus.$on('cart-add', this.getCart);

            },
/*

//Without Pagination

            methods: {
                fetchProducts() {
                    fetch('/api/products')
                    .then(res => res.json())
                    .then(res => {
                        this.products = res.data;

                    })
                }
            }    
*/

//with Pagination

methods: {



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

                            this.fetchCarts();
                            this.fetchCount();
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

             fetchCarts() {
                    fetch('/api/cart', {

                                
                                //body: JSON.stringify(this.user),
                                headers: {
                                    
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })
                    .then(res => res.json())
                    .then(res => {
                        this.carts = res.data;
                    })
                },




                fetchCount() {

                fetch('/api/count-total', {

                                
                                //body: JSON.stringify(this.user),
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



    
             fetchProducts(page_url) {
                    let vm = this;
                    page_url = page_url || '/api/products'
                    fetch(page_url, {

                                headers: {
                                    'Store_Key': 'WackAMolE'
                                }
                            })

                    .then(res => res.json())
                    .then(res => {
                        this.products = res.data;
                        vm.makePagination(res.meta, res.links);
                        this.Loading = false;
                    })
                    .catch(err => console.log(err));

                },

                makePagination(meta, links) {
                    let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                    total: meta.total,
                    per_page: meta.per_page,
                    }

                    this.pagination = pagination;
                },

                onImgLoad() {
                    this.imgloading = false
                }
            }

       
    }
</script>

<style scoped>

</style>