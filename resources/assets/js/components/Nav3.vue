<template>
    <nav>
    <div class="container mx-auto px-6 py-2 flex justify-between items-center">
                            Dashboard
            <div>
             <ul class="inline-flex">

                    <li> 
                        <button class="px-4 hover:text-gray-800" v-if="isLoggedIn"> Hi, {{user.name}} </button>
                            
                    </li>



                    <li> 
                        <button class="px-4 hover:text-gray-800"> Your Cart has {{badge}} Items  </button>
                            
                    </li>

                    

                </ul>

        </div>
    </div>

    </nav>

</template>

<script>
    export default {
        data() {
            return {

                users: [],
                user: {
                    name: '',
                    email: '',

                },
                //name: null,
                //user_type: 0,
                isLoggedIn: localStorage.getItem('Store.jwt') != null,
                badge: '0',
            }
        },

        mounted() {
            this.setDefaults();
            this.viewCart();

        },

        methods : {

            
                viewCart() {

                    if(localStorage.getItem('carts')) {
                        this.carts = JSON.parse(localStorage.getItem('carts'));
                        this.badge = this.carts.length;
                        this.totalprice = this.carts.reduce((total, item)=>{
                            return total + this.quantity * item.price;
                        }, 0);
                    }

                },

                addCart() {

                    this.badge = 1


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
        }
    }

    
</script>

<style scoped>
a.router-link-exact-active {
 @apply text-blue-400 font-bold;
}
</style>