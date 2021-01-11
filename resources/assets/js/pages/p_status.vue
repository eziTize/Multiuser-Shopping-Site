<template>

   <div  class="text-gray-900 bg-gray-200">

    <div v-if="successful" class="py-20 flex justify-center">
        <h1 class="text-3xl text-green-500">
            Payment Successful.
        </h1>
    </div>


    <div v-if="failed" class="py-20 flex justify-center">
        <h1 class="text-3xl text-red-500">
            Payment Failed
        </h1>
    </div>


    <div v-if="pending" class="py-20 flex justify-center">
        <h1 class="text-3xl text-orange-500">
            Payment Pending
        </h1>
    </div>

   </div>

</template>

<script>
    //import sCart from '../components/sCart.vue';

    export default {

        //components: {
           // sCart,
        //},
			
		data(){
                return {

                	successful: false,
                	failed: false,
                	pending: false,


                }
            },

         created() {

                 this.fetchPayment();
         
            },


         methods: {


                fetchPayment() {

                fetch('/payment/status', {
                                
                                //body: JSON.stringify(this.user),
                                headers: {
                                    
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })
                    .then(res => res.json())
                    .then(res => {
                        if(res == Successful){

                        	this.successful = true;

                        }

                        if(res == Failed){

                        	 this.failed = true;
                        }

                         if(res == Open){

                        	 this.pending = true;
                        }

                    })

        },
      }

    };



</script>

<style scoped>
</style>