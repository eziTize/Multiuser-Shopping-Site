<template>
	<div class=" mx-auto container flex flex-wrap">
    <div class="w-full">
      <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
          <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(1)" v-bind:class="{'text-blue-600 bg-white': openTab !== 1, 'text-white bg-blue-600': openTab === 1}">
            Profile
          </a>
        </li>
        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
          <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(2)" v-bind:class="{'text-blue-600 bg-white': openTab !== 2, 'text-white bg-blue-600': openTab === 2}">
            Orders
          </a>
        </li>
 <!--        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
          <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(3)" v-bind:class="{'text-blue-600 bg-white': openTab !== 3, 'text-white bg-blue-600': openTab === 3}">
            Options
          </a>
        </li> -->
      </ul>
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
        <div class="px-4 py-5 flex-auto">
          <div class="tab-content tab-space">
            
            <div v-bind:class="{'hidden': openTab !== 1, 'block': openTab === 1}">
              	   <div class="container mx-auto my-5 md:my-40">
					<div class="flex justify-center px-6 my-5 md:my-40">
						<updateuserform>
						</updateuserform>
					</div>
					</div>
            </div>
            
            <div v-bind:class="{'hidden': openTab !== 2, 'block': openTab === 2}">
              <orders></orders>
            </div>
            
      <!--      <div v-bind:class="{'hidden': openTab !== 3, 'block': openTab === 3}">
              <p>
                Efficiently unleash cross-media information without
                cross-media value. Quickly maximize timely deliverables for
                real-time schemas.
                <br />
                <br />
                Dramatically maintain clicks-and-mortar solutions
                without functional solutions.
              </p>
            </div> -->


          </div>
        </div>
      </div>
    </div>
  </div>		

</template>


<script>

import updateuserform from '../components/updateuserform.vue';
import orders from '../components/orders.vue';


    export default {

    	name: "blue-tabs",
		data() {
		    return {
		      openTab: 1
		    }
		  },
		  methods: {
		    toggleTabs: function(tabNumber){
		      this.openTab = tabNumber
		    }
		  },

        components: {
            updateuserform,
            orders,
        },
    }
</script>

<style scoped>

</style>


