<template>

<div v-if="!isLoggedIn" class="py-20 flex justify-center">
        <h1 class="text-3xl">
            You Must Login To Access The Cart
        </h1>
</div>

<div v-else class="text-gray-900 bg-white">
    
    <div v-if="Loading" class="justify-self-center flex justify-center items-center py-20">
            <div class="loader"> </div>
    </div>

    <div v-if="!Loading" class="pt-5 pb-2 flex justify-center">
        <h1 class="text-3xl">
            Your Cart
        </h1>
    </div>
<body v-if="!Loading" class="flex items-center justify-center bg-white mx-4">
    <div class="container">
        <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
            <thead class="text-white">
                <tr v-for="cart in carts" v-bind:key="carts.cart_id" class="bg-blue-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-center">Product</th>
                    <th class="p-3 text-center">Quantity</th>
                    <th class="p-3 text-center">Unit Price</th>
                    <th class="p-3 text-center">Total Price</th>
                    <th class="p-3 text-center">Options</th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                <tr v-for="(cart, n) in carts" v-bind:key="cart.id" class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                    <td class="border-grey-light border hover:bg-gray-100 p-3 text-center">{{cart.product}}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 flex justify-center">

                        <button class=" mx-5 text-sm bg-green-600 hover:bg-green-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" @click="IncrCart(cart.cart_id)" ><i class="fas fa-plus text-xs"></i></button>
                            
                            <p class="px-5 text-center" v-model="cart.quantity"> {{cart.quantity}} </p>

                        <button class=" mx-5 text-sm bg-red-600 hover:bg-red-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" @click="DecrCart(cart.cart_id)" ><i class="fas fa-minus text-xs" ></i></button>
                        
                    </td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate text-center"> Rs. {{cart.unit_price}} </td>

                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate text-center"> Rs. {{cart.total}} </td>

                    <td class="border-grey-light border-t hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer text-center">
                        
                    <button class=" mx-5 text-sm bg-red-700 hover:bg-red-900 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" @click="removeCart(cart.cart_id)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>

                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 border-t border-black items-center">
                    <td> </td>
                    
                    <td class="text-2xl text-center"> Total </td>

                    <td> </td>

                    <td class="text-center text-2xl text-right"> Rs. {{cart_total}} <p v-if="dlv_fee>0" class="text-xl"> + Rs. {{dlv_fee}} </p>
                    <p v-if="dlv_fee>0" class="text-blue-500 text-base"> (Delivery Fee Applied for orders below Rs. 400) </p> 
                    <p class="text-orange-500"> </p>
                    </td>

                    <td> </td>
                </tr>
            </tbody>
        </table>
         <div v-if="cart_count" class="w-full px-4 pb-10 flex justify-between">
            <router-link :to="{ path: '/checkout'}">
                <button class=" shadow bg-blue-600 hover:bg-blue-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                    Pay with PayTM
                </button>
            </router-link>

            <router-link :to="{ path: '/cod'}">
                <button class=" shadow bg-indigo-600 hover:bg-indigo-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                    Cash On Delivery
                </button>
            </router-link>
     </div>
    </div>

</body>
        <p v-if="!Loading && carts<1" class="text-2xl text-red-700 text-center"> No Item in your cart!</p>

        
 </div>
</template>

<script>
    export default {
        name: "sCart",

         data(){
                return {

                    carts:[],
                    
                    cart: {

                        cart_id: '',
                        product: '',
                        quantity: '',
                        unit_price: '',
                        total: '',
                    },
                   
                    products : [],
                    product: {
                        
                        id: '',
                        name: '',
                        description: '',
                        slug: '',
                       // units: '',
                        //image: '',
                        price: '',
                        
                    }, 

                product_id: '',
                pagination: {},            

                badge: '0',
                quantity: '1',
                totalprice: '0',
                cart_total: '',
                cart_count: '',
                dlv_fee: '',
                Loading: true,


                isLoggedIn: localStorage.getItem('Store.jwt') != null,


                }
            },

        mounted() {

                 //this.fetchProducts();
                 this.fetchCarts();
                 this.fetchCount();

            },

            methods: {
    
           /*  fetchProducts(page_url) {
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
                
                */

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
                        this.cart_total = res.cart_total;
                        this.dlv_fee = res.dlv_fee;
                    })

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
                        this.fetchCount();
                        this.Loading = false;
                    })
                },


                removeCart(id) {

                     if(confirm('Remove product from cart?')) {

                        fetch(`/api/remove-from-cart/${id}`, 
                        {

                                method: 'delete',
                                headers: {
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

                },




               /* fetchTotal() {

                fetch('/api/count-total', {
                                
                                //body: JSON.stringify(this.user),
                                headers: {
                                    
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })
                    .then(res => res.json())
                    .then(res => {
                        this.cart_total = res.cart_total;
                        this.dlv_fee = res.dlv_fee;
                    }) 

        },*/


        IncrCart(id) {


                fetch(`/api/incr-from-cart/${id}`, {

                                method: 'put',
                                body: JSON.stringify(this.cart),
                                headers: {
                                    'content-type': 'application/json',
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })

                        .then(res => res.json())
                        .then(data => {


                            alert('Cart Updated');
                            this.fetchCarts();
                            this.fetchCount();
                        })  

                      .catch(err => console.log(err));

        },


        DecrCart(id) {

            fetch(`/api/decr-from-cart/${id}`, {

                                method: 'put',
                                body: JSON.stringify(this.cart),
                                headers: {
                                    'content-type': 'application/json',
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })

                        .then(res => res.json())
                        .then(data => {

                            alert('Cart Updated');
                            this.fetchCarts();
                            this.fetchCount();


                        })  

                      .catch(err => console.log(err));

        },


      }

    }
</script>

<style scoped>
 html,
  body {
    height: 100%;
  }

  @media (min-width: 640px) {
    table {
      display: inline-table !important;
    }

    thead tr:not(:first-child) {
      display: none;
    }
  }

  td:not(:last-child) {
    border-bottom: 0;
  }

  th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
  }
</style>