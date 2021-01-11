<template>

<div class="bg-indigo-700 h-full py-32 pb-40" id="cod">
    
    <div v-if="!loading" class="mx-auto text-center break-normal ">
        <!--Title-->
        <p class="text-white font-extrabold text-xl md:text-2xl py-10">
            Please Enter The below Details For Delivery
        </p>
    </div>


    <div v-else class="mx-auto text-center break-normal ">
        <!--Title-->
        <p class="text-white font-extrabold text-xl md:text-2xl py-10">
            Please wait.. Your order is being processed..
        </p>
    </div>

    <div v-if="loading" class="justify-self-center flex justify-center items-center py-20">
        <div class="loader"> </div>
    </div>

    
    <div v-else class="container mx-auto px-6 flex justify-around items-center ">

        <form @submit.prevent="makeCOD" class="w-full max-w-lg">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="email">
                    Contact Email
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" placeholder="Email Address" v-model="order.email">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="ph_no">
                    Contact Number
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="ph_no" type="number" placeholder="Phone Number" v-model="order.ph_no">
            </div>
        </div>

         <div class="w-full mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="address">
                    Delivery Address
                </label>
                <textarea class="no-resize appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-20 resize-none" id="address" placeholder="Delivery Address" v-model="order.address"> </textarea>
        </div>

        <div class="md:flex md:items-center pt-5">
            <div class="md:w-1/3">
                <button class="shadow bg-green-500 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    Place Order
                </button>
            </div>
        </div>
    </form>
 </div>
</div>

</template>

<script>
    export default {
         data(){
                return {
                    order: {
                        email: '',
                        ph_no: '',
                        address: '',
                    },
                    loading: false,
                }
            },

            mounted() {
                this.setDefaults();
            },
             methods: {

               makeCOD() {
                        this.loading = true;

                        fetch('/api/cod', {

                                method: 'post',
                                body: JSON.stringify(this.order),
                                headers: {
                                    'content-type': 'application/json',
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')

                                }

                        })

                        .then(res => res.json())
                        .then(data => {

                            //window.location.replace("/order-placed");

                        })

                        .catch((error) => {
                            // handle this error here
                            alert('Order Failed');
                            //window.location.replace("/");
                        })

            
                },

             setDefaults() {

                    if (localStorage.getItem('Store.jwt')) {
                     
                      fetch('/api/details', {
                                
                                headers: {
                                    
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }
                        })

                        .then(res => res.json())

                        .then(res => {
                        this.order.email = res.data.email;

                        if(res.data.ph_no !== 'N/A'){

                            this.order.ph_no = res.data.ph_no;

                        }
                        
                    })
                }      
                     
            },


            }    
    }
</script>

<style scoped>

</style>