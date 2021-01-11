<template>
 <div class="container mx-auto px-6 py-2 pb-20 flex justify-around items-center ">

        <form @submit.prevent="addProduct" class="w-full max-w-lg">

		   <div class="flex flex-wrap -mx-3 mb-6">
		    	<div class="w-full px-3">
		      <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="grid-password">
		        Product Name *
		      </label>
		      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="productname" type="text" v-model="product.name">
		      <p class="text-gray-600 text-xs italic">Remove if not needed</p>
		    </div>
		  </div>

         <div class="flex flex-wrap -mx-3 mb-6">
		    	<div class="w-full px-3">
		      <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="grid-password">
		        Slug *
		      </label>
		      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="slug" type="string" v-model="product.slug">
		      <p class="text-gray-600 text-xs italic">Remove if not needed</p>
		    </div>
		  </div>

<div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="grid-price">
                    Price (INR) *
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="price" type="double" placeholder="Numbers Only" v-model="product.price">
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="grid-units">
                    Units Available
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-units" type="integer" placeholder="Numbers Only">
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="grid-password">
                    Description
                </label>
                <textarea class=" no-resize appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none" id="message" v-model="product.description" ></textarea>
                <p class="text-black text-xs italic">Re-size can be disabled by set by resize-none / resize-y / resize-x / resize</p>
            </div>
        </div>

        <!-- This is an example component -->
        <div class="flex flex-wrap -mx-3 mb-6 relative inline-flex">
          <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
          <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" v-model="product.category_name">
            <option v-for="category in categories" v-bind:key="category.id" >{{category.name}}</option>
          </select>
        </div>

        <div class="md:flex md:items-center">
            <div class="md:w-1/3">
                <button class="shadow bg-teal-400 hover:bg-teal-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
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
                        //units: '',
                        //image: '',
                        price: '', 
                        category_name: '',
                        
      
                    }, 

                categories : [],
                 category: {
                        id: '',
                        name: '',
                    }, 
                product_id: '',
                edit: false
                }
            },

            created() {
                this.fetchProducts();
            },


             methods: {
                fetchProducts() {
                    fetch('/api/products',{

                                headers: {
                                    'Store_Key': 'WackAMolE'
                                }

                        })
                    .then(res => res.json())
                    .then(res => {
                        this.products = res.data;

                    })

                    fetch('/api/categories',{

                                headers: {
                                    'Store_Key': 'WackAMolE'
                                }

                        })
                    .then(res => res.json())
                    .then(res => {
                        this.categories = res.data;

                    })
                },

                addProduct() {
                

                		//Add

                		fetch('/api/product', {

                				method: 'post',
                				body: JSON.stringify(this.product), 
                				headers: {
                					'content-type': 'application/json',
                                    'Store_Key': 'WackAMolE'
                				}

                		})

                		.then(res => res.json())
                		.then(data => {

                			this.product.name = '';
                            this.product.category_name = '';
                			this.product.slug = '';
                			this.product.description = '';
                			this.product.price = '';
                			alert('Product Added');
                			this.fetchProducts();

                		})	

            
                },

                editProduct(product) {

                	this.edit = true;
                	
                	this.product.name = product.name;
                    this.product.category_name = product.category_name;
                	this.product.slug = product.slug;
                	this.product.description = product.description;
                	this.product.price = product.price;
                }

            }    
    }
</script>

<style scoped>

</style>