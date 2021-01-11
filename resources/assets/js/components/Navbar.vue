<template>
    <nav>
        <div class="mx-auto flex justify-between items-center px-6 py-4 bg-white shadow-xl border-b-2">

            

            <router-link tag="logo" :to="{name: 'home'}" class="font-bold text-2xl lg:text-4xl text-blue-500">
                            AC Enterprise
            </router-link>
            <div class="block lg:hidden">
                <button @click="isOpen = !isOpen" type="button" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-teal-500 appearance-none focus:outline-none">
                    <svg class=" h-5 w-5 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:block">
                <ul class="inline-flex">

                    <li>
                        <router-link  :to="{name: 'home'}" class="px-4">Home</router-link>
                    </li>

                  <!-- <li>

                        <router-link :to="{name: 'contact'}" class="px-4 hover:text-gray-800" > Contact </router-link>
                        
                        <router-link  to="/contact" class="px-4 hover:text-gray-800">Contact</router-link> 
                    </li> -->

                    <li>
                        <router-link :to="{name: 'store'}" class="px-4 hover:text-gray-800">Store</router-link>
                    </li>

                    <li> 

                         <router-link :to="{name: 'login'}" class="px-4 hover:text-gray-800" v-if="!isLoggedIn">Login</router-link>
                        
                    </li>


                    <li> 
                         <router-link :to="{name: 'register'}" class="px-4 hover:text-gray-800" v-if="!isLoggedIn">Register</router-link>
                            
                    </li>

                    <li> 
                        <router-link :to="{name: 'dashboard'}" class="px-4 hover:text-gray-800" v-if="isLoggedIn"> Dashboard </router-link>
                            
                    </li>

                    <li> 
                        <button class="px-4 hover:text-gray-800" v-if="isLoggedIn" @click="logout"> Logout</button>
                            
                    </li>



              <!--      <li> 
                        <button class="px-4 hover:text-gray-800" > {{badge}}  </button>
                            
                    </li> -->

                    

                </ul>



            </div>
        </div>
        <div :class="isOpen ? 'block' : 'hidden'" class="px-2 pt-2 pb-4">
            <router-link :to="{name: 'home'}" class="block px-2 py-1 text-black font-semibold rounded hover:bg-gray-800">Home</router-link>
           <!-- <router-link :to="{name: 'contact'}" class="mt-1 block px-2 py-1 text-black font-semibold rounded  hover:bg-gray-800">Contact</router-link> -->
            <router-link :to="{name: 'store'}" class="mt-1 block px-2 py-1 text-black font-semibold rounded hover:bg-gray-800">Store</router-link>
            <router-link :to="{name: 'login'}" class="mt-1 block px-2 py-1 text-black font-semibold rounded hover:bg-gray-800" v-if="!isLoggedIn">Login</router-link>
            <router-link :to="{name: 'register'}" class="mt-1 block px-2 py-1 text-black font-semibold rounded hover:bg-gray-800" v-if="!isLoggedIn">Register</router-link>
            <router-link :to="{name: 'dashboard'}" class="mt-1 block px-2 py-1 text-black font-semibold rounded hover:bg-gray-800" v-if="isLoggedIn"> Dashboard </router-link>
             <button class="mt-1 block px-2 py-1 text-black font-semibold rounded hover:bg-gray-800" v-if="isLoggedIn" @click="logout"> Logout </button>

        </div>

    </nav>

</template>



//Might be helpful later on
created() {
            axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("Store.jwt");
            
        }

<script>
    export default {
        data() {
            return {

                users: [],
                user: {
                    name: '',
                    email: '',
                    is_logged: ''

                },
                isOpen: false,
                //name: null,
                //user_type: 0,
                isLoggedIn: localStorage.getItem('Store.jwt') != null,
               // name_user: null,
                badge: '0',
            }
        },

        mounted() {
            this.setDefaults();
            this.viewCart();
            this.$eventBus.$on('cart-add', this.getCart);

        },

        methods : {

                getCart(badge) {


                    this.badge = badge;


                },
                
                removeCart(product) {

                    this.cartadd.splice(product, 1);
                    this.storeCart();

                },

                storeCart() {

                    let parsed = JSON.stringify(this.carts);
                    localStorage.setItem('carts', parsed);
                    this.viewCart();

                },

            setDefaults() {
                if (this.isLoggedIn) {
                    //let user = JSON.parse(localStorage.getItem('Store.user'))
                    //this.name = user.name
                    //this.user_type = user.is_admin
                     

                      fetch('/api/details', {

                                
                                //body: JSON.stringify(this.user),
                                headers: {
                                    
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })

                    

                        .then(res => res.json())

                        .then(res => {
                        this.user = res.data;

                         //To save in cookies
                         //document.cookie = "Store.jwt =" + this.result.token;


                        })
                }
            },
            change() {
                this.isLoggedIn = localStorage.getItem('Store.jwt') != null;
                this.setDefaults()
            },
            logout(){
                localStorage.removeItem('Store.jwt')
                
                this.change();
                this.$router.push('/')
            },
        }
    }

    
</script>

<style scoped>
a.router-link-exact-active {
 @apply text-blue-400 font-bold;
}
</style>