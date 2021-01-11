<template> 

        <div class="container mx-auto px-4 py-2">

<div class="flex flex-wrap ">


     <!-- Form to Edit/Create Products -->

            <div class="w-full lg:w-1/3 mb-20 px-">
              <form @submit.prevent="updateProduct" class="w-full max-w-lg">

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

            <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="grid-password">
                    Category
            </label>

        <div class="flex flex-wrap -mx-3 mb-6 px-2 relative inline-flex">
          <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
          <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" v-model="product.category_name">
            <option v-for="category in categories" v-bind:key="category.id" >{{category.name}}</option>
          </select>
        </div>

        <div class="md:flex md:items-center">
            <div class="md:w-1/3">
                <button class="shadow bg-teal-400 hover:bg-teal-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    Update
                </button>
            </div>
        </div>
    </form>
            </div>

     <!-- End Form to Edit/Create Products -->


            <!-- Table with Product Details -->


            <div class="w-full lg:w-2/3 pl-24">
             <table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase shadow bg-teal-400 text-gray-600 border border-gray-300 hidden lg:table-cell">Product name</th>
            <th class="p-3 font-bold uppercase shadow bg-teal-400 text-gray-600 border border-gray-300 hidden lg:table-cell">Price</th>
            <th class="p-3 font-bold uppercase shadow bg-teal-400 text-gray-600 border border-gray-300 hidden lg:table-cell">Slug</th>
            <th class="p-3 font-bold uppercase shadow bg-teal-400 text-gray-600 border border-gray-300 hidden lg:table-cell">Category</th>
            <th class="p-3 font-bold uppercase shadow bg-teal-400 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
        </tr>
    </thead>
    <tbody>
       
        <tr v-for="product in products" v-bind:key="products.slug" class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Product name</span>
                <br>{{product.name}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Price</span>
               <br> {{product.price}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Slug</span>
               <br> {{product.slug}}
            </td>

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Category</span>
               <br> {{product.category_name}}
            </td>

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                <br>
                <a href="#" class="text-blue-400 hover:text-blue-600 underline" @click="editProduct(product)">Edit</a>
                <a href="#" class="text-blue-400 hover:text-blue-600 underline pl-6" @click="deleteProduct(product.id)">Remove</a>
                <br>

            </td>
        </tr>
        
    </tbody>

</table>
            <!-- End Table with Product Details -->


<!-- Pagination -->

<div class="container mx-auto flex justify-center my-8 mt-auto pt-8 mb-10 pb-5">
    <button :class="!pagination.prev_page_url ? 'hidden' : 'block'" class="relative block py-2 px-3 leading-tight bg-white border border-gray-300  border-r-0 ml-0 rounded-l hover:bg-gray-200" @click="fetchProducts(pagination.prev_page_url)">
        Previous
    </button>

  <li class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 hover:bg-gray-200"><a class="page-link" href="#">{{pagination.current_page}}</a></li>
  <button :class="!pagination.next_page_url ? 'hidden' : 'block' " class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 rounded-r hover:bg-gray-200" @click="fetchProducts(pagination.next_page_url)">
        Next
    </button>

</div>

<!-- End Pagination -->


</div>


</div>


<!-- Create Product Link Button -->
 <div class="flex justify-center mb-6">


                      <p> Need To Add New Products? <br>

<router-link :to="{ path: '/admin/create-products'}">
                <button class="shadow bg-teal-400 hover:bg-teal-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                    Create  A New Product
                </button>

</router-link>

                </p> 
        </div>
<!-- End Create Product Link Button -->

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
                pagination: {},
                edit: true
                }
            },
            

//mounted() & created()  almost same
            created() {
                this.fetchProducts();
                this.fetchCategories();

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
                    })

                  
                    .catch(err => console.log(err));

                },



                fetchCategories() {
                   fetch('/api/categories', {

                                headers: {
                                    'Store_Key': 'WackAMolE'
                                }

                        })
                    .then(res => res.json())
                    .then(res => {
                        this.categories = res.data;

                    })
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



                deleteProduct(id) {

                     if(confirm('Are you sure?')) {

                        fetch(`/api/product-edit/${id}`, 
                        {

                                method: 'delete',
                                headers: {
                                    'Store_Key': 'WackAMolE'
                                }

                        })

                        .then(res => res.json())
                        .then(data => {

                            alert('Product Deleted');
                            this.fetchProducts();
                        })
                        .catch(err => console.log(err));

                     }

                },


                updateProduct() {
           

                        // Update



                        fetch('/api/product-edit', {

                                method: 'put',
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
                            alert('Product Updated');
                            this.fetchProducts();

                        })  

                      .catch(err => console.log(err));

                
                },

                editProduct(product) {

                    this.edit = true;
                    this.product.product_id = product.id;
                    this.product.category_name = product.category_name;
                    this.product.name = product.name;
                    this.product.slug = product.slug;
                    this.product.description = product.description;
                    this.product.price = product.price;
                }

        }
       
    }
</script>

<style scoped>

</style>