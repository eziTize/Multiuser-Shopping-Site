<template>

<div  class="text-gray-900 bg-gray-200 px-2">

    <div class="pt-5 pb-2 flex justify-center">
        <h1 class="text-3xl">
            Your Orders
        </h1>
    </div>
<body class="flex items-center justify-center bg-white">
    <div class="container">
        <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
            <thead class="text-white">
                <tr v-for="order in orders" v-bind:key="orders.id" class="bg-blue-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-center">Txn ID</th>
                    <th class="p-3 text-center">Address</th>
                    <th class="p-3 text-center">Phone</th>
                    <th class="p-3 text-center">Amount</th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-center">Type</th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                <tr v-for="order in orders" v-bind:key="order.id" class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                    <td class="border-grey-light border hover:bg-gray-100 p-3 text-center">{{order.transaction_id}}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 text-center">{{order.address}}</td>
                    
                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate text-center"> {{order.ph_no}} </td>

                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate text-center"> Rs. {{order.amount}} </td>

                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate text-center"> {{order.status}} </td>

                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate text-center"> {{order.type}} </td>
                 
                </tr>

                
            </tbody>
        </table>
    </div>

</body>

        
 </div>
</template>

<script>
    export default {
        name: "orders",

         data(){
                return {

                    orders:[],
                    
                    order: {

                        id: '',
                        ph_no: '',
                        transaction_id: '',
                        email: '',
                        amount: '',
                        address: '',
                        status: '',
                        is_delivered: '',
                        type: 'N/A',
                    },

                }
            },

        mounted() {

                 this.fetchOrders();

            },

            methods: {

                fetchOrders() {
                    fetch('/api/orders', {

                                
                                //body: JSON.stringify(this.user),
                                headers: {
                                    
                                    'Store_Key': 'WackAMolE',
                                    'Authorization': 'Bearer ' + localStorage.getItem('Store.jwt')
                                }

                        })
                    .then(res => res.json())
                    .then(res => {
                        this.orders = res.data;
                    })
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